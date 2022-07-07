<?php
include 'header.php';
?>
<?php  

$id = $_GET['id'];
$sor = $db->prepare("SELECT * FROM siparisler WHERE masa_sifre=?");
$sor->execute(array($id));
$cek = $sor->fetch(PDO::FETCH_ASSOC);

$masa_id = $cek['masa_id'];

$sor = $db->prepare("SELECT * FROM masalar WHERE id=?");
$sor->execute(array($masa_id));
$ceks = $sor->fetch(PDO::FETCH_ASSOC);
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Siparis Detay</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
                        <li class="breadcrumb-item">Siparis Detay</li>
                        <li class="breadcrumb-item active"><?php echo $ceks['masa_ad'] ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title py-1"><?php echo $cek['masa_ad'] ?></h3>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Masa Bilgileri</h3>
                                    <hr>
                                    <label class="my-1">Masa Ad:</label>
                                    <input  class="form-control" disabled value="<?php echo $ceks['masa_ad'] ?>" name="">
                                    <label class="my-1">Masa Şifre:</label>
                                    <input  class="form-control" disabled value="Masa Kapalı" name="">
                                </div>
                                <div class="col-md-6">
                                    <h3>Siparis Bilgileri</h3>
                                    <table class="table table-md table-striped table-hover table-bordered table-light">
                                        <tr>
                                            <th>Tarih</th>
                                          <th>Ürün</th>
                                          <th style="text-align: center;">Adet</th>
                                          <th style="text-align: center;">Fiyat</th>
                                      </tr>
                                      <?php  

                                      $masa_id = $ceks['id'];
                                      $masa_sifre = $id;

                                      $sql = "SELECT * FROM siparisler WHERE masa_id=$masa_id and masa_sifre='$masa_sifre' and gizli=1";
                                      foreach ($db->query($sql) as $key) { ?>
                                          <?php  

                                          $urunSiparisId = $key['urun_id'];

                                          $sor = $db->prepare("SELECT *, urun.urun_ad urunAd , stok.satis_fiyat satisFiyat , marka.marka_ad markaAd FROM urun inner join stok on stok.urun=urun.id inner join marka on marka.id=urun.urun_marka WHERE urun.id=?");
                                          $sor->execute(array($urunSiparisId));
                                          $cek = $sor->fetch(PDO::FETCH_ASSOC);

                                          ?>
                                          <tr>
                                            <td><?php echo $key['siparis_tarih'] ?></td>
                                            <td><?php echo $cek['markaAd'].' '.$cek['urunAd'] ?></td>
                                            <td align="center">
                                              <?php echo $urun_adet = $key['urun_adet'] ?>
                                          </td>
                                          <td align="center"><?php $urun_fiyat = $urun_adet*$cek['satisFiyat']; echo $urun_fiyat; ?>₺</td>
                                      </tr>
                                  <?php } ?>
                                  <?php  

                                  $sor = $db->prepare("SELECT SUM(urun_adet) as toplam FROM siparisler WHERE masa_id=? and masa_sifre=? and gizli=1");
                                  $sor->execute(array($masa_id , $masa_sifre));
                                  $toplamadet = $sor->fetch(PDO::FETCH_ASSOC);

                                  ?>
                                  <?php  

                                  $sor = $db->prepare("SELECT SUM(fiyat) as toplamfiyat FROM siparisler WHERE masa_id=? and masa_sifre=? and gizli=1");
                                  $sor->execute(array($masa_id , $masa_sifre));
                                  $toplamfiyat = $sor->fetch(PDO::FETCH_ASSOC);

                                  ?>
                                  <tr class="text-danger">
                                      <td>Toplam:</td>
                                      <td></td>
                                      <td align="center"><?php echo $toplamadet['toplam']; ?></td>
                                      <td align="center"><?php echo $toplamfiyat['toplamfiyat'] ?>₺</td>
                                  </tr>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
</div>

<?php
include 'footer.php';
?>