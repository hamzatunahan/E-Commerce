<?php

include("../includes/header.php");

?>

<div class="card bg-dark text-white p-5" id="marg" style="width: 25rem;">
    <h2 class="card-title text-center">Üyelik için formu doldurun.</h2>
    <div class="card-body">
        <form class="form-group" action="uyelik.php" method="post">
            <label class="mt-3" for="ad">Adınız :</label>
            <input class="form-control mt-1" type="text" name="ad" placeholder="Adınızı girin.">
            <label class="mt-3" for="mail">E-mail :</label>
            <input class="form-control mt-1" type="email" name="mail" placeholder="Email girin.">
            <label class="mt-3" for="rumuz">Kullanıcı adınız :</label>
            <input class="form-control mt-1" type="text" name="rumuz" placeholder="Kullanıcı adınızı girin.">
            <label class="mt-3" class="mt-3" for="KullaniciSifre">Şifre belirleyin :</label>
            <input class="form-control mt-1" type="password" name="sifre" placeholder="Şifrenizi girin.">
            <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" value="1" name="saticiMi">
                <label class="form-check-label" for="saticiMi">
                    Satıcı hesabı oluşturmak için bu seçeneği işaretleyiniz.
                </label>
            </div>
            <input type="submit" value="Üyelik oluştur" class="btn btn-secondary mt-3 container-fluid">
        </form>
    </div>
</div>







<link rel="stylesheet" type="text/css" href="adminGiris.css">
</body>

</html>