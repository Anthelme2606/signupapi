<?php

namespace anthelme;

use PDO;
use PDOException;

class SignUp
{
private $db;
    public function __construct( $host,$dbname,$username,$password){
        try
        {

        
        $dsn="mysql:host=$host;dbname=$dbname";
        $this->db=new \PDO($dsn,$username,$password);
        $this->db->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
        $this->createTable('students');
    }catch(PDOException $e)
    {
        die("ERREUR de connexion lors de la connexion a la base de donnee:".$e->getMessage());

    }


    }
    private function createTable($tableName)
    {
        $sql="CREATE TABLE  IF NOT EXISTS $tableName (
            id INT AUTO_INCREMENT PRIMARY KEY,
            first_name varchar(255),
            last_name varchar(255),
            email varchar(255))";
        try
        {
            $this->db->exec($sql);


        }catch(PDOException $e)
        {
  die("ERREUR lors de le creation de la table :".$e->getMessage());
        }
    }

    public function create($studentdata)
    {
     $sql="INSERT INTO students(first_name,last_name,email) values(:first_name,:last_name,:email)";
     try
     {
        $stm=$this->db->prepare($sql);
        $stm->execute($studentdata);
     }catch(PDOException $e)
     {
        die("erreur lors de l'ajout de l'etudiant:".$e->getMessage());
     }
    }
    public function read($id)
    {
        $sql="SELECT * FROM students whereid=:id";
        try{
  $stm=$this->db->prepare($sql);
  $stm->execute(array('id'=>$id));
  return $stm->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e)
        {
    die("EREUR lors de la recuperation de l'etudiant");
        }

    }
    public function update($id,$data)
    {
$sql="UPDATE students set first_name=:first_name,last_name=:last_name,email=:email where id=:id";
try
{
    $stm=$this->db->prepare($sql);
    $data["id"]=$id;
    $stm->execute($data);

}catch(PDOException $e)
{
    die("erreur lors de la mise a jour de l'etudiant:".$e->getMessage());
}
    }
    public function delete($id)

    {
$sql="DELETE FROM students where id=:id";
try
{
$stm=$this->db->prepare($sql);
$stm->execute(array("id"=>$id));
}catch(PDOException $e)
{
    die("ereur lors de la suppression de l'etudiant");
}
    }
    public function list()
    {
        $sql="SELECT * FROM students ";
        try
        {
    $stm=$this->db->prepare($sql);
    return $stm->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e)
        {
            die("erreur lors de l' affichage des etudiants:".$e->getMessage());
        }

    }
    public function __destruct()
    {
        $this->db=null;
    }
}