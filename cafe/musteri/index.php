<?php include 'header.php'; ?>
<div class="container">
  <div class="row my-5">
    <div class="col-md-12">
      <div class="cafeName"><b class="fs-1">Cafe İsmi</b></div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 my-5">
      <div class="card">
        <span class="m-3">
          <?php if($_GET['siparis'] == 'no') {
            echo "<b class='text-danger'>Siparis oluşturulamadı. Sepet Boş Olamaz.</b>";
          } ?>
          <?php if($_GET['siparis'] == 'ok') {
            echo "<b class='text-success'>Siparis oluşturuldu.</b>";
          } ?>
        </span>
        <?php  
        $masa_id = $_SESSION['masaid'];

        $sor = $db->prepare("SELECT * FROM masalar WHERE id=? and masa_sifre != ''");
        $sor->execute(array($masa_id));
        $count = $sor->rowCount();

        if($masa_id && $count > 0) {

          ?>
          <div class="card-body shadow-lg">
            <h5 class="card-title">Menü</h5>
            <h6 class="card-subtitle mb-2 text-muted float-end px-2"><?php echo masaAd($masa_id); ?></h6>
            <hr>

            <?php  

            $sql = "SELECT * FROM tur";
            foreach ($db->query($sql) as $key) { ?>
              <b class="mt-3 text-primary fs-4 border-bottom"><?php echo $key['tur_ad'] ?></b>
              <table class="table table-md my-3">
                <tr>
                  <th></th>
                  <th>Ürün</th>
                  <th>Fiyat</th>
                  <th></th>
                </tr>
                <style type="text/css">

                </style>
                <?php  

                $tur = $key['id'];
                $sql = "SELECT *, U.urun_resim urunResim , M.marka_ad markaAd, U.id urun_id, U.urun_ad urunAd FROM urun as U inner join marka as M on M.id=U.urun_marka WHERE M.marka_tur=$tur ORDER BY U.urun_marka ASC";
                foreach ($db->query($sql) as $mar) { ?>
                  <tr>

                    <td><img width="100" src="<?php echo $mar['urunResim']; ?>"></td>
                    <td class="py-5"><?php echo $mar['markaAd'].' '.$mar['urunAd'] ?></td>
                    <?php  

                    $urun = $mar['urun_id'];
                    $sor = $db->prepare("SELECT * FROM stok WHERE urun=?");
                    $sor->execute(array($urun));
                    $cek=$sor->fetch(PDO::FETCH_ASSOC);

                    if($cek['adet'] > 0) {
                      ?>
                      <td align="left" class="py-5 text-primary"><?php echo $cek['satis_fiyat'] ?>₺</td>
                      <td align="right" class="py-5">
                        <input type="number" min="0" placeholder="Adet" name="urunAdet<?php echo $urun ?>">
                        <button type="submit" class="btn btn-sm btn-outline-dark" urunId="<?php echo $urun ?>" name="sepeteEkle">Sepete Ekle</button>
                      </td>
                    <?php } else { ?>
                      <td></td>
                      <td align="right" class="text-danger py-5"><b>STOK YOK!</b></td>
                    <?php } ?>
                  </tr>
                <?php } ?>
              </table>
            <?php } ?>

            <div class="my-5">
              <form action="../config/action.php" method="POST">
              <div id="urunler">
                <h3>Sepetiniz:</h3>
              </div>
              <input type="hidden" value="<?php echo $masa_sifre ?>" name="masa_sifre">
              <input type="hidden" value="<?php echo $masa_id ?>" name="masa_id">
              <button class="btn btn-sm btn-block btn-primary my-2" style="width: 50%;" type="submit" name="siparisolustur">Sepettekileri Siparis Ver</button>
            </form>
            </div>
            <hr>
            <?php  

            $sor = $db->prepare("SELECT * FROM siparisler WHERE masa_id=? and masa_sifre=?");
            $sor->execute(array($masa_id , $masa_sifre));
            $count = $sor->rowCount();


            if($count > 0) { ?>
              <h3><b class="text-primary">Siparişleriniz;</b></h3>
              <div class="row">
                <div class="col-md-6">
                  <table class="table table-md table-responsive table-striped table-hover table-bordered table-light">
                    <tr>
                      <th>Ürün</th>
                      <th style="text-align: center;">Adet</th>
                      <th style="text-align: center;">Fiyat</th>
                    </tr>
                    <?php  

                    $sql = "SELECT * FROM siparisler WHERE masa_id=$masa_id and masa_sifre='$masa_sifre'";
                    foreach ($db->query($sql) as $key) { ?>
                      <?php  

                      $urunSiparisId = $key['urun_id'];

                      $sor = $db->prepare("SELECT *, urun.urun_ad urunAd , stok.satis_fiyat satisFiyat , marka.marka_ad markaAd FROM urun inner join stok on stok.urun=urun.id inner join marka on marka.id=urun.urun_marka WHERE urun.id=?");
                      $sor->execute(array($urunSiparisId));
                      $cek = $sor->fetch(PDO::FETCH_ASSOC);

                      ?>
                      <tr>
                        <td><?php echo $cek['markaAd'].' '.$cek['urunAd'] ?></td>
                        <td align="center">
                          <?php echo $urun_adet = $key['urun_adet'] ?>
                        </td>
                        <td align="center"><?php $urun_fiyat = $urun_adet*$cek['satisFiyat']; echo $urun_fiyat; ?>₺</td>
                      </tr>
                    <?php } ?>
                    <?php  

                    $sor = $db->prepare("SELECT SUM(urun_adet) as toplam FROM siparisler WHERE masa_id=? and masa_sifre=?");
                    $sor->execute(array($masa_id , $masa_sifre));
                    $toplamadet = $sor->fetch(PDO::FETCH_ASSOC);

                    ?>
                    <?php  

                    $sor = $db->prepare("SELECT SUM(fiyat) as toplamfiyat FROM siparisler WHERE masa_id=? and masa_sifre=?");
                    $sor->execute(array($masa_id , $masa_sifre));
                    $toplamfiyat = $sor->fetch(PDO::FETCH_ASSOC);

                    ?>
                    <tr class="text-danger">
                      <td class="text-danger">Toplam:</td>
                      <td class="text-danger" align="center"><?php echo $toplamadet['toplam']; ?></td>
                      <td class="text-danger" align="center"><?php echo $toplamfiyat['toplamfiyat'] ?>₺</td>
                    </tr>
                  </table>
                </div>
              </div>
            <?php } ?>
          </div>

        <?php } else { ?>

          <div class="card-body shadow-lg">
            <h5 class="card-title">Masa Girişi</h5>
            <h6 class="card-subtitle mb-2 text-muted float-end px-2">Lütfen Giriş Yapınız.</h6>
            <hr>
            <form action="../config/action.php" class="col-md-4" method="POST">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Kullanıcı Adı</label>
                <input type="text" class="form-control" name="kullaniciadi" disabled value="restoranismi">
              </div>
              <div class="mb-3">
                <label class="form-label">Şifre</label>
                <input type="password" class="form-control" name="sifre" aria-describedby="sifreyardim">
                <div id="sifreyardim" class="form-text">Lütfen restoranın verdiği şifreyi giriniz.</div>
              </div>
              <button type="submit" name="giris" class="btn btn-primary" style="width: 100%;">Giriş Yap</button>
            </form>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>