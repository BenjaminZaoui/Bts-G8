<?php

namespace Apps\Controller\Users;

use Apps\Core\Controller\Request;
use Apps\Core\View\TwigCore;
use Apps\Core\Controller\ControllerInterface;
use Apps\Entity\demandeTab;
use Apps\Entity\Etudiant;
use Apps\Entity\TimeConnexion;
use Apps\Exception\ConnexionException;
use Apps\Exception\ConnexionTimeException;
use Apps\Exception\DemandeNotSelectedException;
use Apps\Exception\IncorrectPasswordException;
use Apps\Exception\NoPasswordException;
use Apps\Model\AcceuilTabModel;
use Apps\Model\HomeModel;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use function PHPUnit\Framework\throwException;

class AcceuilTableauAssisterController implements ControllerInterface
{
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function execute(Request $request)
    {
        unset($_SESSION["IDDEMANDE"]);

        try {
            $demandeSelectionnee ="";
            $demande = new demandeTab();
            $homeModel = new HomeModel();
            $_SESSION['Time']="T";
            $sessionTime = new TimeConnexion();
            // $sessionTime->TimeSession();
            $errorCode = 0;
            $errorMessage = "";
            unset($_SESSION["IDDEMANDE"]);
            if ($_SESSION['authentification'] == null){
                throw new ConnexionException();
            }
            elseif ($homeModel->CheckSessionsId($_SESSION['authentification'])==false){
                throw new  ConnexionException();
            }
            elseif (isset($_POST['demande_selectionnee']) && $_POST['demande_selectionnee'] != null) {
                $demandeSelectionnee = $_POST['demande_selectionnee'];
                $_SESSION["IDDEMANDE"] = $demandeSelectionnee;
                header("Location: /modifier");

            }
            if ($_SESSION['Time']=="F"){
                throw new ConnexionTimeException();
            }
        }catch (\Exception $e){
            $errorCode = $e->getCode();
            $errorMessage = $e->getMessage();
        }
        $twig = TwigCore::getEnvironment();
        $demandeModel = new AcceuilTabModel();
        if ($errorCode == 1007){
            header("Location: /");
        }
        if ($errorCode == 1008){
            // Déconnectez l'utilisateur et détruisez la session
            session_unset();
            session_destroy();
            // Redirigez l'utilisateur vers la page de connexion ou une autre page appropriée
            header("Location: /");
            exit();
        }
        if ($errorCode !=0){
            echo $twig->render('home/acceuilTabAssister.twig', [
                'visu' => false,
                'demandes'=>$demandeModel->getFechAllForUser($_SESSION['authentification']),
                'error'=>$errorMessage
            ]);
        }else{
            echo $twig->render('home/acceuilTabAssister.twig', [
                'visu' => false,
                'demandes'=>$demandeModel->getFechAllForUser($_SESSION['authentification'])
            ]);
        }




    }
}