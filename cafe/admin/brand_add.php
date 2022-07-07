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
                            <li class="breadcrumb-item active">Marka Ekle</li>
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
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="form-group col">
                                            <label>Marka Adı</label>
                                            <input type="text" name="brand_name" placeholder="Ad.." class="form-control">
                                        </div>
                                        <div class="form-group col">
                                            <label>Marka Tür</label>
                                            <select class="form-control" name="markatur">
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
                                    <button type="submit" name="brand_add" class="btn btn-primary px-4 float-right">Ekle</button>
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