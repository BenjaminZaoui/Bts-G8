<?php

namespace Apps\Controller\Users;

use Apps\Core\Controller\Request;
use Apps\Core\Service\DatabaseService;
use Apps\Core\View\TwigCore;
use Apps\Core\Controller\ControllerInterface;
use Apps\Entity\Send;
use Apps\Exception\IncorrectPasswordException;
use Apps\Exception\InvalidPasswordException;
use Apps\Exception\NoPasswordException;
use Apps\Exception\NoUsernameException;
use Apps\Exception\SameUsernameException;
use Apps\Exception\UsernameAlreadyTakenException;
use Apps\Model\InscriptionModel;
use mysql_xdevapi\Exception;
use PhpParser\Node\Stmt\TryCatch;
use Studoo\Api\EcoleDirecte\Client;
use Studoo\Api\EcoleDirecte\Exception\NotDataResponseException;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class InscriptionController implements ControllerInterface
{
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    private $bdd;

    public function __construct()
    {
        $this->bdd = DatabaseService::getConnect();
    }

public function verifMotDePasse($unMDP){
    if (strlen($unMDP) < 8) {
        $verifMDP = false;
    }elseif (!preg_match('/\d/', $unMDP)) {
        $verifMDP = false;
    }elseif (!preg_match('/[a-z]/', $unMDP)) {
        $verifMDP = false;
    }elseif (!preg_match('/[A-Z]/', $unMDP)) {
        $verifMDP = false;
    }elseif (!preg_match('/[\W]/', $unMDP)) {
        $verifMDP = false;
    }else{
        $verifMDP = true;
    }
    return $verifMDP;
}

    public function execute(Request $request)
    {
        $checkInscription = false;
        $inscriptionModel = new InscriptionModel();
        $sendMail = new Send();
        $checkPseudo = false;
        $error = "";
        $errorAPI = "";
        $etudiant = "";
        $verif = false;
        try {

            if (isset($_POST['ChampsIdEcoleDirect']) && isset($_POST['ChampsMotPasseEcoleDirect'])) {
                $client = new Client([
                    "client_id" => $_POST['ChampsIdEcoleDirect'],
                    "client_secret" => $_POST['ChampsMotPasseEcoleDirect'],
                    'verify' => false,
                ]);
                $etudiant = $client->fetchAccessToken();
                $checkPseudo = $inscriptionModel->checkDispoPseudo($_POST['ChampsPseudo']);

                if ($_POST['ChampsPseudo'] == null) {
                    throw new NoUsernameException();
                }
                elseif ($inscriptionModel->checkmail($etudiant->getEmail())){
                    throw new SameUsernameException();
                }
                elseif ($checkPseudo){
                 throw new UsernameAlreadyTakenException();}
                elseif ($_POST['ChampsMotPasse'] == null) {
                    throw new NoPasswordException();
                }

                elseif (!$this->verifMotDePasse($_POST['ChampsMotPasse'])){
                    throw new InvalidPasswordException();
                }

                elseif (!($_POST['ChampsMotPasse'] == $_POST['ChampsConfirmeMotPasse'])) {
                    throw new IncorrectPasswordException();
                }

                else {

                    $password = hash('sha512',$_POST['ChampsConfirmeMotPasse']);
                    $sendMail->SendMail($etudiant->getEmail(), $etudiant->getPrenom(),$etudiant->getTypeCompte());
                    $inscriptionModel->insertStudent($etudiant->getNom(),$etudiant->getPrenom(),$etudiant->getEmail(),$_POST['ChampsPseudo'],$etudiant->getProfile()["classe"]["code"],$password,$etudiant->getTypeCompte());
                    $verif = true;
                }
            }


        } catch (\Exception $e) {
            $error = $e->getMessage();
            $errorAPI = $e->getCode();
        }

        if ($errorAPI == 403) {
           $error = "Votre identifiant ou mot de passe est incorrect";
        }
        if($error != ""){
            $twig = TwigCore::getEnvironment();
            echo $twig->render('home\inscription.html.twig', [
                'visu'=>false,
                'error'=>$error
            ]);
        }
        elseif ($verif == true){
          //TODO faire page confirme inscription
            $twig = TwigCore::getEnvironment();
            echo $twig->render('home\succes.html.twig', [
                'visu'=>false
            ]);
        }
        else {
            $twig = TwigCore::getEnvironment();
            echo $twig->render('home\inscription.html.twig', [
                'visu'=>false
            ]);


        }
    }


}