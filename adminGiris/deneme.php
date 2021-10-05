<?php 


session_start();
ob_start();
if(isset($_SESSION['id'],$_SESSION['kullaniciAd'],$_SESSION['sifre'])){


    echo "ID = ".$_SESSION['id']." Name = ".$_SESSION['kullaniciAd'];


}




?>