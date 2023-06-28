<?php

namespace Apps\Entity;

class demandeTab
{
    private $intitule="";
    private $matiere = "";
    private $description = "";
    private $nature = "";
    private $date;
    private $heure;
    private $etat = "";
    private $seanceId = 0;

    /**
     * @return string
     */
    public function getIntitule(): string
    {
        return $this->intitule;
    }

    /**
     * @param string $intitule
     */
    public function setIntitule(string $intitule): void
    {
        $this->intitule = $intitule;
    }

    /**
     * @return int
     */
    public function getSeanceId(): int
    {
        return $this->seanceId;
    }

    /**
     * @param int $seanceId
     */
    public function setSeanceId(int $seanceId): void
    {
        $this->seanceId = $seanceId;
    }



    /**
     * @return string
     */
    public function getMatiere(): string
    {
        return $this->matiere;
    }

    /**
     * @param string $matiere
     */
    public function setMatiere(string $matiere): void
    {
        $this->matiere = $matiere;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getNature(): string
    {
        return $this->nature;
    }

    /**
     * @param string $nature
     */
    public function setNature(string $nature): void
    {
        $this->nature = $nature;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * @param mixed $heure
     */
    public function setHeure($heure): void
    {
        $this->heure = $heure;
    }

    /**
     * @return string
     */
    public function getEtat(): string
    {
        return $this->etat;
    }

    /**
     * @param string $etat
     */
    public function setEtat(string $etat): void
    {
        $this->etat = $etat;
    }



}