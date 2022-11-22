<?php  

    require_once 'partials/head.php';
    require_once '../randomStr.php';
    $pdo = require_once '../db.php';
    $id = $_GET['id'] ?? null;
    if(!$id)
      {
        header('Location:index.php');
      }

    $errors = [];
    $image_path = '';
  


    $statement = $pdo->prepare('SELECT * FROM teddy_bears WHERE id = :id');
    $statement->bindValue(':id', $id);
    $statement->execute();
    $product = $statement->FETCH(PDO::FETCH_ASSOC);
    $title = $product['title'];
    $image_path = $product['image'];
    $description = $product['description'];
    $price = $product['price'];

    
    
    if($_SERVER['REQUEST_METHOD']==='POST')
    {    
      require_once '../validateInput.php';
      if(empty($errors))
      { 
        $statement = $pdo->prepare('UPDATE teddy_bears SET 
                              title = :title,
                              image = :image,
                              description = :description,
                              price = :price WHERE id = :id');
        $statement->bindValue(':title', $title);
        $statement->bindValue(':image', $image_path);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':id', $id);
        $statement->execute();
        header('Location:index.php');
      }

    }
  




?>
<body>

<h1>Update the item</h1>
<a href="index.php"type="button" class="btn btn-primary back-btn">back to main page</a>

<?php require_once '../errorStyles.php' ?>
<form method="POST"enctype="multipart/form-data" >
  <?php if($image_path): ?>
  <img class="cell-img" src="<?php echo $image_path?>" alt="">
  <?php endif; ?>
<div class="mb-3">
    <label for="image" class="form-label">Image</label>
    <input type="file" class="form-control" name="image" id="image">
  </div>
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" name="title" id="title" value="<?php echo $title?>">
  </div>
  <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea type="text" class="form-control" name="description" id="desription"><?php echo $description?></textarea>
  </div>
  <div class="mb-3">
    <label for="price" class="form-label">Price</label>
    <input type="decimal" class="form-control" name="price" id="price" value="<?php echo $price?>">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</body>
</html>