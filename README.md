# **OTP WhatsApp Verification System – PHP, JavaScript, MySQL, Fonnte API**

Repository ini berisi source code lengkap untuk membuat **sistem OTP WhatsApp** menggunakan **PHP**, **JavaScript**, **MySQL**, dan **Fonnte API**. Project ini merupakan contoh implementasi autentikasi modern berbasis WhatsApp dengan metode **OTP (One-Time Password)**. Sistem ini dapat digunakan untuk **login**, **registrasi**, **verifikasi nomor WhatsApp**, dan berbagai keperluan autentikasi lainnya.

OTP di-generate menggunakan **PHP** dan dikirim otomatis melalui **Fonnte API**. Kode OTP kemudian disimpan di **database MySQL dalam bentuk hashed**, sehingga lebih aman dan tidak bisa dibaca langsung. Untuk menjaga alur verifikasi tetap konsisten, nomor WhatsApp disimpan menggunakan **session PHP**. Pada sisi frontend, **JavaScript** digunakan untuk membuat **countdown timer** agar pengiriman OTP tidak dapat dilakukan berulang-ulang (anti spam). Seluruh alur — kirim OTP, verifikasi, pengecekan database, hingga login berhasil — dijelaskan dengan jelas dan mudah dikembangkan.


## **🔥 Fitur Utama**
- Kirim OTP WhatsApp otomatis menggunakan **Fonnte API**
- Penyimpanan OTP **hashed** di database MySQL
- Verifikasi OTP dengan **PHP**
- **Countdown timer** menggunakan JavaScript (anti spam)
- OTP hanya berlaku sekali (**one-time use**)
- Menggunakan **session PHP** untuk menyimpan nomor WhatsApp
- Struktur kode rapi dan mudah dikembangkan
- Cocok untuk login, registrasi, dan autentikasi WhatsApp


## **🛠️ Teknologi yang Digunakan**
- **PHP** – backend & generator OTP  
- **JavaScript** – countdown timer  
- **MySQL** – penyimpanan OTP ter-hash  
- **Fonnte API** – pengiriman OTP WhatsApp  
- **HTML/CSS** – UI dan form input  

## **🚀 Cara Kerja Sistem**
1. User memasukkan nomor WhatsApp pada form.
2. PHP membuat kode OTP dan mengirimnya melalui Fonnte API.
3. OTP disimpan dalam bentuk **hashed** di MySQL.
4. JavaScript menjalankan countdown untuk request OTP berikutnya.
5. User memasukkan OTP yang diterima di WhatsApp.
6. PHP memverifikasi OTP dengan hash di database.
6. Jika cocok, user dianggap valid dan proses login/registrasi berhasil.

## Tutorial Lengkap

Panduan lengkap pembuatan OTP WhatsApp  dapat dilihat di:

- **YouTube Playlist:**  
  https://www.youtube.com/playlist?list=PL0xxlUJSOUAoGCfkJazP94D1PbB9NQl5-
  
- **Website :**  
  https://www.bisangoding.id

Tutorial mencakup:

- Penjelasan konsep dasar OTP WhatsApp dan alur kerjanya  
- Cara generate OTP menggunakan PHP dengan metode yang aman  
- Cara mengirim OTP WhatsApp otomatis menggunakan Fonnte API  
- Cara menyimpan OTP ke database MySQL dalam bentuk **hashed**  
- Cara menggunakan **session PHP** untuk menyimpan nomor WhatsApp  
- Membuat form input OTP dan fitur **countdown timer** dengan JavaScript  
- Validasi dan verifikasi OTP yang dikirim oleh pengguna  
- Mencegah spam request dengan timer JavaScript  
- Cara memastikan OTP hanya bisa digunakan **satu kali (one-time use)**  
- Pengujian lengkap, debugging, dan best practice keamanan OTP  
- Integrasi OTP WhatsApp ke sistem login atau registrasi pengguna  

Semua materi dijelaskan langkah demi langkah agar mudah dipahami dan langsung bisa diterapkan.



