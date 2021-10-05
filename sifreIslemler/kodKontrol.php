<?php

include("../includes/header.php");

?>

<?php 
include("../includes/baglanti.php");
if (isset($_POST['eposta'],$_POST['kod'])) {
    

    $eposta = $_POST['eposta'];
    $kod = $_POST['kod'];
    $html ="";
    $sorguKod = "SELECT * From dogrulama Where Mail ='$eposta' and Kod = $kod";
    $sonucKod = $baglanti->query($sorguKod);
    if (mysqli_num_rows($sonucKod)!=0) {
    
        $html .= "
                <div class='card bg-dark text-white p-5' 
                    style='
                    width: 25rem;margin-top: 5rem;
                    margin-bottom: 5rem;
                    margin-left: auto;
                    margin-right: auto;
                    '>
                    <h1 class='card-title text-center'>Şifrenizi Yenileyebilirsiniz</h1>
                    <div class='card-body text-center'>
                        <form class='form-group' action='sifreYenile.php' method='POST'>
                            <input type='hidden' name='eposta' value='$eposta'>
                            <label for='yeniSifre'>Yeni Şifreniz</label>
                            <input class='form-control mt-2' type='password' name='yeniSifre' placeholder='Yeni Şifrenizi Girin'>
                            <label for='yeniSifreTekrar'>Yeni Şifrenizi Tekrar Girin</label>
                            <input class='form-control mt-2' type='password' name='yeniSifreTekrar' placeholder='Tekrar Girin'>
                            <input type='submit' value='Şifremi Yenile' class='btn btn-success mt-5'>
                        </form>
                    </div>
                </div>
            </body>
        </html>
    ";


    }else {
        echo "<h1>Girdiğiniz Mail Ya Da Yenileme Kodu Yanlış. Lütfen Kontrolleriniz Sağlayıp Şifrenizi Yenileyin.</h1>
              <br>
              <h1>Yönlendiriliyorsunuz...</h1>
              <h2>Sorunlarınız için <a href='mailto:hamzarslan34@gmail.com'>hamzarslan34@gmail.com</a>.</h2>
            ";
		$url = "/ProjeE-ticaret/adminGiris/adminGiris.php";
		header("Refresh: 3; url=$url");
    }
    
    
    echo $html;




}

?>

