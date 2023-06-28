<?php

namespace Apps\Model;

use Apps\Core\Service\DatabaseService;
use Apps\Entity\demandeTab;
use Apps\Entity\Questionnaire;

class ModifierModel
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = DatabaseService::getConnect();
    }

    /**
     * @return array
     */
    public function getInfoById(int $seanceId)
    {
        $requete = $this->bdd->prepare('SELECT  seance.ID, seance.Intitule, seance.MATIERE, seance.DESCRIPTION, seance.NATURE,seance.Date, seance.Heure, seance.etat
FROM seance
INNER JOIN user ON user.ID = seance.id_assiste
WHERE seance.ID = ?');
        $requete->execute([$seanceId]);
        $tabDemande= [];

        foreach ($requete->fetchAll() as $value)
        {
            $demande = new demandeTab();
            $demande->setSeanceId($value["ID"]);
            $demande->setIntitule($value["Intitule"]);
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

}