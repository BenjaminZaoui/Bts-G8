<?php

namespace Apps\Model;

use Apps\Core\Service\DatabaseService;
use Apps\Entity\Etudiant;
use Apps\Entity\Questionnaire;
use MongoDB\Driver\Exception\EncryptionException;

class HomeModel
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = DatabaseService::getConnect();
    }
    public function CheckUserPassword(string $Pseudo, string $MotPasse):bool
    {
        $check = false;
        $requete = $this->bdd->prepare('SELECT MotDePasse FROM user WHERE Pseudo LIKE ? AND MotDePasse = ?');
        $requete->execute([$Pseudo,$MotPasse]);
        $result = $requete->fetch();
        if ($result == true){
                $check = true;
        }


        return  $check;
    }
    public function CheckSessionsId (int $id):bool {
        $check = false;
        $requete = $this->bdd->prepare('SELECT user.ID FROM user WHERE user.ID = ?');
        $requete->execute([$id]);
        $result = $requete->fetch();
        if ($result == true){
            $check = true;
        }

    return $check;
    }
    public function getIdByPseudo(string $pseudo)
    {

        $requete = $this->bdd->prepare('SELECT ID FROM user WHERE Pseudo = ?');
        $requete->execute([$pseudo]);
        $result = $requete->fetch();
        $id = $result['0'];
        return $id;
    }
}