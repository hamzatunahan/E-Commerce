<?php

include("../includes/header.php");

?>

<div class="card bg-dark text-white p-5" 
    style="
    width: 30rem;margin-top: 5rem;
    margin-bottom: 5rem;
    margin-left: auto;
    margin-right: auto;
    ">
        <h1 class="card-title text-center">Şifrenizi Yenilemek için e-postanızı ve mailinize gönderilen kodu girin</h1>
        <div class="card-body text-center">
            <form class="form-group" action="kodKontrol.php" method="POST">
                <label class="mt-2" for="eposta">Kullanıcı Mailiniz :</label>
                <input class="form-control mt-1" type="email" name="eposta" placeholder="Sisteme kayıtlı E-Postanızı girin.">
                <label class="mt-2" for="kod">Maile Gönderilen Kod :</label>
                <input class="form-control mt-1" type="text" name="kod" placeholder="Mailinize gelen kodu girin.">
                <input type="submit" value="Şifre Değiştir" class="btn btn-primary mt-5">
            </form>
        </div>
</div>

</body>
</html>