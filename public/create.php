<?php 

  require_once 'partials/head.php';
  $pdo = require_once '../db.php';
  require_once '../randomStr.php';

  $image = '';
  $image_path = '';
  $title = '';
  $description = '';
  $price = '';


  $errors = [];
  if($_SERVER['REQUEST_METHOD']==='POST')
  { 
    require_once '../validateInput.php';

    if(empty($errors))
    {
      $statement = $pdo->prepare('INSERT INTO teddy_bears(title,image, description, price, create_date)
      VALUES(:title, :image, :description, :price, :date)');
      $statement->bindValue(':title', $title);
      $statement->bindValue(':image', $image_path);
      $statement->bindValue(':description', $description);
      $statement->bindValue(':price', $price);
      $statement->bindValue(':date', date('Y-m-d H:i:s'));
      $statement->execute();
      header('Location: index.php');

    }
  }
?>

<body>


<h1>create an item</h1>
<a href="index.php"type="button" class="btn btn-primary back-btn">back to main page</a>

<?php require_once '../errorStyles.php'; ?>

<form method="POST" action="create.php" enctype="multipart/form-data" >
<div class="mb-3">
    <label for="image" class="form-label">Image</label>
    <input type="file" class="form-control" name="image" id="image" >
  </div>
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" name="title" id="title" value = <?php echo $title ?>>
  </div>
  <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea type="text"  class="form-control" name="description" id="description"><?php echo $description ?></textarea>
  </div>
  <div class="mb-3">
    <label for="price" class="form-label">Price</label>
    <input type="decimal" class="form-control" name="price" id="price" value = <?php echo $price?>>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</body>
</html>