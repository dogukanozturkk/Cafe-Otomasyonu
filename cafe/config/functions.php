<?php  
include 'db.php';
ob_start();
session_start();
error_reporting(0);
function tarih($tarih) {
	$year   = substr($tarih, 0,4);
	$month = substr($tarih, 5,2);
	$day  = substr($tarih, 8,2);

	$sayisalAylar = array("01","02","03","04","05","06","07","08","09","10","11","12");
	$ingilizAylar = array("Ocak","Şubat","Mart","Nisan","Mayıs","Haziran","Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık");

	$realMonth = str_replace($sayisalAylar, $ingilizAylar, $month);

	echo $day.' '.$realMonth.' '.$year;

}

# Müsteri Giris
function musteriGiris($sifre) {
	global $db;

	$sql = $db->prepare("SELECT * FROM masalar WHERE masa_sifre=?");
	$sql->execute(array($sifre));

	$count = $sql->rowCount();

	if($count > 0) {
		$row = $sql->fetch(PDO::FETCH_ASSOC);
		$_SESSION['masaid'] = $row['id'];
		$_SESSION['sifre'] = $row['masa_sifre'];
		return true;
	}
}

# Masa Ad
function masaAd($masa_id) {
	global $db;
	
	$sql = $db->prepare("SELECT * FROM masalar WHERE id=?");
	$sql->execute(array($masa_id));
	$row=$sql->fetch(PDO::FETCH_ASSOC);

	$masa_ad = $row['masa_ad'];
	echo $masa_ad;
}

# Tür Ad
function turAd($turid) {
	global $db;
	
	$sql = $db->prepare("SELECT * FROM tur WHERE id=?");
	$sql->execute(array($turid));
	$row=$sql->fetch(PDO::FETCH_ASSOC);

	$masa_ad = $row['tur_ad'];
	echo $masa_ad;
}

# Marka Ad
function markaAd($markid) {
	global $db;
	
	$sql = $db->prepare("SELECT * FROM marka WHERE id=?");
	$sql->execute(array($markid));
	$row=$sql->fetch(PDO::FETCH_ASSOC);

	$masa_ad = $row['marka_ad'];
	echo $masa_ad;
}

# Urun Ad
function urunAd($markid) {
	global $db;
	
	$sql = $db->prepare("SELECT * FROM urun WHERE id=?");
	$sql->execute(array($markid));
	$row=$sql->fetch(PDO::FETCH_ASSOC);

	$masa_ad = $row['urun_ad'];
	echo $masa_ad;
}


# Tür Ekleme
function turEkle($name) {
	global $db;

	$sql = $db->prepare("SELECT * FROM tur WHERE tur_ad=?");
	$sql->execute(array($name));

	$count = $sql->rowCount();

	if($count == 0) {
		$sql = $db->prepare("INSERT INTO tur SET
			tur_ad=:turname
			");
		$sql->execute(array(
			'turname' => $name
		));
		return true;
	} else {
		return false;
	}
}

# Tür Düzenle
function turDuzenle($name , $id) {
	global $db;

	$sql = $db->prepare("SELECT * FROM tur WHERE tur_ad=?");
	$sql->execute(array($name));

	$count = $sql->rowCount();

	if($count == 0) {
		$sql = $db->prepare("UPDATE tur SET
			tur_ad=:turname
			WHERE id=$id");
		$sql->execute(array(
			'turname' => $name
		));
		return true;
	} else {
		return false;
	}
}

# Marka Ekleme
function markaEkle($name , $tur) {
	global $db;

	$sql = $db->prepare("SELECT * FROM marka WHERE marka_ad=?");
	$sql->execute(array($name));

	$count = $sql->rowCount();

	if($count == 0) {
		$sql = $db->prepare("INSERT INTO marka SET
			marka_ad=:markname,
			marka_tur=:tur
			");
		$sql->execute(array(
			'markname' => $name,
			'tur'      => $tur
		));
		return true;
	} else {
		return false;
	}
}

# Marka Düzenleme
function markaDuzenle($name , $tur , $id) {
	global $db;

	$sql = $db->prepare("SELECT * FROM marka WHERE marka_ad=? and marka_tur=?");
	$sql->execute(array($name , $tur));

	$count = $sql->rowCount();

	if($count == 0) {
		$sql = $db->prepare("UPDATE marka SET
			marka_ad=:markname,
			marka_tur=:tur
			WHERE id=$id");
		$sql->execute(array(
			'markname' => $name,
			'tur'      => $tur
		));
		return true;
	} else {
		return false;
	}
}

# Urun Ekleme
function urunEkle($names , $marka , $resimyol) {
	global $db;

	$sql = $db->prepare("INSERT INTO urun SET
		urun_ad=:name,
		urun_marka=:marka,
		urun_resim=:resim
		");
	$sql_check = $sql->execute(array(
		'resim' => $resimyol,
		'name' => $names,
		'marka' => $marka
	));

	if($sql_check) {
		return true;
	} else {
		return false;
	}
} 

# Urun Ekleme
function urunDuzenle($names , $marka , $resimyol , $id) {
	global $db;

	$sql = $db->prepare("UPDATE urun SET
		urun_resim=:resim,
		urun_ad=:name,
		urun_marka=:marka
		WHERE id=$id");
	$sql_check = $sql->execute(array(
		'resim' => $resimyol,
		'name' => $names,
		'marka' => $marka
	));

	if($sql_check) {
		return true;
	} else {
		return false;
	}
} 

# Stok Ekleme
function stokEkle($urun , $stok , $alis , $satis) {
	global $db;

	$sql = $db->prepare("INSERT INTO stok SET
		urun=:product,
		adet=:adet,
		alis_fiyat=:alis,
		satis_fiyat=:satis
		");
	$sql_check = $sql->execute(array(
		'product' => $urun,
		'adet' => $stok,
		'alis' => $alis,
		'satis' => $satis
	));

	if($sql_check) {
		return true;
	} else {
		return false;
	}

}

# Stok Düzenleme
function stokDuzenle($urun , $stok , $alis , $satis , $id) {
	global $db;

	$sql = $db->prepare("UPDATE stok SET
		urun=:product,
		adet=:adet,
		alis_fiyat=:alis,
		satis_fiyat=:satis
		WHERE id=$id");
	$sql_check = $sql->execute(array(
		'product' => $urun,
		'adet' => $stok,
		'alis' => $alis,
		'satis' => $satis
	));

	if($sql_check) {
		return true;
	} else {
		return false;
	}

}

?>