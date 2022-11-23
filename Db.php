<?php

namespace app;

//use PDO or \PDO IN CODE
use app\models\Product;
class Db{

    public $pdo=null;
    public static ?Db $dbInstance = null;

    public function __construct(){
        $this->pdo = new \PDO('mysql:host=localhost;  port = 3306; dbname=products_crud', 'root', '');
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        self::$dbInstance = $this;
    }

    function  getProducts($keyword=''){
        if($keyword)
        {            
        $statement = $this->pdo->prepare('SELECT *FROM Products WHERE title like :keyword ORDER BY create_date DESC' );
        $statement->bindValue(':keyword', "%$keyword%"); //double qoutes important

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
    public function createProduct(Product $product){
        $statement = $this->pdo->prepare('INSERT INTO Products(title,image, description, price, create_date)
        VALUES(:title, :image, :description, :price, :date)');
        $statement->bindValue(':title', $product->title);
        $statement->bindValue(':image', $product->imagePath);
        $statement->bindValue(':description', $product->description);
        $statement->bindValue(':price', $product->price);
        $statement->bindValue(':date', date('Y-m-d H:i:s'));
        $statement->execute();
    }
    public function updateProduct(Product $product){
        $statement = $this->pdo->prepare('UPDATE Products SET 
        title = :title,
        image = :image,
        description = :description,
        price = :price WHERE id = :id');
        $statement->bindValue(':title', $product->title);
        $statement->bindValue(':image', $product->imagePath);
        $statement->bindValue(':description', $product->description);
        $statement->bindValue(':price', $product->price);
        $statement->bindValue(':id', $product->id);
        $statement->execute();
    }
} 