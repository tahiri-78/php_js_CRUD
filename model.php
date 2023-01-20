<?php

class Database{

    private $host="mysql:host=localhost;dbname=crud_ajax";
    private $user="root";
    private $pw="";
    //Connexion 
    private function getconnection()
    {
        try {
            return new PDO($this->host,$this->user);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    // ajout donné dans la table factures
    public function create(string $costumer, string $cashier ,int $amount ,int $received ,int $returned, string $etat )
    {
        $q=$this->getconnection();
        $exe =$q->prepare("INSERT INTO factures(customer,cashier,amount,received,returned,etat) VALUES (?,?,?,?,?,?)");
        $exe->execute([ $costumer, $cashier ,$amount,$received, $returned,$etat]);
    }
    

    public function getfactures()
    {
        return $this->getconnection()->query("SELECT * FROM factures ORDER BY id")->fetchAll(PDO::FETCH_OBJ);
    }


    public function getfacture(int $id)
    {
        $q=$this->getconnection()->prepare("SELECT * FROM factures where id=?");
        $q->execute([$id]);
        return $q->fetch(PDO::FETCH_OBJ);
    }

    public function countBills():int
    {
      return   (int)$this->getconnection()->query("select count(*) as count from factures")->fetch()[0];
    }


    public function updat(string $customer, string $cashier ,int $amount ,int $received ,int $returned, string $etat,int $id)
    {
        $q=$this->getconnection();
        $exe =$q->prepare("UPDATE  factures SET customer=:customer,   cashier=:cashier , amount=:amount , received=:received,  returned=:returned , etat=:etat WHERE id =:id") ;
        $exe->execute([
            
            'customer'=>$customer,
            'cashier'=>$cashier,
            'amount'=>$amount,
            'received'=>$received,
            'returned'=>$returned,
            'etat'=>$etat,
            'id'=>$id,
            
        
        ]);
    }


    public function deletfacture(int $id)
    {
        $q=$this->getconnection()->prepare("DELETE  FROM factures where id=?");
        $q->execute([$id]);
    }

}





