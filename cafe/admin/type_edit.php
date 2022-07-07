<?php
    include 'header.php';
?>

<?php
    $sql = $db -> prepare("SELECT * FROM tur WHERE id = ?");
    $sql -> execute([$_GET['type_edit_id']]);
    $tur = $sql -> fetch(PDO::FETCH_ASSOC);
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
                            <li class="breadcrumb-item active">Tür Düzenle</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 mx-auto"> 
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Tür Bilgileri</h3>
                            </div>
                            <form action="../config/action.php" method="post">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col">
                                            <label>Tür Adı</label>
                                            <input type="text" name="type_name" placeholder="Ad.." value="<?php echo $tur['tur_ad'] ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <input type="hidden" name="type_id" value="<?php echo $tur['id'] ?>">
                                    <button type="submit" name="type_edit" class="btn btn-primary px-4 float-right">Düzenle</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

<?php
    include 'footer.php';
?>