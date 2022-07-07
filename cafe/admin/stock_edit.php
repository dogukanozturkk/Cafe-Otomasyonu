<?php
include 'header.php';
?>

<?php
$sql = $db -> prepare("SELECT * FROM stok WHERE id = ?");
$sql -> execute([$_GET['stock_edit_id']]);
$stok = $sql -> fetch(PDO::FETCH_ASSOC);
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
                        <li class="breadcrumb-item active">Stok Düzenle</li>
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
                                            <?php  

                                            $urun = $stok['urun']; 
                                            $aa=$db->prepare("SELECT * FROM urun WHERE id=?");
                                            $aa->execute(array($urun));
                                            $ss=$aa->fetch(PDO::FETCH_ASSOC);
                                            $marka = $ss['urun_marka'];

                                            ?>
                                            <option value="<?php echo $stok['urun'] ?>"><?php echo markaAd($marka)?> <?php urunAd($stok['urun']) ?></option>
                                            <option disabled>------</option>
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
                                        <input type="number" name="stock_number" value="<?php echo $stok['adet'] ?>" class="form-control">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Ürün Alış Fiyatı</label>
                                        <input type="number" min="0.000" max="100000.000" step="0.01" name="product_price_purchase" value="<?php echo $stok['alis_fiyat'] ?>" class="form-control">
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Ürün Satış Fiyatı</label>
                                        <input type="number" min="0.000" max="100000.000" step="0.01" name="product_price_sale" value="<?php echo $stok['satis_fiyat'] ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="hidden" name="stock_id" value="<?php echo $stok['id'] ?>">  
                                <button type="submit" name="stock_edit" class="btn btn-primary px-4 float-right">Düzenle</button>
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