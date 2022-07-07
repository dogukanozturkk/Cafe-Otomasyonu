<?php
    include 'header.php';
?>

<?php
    $sql = $dbConnection -> prepare("SELECT * FROM satici WHERE satici_id = ?");
    $sql -> execute([$_GET['seller_edit_id']]);
    $satici = $sql -> fetch(PDO::FETCH_ASSOC);
?>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Satıcılar</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
                            <li class="breadcrumb-item">Satıcılar</li>
                            <li class="breadcrumb-item active">Satıcı Düzenle</li>
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
                                <h3 class="card-title">Satıcı Bilgileri</h3>
                            </div>
                            <form action="config/functions.php" method="post">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="form-group col">
                                            <label>Satıcı Adı</label>
                                            <input type="text"name="seller_name" placeholder="Ad.." value="<?php echo $satici['satici_ad'] ?>" class="form-control">
                                        </div>
                                        <div class="form-group col">
                                            <label>Satıcı Numarası</label>
                                            <input type="tel" pattern="[0-9]{10-11}" name="seller_number" placeholder="Numara.." value="<?php echo $satici['satici_numara'] ?>" class="form-control">
                                        </div>
                                        <div class="form-group col">
                                            <label>Satıcı Adresi</label>
                                            <textarea type="text" name="seller_adress" rows="1" placeholder="Adres.." class="form-control"><?php echo $satici['satici_adres'] ?></textarea>
                                        </div>
                                    </div>    
                                </div>
                                <div class="card-footer">
                                    <input type="hidden" name="seller_id" value="<?php echo $satici['satici_id'] ?>">
                                    <button type="submit" name="seller_add" class="btn btn-primary px-4 float-right">Düzenle</button>
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