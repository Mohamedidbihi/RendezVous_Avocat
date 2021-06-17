<?php

class RDV {

    private $conn;
    private $table = 'rdv';
    public $Reference;
    public $Motif;
    public $Date;
    public $Num_Creneau;
 

    public function __construct($db) {
      $this->conn = $db;
    }
    public function AddRdv(){
        try
        {
           
      $query  = 'INSERT INTO ' .$this->table.'( `Motif`, `Date`, `Num_creneau`, `Reference`) VALUES ( :Reference, :nom, :prenom, :profession ,:Telephone, :cin);'; 
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':Reference',$this->Reference);
      $stmt->bindParam(':Motif',$this->Motif);
      $stmt->bindParam(':Date',$this->Date);
      $stmt->bindParam(':Num_Creneau',$this->Num_Creneau);
      $stmt->execute();
      return true;
       }
          catch(Exception $e)
       {
       echo 'Exception reçue : ',  $e->getMessage(), "\n";
         return false;
    }  
    }
    public function read() {

        $query = 'SELECT `rdv.Motif`, `rdv.Date`, `Rdv.Time` FROM rdv , creneau c WHERE c.Num_creneau=rdv.Num_creneau';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);
  
        // Execute query
        $stmt->execute();
  
        return $stmt;
      }

}