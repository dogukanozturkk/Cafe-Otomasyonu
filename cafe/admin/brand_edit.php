<?php
    include 'header.php';
?>

<?php
    $sql = $db -> prepare("SELECT * FROM marka WHERE id = ?");
    $sql -> execute([$_GET['brand_edit_id']]);
    $marka = $sql -> fetch(PDO::FETCH_ASSOC);
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
                            <li class="breadcrumb-item active">Marka Düzenle</li>
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
                                <h3 class="card-title">Marka Bilgileri</h3>
                            </div>
                            <form action="../config/action.php" method="post">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col">
                                            <label>Marka Adı</label>
                                            <input type="text" name="brand_name" placeholder="Ad.." value="<?php echo $marka['marka_ad'] ?>" class="form-control">
                                        </div>
                                        <div class="form-group col">
                                            <label>Marka Tür</label>
                                            <select class="form-control" name="markatur">
                                                <option value="<?php echo $marka['marka_tur'] ?>"><?php $turid = $marka['marka_tur']; echo turAd($turid); ?></option>
                                                <option disabled>------</option>
                                                <?php  

                                                $sql = "SELECT * FROM tur";
                                                foreach ($db->query($sql) as $key) { ?>
                                                    <option value="<?php echo $key['id'] ?>"><?php echo $key['tur_ad'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <input type="hidden" name="brand_id" value="<?php echo $marka['id'] ?>">
                                    <button type="submit" name="brand_edit" class="btn btn-primary px-4 float-right">Düzenle</button>
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