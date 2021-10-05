<?php include("../includes/header.php"); ?>
<div class='card text-dark p-5' id='marg' style='width: 48rem;'>
     <div class='row'> 
     $resimhtml
    </div>
    <h2 class='card-title text-center mt-4'>$ad</h2>
        <div class='card-body bg-secondary rounded mt-3 border border-white'>
        <p class='card-text'>$detay</p>
            <br>
            <p class='card-text'> <b>$fiyat TL</b></p>
    
            <a href='sepet.php?id=".$idsepet."' class='btn btn-success'>Sepete Ekle</a>
    
        </div>
        <div class='card-footer'> 
        <form action='yorumKayit.php' method='post'> 
        <div class='row mt-2 '>
            
            <div class = 'col-sm-4 border'>
            <label for='kullad'>Kullanıcı adı :</label>
            <input class='form-control mt-1' type='text' name='kullad' placeholder='Kullanıcı adınızı girin.'>
            <label class='mt-3' for='email'>E-mail :</label>
            <input class='form-control mt-1' type='email' name='email' placeholder='Kullanıcı adınızı girin.'> 
            </div> 
            <div class = 'col-sm-8 border'>
            <input class='form-control mt-3 h-50 ' type='textarea' name='yorum' placeholder='yorumunuzu girin.'> 
                <input type='submit' value='Kaydet' class='btn btn-primary mt-4 btn-sm'>
            </div> 
            
        </div>
        </form> 
        </div>
    
    
    </div> 

<?php include("../includes/footer.php");   ?>