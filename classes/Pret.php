<?php

class Pret{
    private DateTime $dateDebut;
    private DateTime $dateFin;   
   
    public function __construct(){                                       
        $this->dateDebut = new DateTime();
        $this->dateFin = $this->tempsFin();                                  
    }

    public function tempsFin(){
        $fin = clone $this->dateDebut;
        return $fin->modify('+31 days');
    }

    public function setDateDebut($dateDebut){
        $this->dateDebut = new DateTime($dateDebut);
        $this->dateFin = $this->tempsFin();                      
    }
    
    public function getDateDebut(){
        return $this->dateDebut;                       
    }

    public function getDateFin(){
        return $this->dateFin;                       
    }
    
    public function tempsRestant(){
        $now = new DateTime();
        $diff = $now->diff($this->dateFin);
        return $diff->days; 
    }
}


?>