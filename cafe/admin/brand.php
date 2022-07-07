<?php
    include 'header.php';
?>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Markalar</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
                            <li class="breadcrumb-item">Markalar</li>
                            <li class="breadcrumb-item active">Markalar Tablosu</li>
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
                                <h3 class="card-title py-1">Markalar Tablosu</h3>
                                <a href="brand_add.php" class="btn btn-sm btn-default text-body px-4 float-right">Marka Ekle</a>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Marka ID</th>
                                            <th>Marka Adı</th>
                                            <th>Marka Tür</th>
                                            <th colspan="2" class="text-center">İşlemler</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = $db -> prepare("SELECT * FROM marka");
                                            $sql -> execute();
                                            $tablo = $sql -> fetchALL(PDO::FETCH_ASSOC);
                                            foreach ($tablo as $key => $marka) { ?>
                                            <tr>
                                                <td><?php echo $marka['id'] ?></td>
                                                <td><?php echo $marka['marka_ad'] ?></td>
                                                <td><?php $turid = $marka['marka_tur']; echo turAd($turid); ?></td>
                                                <td class="project-actions text-center">
                                                    <a href="brand_edit.php?brand_edit_id=<?php echo $marka['id'] ?>" class="btn btn-info btn-sm">  
                                                        <i class="fas fa-pencil-alt"></i>
                                                        Düzenle
                                                    </a>
                                                </td>
                                                <td class="project-actions text-center">
                                                    <a href="config/functions.php?brand_delete_id=<?php echo $marka['id'] ?>" class="btn btn-danger btn-sm">
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