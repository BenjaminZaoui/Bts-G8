<?php

namespace Apps\Model;

use Apps\Core\Service\DatabaseService;
use Apps\Entity\demandeTab;
use Apps\Entity\Etudiant;
use Apps\Entity\Questionnaire;
use MongoDB\Driver\Exception\EncryptionException;

class AcceuilTabModel
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = DatabaseService::getConnect();
    }
    public function getFechAllForUser(int $id)
    {
        $requete = $this->bdd->prepare('SELECT  seance.Intitule, seance.ID, seance.MATIERE, seance.DESCRIPTION, seance.NATURE,seance.Date, seance.Heure, seance.etat
FROM seance
INNER JOIN user ON user.ID = seance.id_assiste
WHERE USER.ID = ?');
        $requete->execute([$id]);
        $tabDemande= [];

        foreach ($requete->fetchAll() as $value)
        {
            $demande = new demandeTab();
            $demande->setIntitule($value["Intitule"]);
            $demande->setSeanceId($value["ID"]);
            $demande->setMatiere($value["MATIERE"]);
            $demande->setDescription($value["DESCRIPTION"]);
            $demande->setNature($value["NATURE"]);
            $demande->setDate($value["Date"]);
            $demande->setHeure($value["Heure"]);
            $demande->setEtat($value["etat"]);
            $tabDemande[] = $demande;
        }

        return $tabDemande;
    }
    public function ComptNbDemande($id):bool{
        $check = false;
        $requete = $this->bdd->prepare('SELECT COUNT(seance.ID) FROM seance INNER JOIN user ON user.ID = seance.id_assiste WHERE USER.ID = ?');
        $requete->execute([$id]);
        $result = $requete->fetch();
        if ($result[0] >= 5){
            $check = true;
        }
      return  $check;
    }
}