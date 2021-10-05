<?php

include("../../includes/header.php");

?>

<div class="card bg-dark text-white p-5" id="marg" style="width: 25rem;">
    <h1 class="card-title text-center">Admin Adı ve Şifrenizle Giriş Yapınız</h1>
    <div class="card-body">
        <form class="form-group" action="../adminLogin.php" method="POST">
            <label for="rumuz">Admin adı :</label>
            <input id="rumuz" class="form-control mt-1" type="text" name="rumuz" placeholder="Kullanıcı adınızı girin.">
            <div id="rumuzMesaj" class="bg-danger p-1 mt-1 d-none">Kullanıcı adı boş bırakılamaz.</div>
            <label class="mt-3" for="KullaniciSifre">Şifre :</label>
            <input id="sifre" class="form-control mt-1" type="password" name="sifre" placeholder="Şifrenizi girin.">
            <div id="sifreMesaj" class="bg-danger p-1 mt-1 d-none">Şifre boş bırakılamaz.</div>
            <input type="submit" value="Giriş" class="btn btn-primary mt-3">
        </form>
        <div class="text-center"><a class="btn btn-info text-center" href="/ProjeE-ticaret/sifreIslemler/epostaGir.php">Şifremi Unuttum</a></div>
    </div>
</div>







<link rel="stylesheet" type="text/css" href="adminGiris.css">


<script>
    // Sayfa Hazır olduğunda Çalış
    $(document).ready(function() {


        var kullaniciAdInput = $("#rumuz");
        var sifreInput = $("#sifre");

      

        kullaniciAdInput.click(function() {

            if ($(this).val() == "") {
                $("#rumuzMesaj").removeClass("d-none");
            }
        });

        kullaniciAdInput.keypress(function() {
            $("#rumuzMesaj").addClass("d-none");
        });

        sifreInput.click(function() {
            if ($(this).val() == "") {
                $("#sifreMesaj").removeClass("d-none");
            }else {
                $("#sifreMesaj").addClass("d-none");
            }
        });

        sifreInput.keypress(function() {
            $("#sifreMesaj").addClass("d-none");
        });
  

    });
</script>
</body>

</html>