<?php 
$id = $_GET['id'];

include("../../includes/baglanti.php");

$sorgu = "DELETE FROM yorumlar Where ID = $id";
if($baglanti->query($sorgu)){
        
    //Burası link verme gibi çalışıyor. 
    header("Location: /ProjeE-ticaret/adminGiris/adminPanel/yorumlar.php");
    
}else{

    echo "<p> Silme Başarısız. </p>";
}
$baglanti->close();




?>