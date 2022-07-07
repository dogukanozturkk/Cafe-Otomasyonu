<?php
    include 'header.php';
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
                            <li class="breadcrumb-item active">Satıcı Ekle</li>
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
                                            <input type="text"name="seller_name" placeholder="Ad.." class="form-control">
                                        </div>
                                        <div class="form-group col">
                                            <label>Satıcı Numarası</label>
                                            <input type="tel" pattern="[0-9]{10-11}" name="seller_number" placeholder="Numara.." class="form-control">
                                        </div>
                                        <div class="form-group col">
                                            <label>Satıcı Adresi</label>
                                            <textarea type="text" name="seller_adress" rows="1" placeholder="Adres.." class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" name="seller_add" class="btn btn-primary px-4 float-right">Ekle</button>
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