<?php  

///
ob_start();
session_start();
include 'db.php';
include 'functions.php';
///

# Masa Kapat
if(isset($_GET['masakapat'])) {
	$id = $_GET['id'];
	$sifre = $_GET['sifre'];

	$sql = $db -> prepare("UPDATE masalar SET masa_sifre = ? WHERE id = ?");
	$sql_run = $sql -> execute(['',$id]);

	$sql = $db -> prepare("UPDATE siparisler SET gizli=1 WHERE masa_sifre = ? and masa_id = ?");
	$sql_run = $sql -> execute([$sifre,$id]);

	if ($sql_run) {
		echo '<script>alert("Masa kapandı.")</script>';
		header("Refresh: 0.33; url=../admin/masalar.php");

	} else {
		echo '<script>alert("Bir hata oluştu! Marka ekleme başarısız.")</script>';

	}
}

# Masa sil
if(isset($_GET['masasil'])) {
	$id = $_GET['id'];

	$sql = $db->prepare("DELETE FROM masalar WHERE id=?");
	$sql_run = $sql->execute(array($id));

	if($sql_run) {
		echo '<script>alert("Masa Silindi.")</script>';
		header("Refresh: 0.33; url=../admin/masalar.php");
	}else {
		echo '<script>alert("Bir hata oluştu! Marka ekleme başarısız.")</script>';

	}
}

# Masa Ekle
if (isset($_POST['masa_add'])) {
	$sql = $db -> prepare("INSERT INTO masalar (masa_ad) VALUES (?)");
	$sql_run = $sql -> execute([$_POST['masaad']]);



	if ($sql_run) {
		echo '<script>alert("Masa başarıyla eklendi.")</script>';
		header("Refresh: 0.33; url=../admin/masalar.php");

	} else {
		echo '<script>alert("Bir hata oluştu! Marka ekleme başarısız.")</script>';

	}
}

# Siparis Olustur
if(isset($_POST['siparisolustur'])) {


	echo $urun = $_POST['urunid'];

	if($urun) {

		$masa_sifre = $_POST['masa_sifre'];
		$masa_id = $_POST['masa_id'];

		foreach ($urun as $key => $value) {

			$urun_id = $value;
			$urun_adet = $_POST['urunadet'.$urun_id];

			$sor = $db->prepare("SELECT * FROM siparisler WHERE masa_id=? and masa_sifre=? and urun_id=?");
			$sor->execute(array($masa_id , $masa_sifre , $urun_id));

			$count = $sor->rowCount();

			if($count == 0) {

			// Siparisler Tablosuna Ekle

				$sor = $db->prepare("SELECT * FROM stok WHERE urun=?");
				$sor->execute(array($urun_id));
				$cek = $sor->fetch(PDO::FETCH_ASSOC);

				$fiyat = $cek['satis_fiyat']*$urun_adet;

				$insert = $db->prepare("INSERT INTO siparisler SET
					masa_id=:masa,
					masa_sifre=:masasifre,
					urun_id=:urun,
					urun_adet=:adet,
					fiyat=:price
					");
				$check = $insert->execute(array(
					'price' => $fiyat,
					'masa' => $masa_id,
					'masasifre' => $masa_sifre,
					'urun' => $urun_id,
					'adet' => $urun_adet
				));
				$stok = $db->prepare("UPDATE stok SET adet=adet-$urun_adet WHERE urun=?");
				$check = $stok->execute(array($urun_id));
			} else {
			// Siparisin Adetini Güncelle

				$sor = $db->prepare("SELECT * FROM stok WHERE urun=?");
				$sor->execute(array($urun_id));
				$cek = $sor->fetch(PDO::FETCH_ASSOC);

				$fiyat = $cek['satis_fiyat']*$urun_adet;

				$insert = $db->prepare("UPDATE siparisler SET
					urun_adet=urun_adet+$urun_adet,
					fiyat = fiyat+$fiyat
					WHERE masa_id=:masa and masa_sifre=:masasifre and urun_id=:urun");
				$check = $insert->execute(array(
					'masa' => $masa_id,
					'masasifre' => $masa_sifre,
					'urun' => $urun_id
				)); 
				$stok = $db->prepare("UPDATE stok SET adet=adet-$urun_adet WHERE urun=?");
$check = $stok->execute(array($urun_id));
			}

			
			if($check) {
				header('location:../musteri/index.php?siparis=ok');
			} else {
				echo "hata";
			}

		}
	} else {
		header('location:../musteri/index.php?siparis=no');
	}

}

if(isset($_GET['adetazalt'])) {
	$siparis = $_GET['id'];
	$masa = $_GET['masa'];

	$sor = $db->prepare("SELECT * FROM siparisler WHERE id=?");
	$sor->execute(array($siparis));
	$cek = $sor->fetch(PDO::FETCH_ASSOC);

	$urunid = $cek['urun_id'];

	$sor = $db->prepare("SELECT * FROM stok WHERE urun=?");
	$sor->execute(array($urunid));
	$cek = $sor->fetch(PDO::FETCH_ASSOC);

	$fiyat = $cek['satis_fiyat'];



	$insert = $db->prepare("UPDATE siparisler SET
		urun_adet=urun_adet-1,
		fiyat = fiyat-$fiyat
		WHERE id=$siparis");
	$check = $insert->execute();

	$update = $db->prepare("UPDATE stok SET adet=adet+1 WHERE urun=?");
	$check = $update->execute(array($urunid));


	$sor = $db->prepare("SELECT * FROM siparisler WHERE id=?");
	$sor->execute(array($siparis));
	$cek = $sor->fetch(PDO::FETCH_ASSOC);

	if($cek['urun_adet'] == 0) {
		$delete = $db->prepare("DELETE FROM siparisler WHERE id=?");
		$check = $delete->execute(array($siparis));
	}

	if($check) {
		header('location:../admin/masa.php?id='.$masa.'&azalt=ok');
	} else {
		header('location:../admin/masa.php?id='.$masa.'&azalt=no');
	}

}

if(isset($_GET['adetarrtir'])) {
	$siparis = $_GET['id'];
	$masa = $_GET['masa'];

	$sor = $db->prepare("SELECT * FROM siparisler WHERE id=?");
	$sor->execute(array($siparis));
	$cek = $sor->fetch(PDO::FETCH_ASSOC);

	$urunid = $cek['urun_id'];

	$sor = $db->prepare("SELECT * FROM stok WHERE urun=?");
	$sor->execute(array($urunid));
	$cek = $sor->fetch(PDO::FETCH_ASSOC);

	$fiyat = $cek['satis_fiyat'];



	$insert = $db->prepare("UPDATE siparisler SET
		urun_adet=urun_adet+1,
		fiyat = fiyat+$fiyat
		WHERE id=$siparis");
	$check = $insert->execute();

	$update = $db->prepare("UPDATE stok SET adet=adet-1 WHERE urun=?");
	$check = $update->execute(array($urunid));

	$sor = $db->prepare("SELECT * FROM siparisler WHERE id=?");
	$sor->execute(array($siparis));
	$cek = $sor->fetch(PDO::FETCH_ASSOC);

	if($cek['urun_adet'] == 0) {
		$delete = $db->prepare("DELETE FROM siparisler WHERE id=?");
		$check = $delete->execute(array($siparis));
	}

	if($check) {
		header('location:../admin/masa.php?id='.$masa.'&arttir=ok');
	} else {
		header('location:../admin/masa.php?id='.$masa.'&arttir=no');
	}

}

# Masa Sifre
if(isset($_GET['sifreolustur'])) {
	echo $id = $_GET['id'];

	$sql = $db -> prepare("UPDATE masalar SET masa_sifre = ? WHERE id = ?");
	$sql_run = $sql -> execute([uniqid(),$id]);

	if ($sql_run) {
		echo '<script>alert("Masa başarıyla açıldı.")</script>';
		header("Refresh: 0.33; url=../admin/masa.php?id=".$id."");

	} else {
		echo '<script>alert("Bir hata oluştu! Marka ekleme başarısız.")</script>';

	}

}

# Müsteri Giris
if(isset($_POST['giris'])) {

	$sifre = $_POST['sifre'];
	if(musteriGiris($sifre)) {
		echo '<script>alert("Giriş işlemi başarılı.")</script>';
		header("refresh: 0.33; url= ../musteri/index.php");
	}
}

# Tür Ekleme
if(isset($_POST['type_add'])) {
	$name = $_POST['type_name'];

	if(turEkle($name)) {
		echo '<script>alert("İşlem başarılı.")</script>';
		header("refresh: 0.33; url= ../admin/type.php");
	} else {
		echo '<script>alert("İşlem başarılı değil.")</script>';
		header("refresh: 0.33; url= ../admin/type.php");
	}
}

# Tür Düzenleme
if(isset($_POST['type_edit'])) {
	$name = $_POST['type_name'];
	$id = $_POST['type_id'];

	if(turDuzenle($name , $id)) {
		echo '<script>alert("İşlem başarılı.")</script>';
		header("refresh: 0.33; url= ../admin/type.php");
	} else {
		echo '<script>alert("İşlem başarılı değil.")</script>';
		header("refresh: 0.33; url= ../admin/type.php");
	}
}

# Marka Ekleme
if(isset($_POST['brand_add'])) {
	$name = $_POST['brand_name'];
	$tur  = $_POST['markatur'];

	if(markaEkle($name , $tur)) {
		echo '<script>alert("İşlem başarılı.")</script>';
		header("refresh: 0.33; url= ../admin/brand.php");
	} else {
		echo '<script>alert("İşlem başarılı değil.")</script>';
		header("refresh: 0.33; url= ../admin/brand.php");
	}
}


# Marka Düzenleme
if(isset($_POST['brand_edit'])) {
	$name = $_POST['brand_name'];
	$id = $_POST['brand_id'];
	$tur = $_POST['markatur'];
	if(markaDuzenle($name , $tur , $id)) {
		echo '<script>alert("İşlem başarılı.")</script>';
		header("refresh: 0.33; url= ../admin/brand.php");
	} else {
		echo '<script>alert("İşlem başarılı değil.")</script>';
		header("refresh: 0.33; url= ../admin/brand.php");
	}
}

if(isset($_GET['product_delete_id'])) {
	$id = $_GET['product_delete_id'];

	$delete = $db->prepare("DELETE FROM urun WHERE id=?");
	$check = $delete->execute(array($id));

	if ($check) {
            echo '<script>alert("Ürün başarıyla silindi.")</script>';
            header ("refresh: 0.33; url= ../admin/product.php");

        } else {
            echo '<script>alert("Bir hata oluştu! Ürün silme başarısız.")</script>';

        }

}

# Ürün Ekleme 
if(isset($_POST['product_add'])) {
	$names = $_POST['product_name'];
	$marka = $_POST['product_brand'];
	$resimn = $_FILES['product_resim']["name"];

	if($resimn != null) {

		$uploads_dir = '../musteri/img/urun';
		@$tmp_name = $_FILES['product_resim']["tmp_name"];
		@$name = $_FILES['product_resim']["name"];
		@$tip = $_FILES['product_resim']["type"];	
		$yeniTip = substr($tip, 6);

		$benzersizsayi1 = rand(20000,32000);
		$benzersizsayi2 = rand(20000,32000);

		$benzersizad = $benzersizsayi1.$benzersizsayi2;
		$resimyol=substr($uploads_dir, 11)."/urun-"."-".$benzersizad.'-'.'.'.'jpg';
		@move_uploaded_file($tmp_name, "$uploads_dir/urun--$benzersizad-.jpg");

	} else {
		$resimyol = 'https://i0.wp.com/fansada.com/wp-content/uploads/2020/10/Urun-gorseli-hazirlaniyor.png?ssl=1';
	}

	if(urunEkle($names , $marka , $resimyol)) {
		echo '<script>alert("İşlem başarılı.")</script>';
		header("refresh: 0.33; url= ../admin/product.php");
	} else {
		echo '<script>alert("İşlem başarılı değil.")</script>';
		header("refresh: 0.33; url= ../admin/product.php");
	}
}

# Ürün Düzenleme 
if(isset($_POST['product_edit'])) {
	$id = $_POST['product_id'];
	$names = $_POST['product_name'];
	$marka = $_POST['product_brand'];
	$resimn = $_FILES['product_resim']["name"];

	if($resimn != null) {

		$uploads_dir = '../musteri/img/urun';
		@$tmp_name = $_FILES['product_resim']["tmp_name"];
		@$name = $_FILES['product_resim']["name"];
		@$tip = $_FILES['product_resim']["type"];	
		$yeniTip = substr($tip, 6);

		$benzersizsayi1 = rand(20000,32000);
		$benzersizsayi2 = rand(20000,32000);

		$benzersizad = $benzersizsayi1.$benzersizsayi2;
		$resimyol=substr($uploads_dir, 11)."/urun-"."-".$benzersizad.'-'.'.'.'jpg';
		@move_uploaded_file($tmp_name, "$uploads_dir/urun--$benzersizad-.jpg");

	} else {
		$sor = $db->prepare("SELECT * FROM urun WHERE id=?");
		$sor->execute(array($id));
		$cek = $sor->fetch(PDO::FETCH_ASSOC);
		$resimyol = $cek['urun_resim'];
	}

	if(urunDuzenle($names , $marka , $resimyol , $id)) {
		echo '<script>alert("İşlem başarılı.")</script>';
		header("refresh: 0.33; url= ../admin/product.php");
	} else {
		echo '<script>alert("İşlem başarılı değil.")</script>';
		header("refresh: 0.33; url= ../admin/product.php");
	}
}

# Stok Ekleme
if(isset($_POST['stock_add'])) {
	$urun = $_POST['product_name'];
	$stok = $_POST['stock_number'];
	$alis = $_POST['product_price_purchase'];
	$satis = $_POST['product_price_sale'];

	if(stokEkle($urun , $stok , $alis , $satis)) {
		echo '<script>alert("İşlem başarılı.")</script>';
		header("refresh: 0.33; url= ../admin/stock.php");
	} else {
		echo '<script>alert("İşlem başarılı değil.")</script>';
		header("refresh: 0.33; url= ../admin/stock.php");
	}
}

# Stok Düzenleme
if(isset($_POST['stock_edit'])) {
	$id = $_POST['stock_id'];
	$urun = $_POST['product_name'];
	$stok = $_POST['stock_number'];
	$alis = $_POST['product_price_purchase'];
	$satis = $_POST['product_price_sale'];

	if(stokDuzenle($urun , $stok , $alis , $satis , $id)) {
		echo '<script>alert("İşlem başarılı.")</script>';
		header("refresh: 0.33; url= ../admin/stock.php");
	} else {
		echo '<script>alert("İşlem başarılı değil.")</script>';
		header("refresh: 0.33; url= ../admin/stock.php");
	}
}

# Siparis Olustur
if(isset($_POST['siparisolustur'])) {


}

# Masa Kapat
/*if(isset($_GET['masakapat'])) {
	$id = $_GET['id'];
}*/

?>