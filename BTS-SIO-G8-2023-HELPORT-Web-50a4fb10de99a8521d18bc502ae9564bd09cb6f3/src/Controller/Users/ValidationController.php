<?php

namespace Apps\Controller\Users;

use Apps\Core\Controller\ControllerInterface;
use Apps\Core\Controller\Request;
use Apps\Core\View\TwigCore;
use http\Client;

class ValidationController implements ControllerInterface
{
    /**
     * @param Request $request
     * @return void
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public  function  execute(Request $request)
    {
        if (isset($_POST['utilisateur']) && isset($_POST['password'])) {
            $client = new \Studoo\Api\EcoleDirecte\Client([
                "client_id" => $_POST['utilisateur'],
                "client_secret" => $_POST['password'],
                'verify' => false,
            ]);
            $etudiant = $client->fetchAccessToken();


            $twig = TwigCore::getEnvironment();

            echo $twig->render('users\validation.html.twig', [
                'etudiantAPI' => $etudiant
            ]);
        }
    }
    }