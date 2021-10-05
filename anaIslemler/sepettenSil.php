<?php
$id = $_GET['id'];

include("../includes/baglanti.php");

$sql = "DELETE FROM sepeturunu WHERE ID=$id";

if($baglanti->query($sql)){
        
    //Burası link verme gibi çalışıyor. 
    header("Location: /ProjeE-ticaret/anaIslemler/sepetListele.php");
    
}else{

    echo "<p> Silme Başarısız. </p>";
}
$baglanti->close();

?>
