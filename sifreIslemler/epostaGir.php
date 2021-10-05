<?php

include("../includes/header.php");

?>

<div class="card bg-dark text-white p-5" 
    style="
    width: 25rem;margin-top: 5rem;
    margin-bottom: 5rem;
    margin-left: auto;
    margin-right: auto;
    ">
        <h1 class="card-title text-center">Şifrenizi Yenilemek için e-postanızı girin</h1>
        <div class="card-body text-center">
            <form class="form-group" action="mailer.php" method="POST">
                <label for="eposta">Kullanıcı Mailiniz :</label>
                <input class="form-control mt-2" type="email" name="eposta" placeholder="Sisteme kayıtlı E-Postanızı girin.">
                <input type="submit" value="Doğrulama Kodu Gönder" class="btn btn-primary mt-5">
            </form>
        </div>
</div>







<link rel="stylesheet" type="text/css" href="adminGiris.css">
</body>

</html>