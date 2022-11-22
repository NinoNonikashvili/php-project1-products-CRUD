 <?php 
    // require_once 'partials/head.php';
    // require_once '../db.php';

    // $keyword = $_GET['search'] ?? null;

    // if($keyword){
    //     $statement = $pdo->prepare('SELECT *FROM teddy_bears WHERE title like :keyword ORDER BY create_date DESC' );
    //     $statement->bindValue(':keyword', "%$keyword%");
    // }else
    // {
    //     $statement = $pdo->prepare('SELECT *FROM teddy_bears ORDER BY create_date DESC' );
    
    // }
    // $statement->execute();
    // $products = $statement->fetchAll(PDO::FETCH_ASSOC);




?>

<body>
    <h1 class="header">Teddy-Bear Shop</h1>
    <form action="" method="get" >
      <div class="input-group mb-4">
        <input type="text" name="search" value = "<?php echo $keyword ?? ''?>" class="form-control" placeholder="search" >
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit">Button</button>
        </div>
      </div>
    </form>

    <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">image</th>
            <th scope="col">title</th>
            <th scope="col">description</th>
            <th scope="col">price</th>
            <th scope="col">date</th>
            <th scope="col">action</th>
            </tr>
        </thead>
        <tbody>
            <!-- php code to unfold data -->
            <?php foreach($products as $i =>$product ) : ?>          
                <tr>
                <th scope="row"><?php echo $product['id']?></th>
                <td><img class="cell-img" src="<?php echo $product['image'] ?>" alt=""></td>
                <td><?php echo $product['title'] ?></td>
                <td><?php echo $product['description'] ?></td>
                <td><?php echo $product['price'] ?></td>
                <td><?php echo $product['create_date'] ?></td>
                <td>
                    <form action="delete" method="POST" style="display:inline-block">
                        <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <a href="update?id=<?php echo $product['id']?>" type="button" class="btn btn-primary">Edit</a>
                </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="create" type="button" class="btn btn-primary">Add a toy</a>
</body>
</html>