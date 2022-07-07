<?php
include 'header.php';
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Satışlar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
                        <li class="breadcrumb-item">Satışlar</li>
                        <li class="breadcrumb-item active">Satışlar Tablosu</li>
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
                            <h3 class="card-title py-1">Satışlar Tablosu</h3>
                            <a href="brand_add.php" class="btn btn-sm btn-default text-body px-4 float-right">Marka Ekle</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tarih</th>
                                        <th>Masa ID</th>
                                        <th>Masa Sifre</th>
                                        <th>Masa Tutar</th>
                                        <th colspan="2" class="text-center">İşlemler</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = $db -> prepare("SELECT * FROM siparisler WHERE gizli=1 GROUP BY(masa_sifre)");
                                    $sql -> execute();
                                    $tablo = $sql -> fetchALL(PDO::FETCH_ASSOC);
                                    foreach ($tablo as $key => $marka) { ?>
                                        <tr>
                                            <?php  

                                            $saat = substr($marka['siparis_tarih'] , 11);


                                            ?>
                                            <td><?php echo tarih($marka['siparis_tarih']).' '.$saat; ?></td>
                                            <td><?php echo $marka['masa_id'] ?></td>
                                            <td><?php echo $marka['masa_sifre'] ?></td>
                                            <td><?php $sor = $db->prepare("SELECT SUM(fiyat) as toplamfiyat FROM siparisler WHERE masa_id=? and masa_sifre=?");
                                            $sor->execute(array($marka['masa_id'] , $marka['masa_sifre']));
                                            $toplamfiyat = $sor->fetch(PDO::FETCH_ASSOC); ?>
                                                <?php echo $toplamfiyat['toplamfiyat'].'₺'; ?>
                                            </td>
                                            <td class="project-actions text-center">
                                                <a href="goruntule.php?id=<?php echo $marka['masa_sifre'] ?>" class="btn btn-info btn-sm">  
                                                    <i class="fa fa-eye"></i>
                                                    Görüntüle
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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