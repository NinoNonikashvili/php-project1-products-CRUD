<form method="POST" action="create.php" enctype="multipart/form-data" >
<?php if($product['image']): ?>
  <img class="cell-img" src="<?php echo $product['image']?>" alt="image">
  <?php endif; ?>
<div class="mb-3">
    <label for="image" class="form-label">Image</label>
    <input type="file" class="form-control" name="image" id="image" >
  </div>
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" name="title" id="title" value = <?php echo $product['title'] ?>>
  </div>
  <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea type="text"  class="form-control" name="description" id="description"><?php echo $product['description'] ?></textarea>
  </div>
  <div class="mb-3">
    <label for="price" class="form-label">Price</label>
    <input type="decimal" class="form-control" name="price" id="price" value = <?php echo $product['price']?>>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>