<?php 

$baglanti = mysqli_connect("localhost", "root", "1234", "eticaret", 3306);


    if ($baglanti->connect_errno>0) {
        die("<p> Ekleme Başarısız. </p>". $baglanti->connect_errno);
    }

?>