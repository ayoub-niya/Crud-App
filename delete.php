<?php

    include 'connect.php';

    $id = $_POST['id'] ?? null;

    if (!$id) {

        header('Location: index.php');
        exit;
        
    }

    $query = "DELETE FROM products WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(":id", $id);
    $stmt->execute();

    header('Location: index.php');
    exit();