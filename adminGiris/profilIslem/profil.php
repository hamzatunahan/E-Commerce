<?php
session_start();
ob_start();
include("../../includes/headerClear.php");

if (isset($_SESSION['id'], $_SESSION['kullaniciAd'], $_SESSION['sifre'])) {
    $id = $_SESSION['id'];
    $kAd = $_SESSION['kullaniciAd'];
    include("../../includes/baglanti.php");
    $sorguValues = "SELECT * From kullanicilar Where ID = $id";
    $sonucValues = $baglanti->query($sorguValues);
    while ($cikti = $sonucValues->fetch_assoc()) {
        $mail = $cikti['KullaniciEmail'];
        $ad = $cikti['KullaniciAd'];

    }


?>


    <form class="mb-5" action="profilGuncelle.php?id=<?php echo $id ?>" method="post">
        <div class="row well p-5 mt-5 bg-dark text-white" style="margin-left:auto;margin-right:auto; ">

            <div class="col-sm-6">
                <label for="ad">ID</label>
                <input type="text" disabled name="ID" class="form-control" value='<?php echo $id ?>'>
                <label for="ad">Mailiniz</label>
                <input type="email" name="email" class="form-control" value='<?php echo $mail ?>'>
                <label for="kAd">Kullanıcı Adınız</label>
                <input type="text" name="kAd" class="form-control" value='<?php echo $kAd ?>'>
            </div>
            <div class="col-sm-6">
                <label for="ad">Adınız</label>
                <input type="text" name="ad" class="form-control" value='<?php echo $ad ?>'>
                <a class="btn btn-warning form-control" style="margin-top:2rem;display:block;" href="sifre.php?id=<?php echo $id ?>">Şifre işlemleri için tıklayın.</a>
                <a class="btn btn-success form-control" style="margin-top:2rem;display:block;" href="saticiOl.php?id=<?php echo $id ?>">Satıcı Başvurusu İşlemleri İçin tıklayın.</a>
            </div>
            <input type="submit" style="width:98%;margin:auto;" class="btn btn-primary mt-4" value="Profilimi Güncelle">
        </div>
        
    </form>
    <div class="text-center" style="background-color:lightgrey ;position: fixed;left:0;bottom:0;width:100%;">
        <div class="p-3">
            <button disabled class="btn p-2">Bizi Tercih Ettiğiniz İçin Teşekkürler.</button>
        </div>
    </div>








    <link rel="stylesheet" type="text/css" href="adminGiris.css">
    </body>

    </html>

<?php
}
?>