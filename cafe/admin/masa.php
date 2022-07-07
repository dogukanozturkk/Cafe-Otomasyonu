<?php
include 'header.php';
?>
<?php  

$id = $_GET['id'];
$sor = $db->prepare("SELECT * FROM masalar WHERE id=?");
$sor->execute(array($id));
$cek = $sor->fetch(PDO::FETCH_ASSOC);
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Masalar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
                        <li class="breadcrumb-item">Masalar</li>
                        <li class="breadcrumb-item active"><?php echo $cek['masa_ad'] ?></li>
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
                            <?php  

                            if($cek['masa_sifre'] == null) { ?>
                                <h1 class="text-danger"><b>Masa Boş.</b></h1>
                                <a href="config/functions.php?sifreolustur&id=<?php echo $cek['id'] ?>" class="btn btn-primary">Şifre Oluştur ( Masa Açılır )</a>
                            <?php } else { ?>

                                <div class="row">
                                    <div class="col-md-4">
                                        <h3>Masa Bilgileri</h3>
                                        <hr>
                                        <label class="my-1">Masa Ad:</label>
                                        <input  class="form-control" disabled value="<?php echo $cek['masa_ad'] ?>" name="">
                                        <label class="my-1">Masa Şifre:</label>
                                        <input  class="form-control" disabled value="<?php echo $cek['masa_sifre'] ?>" name="">
                                        <a class="btn btn-danger btn-sm btn-block my-3 text-bold" href="../config/action.php?masakapat&id=<?php echo $cek['id'] ?>&sifre=<?php echo $cek['masa_sifre'] ?>">Masayı Kapat</a>
                                    </div>
                                    <div class="col-md-8">
                                        <h3>Siparis Bilgileri</h3>
                                        <hr>
                                        <table class="table table-md table-striped table-hover table-bordered table-light">
                                        <tr>
                                            <th>Tarih</th>
                                          <th>Ürün</th>
                                          <th style="text-align: center;">Adet</th>
                                          <th style="text-align: center;">Fiyat</th>
                                          <th style="text-align: center;">İşlem</th>
                                      </tr>
                                      <?php  

                                      $masa_id = $cek['id'];
                                      $masa_sifre = $cek['masa_sifre'];

                                      $sql = "SELECT * FROM siparisler WHERE masa_id=$masa_id and masa_sifre='$masa_sifre' and gizli=0";
                                      foreach ($db->query($sql) as $key) { ?>
                                          <?php  

                                          $urunSiparisId = $key['urun_id'];

                                          $sor = $db->prepare("SELECT *, urun.urun_ad urunAd , stok.adet stokAdet , stok.satis_fiyat satisFiyat , marka.marka_ad markaAd FROM urun inner join stok on stok.urun=urun.id inner join marka on marka.id=urun.urun_marka WHERE urun.id=?");
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
                                          <td>
                                         
                                              <a href="../config/action.php?adetazalt&id=<?php echo $key['id'] ?>&masa=<?php echo $id ?>" class="btn btn-danger btn-sm">Adet Azalt</a>
                                              <?php if($cek['stokAdet'] != 0) { ?>
                                              <a href="../config/action.php?adetarrtir&id=<?php echo $key['id'] ?>&masa=<?php echo $id ?>" class="btn btn-primary btn-sm">Adet Artır</a>
                                              <?php } ?>
                                          </td>
                                      </tr>
                                  <?php } ?>
                                  <?php  

                                  $sor = $db->prepare("SELECT SUM(urun_adet) as toplam FROM siparisler WHERE masa_id=? and masa_sifre=? and gizli=0");
                                  $sor->execute(array($masa_id , $masa_sifre));
                                  $toplamadet = $sor->fetch(PDO::FETCH_ASSOC);

                                  ?>
                                  <?php  

                                  $sor = $db->prepare("SELECT SUM(fiyat) as toplamfiyat FROM siparisler WHERE masa_id=? and masa_sifre=? and gizli=0");
                                  $sor->execute(array($masa_id , $masa_sifre));
                                  $toplamfiyat = $sor->fetch(PDO::FETCH_ASSOC);

                                  ?>
                                  <tr class="text-danger">
                                      <td>Toplam:</td>
                                      <td></td>
                                      <td align="center"><?php echo $toplamadet['toplam']; ?></td>
                                      <td align="center"><?php echo $toplamfiyat['toplamfiyat'] ?>₺</td>
                                      <td></td>
                                  </tr>
                              </table>
                                    </div>

                                    <div class="col-md-12">
                                        <form action="masa.php" method="GET">
                                            <div class="row">
                                                    <input type="hidden" name="id" value="<?php echo $_GET["id"] ?>">
                                                    <div class="col-sm-4"><input type="date" class="form-control" name="ilk" value="<?php if (isset($_GET['ilk'])){echo $_GET['ilk'];} ?>"></div>
                                                    <div class="col-sm-4"><input type="date" class="form-control" name="son" value="<?php if (isset($_GET['son'])){echo $_GET['son'];} ?>"></div>
                                                    <div class="form-group col-4">
                                            <label>Ürün Markası</label>
                                            <select name="product_brand" class="form-control">
                                                <option value="<?php echo $urun['urun_marka'] ?>"><?php $markid = $urun['urun_marka']; echo markaAd($markid); ?></option>
                                                <option disabled>-----</option>
                                                <?php
                                                    $sql = $db -> prepare("SELECT * FROM marka");
                                                    $sql -> execute();
                                                    $tablo = $sql -> fetchALL(PDO::FETCH_ASSOC);
                                                    foreach ($tablo as $key => $marka) { ?>
                                                        <option value="<?php echo $marka['marka_id'] ?>"><?php echo $marka['marka_ad'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                                    <div class="col-sm-4"><button class="btn btn-primary">Uygula</button></div>

                                                    <?php
                                                        $masa_id = $_GET['id'];
                                                        $ilk = $_GET['ilk'];
                                                        $son = $_GET['son'];

                                                        $sql = $db->prepare("SELECT * FROM siparisler LEFT JOIN urun ON urun_id=urun.id WHERE siparis_tarih >= ? AND siparis_tarih <= ? AND masa_id = ?");
                                                        $sql->execute(array($ilk, $son, $masa_id));

                                                        $rows = $sql->fetchAll(PDO::FETCH_ASSOC);

                                                        // echo "<pre>";
                                                        // print_r($rows);
                                                        // echo "</pre>";


                                                    ?>
                                                <div class="col-sm-12">
                                                    
                                                    <table class="table table-md table-striped table-hover table-bordered table-light mt-3">
                                                        <tr>
                                                            <th>Tarih</th>
                                                            <th>Ürün</th>
                                                            <th style="text-align: center;">Adet</th>
                                                            <th style="text-align: center;">Fiyat</th>
                                                        </tr>
                                                        
                                                        <?php
                                                        foreach ( $rows as $row ){ ?>
                                                            <tr>
                                                                <td><?php echo $row["siparis_tarih"]; ?></td>
                                                                <td><?php echo $row["urun_ad"]; ?></td>
                                                                <td align="center"><?php echo $row["urun_adet"]; ?></td>
                                                                <td align="center"><?php echo $row["fiyat"] . "/" . $Fiyat = $row["urun_adet"] * $row["fiyat"]; ?></td>
                                                            </tr>

                                                        <?php
                                                            $TotalFiyat = $Fiyat + $TotalFiyat;

                                                        } ?>

                                                        <tr class="text-danger">
                                                            <td>Toplam:</td>
                                                            <td><?php echo $TotalFiyat; ?></td>
                                                            <td align="center"></td>
                                                            <td align="center"></td>
                                                        </tr>
                                                    </table>

                                                </div>

                                            </div>

                                        </form>
                                    </div>
                                </div>

                            <?php } ?>
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