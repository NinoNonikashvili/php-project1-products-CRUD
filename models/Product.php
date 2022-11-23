<?php

namespace app\models;
use app\Db;
use app\helpers\UtilHelper;
//modelis danishnulebaa dbs asaxavdes, class aris table, da cvladebi  chanawerebi columnebi
class Product{

    public ?int $id = null;
    public string $title;
    public string $description;
    public float $price;
    public ?array $imageFile = null; //comes from post
    public ?string $imagePath = null; //comes from get


    public function load($data){
        $this->title = $data['title'];
        $this->id = $data['id'] ?? null;
        $this->description = $data['description'];
        $this->price = $data['price'];
        $this->imageFile = $data['imageFile'];
        $this->imagePath = $data['image'] ?? null;
    }

    public function save()
    {   
        $errors = [];
        if(!$this->title)
        {
        $errors[] = "please, enter title";
        }
        if(!$this->price)
        {
        $errors[] = "please, enter price";
        }
        if(empty($errors))
        {
            if($this->imageFile && $this->imageFile['tmp_name'])
                { //tu image aris mashin sheuqmenni misamarti da stringi chawere imagePathshi da eg gaatane dbze
                if(!is_dir(__DIR__.'/../public/images')){
                    mkdir(__DIR__.'/../public/images');
                } 
                if($this->imagePath) //updatistvis tu getit gamoyva image_path da tan updatisas postitac movida mashin getis washale da post dausete
                {
                    unlink(__DIR__.'/../public/'.$this->imagePath);
                } 
                $this->imagePath = 'images/'.UtilHelper::randStr(9).'/'.$this->imageFile['name'];
                mkdir(dirname(__DIR__.'/../public/'. $this->imagePath));
                move_uploaded_file($this->imageFile['tmp_name'], __DIR__.'/../public/'. $this->imagePath);
                }
            
            $db = Db::$dbInstance;
            if($this->id){
                //update
                // echo '<pre>';
                // var_dump($this);
                // echo '</pre>';
                // exit;
                $db->updateProduct($this);

            } else{
                //create
                $db->createProduct($this);

            }
            header('Location: index.php');

        }

 
    }
}