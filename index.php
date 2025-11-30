<?php
session_start();
include "connect_db.php";

// Hapus OTP expired & session lama
$db->prepare("DELETE FROM otp_codes WHERE expired < " . time())->execute();
unset($_SESSION['wa']);

?>

<title>OTP WhatsApp</title>
<?php $css_ver = filemtime("style.css"); ?>
<link rel="stylesheet" href="style.css?v=<?php echo $css_ver; ?>">


<div class="title-box">
    <div class="title-logo"></div>
    <h2>OTP WhatsApp</h2>
</div>


<div class="container">
<h3>1. Kirim OTP</h3>

<form method="POST">
    <input type="text" name="wa" placeholder="Nomor WhatsApp" required>
    <button name="kirim">Kirim OTP</button>
</form>
</div>

<?php

if (isset($_POST['kirim'])) { 

    // Normalisasi nomor
    $wa = preg_replace('/[^0-9+]/', '', $_POST['wa']); // mengapus karakter selain angka dan +
    $wa = ltrim($wa, '+');
    if ($wa[0] == '0') $wa = '62' . substr($wa, 1); // ganti 0 diawal dengan 62

    // Generate OTP
    $otp      = rand(100000, 999999); // generate 6 digit OTP 
    $otp_hash = password_hash($otp, PASSWORD_DEFAULT); // hash OTP untuk disimpan di database
    $expired  = time() + 60;  // OTP berlaku 60 detik

    $_SESSION['wa'] = $wa; // simpan nomor WA di session

    // Hapus OTP lama
    $db->prepare("DELETE FROM otp_codes WHERE no_wa='$wa'")->execute();

    // Simpan OTP baru
    $stmt = $db->prepare("INSERT INTO otp_codes (no_wa, otp_hash, expired) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $wa, $otp_hash, $expired);
    $stmt->execute();

    // Kirim ke WhatsAPP API Fonnte
    $token = "******"; // sesuaikan tokennya

    $msg   = [
        "target" => $wa,
        "message" => "Kode OTP Anda adalah *$otp*\n\nUntuk keamanan perangkat anda, jangan berikan OTP ini kepada siapa pun."];

    $ch = curl_init();
    curl_setopt_array($ch,[
        CURLOPT_URL=>"https://api.fonnte.com/send",
        CURLOPT_RETURNTRANSFER=>true,
        CURLOPT_POST=>true,
        CURLOPT_POSTFIELDS=>$msg,
        CURLOPT_HTTPHEADER=>["Authorization: $token"]
    ]);
    curl_exec($ch);
    curl_close($ch);

    echo "<div class='success'>OTP telah dikirim ke $wa</div>";
    echo "<script>setTimeout(()=>location.href='verifikasi.php',2000);</script>";
}
?>
