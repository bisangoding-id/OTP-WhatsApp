<?php
session_start(); 
include "connect_db.php"; 

$wa = $_SESSION['wa']; // ambil nomor WA dari session

// Ambil OTP dari database untuk cek sisa waktu/expired
$stmt = $db->prepare("SELECT * FROM otp_codes WHERE no_wa=? LIMIT 1");
$stmt->bind_param("s", $wa);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();

// Hitung sisa waktu
$remaining = max(0, $row['expired'] - time());
$otpValid = false;

?>

<title>OTP WhatsApp</title>
<?php $css_ver = filemtime("style.css"); ?>
<link rel="stylesheet" href="style.css?v=<?php echo $css_ver; ?>">

<div class="title-box">
    <div class="title-logo"></div>
    <h2>OTP WhatsApp</h2>
</div>

<div class="container">
<h3>2. Verifikasi OTP</h3>

<form method="POST">
    <input type="text" name="otp" id="input" placeholder="Masukkan OTP" required>
    <button type="submit" name="cekotp" id="btn">Verifikasi OTP</button>
</form>

<div id="cdWrapper" style="margin-top:10px;">
    Waktu tersisa: <span id="countdown"><?= $remaining ?></span> detik
</div>
</div>

<?php

if (isset($_POST['cekotp'])) {
   
// Ambil OTP dari database untuk verifikasi OTP
$stmt = $db->prepare("SELECT * FROM otp_codes WHERE no_wa=? LIMIT 1");
$stmt->bind_param("s", $wa);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();

    if (password_verify($_POST['otp'], $row['otp_hash'])) {

       echo "
       <div class='alert success'>
         <span class='alert-icon'>✔</span>
         <div class='alert-content'>
            <strong>SUCCESS!</strong>
            <p>OTP anda terverifikasi dan akun anda sudah aktif.</p>
        </div>
       </div>"; //action selanjutnya bisa ditaruh disini

       unset($_SESSION['wa']);
       $otpValid = true;

    } else {
        echo "<div class='error'>OTP SALAH!</div>";
    }
}

?>

<script>
let s = <?= $remaining ?>, // sisa waktu
    v = <?= json_encode($otpValid) ?>, // OTP valid atau tidak
    w = document.getElementById('cdWrapper'), // wrapper countdown
    c = document.getElementById('countdown'), // elemen countdown

    exp = ()=>{ 
        w.style.display="none"; 
        document.body.insertAdjacentHTML(
            "beforeend",
            "<div class='error'>OTP kadaluarsa! Silakan kirim ulang.</div>"
        );
        setTimeout(()=>location.href="index.php",2000);
    };

// Jika OTP VALID → disable input & tombol
if (v) {
    w.style.display = "none";
    document.getElementById('input').disabled = true;
    document.getElementById('btn').disabled = true;
}

// Jika waktu habis
else if (s <= 0) {
    exp();
}

// Countdown berjalan
else {
    let t = setInterval(()=>{
        c.textContent = --s;
        if (s <= 0) { clearInterval(t); exp(); }
    }, 1000);
}
</script>
