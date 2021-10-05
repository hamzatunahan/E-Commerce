<?php


$sayfaNumara="";
for($s = 1; $s <= $toplamSayfa; $s++) {
    if($sayfa == $s) { // eğer sayfa değeri bulunduğumuz sayfaya eşit ise linki böyle göster.
        $sayfaNumara .= $s . '<- '; 
    } else {
        $sayfaNumara .='<a class="text-white" href="?sayfa=' . $s . '">' . $s . '</a> ';
    }
}

?>
