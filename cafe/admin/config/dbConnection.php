<?php
    try {
        $dbConnection = new PDO("mysql:host=localhost;dbname=cafeproje;charset=utf8",'cafeuser','asdfg1327');
        $dbConnection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    catch(PDOException $e) {
        echo "Bağlantı Başarısız: " . $e->getMessage();
    }
?>