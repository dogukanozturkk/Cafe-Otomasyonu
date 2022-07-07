<?php
    include 'header.php';
?>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Ürünler</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
                            <li class="breadcrumb-item">Ürünler</li>
                            <li class="breadcrumb-item active">Ürünler Tablosu</li>
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
                                <h3 class="card-title py-1">Ürünler Tablosu</h3>
                                <a href="product_add.php" class="btn btn-sm btn-default text-body px-4 float-right">Ürün Ekle</a>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Ürün ID</th>
                                            <th>Ürün Resim</th>
                                            <th>Ürün Türü</th>
                                            <th>Ürün Marka</th>
                                            <th>Ürün Adı</th>
                                            <th colspan="2" class="text-center">İşlemler</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = $db -> prepare("SELECT * FROM urun");
                                            $sql -> execute();
                                            $tablo = $sql -> fetchALL(PDO::FETCH_ASSOC);
                                            foreach ($tablo as $key => $urun) { ?>
                                            <tr>
                                                <td><?php echo $urun['id'] ?></td>
                                                <td>
                                                    <img src="../musteri/<?php echo $urun['urun_resim'] ?>" width="50">
                                                </td>
                                                <?php  

                                                $markid = $urun['urun_marka'];
                                                $sql = $db -> prepare("SELECT * FROM marka WHERE id=?");
                                                $sql -> execute(array($markid));
                                                $row = $sql->fetch(PDO::FETCH_ASSOC);

                                                $turid = $row['marka_tur'];
                                                ?>
                                                <td><?php echo turAd($turid); ?></td>
                                                <td><?php echo markaAd($markid); ?></td>

                                                <td><?php echo $urun['urun_ad'] ?></td>
                                                <td class="project-actions text-center">
                                                    <a href="product_edit.php?product_edit_id=<?php echo $urun['id'] ?>" class="btn btn-info btn-sm">  
                                                        <i class="fas fa-pencil-alt"></i>
                                                        Düzenle
                                                    </a>
                                                </td>
                                                <td class="project-actions text-center">
                                                    <a href="../config/action.php?product_delete_id=<?php echo $urun['id'] ?>" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                        Sil
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