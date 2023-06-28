<?php

namespace Apps\Controller\Users;

use Apps\Core\Controller\Request;
use Apps\Core\View\TwigCore;
use Apps\Core\Controller\ControllerInterface;
use Apps\Entity\Etudiant;
use Apps\Entity\TimeConnexion;
use Apps\Exception\ConnexionException;
use Apps\Exception\ConnexionTimeException;
use Apps\Exception\DateException;
use Apps\Exception\FullDemandeException;
use Apps\Exception\IncorrectPasswordException;
use Apps\Exception\fieldsNotFilledException;
use Apps\Exception\NoPasswordException;
use Apps\Exception\NoUsernameException;
use Apps\Model\AcceuilTabModel;
use Apps\Model\CRUDSeanceModel;
use Apps\Model\HomeModel;
use Apps\Model\ModifierModel;
use DateTime;
use http\Exception\InvalidArgumentException;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use function PHPUnit\Framework\throwException;

class ModifierController implements ControllerInterface
{
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function execute(Request $request)
    {
        $demandeModel = new ModifierModel();

        $result = $demandeModel->getInfoById($_SESSION['IDDEMANDE']);
        $premiereLigne = $result[0];
        $intitule ="";
        $seanceId =0;
        $matiere ="";
        $description="";
        $nature ="";
        $date ="";
        $heure ="";
        $etat="";


        if (!empty($result)) {
            $premiereLigne = $result[0];
            $intitule = $premiereLigne->getIntitule();
            $seanceId = $premiereLigne->getSeanceId();
            $matiere = $premiereLigne->getMatiere();
            $description = $premiereLigne->getDescription();
            $nature = $premiereLigne->getNature();
            $date = $premiereLigne->getDate();
            $heure = $premiereLigne->getHeure();
            $etat = $premiereLigne->getEtat();
        }
        date_default_timezone_set('Europe/Paris');
        try {
            $sessionTime = new TimeConnexion();

            $acceuilTabModel = new AcceuilTabModel();
            $crudModel = new CRUDSeanceModel();
            $homeModel = new HomeModel();
            $dateActuelle = date('Y-m-d');
            $current_time = date('H:i');
            $_SESSION['Time']="T";
            $errorCode = 0;
            $error = "";


            //$sessionTime->TimeSession();
            if ($_SESSION['authentification'] == null){
                throw new ConnexionException();
            }
            elseif ($homeModel->CheckSessionsId($_SESSION['authentification'])==false){
                throw new  ConnexionException();

            }
            if ($_SESSION['Time']=="F"){
                throw new ConnexionTimeException();
            }
            if (isset($_POST['Champsintituler'])&&isset($_POST['ChampsDescription'])&&isset($_POST['clendrier'])&&isset($_POST['heureBox'])&&isset($_POST['heureBox'])){
            if ($_POST['Champsintituler']==null){
                    throw new fieldsNotFilledException();
            }
            elseif ($_POST['ChampsDescription']==null){
                throw new fieldsNotFilledException();
            }
            elseif ($_POST['clendrier']==null){
                throw new fieldsNotFilledException();
            }
            elseif ($_POST['heureBox']==null){
                throw new fieldsNotFilledException();
            }
            elseif ($_POST['clendrier']<$dateActuelle){
                throw new DateException();
            }
            elseif ($_POST['clendrier'] == $dateActuelle && $_POST['heureBox']<$current_time ){
                throw new DateException();
            }
            else {
                $crudModel->UpdateDemande($_POST['ListeMatiere'],$_POST['ChampsDescription'],"jsp",$_POST['clendrier'],$_POST['heureBox'],0,"en attante d'un assistant",$_POST['Champsintituler'],$_SESSION['IDDEMANDE']);
                header("Location: /Acceuil");
            }

            }
            //TODO afficher les valeurs de la ligne a modifier,
            //TODO mettre un bouton de suppression de la demande





        }catch (\Exception $e){
            $errorCode = $e->getCode();
            $error = $e->getMessage();
        }
        $twig = TwigCore::getEnvironment();
        if ($errorCode == 1007 or $errorCode == 1008){
            session_unset();
            session_destroy();
            header("Location: /");
            exit();
        }

        elseif ($errorCode != 0){
            echo $twig->render('home/modifier.html.twig', [
                'visu' => false,
                'error'=>$error,
                'intitule'=>$intitule,
                'seanceId' =>$seanceId,
                'matiere'=>$matiere,
                'description'=>$description,
                'nature' =>$nature,
                'date' =>$date,
                'heure' =>$heure
            ]);
        }
            echo $twig->render('home/modifier.html.twig', [
                'visu' => false,
                'intitule'=>$intitule,
                'seanceId' =>$seanceId,
                'matiere'=>$matiere,
                'description'=>$description,
                'nature' =>$nature,
                'date' =>$date,
                'heure' =>$heure
            ]);



    }
}