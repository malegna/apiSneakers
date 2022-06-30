<?php

include 'db/DB.php';

header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['Id'])){
        $query="select * from products where id=".$_GET['Id'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="select * from products";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $Title=$_POST['Title'];
    $Price=$_POST['Price'];
    $Description=$_POST['Description'];
    $Image=$_POST['Image'];
    $query="insert into productS (Title, Price, Description, Image) values ('$Title', '$Price', '$Description', '$Image')";
    $queryAutoIncrement="select MAX(Id) as Id from productS";
    $resultado=metodoPost($query, $queryAutoIncrement);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $Id=$_GET['Id'];
    $Title=$_POST['Title'];
    $Price=$_POST['Price'];
    $Description=$_POST['Description'];
    $Image=$_POST['Image'];
    $query="UPDATE products SET Title='$Title', Price='$Price', Description='$Description', Image='$Image' WHERE Id='$Id'";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='DELETE'){
    unset($_POST['METHOD']);
    $Id=$_GET['Id'];
    $query="DELETE FROM products WHERE id='$Id'";
    $resultado=metodoDelete($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

header("HTTP/1.1 400 Bad Request");


?>