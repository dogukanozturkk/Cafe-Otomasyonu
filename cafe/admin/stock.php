<?php
    include 'header.php';
?>


    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Stok</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
                            <li class="breadcrumb-item">Stok</li>
                            <li class="breadcrumb-item active">Stok Tablosu</li>
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
                                <h3 class="card-title py-1">Stok Tablosu</h3>
                                <a href="stock_add.php" class="btn btn-sm btn-default text-body px-4 float-right">Stok Ekle</a>
                                
                            </div>
                            
                            <div class="card-body">
                                <a class="btn btn-primary btn-sm my-2" href="stock.php?filtre=var">Stokta olmayanları göster</a> 
                                <a class="btn btn-secondary btn-sm my-2" href="stock.php">Tüm ürünleri göster</a> 
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Stok ID</th>
                                            <th>Stok Giriş Tarihi</th>
                                            <th>Ürün Adı</th>
                                            <th>Stok</th>
                                            <th>Ürün Alış Fiyatı</th>
                                            <th>Ürün Satış Fiyatı</th>
                                            <th colspan="2" class="text-center">İşlemler</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php

                                                if($_GET['filtre'] == 'var') {
                                                    $sql = $db->prepare("SELECT * FROM stok WHERE adet = 0");
                                                } else {
                                                    $sql = $db->prepare("SELECT * FROM stok");
                                                }

                                                $sql->execute();
                                                $tablo=$sql->fetchALL(PDO::FETCH_ASSOC);
                                                foreach($tablo as $key => $stok) { ?>
                                                <tr>
                                                    <td><?php echo $stok['id'] ?></td>
                                                    <td><?php echo $stok['tarih'] ?></td>
                                                    <td><?php

                                                    $urun = $stok['urun']; 
                                                    $aa=$db->prepare("SELECT * FROM urun WHERE id=?");
                                                    $aa->execute(array($urun));
                                                    $ss=$aa->fetch(PDO::FETCH_ASSOC);
                                                    $marka = $ss['urun_marka'];


                                                    echo  markaAd($marka);
                                                    echo " ";
                                                    echo urunAd($urun); ?></td>
                                                    <td><?php echo $stok['adet'] ?></td>
                                                    <td><?php echo $stok['alis_fiyat'] ?></td>
                                                    <td><?php echo $stok['satis_fiyat'] ?></td>
                                                    <td class="project-actions text-center">
                                                        <a href="stock_edit.php?stock_edit_id=<?php echo $stok['id'] ?>" class="btn btn-info btn-sm">  
                                                            <i class="fas fa-pencil-alt"></i>
                                                            Düzenle
                                                        </a>
                                                    </td>
                                                    <td class="project-actions text-center">
                                                        <a href="config/functions.php?stock_delete_id=<?php echo $stok['id'] ?>" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash"></i>
                                                            Sil
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tr>
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