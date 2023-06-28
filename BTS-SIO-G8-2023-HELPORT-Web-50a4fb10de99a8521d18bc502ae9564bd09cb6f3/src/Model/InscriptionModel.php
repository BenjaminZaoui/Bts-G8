<?php

namespace Apps\Model;

use Apps\Core\Service\DatabaseService;
use Apps\Entity\Etudiant;
use Apps\Entity\Questionnaire;
use MongoDB\Driver\Exception\EncryptionException;

class InscriptionModel
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = DatabaseService::getConnect();
    }
    public function checkDispoPseudo(string $pseudo): bool
    {
        $check = false;
            $requete = $this->bdd->prepare('SELECT user.Pseudo FROM user WHERE user.Pseudo LIKE ?');
            //var_dump($requete);
            $requete->execute([$pseudo]);
            $result=$requete->fetch();
            //var_dump($result);
        if ($result == true){
                $check = true;
        }

        return $check;
    }
    public function checkmail(string $mail):bool
    {
        $check =false;
        $requete = $this->bdd->prepare('SELECT EMAIL FROM user WHERE EMAIL = ?');
        $requete->execute([$mail]);
        $result=$requete->fetch();
        if ($result == true){
            $check = true;
        }
        return $check;
    }
    public function insertStudent(string $nom, string $prenom,string $mail, string $pseudo, string $niveau,string $motDePasse,string $typeCompte){
        $requete = $this->bdd->prepare('INSERT INTO user (NOM, PRENOM, EMAIL, ROLE, Pseudo, Niveau, MotDePasse, DateDeCreation, DateMiseAJour,TypeCompte) 
        VALUES (?,?,?,?,?,?,?,CURDATE(),?,?)');
        $requete->execute([$nom,$prenom,$mail,'',$pseudo,$niveau,$motDePasse,'',$typeCompte]);



    }
}