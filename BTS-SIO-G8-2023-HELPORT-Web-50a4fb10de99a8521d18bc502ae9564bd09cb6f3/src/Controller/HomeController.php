<?php

namespace Apps\Controller;

use Apps\Core\Controller\Request;
use Apps\Core\View\TwigCore;
use Apps\Core\Controller\ControllerInterface;
use Apps\Entity\Etudiant;
use Apps\Exception\IncorrectPasswordException;
use Apps\Exception\NoPasswordException;
use Apps\Model\HomeModel;
use http\Exception\InvalidArgumentException;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use function PHPUnit\Framework\throwException;

class HomeController implements ControllerInterface
{
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function execute(Request $request)
    {

        $error = "";
        try {
            unset($_SESSION['authentification']);
            if (isset($_POST['champsId']) && isset($_POST['champsMotsPasse'])){

                $homeModel =new HomeModel();
                $check = false;
                $check = $homeModel->CheckUserPassword($_POST['champsId'],hash('sha512',$_POST['champsMotsPasse']));
                if ($check == true ){

                    $_SESSION['authentification'] = $homeModel->getIdByPseudo($_POST['champsId']);
                    //var_dump($_SESSION['authentification']);
                    header("Location: /Acceuil");
                }
                else {
                    throw new NoPasswordException();

                }

            }


        }
        catch (\Exception $e){
           $error =  $e->getMessage();
        }

        if ($error != "")
        {
            $twig = TwigCore::getEnvironment();
            echo $twig->render('home/home.html.twig', [
                'visu' => false,
                'error'=>$error

            ]);
        }else {
            $twig = TwigCore::getEnvironment();

            echo $twig->render('home/home.html.twig', [
                'visu' => false
            ]);

        }

    }
}