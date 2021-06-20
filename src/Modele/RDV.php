<?php

class RDV {

    private $conn;
    private $table = 'rdv';
    public $Id_rdv;
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
           
      $query  = 'INSERT INTO ' .$this->table.'( `Reference`, `Motif`, `Date` `Num_creneau`) VALUES ( :Reference, :Motif, :Date, :Num_Creneau);'; 
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

        $query = 'SELECT r.Id_rdv,r.Date,r.Motif,c.Num_creneau from rdv r, creneau c where r.Reference = :Reference and r.Num_creneau=c.Num_creneau';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':Reference',$this->Reference);
        $stmt->execute();
        return $stmt;
      }
      public function delete(){

        $query  = "DELETE FROM ". $this->table." WHERE Id_rdv = :id";
        $stmt   = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->Id_rdv));
         $stmt->bindParam(':id',$this->Id_rdv);
        if($stmt->execute()){
          return true;
        }else{
        printf('Erreur de suppresion: %s.\n',$stmt->error);
        return false;
        } 
    }
public function Dropdown()
{
  $query ="SELECT * FROM creneau WHERE  Num_creneau NOT IN(SELECT c.Num_creneau FROM creneau c, rdv r where c.Num_creneau=r.Num_creneau AND r.Date='2021-06-18')";
}


}
