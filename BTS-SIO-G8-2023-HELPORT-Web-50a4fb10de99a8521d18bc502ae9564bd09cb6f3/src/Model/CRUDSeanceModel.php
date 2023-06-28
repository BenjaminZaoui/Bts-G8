<?php

namespace Apps\Model;

use Apps\Core\Service\DatabaseService;
use PhpParser\Node\Scalar\String_;

class CRUDSeanceModel
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = DatabaseService::getConnect();
    }
    public function CreateDemande(string $matiere,string $description,string $niveau,$date,$heure,int $id_assistant,int $id_assiste,string $etat, string $intitule){
        $requete = $this->bdd->prepare('INSERT INTO seance(matiere,description,Nature,Date,Heure,id_assistant,id_assiste,etat,Intitule)
        VALUES (?,?,?,?,?,?,?,?,?)');
        $requete->execute([$matiere,$description,$niveau,$date,$heure,$id_assistant,$id_assiste,$etat,$intitule]);
    }
    public function ReadDemande(string $critere, int $numero){
        $requete = $this->bdd->prepare('SELECT critere FROM seance WHERE ID LIKE numero
        VALUES (?,?)');
        $requete->execute([$numero]);
    }
    public function UpdateDemande($tab, $cat, $critere,$id){
        $requete = $this->bdd->prepare('UPDATE seance SET Cat WHERE critere like id
        VALUES(?,?,?)');
        $requete->execute();
    }
    public function DeleteDemande(int $id){
        $requete = $this->bdd->prepare('DELETE FROM seance WHERE ID LIKE (val)
        VALUES(?)');
        $requete->execute([$id]);
    }
    Private function TrouveIdDispo(){
        $i=0;
        $verif=false;
        $requete = $this->bdd->prepare('SELECT "ID" FROM seance WHERE ID LIKE "i"
        VALUES (?)');
        while(!$verif){
            if($requete->execute([$i])!=""){
                $i++;
            }
            else{
                $verif=TRUE;
            }
        }
        return $i;
    }
}