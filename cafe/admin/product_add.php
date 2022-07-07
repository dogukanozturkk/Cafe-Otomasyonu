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
                            <li class="breadcrumb-item active">Ürün Ekle</li>
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
                                <h3 class="card-title">Ürün Bilgileri</h3>
                            </div>
                            <form action="../config/action.php" method="post" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-4">
                                            <label>Ürün Resim</label>
                                            <input type="file" name="product_resim"  class="form-control">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Ürün Markası</label>
                                            <select name="product_brand" class="form-control">
                                                <option>Marka Seciniz..</option>
                                                <?php
                                                    $sql = $db -> prepare("SELECT * FROM marka");
                                                    $sql -> execute();
                                                    $tablo = $sql -> fetchALL(PDO::FETCH_ASSOC);
                                                    foreach ($tablo as $key => $marka) { ?>
                                                        <option value="<?php echo $marka['id'] ?>"><?php echo $marka['marka_ad'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Ürün Adı</label>
                                            <input type="text" name="product_name" placeholder="Ad.." class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" name="product_add" class="btn btn-primary px-4 float-right">Ekle</button>
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