<?php
    ob_start();
    session_start();
    include 'dbConnection.php';

    if (isset($_POST['admin_login'])){
        $inc_name = $_POST['admin_name'];
        $inc_password = md5($_POST['admin_password']);
        
        if ($inc_name != "" && $inc_password != "") {
            $adminControl = $dbConnection -> prepare("SELECT * FROM admin WHERE username = ? and password = ?");
            $adminControl -> execute([$inc_name, $inc_password]);

            $say = $adminControl -> rowCount();
            
            if ($say == 1) {
                $_SESSION['admin_name'] = $inc_name;
                echo '<script>alert("Giriş işlemi başarılı.")</script>';
                header("refresh: 0.33; url= ../index.php");
                exit;
        
            } else {
                echo '<script>alert("Bu bilgilere ait admin bulunamadı! Giriş başarısız.")</script>';
                header("refresh: 0.33; url= ../login.php");

            }

        } else {
            echo '<script>alert("Lütfen eksik bir yer bırakmayın! Giriş başarısız.")</script>';
            header("refresh: 0.33; url= ../login.php");

        }
    }

    if (isset($_POST['stock_add'])) {
		$sql = $dbConnection -> prepare("INSERT INTO stok (satici_ad, stok_tarih, stok_adet, urun_ad, urun_fiyat_alis, urun_fiyat_satis) VALUES (?, ?, ?, ?, ?, ?)");
		$sql_run = $sql -> execute([$_POST['seller_name'], $_POST['stock_datetime'], $_POST['stock_number'], $_POST['product_name'], $_POST['product_price_purchase'], $_POST['product_price_sale']]);
		
		if ($sql_run) {
			echo '<script>alert("Stok başarıyla eklendi.")</script>';
            header("refresh: 0.33; url=../stock.php");
			
        } else {
            echo '<script>alert("Bir hata oluştu! Stok ekleme başarısız.")</script>';
			
		}
	}

    if (isset($_POST['stock_edit'])) {
        $sql = $dbConnection -> prepare("UPDATE stok 
                                            SET satici_ad = ?, stok_tarih = ?, stok_adet = ?, urun_ad = ?, urun_fiyat_alis = ?, urun_fiyat_satis = ? 
                                            WHERE stok_id = ?");
        $sql_run = $sql -> execute([$_POST['seller_name'], $_POST['stock_datetime'], $_POST['stock_number'], $_POST['product_name'], $_POST['product_price_purchase'], $_POST['product_price_sale'], $_POST['stock_id']]);

        if ($sql_run) {
            echo '<script>alert("Stok başarıyla güncellendi.")</script>';
            header ("refresh: 0.33; url= ../stock.php");

        } else {
            echo '<script>alert("Bir hata oluştu! Stok güncelleme başarısız.")</script>';

        }
    }

    if (isset($_GET['stock_delete_id'])) {
        $sql = $dbConnection -> prepare("DELETE FROM stok WHERE stok_id = ?");
        $sql_run = $sql -> execute([$_GET['stock_delete_id']]);

        if ($sql_run) {
            echo '<script>alert("Stok başarıyla silindi.")</script>';
            header ("refresh: 0.33; url= ../stock.php");

        } else {
            echo '<script>alert("Bir hata oluştu! Stok silme başarısız.")</script>';

        }
    }

    if (isset($_POST['seller_add'])) {
		$sql = $dbConnection -> prepare("INSERT INTO satici (satici_ad,satici_numara,satici_adres) VALUES (?,?,?)");
		$sql_run = $sql -> execute([$_POST['seller_name'], $_POST['seller_number'], $_POST['seller_adress']]);
		
		if ($sql_run) {
            echo '<script>alert("Satıcı başarıyla eklendi.")</script>';
            header("refresh: 0.33; url=../seller.php");
			
        } else {
            echo '<script>alert("Bir hata oluştu! Satıcı ekleme başarısız.")</script>';
			
		}
	}

    if (isset($_POST['seller_edit'])) {
        $sql = $dbConnection -> prepare("UPDATE satici 
                                            SET satici_ad = ?, satici_numara = ?, satici_adres = ? 
                                            WHERE satici_id = ?");
        $sql_run = $sql -> execute([$_POST['seller_name'], $_POST['seller_number'], $_POST['seller_adress'], $_POST['seller_id']]);

        if ($sql_run) {
            echo '<script>alert("Satıcı başarıyla güncellendi.")</script>';
            header ("refresh: 0.33; url= ../seller.php");

        } else {
            echo '<script>alert("Bir hata oluştu! Satıcı güncelleme başarısız.")</script>';

        }
    }

    if (isset($_GET['seller_delete_id'])) {
        $sql = $dbConnection -> prepare("DELETE FROM satici WHERE satici_id = ?");
        $sql_run = $sql -> execute([$_GET['seller_delete_id']]);

        if ($sql_run) {
            echo '<script>alert("Satıcı başarıyla silindi.")</script>';
            header ("refresh: 0.33; url= ../seller.php");

        } else {
            echo '<script>alert("Bir hata oluştu! Satıcı silme başarısız.")</script>';

        }
    }

    if (isset($_POST['product_add'])) {
		$sql = $dbConnection -> prepare("INSERT INTO urun (urun_tur,urun_marka,urun_ad) VALUES (?,?,?)");
		$sql_run = $sql -> execute([$_POST['product_type'], $_POST['product_brand'], $_POST['product_name']]);
		
		if ($sql_run) {
			echo '<script>alert("Ürün başarıyla eklendi.")</script>';
            header("refresh: 0.33; url=../product.php");
			
        } else {
            echo '<script>alert("Bir hata oluştu! Ürün ekleme başarısız.")</script>';
			
		}
	}

    if (isset($_POST['product_edit'])) {
        $sql = $dbConnection -> prepare("UPDATE urun 
                                            SET urun_tur = ?, urun_marka = ?, urun_ad = ? 
                                            WHERE urun_id = ?");
        $sql_run = $sql -> execute([$_POST['product_type'], $_POST['product_brand'], $_POST['product_name'], $_POST['product_id']]);

        if ($sql_run) {
            echo '<script>alert("Ürün başarıyla güncellendi.")</script>';
            header ("refresh: 0.33; url= ../product.php");

        } else {
            echo '<script>alert("Bir hata oluştu! Ürün güncelleme başarısız.")</script>';

        }
    }

    if (isset($_GET['product_delete_id'])) {
        $sql = $dbConnection -> prepare("DELETE FROM urun WHERE urun_id = ?");
        $sql_run = $sql -> execute([$_GET['product_delete_id']]);

        if ($sql_run) {
            echo '<script>alert("Ürün başarıyla silindi.")</script>';
            header ("refresh: 0.33; url= ../product.php");

        } else {
            echo '<script>alert("Bir hata oluştu! Ürün silme başarısız.")</script>';

        }
    }

    if (isset($_POST['type_add'])) {
		$sql = $dbConnection -> prepare("INSERT INTO tur (tur_ad) VALUES (?)");
		$sql_run = $sql -> execute([$_POST['type_name']]);
		
		if ($sql_run) {
			echo '<script>alert("Tür başarıyla eklendi.")</script>';
            header("Refresh: 0.33; url=../type.php");
			
        } else {
            echo '<script>alert("Bir hata oluştu! Tür ekleme başarısız.")</script>';
			
		}
	}

    if (isset($_POST['type_edit'])) {
        $sql = $dbConnection -> prepare("UPDATE tur 
                                            SET tur_ad = ? 
                                            WHERE tur_id = ?");
        $sql_run = $sql -> execute([$_POST["type_name"], $_POST["type_id"]]);

        if ($sql_run) {
            echo '<script>alert("Tür başarıyla güncellendi.")</script>';
            header ("refresh: 0.33; url= ../type.php");

        } else {
            echo '<script>alert("Bir hata oluştu! Tür güncelleme başarısız.")</script>';

        }
    }

    if (isset($_GET['type_delete_id'])) {
        $sql = $dbConnection -> prepare("DELETE FROM tur WHERE tur_id = ?");
        $sql_run = $sql -> execute([$_GET['type_delete_id']]);

        if ($sql_run) {
            echo '<script>alert("Tür başarıyla silindi.")</script>';
            header ("refresh: 0.33; url= ../type.php");

        } else {
            echo '<script>alert("Bir hata oluştu! Tür silme başarısız.")</script>';

        }
    }

    if (isset($_POST['brand_add'])) {
		$sql = $dbConnection -> prepare("INSERT INTO marka (marka_ad) VALUES (?)");
		$sql_run = $sql -> execute([$_POST['brand_name']]);
		
		if ($sql_run) {
			echo '<script>alert("Marka başarıyla eklendi.")</script>';
            header("Refresh: 0.33; url=../brand.php");
			
        } else {
            echo '<script>alert("Bir hata oluştu! Marka ekleme başarısız.")</script>';
			
		}
	}

    if (isset($_POST['brand_edit'])) {
        $sql = $dbConnection -> prepare("UPDATE marka SET marka_ad = ? WHERE marka_id = ?");
        $sql_run = $sql -> execute([$_POST["brand_name"],$_POST["brand_id"]]);

        if ($sql_run) {
            echo '<script>alert("Marka başarıyla güncellendi.")</script>';
            header ("refresh: 0.33; url= ../brand.php");

        } else {
            echo '<script>alert("Bir hata oluştu! Marka güncelleme başarısız.")</script>';

        }
    }

    if (isset($_GET['brand_delete_id'])) {
        $sql = $dbConnection -> prepare("DELETE FROM marka WHERE marka_id = ?");
        $sql_run = $sql -> execute([$_GET['brand_delete_id']]);

        if ($sql_run) {
            echo '<script>alert("Marka başarıyla silindi.")</script>';
            header ("refresh: 0.33; url= ../brand.php");

        } else {
            echo '<script>alert("Bir hata oluştu! Marka silme başarısız.")</script>';

        }
    }

    if (isset($_POST['masa_add'])) {
        $sql = $dbConnection -> prepare("INSERT INTO masalar (masa_ad) VALUES (?)");
        $sql_run = $sql -> execute([$_POST['masaad']]);
        
        if ($sql_run) {
            echo '<script>alert("Masa başarıyla eklendi.")</script>';
            header("Refresh: 0.33; url=../masalar.php");
            
        } else {
            echo '<script>alert("Bir hata oluştu! Marka ekleme başarısız.")</script>';
            
        }
    }

    if(isset($_GET['sifreolustur'])) {
        echo $id = $_GET['id'];

        $sql = $dbConnection -> prepare("UPDATE masalar SET masa_sifre = ? WHERE id = ?");
        $sql_run = $sql -> execute([uniqid(),$id]);

        if ($sql_run) {
            echo '<script>alert("Masa başarıyla açıldı.")</script>';
            header("Refresh: 0.33; url=../masa.php?id=".$id."");
            
        } else {
            echo '<script>alert("Bir hata oluştu! Marka ekleme başarısız.")</script>';
            
        }

    }

?>