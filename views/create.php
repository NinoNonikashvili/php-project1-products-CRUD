<?php 

//   require_once 'partials/head.php';
//   $pdo = require_once '../db.php';
//   require_once '../randomStr.php';

  $image = '';
  $image_path = '';
  $title = '';
  $description = '';
  $price = '';


//   $errors = [];
//   if($_SERVER['REQUEST_METHOD']==='POST')
//   { 
//     require_once '../validateInput.php';

//     if(empty($errors))
//     {
//       $statement = $pdo->prepare('INSERT INTO teddy_bears(title,image, description, price, create_date)
//       VALUES(:title, :image, :description, :price, :date)');
//       $statement->bindValue(':title', $title);
//       $statement->bindValue(':image', $image_path);
//       $statement->bindValue(':description', $description);
//       $statement->bindValue(':price', $price);
//       $statement->bindValue(':date', date('Y-m-d H:i:s'));
//       $statement->execute();
//       header('Location: index.php');

//     }
//   }
// ?>

<body>


<h1>create an item</h1>
<!-- <a href="index.php"type="button" class="btn btn-primary back-btn">back to main page</a> -->

<?php// require_once '../errorStyles.php'; ?>

<?php require_once '_form.php' ?>

</body>
</html>