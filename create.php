<?php

  include 'connect.php';

  $errors = [];

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $date = date('Y-m-d H:i:s');

  }

  if (!$title) {

    $errors[] = "Product title is required :(!";

  }

  if (!$price) {

    $errors[] = "Product price is required :(!";

  }

  if (!$errors) {

    $query = "INSERT INTO products(title, description, price, create_date) VALUES (:title, :description, :price, :date)";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(":title", $title);
    $stmt->bindValue(":description", $description);
    $stmt->bindValue(":price", $price);
    $stmt->bindValue(":date", date('Y-m-d H:i:s'));
    $stmt->execute();

    header('Location: index.php');

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
  <div class="container w-75">
    <h1 class="text-center mb-4">Add New Product</h1>
    <?php if ($errors) : ?>
      <div class="alert alert-danger">
      <?php foreach ($errors as $error) :?>
        <p><?php echo $error; ?></p>
      <?php endforeach; ?>
      </div>
    <?php endif; ?>
    <form method="post">
      <div class="mb-3">
        <label for="title" class="form-label">Product Title</label>
        <input type="text" class="form-control" id="title" name="title">
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Product Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
      </div>
      <div class="mb-3">
        <label for="price" class="form-label">Product Price</label>
        <input type="number" step=".1" class="form-control" id="price" name="price">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</body>
</html>
