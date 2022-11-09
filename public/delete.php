<?php
$pdo = require_once '../db.php';


$id = $_POST['id'];
var_dump($id);
if(!$id)
{
    header('Location:index.php');
}else
{
    $statement = $pdo->prepare('DELETE  FROM teddy_bears WHERE id = :id');
    $statement->bindValue(':id', $id);
    $statement->execute();
    header('location:index.php');
}


?>