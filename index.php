<?php
$host = "localhost";
$dbname = "products";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT * FROM product_table";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $e){
    echo "Connection failed".$e->getMessage();
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Crud App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <h1>Products Table</h1>
    <a href="create.php" class="btn btn-success">Add product</a>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">price</th>
      <th scope="col">Date created</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($products as $i => $product) : ?>
    <tr>
      <th scope="row"><?php echo $i + 1; ?></th>
      <td><?php echo $product['title']; ?></td>
      <td><?php echo $product['description']; ?></td>
      <td><?php echo $product['price']; ?></td>
      <td><?php echo $product['create_date']; ?></td>
      <td>
      <a href="update.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">Edit</a>
        <form action="delete.php" method="post" style="display: inline-block;">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>