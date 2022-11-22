<?php

namespace app;

class Router {
    public array$getRoutes = []; //[ '/':
                            //    [ProductController::class, 'index],
                            //  '/create':
                            //    [ProductController::class, 'create'] ...
                            //]
    public array $postRoutes = [];
    public ?Db $database = null;
    public function __construct($database){
        $this->database = $database;
    }

    public function get($url, $fn){
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn){
        $this->postRoutes[$url] = $fn;
    }
    public function resolve(){
        $method = strtolower($_SERVER['REQUEST_METHOD']);  //get current method and url to choose appropriate entrie from getRoutes & postRoutes arrays.
        $url = $_SERVER['PATH_INFO'] ?? '/';
        if($method==='get')
        {
            $fn = $this->getRoutes[$url] ?? null; //if you write /blabla in browser it will go on error because there is no entry in get/postRoutes with url = /blabla
        }elseif($method==="post")
        {
            $fn = $this->postRoutes[$url] ?? null; //same here, also if you request delete page with get method it will also go on errorr because there is no function on such method
        }
        //var_dump($fn); //in exception cases described in above comments, the funcqtion will be null
        if($fn===null){
            echo 'page not found'; 
            exit();
            // throw new \Exception("page not found");
        }
        call_user_func($fn, $this); //send the reference to this class to the function 
    }
    public function renderView($view, $params)
    {   
        foreach($params as $key=>$value){
            $$key = $value; //$paramsshi ukve chadebulia is saxeli rac dabla forms chirdeba, anu arc ki chans aq ise iqmneba formistvis sachirp cvladi da ivseba tavisive mnishvnelobit
        }
        ob_start();
        include __DIR__."/views/$view.php";
        $content = ob_get_clean();
        // echo $content;
        include __DIR__."/views/_layout.php";

    }
}