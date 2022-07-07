<?php
    include 'header.php';
?>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Türler</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
                            <li class="breadcrumb-item">Türler</li>
                            <li class="breadcrumb-item active">Türler Tablosu</li>
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
                                <h3 class="card-title py-1">Türler Tablosu</h3>
                                <a href="type_add.php" class="btn btn-sm btn-default text-body px-4 float-right">Tür Ekle</a>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Tür ID</th>
                                            <th>Tür Adı</th>
                                            <th colspan="2" class="text-center">İşlemler</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = $db -> prepare("SELECT * FROM tur");
                                            $sql -> execute();
                                            $tablo = $sql -> fetchALL(PDO::FETCH_ASSOC);
                                            foreach ($tablo as $key => $tur) { ?>
                                            <tr>
                                                <td><?php echo $tur['id'] ?></td>
                                                <td><?php echo $tur['tur_ad'] ?></td>
                                                <td class="project-actions text-center">
                                                    <a href="type_edit.php?type_edit_id=<?php echo $tur['id'] ?>" class="btn btn-info btn-sm">
                                                        <i class="fas fa-pencil-alt"></i>
                                                        Düzenle
                                                    </a>
                                                </td>
                                                <td class="project-actions text-center">
                                                    <a href="../config/functions.php?type_delete_id=<?php echo $tur['id'] ?>" class="btn btn-danger btn-sm">
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