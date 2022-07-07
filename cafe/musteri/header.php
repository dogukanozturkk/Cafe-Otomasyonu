<?php include '../config/db.php'; ?>
<?php  
error_reporting(0); 

ob_start();
session_start();

$masa_sifre = $_SESSION['sifre'];

include '../config/functions.php';

?>
<!doctype html>
  <html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Müşteri Paneli</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
  </head>
  <body>