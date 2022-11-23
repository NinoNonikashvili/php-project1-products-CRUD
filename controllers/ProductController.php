<?php

namespace app\controllers;
use app\models\Product;
use app\Router;
class ProductController 
{
    public static function index(Router $router){
        $keyword = $_GET['search']?? '';
        $products = $router->database->getProducts($keyword);
        $router->renderview('index', [
            'products' => $products  //tan im saxels atan, romelic viewbshi formshi gaqvs gamoyenebuli dasasetad
        ], $keyword); //aq uproblemod rato vidzaxeb renders? $router-shi ukve Router tipis obieqti iqmneba? tu klasi gadmodis
    }
    public static function create(Router $router){ 
        $productData = [
            'image' => '',
            'title' => '',
            'description' => '',
            'price' => ''
        ];

        if($_SERVER['REQUEST_METHOD']==='POST'){
            $productData['title'] = $_POST['title'];
            $productData['description'] = $_POST['description'];
            $productData['price'] = $_POST['price'];
            $productData['imageFile'] = $_FILES['image'] ?? null;

            $product = new Product();
            $product->load($productData);
            $product->save();
        }
         $router->renderview('create', [ //imitom rom forma iyenebs public cvlads, updatshi id is mixedvit, createshi carieli stringebi
            'product'=>$productData
         ]);
    }
    public static function update(Router $router){
        $id = $_GET['id'] ?? null;
        if(!$id){
            header('Location: /index');
            exit();
        }

         $productData = $router->database->getProductById($id); //aq gadmocemuli image tu aris aris stringi
         if($_SERVER['REQUEST_METHOD']==='POST'){
            $productData['title'] = $_POST['title'];
            $productData['description'] = $_POST['description'];
            $productData['price'] = $_POST['price'];
            $productData['imageFile'] = $_FILES['image'] ?? null;
            // echo '<pre>';
            // var_dump($productData);
            // echo '</pre>';
            // exit;
            $product = new Product();
            $product->load($productData);
            $product->save();
        }
         $router->renderview('update', [
            'product' => $productData
         ]);
    }
    public static function delete(Router $router){  
        $id = $_POST['id'];
        if(!$id){
            header('Location:index');
            exit();
        }
        $router->database->deleteProduct($id);
        header('Location: /index');
    }
}