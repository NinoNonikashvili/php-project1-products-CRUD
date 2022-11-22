<?php

$image = $_FILES['image'] ?? null;
$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];

if(!$_POST['title'])
{
  $errors[] = "please, enter title";
}
if(!$_POST['price'])
{
  $errors[] = "please, enter price";
}
if($image && $image['tmp_name']){ //tu image aris mashin sheuqmenni misamarti da stringi chawere imagePathshi da eg gaatane dbze
  if(!is_dir('assets')){
    mkdir('assets');
  } 
  if($image_path) //updatistvis tu getit gamoyva image_path da tan updatisas postitac movida mashin getis washale da post dausete
  {
    unlink($image_path);
  } 
  $image_path = 'assets/'.randStr(9).'/'.$image['name'];
  mkdir(dirname($image_path));
  move_uploaded_file($image['tmp_name'], $image_path);
}
?>