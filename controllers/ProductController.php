<?php

namespace app\controllers;
use app\Router;
class ProductController 
{
    public static function index(Router $router){
        $products = $router->database->getProducts();
        $router->renderview('index', [
            'products' => $products  //tan im saxels atan, romelic viewbshi formshi gaqvs gamoyenebuli dasasetad
        ]); //aq uproblemod rato vidzaxeb renders? $router-shi ukve Router tipis obieqti iqmneba? tu klasi gadmodis
    }
    public static function create(Router $router){ 

         $router->renderview('create', $products);
    }
    public static function update(Router $router){
        $id = $_GET['id'] ?? null;
        if(!$id){
            header('Location: /index');
            exit();
        }
         $product = $router->database->getProductById($id);

         $router->renderview('update', [
            'product' => $product
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