<?php

class Client {

    private $conn;
    private $table = 'client';
    public $Reference;
    public $cin;
    public $nom;
    public $prenom;
    public $profession;
    public $tele;

    public function __construct($db) {
      $this->conn = $db;
    }
    public function CinExists(){
  
      $query = 'SELECT * FROM' .$this->table.'WHERE Cin = :cin ;';
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':cin',$this->cin);
      $stmt->execute();
      $count = $stmt->fetchColumn();
      return $count;
  }

    public function Signup(){
        try
        {
      $query  = 'INSERT INTO ' .$this->table.'(`Reference`, `Nom`, `Prenom`, `Profession`, `Telephone`,`Telephone`) VALUES ( :Reference, :nom, :prenom, :profession ,:Telephone, :cin);'; 
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':Reference',$this->Reference);
      $stmt->bindParam(':nom',$this->nom);
      $stmt->bindParam(':prenom',$this->prenom);
      $stmt->bindParam(':profession',$this->profession);
      $stmt->bindParam(':Telephone',$this->tele);
      $stmt->bindParam(':cin',$this->cin);
      $stmt->execute();
      return true;
       }
          catch(Exception $e)
       {
       echo 'Exception reçue : ',  $e->getMessage(), "\n";
         return false;
    }  
    }

    //Authentifieri
    public function Signin(){
      $query  = 'SELECT * FROM' .$this->table.'WHERE REFERENCE = :reference' ;        
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':reference',$this->Reference);
      //Execute Data
      $stmt->execute();
      $count = $stmt->rowCount();
      $row   = $stmt->fetch(PDO::FETCH_ASSOC);
      if($count == 1 && !empty($row))
       {
         session_start();
        $_SESSION['ref']   = $row['REFERENCE'];
 
        return true;

      } 
      else {
       return false;
    }   
      
    }
}