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
                        <li class="breadcrumb-item active">Stok Ekle</li>
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
                            <h3 class="card-title">Stok Bilgileri</h3>
                        </div>
                        <form action="../config/action.php" method="post">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label>Ürün Adı</label>
                                        <select name="product_name" class="form-control">
                                            <option>Ürün Seciniz..</option>
                                            <?php
                                            $sql = $db -> prepare("SELECT *, marka.marka_ad markaAd, urun.urun_ad, urun.id urun_id FROM urun inner join marka on marka.id=urun.urun_marka ORDER BY marka.marka_ad ASC");
                                            $sql -> execute();
                                            $tablo = $sql -> fetchALL(PDO::FETCH_ASSOC);
                                            foreach ($tablo as $key => $urun) { ?>
                                                <option id="urun_id" value="<?php echo $urun['urun_id'] ?>"><?php echo $urun['markaAd'].' '.$urun['urun_ad'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Stok Adeti</label>
                                        <input type="number" name="stock_number" placeholder="Adet.." class="form-control">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Ürün Alış Fiyatı</label>
                                        <input type="number" min="0.000" max="100000.000" step="0.01" name="product_price_purchase" placeholder="Alış Fiyat.." class="form-control">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Ürün Satış Fiyatı</label>
                                        <input type="number" min="0.000" max="100000.000" step="0.01" name="product_price_sale" placeholder="Satış Fiyat.." class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" name="stock_add" class="btn btn-primary px-4 float-right">Ekle</button>
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