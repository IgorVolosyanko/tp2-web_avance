<?php

class Client{
    private string $nom;
    private string $adresse;
    private string $telephone;
    private string $courriel;

    public function __construct(string $nom, string $adresse, 
                                string $telephone, string $courriel){
        $this->nom = $nom;
        $this->adresse = $adresse;
        $this->telephone = $telephone;
        $this->courriel = $courriel;                            
    }

    public function getNom(){
        return "{$this->nom}";
    }

    public function setClient(string $nom, string $adresse, 
                            string $telephone, string $courriel){
        $this->nom = $nom;
        $this->adresse = $adresse;
        $this->telephone = $telephone;
        $this->courriel = $courriel;                        
    }

    
}


?>