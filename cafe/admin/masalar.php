<?php
include 'header.php';
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
                        <li class="breadcrumb-item active">Masalar Tablosu</li>
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
                            <h3 class="card-title py-1">Masalar Tablosu</h3>
                            <a href="masa_add.php" class="btn btn-sm btn-default text-body px-4 float-right">Masa Ekle</a>
                        </div>
                        <div class="card-body my-2">
                            <div class="row">
                                <?php
                                $sql = $db -> prepare("SELECT * FROM masalar");
                                $sql -> execute();
                                $tablo = $sql -> fetchALL(PDO::FETCH_ASSOC);
                                foreach ($tablo as $key => $masa) { ?>
                                    <div class="col-sm-4">
                                        <div class="border">
                                          <div class="card-body">
                                            <h5 class="card-title"><b><?php echo $masa['masa_ad'] ?></b></h5>
                                            <p class="card-text"><?php if($masa['masa_sifre'] != null) { echo "<b class='text-danger'>DOLU</b>"; } else { echo "<b class='text-success'>BOŞ</b>"; } ?></p>
                                            <p class="card-text"><?php if($masa['masa_sifre'] != null) { 



                                                $sor = $db->prepare("SELECT SUM(fiyat) as toplamfiyat FROM siparisler WHERE masa_id=? and masa_sifre=?");
                                                $sor->execute(array($masa['id'] , $masa['masa_sifre']));
                                                $toplamfiyat = $sor->fetch(PDO::FETCH_ASSOC);



                                                echo "<b class='text-dark'>".$toplamfiyat['toplamfiyat']." TL</b>"; } else { echo "<b class='text-dark'>-</b>"; } ?></p>
                                                <a href="masa.php?id=<?php echo $masa['id'] ?>" class="btn btn-primary">Masa Görüntüle</a>
                                                <a href="../config/action.php?masasil=ok&id=<?php echo $masa['id'] ?>" class="btn btn-danger">Masa Sil</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                            </ul>
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