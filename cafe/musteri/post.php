<?php
error_reporting(0);
include '../config/action.php';

?>

<?php if($_POST) { ?>
<?php  

$urunid = $_POST['urunId'];
$urunAdet = $_POST['urunAdet'];

$sor=$db->prepare("SELECT * FROM urun WHERE id=?");
$sor->execute(array($urunid));
$cek=$sor->fetch(PDO::FETCH_ASSOC);

$urunad = $cek['urun_ad'];
$urunma = $cek['urun_marka'];

$sor=$db->prepare("SELECT * FROM marka WHERE id=?");
$sor->execute(array($urunma));
$cek=$sor->fetch(PDO::FETCH_ASSOC);

$markad = $cek['marka_ad'];

$sor=$db->prepare("SELECT * FROM stok WHERE urun=?");
$sor->execute(array($urunid));
$cek=$sor->fetch(PDO::FETCH_ASSOC);

$fiyat = $cek['satis_fiyat'];

?>

<?php if($urunAdet != 0) { ?>
<li class="text-danger"><?php echo $markad.' '.$urunad.' x '.$urunAdet.' : '.$fiyat*$urunAdet ?>₺</li>
<?php } ?>
<?php echo '<input type="hidden" value="'.$urunid.'" name="urunid[]">' ?>
<?php echo '<input type="hidden" value="'.$urunAdet.'" name="urunadet'.$urunid.'">' ?>
<?php // echo $markad.' '.$urunad.' : '.$fiyat.' ₺'.'<br>'; ?>
<?php } ?>