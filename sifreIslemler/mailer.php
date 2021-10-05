<?php



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['eposta'])) {
	$htmlBody = "";
	$eposta = $_POST['eposta'];
	include("../includes/baglanti.php");
	$varMi = "SELECT * FROM kullanicilar Where KullaniciEmail = '$eposta' ";
	$varMiSorgu = $baglanti->query($varMi);
	if (mysqli_num_rows($varMiSorgu) == 0) {
		echo "<h1>Bu mail adresine ait herhangi bir kayıt bulunamadı. Yönlendiriliyorsunuz.</h1>";
		$url = "/ProjeE-ticaret/adminGiris/adminGiris.php";
		header("Refresh: 3; url=$url");
	} else {
		$kod = rand(100000, 1000000);

		$kodVarMi = "SELECT * From dogrulama Where Mail = '$eposta'";
		$kodVarMiSonuc = $baglanti->query($kodVarMi);
		if (mysqli_num_rows($kodVarMiSonuc) != 0) {
			echo "<h1>Bu mail adresine zaten kod gönderildi lütfen gelen kutunuzu kontrol ediniz . Yönlendiriliyorsunuz...</h1>
				  <br>
				  <h1>Sorunlarınız için <a href='mailto:hamzarslan34@gmail.com'>hamzarslan34@gmail.com</a> adresine mail gönderin. </h1>
			";
			$url = "/ProjeE-ticaret/adminGiris/adminGiris.php";
			header("Refresh: 10; url=$url");
		}else {
			
		
	
		$kodKayit = "INSERT INTO dogrulama(Mail,Kod) VALUES('$eposta',$kod)";
		$kodSonuc = $baglanti->query($kodKayit);
		if ($kodSonuc) {


			$htmlBody .=
				"
		<html>
			<head>
			</head>
			<body>
				<h1>Şifre Yenileme İşlemi</h1>
				<p>Şifre yenileme için kodunuz : $kod  </p>
				<a href='https://localhost/ProjeE-ticaret/SifreIslemler/dogrula.php'>Buradan Kodunuzu Girmek İçin Gidebilirsiniz.</a>
			</body>
		</html>
	";

			//kütüphaneyi projeye dahil ediyoruz 
			require_once "Exception.php";
			require_once "OAuth.php";
			require_once "PHPMailer.php";
			require_once "POP3.php";
			require_once "SMTP.php";
			//phpmailer sınıfından mail değişkeni oluşturuyoruz.
			$mail = new PHPMailer();
			//smtp ayarlarını yapıyoruz. gmail hazır geliyor username ve pw yi yeni açıp giriyoruz.
			$mail->Host = 'smtp.gmail.com';
			$mail->Username = 'zeytinburnuproje@gmail.com';
			$mail->Password = 'sifreyok';
			$mail->Port = 587;
			$mail->SMTPSecure = 'tls';
			//smtp kullanılacağını belirtiyoruz.
			$mail->isSMTP();
			$mail->SMTPAuth = true;
			//gönderilecek mesaj html mi belirtiyoruz.
			$mail->isHTML(true);
			$mail->CharSet = "UTF-8";
			$mail->SMTPDebug  = 2;

			//mailin gönderileceği hesap ve gönderen adı.
			$mail->setFrom('zeytinburnuproje@gmail.com', 'Şifre Yenileme');
			//verilecek cevabın nereye yönlendirileceğine karar veriyoruz.
			$mail->addReplyTo('zeytinburnuproje@gmail.com', 'Kullanıcı');
			//burada da gönderdiğimiz mail işlemleri.
			$mail->addAddress($eposta, 'Şifre Yenileme');
			$mail->Subject = 'Örnek mail konusu';
			$mail->Body = $htmlBody;

			if ($mail->send() == 1) {
				header("Location:/ProjeE-ticaret/sifreIslemler/dogrula.php");
			} else {
				echo " hata oluştu  $mail->ErrorInfo";
			}
		} else {
			echo "<h1>Bir hata oluştu. Yönlendiriliyorsunuz.</h1>";
			$url = "/ProjeE-ticaret/adminGiris/adminGiris.php";
			header("Refresh: 3; url=$url");
		}
		}
	}
}
