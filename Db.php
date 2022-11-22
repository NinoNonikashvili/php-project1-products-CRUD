<?php

namespace app;

//use PDO or \PDO IN CODE
class Db{

    public $pdo=null;

    public function __construct(){
        $this->pdo = new \PDO('mysql:host=localhost;  port = 3306; dbname=products_crud', 'root', '');
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    }

    function  getProducts($keyword=''){
        if($keyword)
        {
            $statement = $this->pdo->prepare('SELECT * FROM Products WHERE title like :keyword ORDER BY create_date DESC');
            $statement->bindValue(':keyword', '%$keyword%');
        }else
        {
            $statement = $this->pdo->prepare('SELECT * FROM Products ORDER BY create_date DESC');

        }
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getProductById($id){
        $statement = $this->pdo->prepare('SELECT * FROM Products WHERE id = :id');
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $product = $statement->FETCH(\PDO::FETCH_ASSOC);

        
    }
    public function deleteProduct($id){
        $statement = $this->pdo->prepare('DELETE  FROM Products WHERE id = :id');
        $statement->bindValue(':id', $id);
        $statement->execute();
        
    }
} 