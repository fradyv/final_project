<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


## About KindlyJAR

KindlyJAR merupakan web charity dengan sistem menyumbang melalui karya atau skill, sehingga dapat memfasilitasi pengguna dengan rasa soial dan filantropi yang tinggi untuk tetap memberi bermodalkan keahlian mereka tanpa perlu mengeluarkan uang.

Nama KindlyJAR merupakan gabungan dari kata “Kindly” (kebaikan atau dengan baik hati) dan “JAR” (toples atau wadah). Nama ini memiliki filosofi dan arti sebagai sebuah “wadah pengumpul kebaikan”. Layaknya sebuah toples yang diisi koin demi koin untuk ditabung. KindlyJAR menjadi wadah digital tempat terkumpulnya hasil kerja keras dari para HERO (penjual) yang didedikasikan sepenuhnya untuk membantu sesama.

## Struktur Web
Struktur halaman web dirancang untuk mendukung tiga pengguna utama: User biasa (dapat berlaku sebagai penjual (hero) dan pembeli (savior)), penggalang dana, dan admin.
•	Landing Page
o	Home: Penjelasan singkat tentang platform dan highlight program donasi, serta produk digital yang dijual hero.
o	Katalog produk: Daftar semua produk yang dijual oleh hero.
o	Daftar program donasi: Menampilkan kampanye donasi yang terdaftar.
•	Dashboard User Biasa dan Penggalang
o	Beranda: Berisi informasi total donasi, karya terjual, inisiasi program (buat program donasi), dan pencairan dana (hanya berlaku jika pengguna daftar menjadi penggalang). Lalu terdapat riwayat transaksi dan highlight program donasi yang populer atau paling banyak dibantu.
o	Program donasi: Berisi informasi lengkap mengenai banyak program yang terdaftar. Terdapat pemilihan juga sesuai kategori.
o	KindlyShop: Berisi katalog produk yang dijual oleh banyak hero (penjual), dapat melihat detail per produk juga.
o	Riwayat Pembelian: Berisi informasi riwayat pembelian produk oleh savior (pembeli).
o	Inisiasi Donasi: Berisi verifikasi KYC sebelum masuk ke halaman manajemen program donasi, dapat membuat, update, dan delete program donasi yang dibuat oleh penggalang yang sudah terverifikasi.
o	Keranjang: Berisi kumpulan pembelian yang belum di checkout oleh savior (pembeli).
•	Dashboard Admin
o	Kelola Pengguna: Memantau aktivitas penjual dan pembeli.
o	Kelola Transaksi: Memantau pembayaran dari pembeli.
o	Kelola Pendaftar Penggalang: Memverifikasi pengguna yang ingin mendaftar sebagai penggalang.

## Proses Bisnis
Alur kerja platform ini memisahkan secara ketat antara hak kepemilikan pendapatan penyalurannya, memastikan komitmen amal platform terjaga.

A.	Alur Seller (Hero)
1.	Pendaftaran Produk: Penjual menawarkan skill sebagai sebuah produk di platform dan menetapkan harga jual di awal.
2.	Penjualan: Saat produk dibeli, dana tidak bisa ditarik ke rekening pribadi penjual.
3.	Pemilihan Target: Saat membuat atau menambahkan produk yang dijual, hero dapat memberikan relasi atau katikan satu produknya dengan satu program donasi, sehingga memiliki relasi one to one. Hasil penjualan satu produk itu akan langsung disalurkan ke program donasi yang ia kaitkan dengan satu produk itu.

B.	Alur Buyer (Savior)
1.	Eksplorasi Katalog: Pembeli melihat-lihat daftar produk yang ditawarkan oleh penjual di halaman katalog.
2.	Pembelian dan Pembayaran: Pembeli memilih produk yang diinginkan dimana produk ini memiliki relasi one to one dengan satu campaign (program donasi) dan beralih ke halaman keranjang untuk melihat daftar belanja serta program donasi apa yang memiliki relasi dengan produk yang savior pilih. Dalam halaman tersebut juga, savior dapat menambahkan produk lain, yang di mana hanya akan menampilkan produk lain yang memiliki relasi dengan campaign (program donasi) yang sama. Pembeli (savior) dapat  melakukan pembayaran sesuai harga tetap yang telah ditentukan penjual atau dapat melebihkan pembayarannya dengan catatan minimal pembayaran adalah harga produk atau harga total produk yang ia beli.
3.	Penerimaan Produk: Pembeli menerima produk dari penjual. Di saat yang sama, pembeli juga mendapatkan transparansi bahwa uang yang mereka bayarkan telah disalurkan ke target donasi.

C.	Alur Penggalang
1.	Pembuatan Program Donasi: Penggalang dapat membuat program donasi.
2.	List Relasi Produk: Penggalang dapat melihat list produk-produk yang berkaitan dengan satu-satu campaign (program donasi) yang ia punya. Sehingga satu campaign (program donasi) memiliki relasi hasMany produk.
3.	Pengambilan Uang Donasi: Penggalang dapat mengambil uang yang telah disalurkan ke program donasi yang dibuat melalui e-wallet penggalang.

D.	Alur Admin
1.	Pemantauan Transaksi: Admin memantau transaksi pembelian yang masuk.
2.	Pemantauan User: Memantau aktivitas user dan penggalang.
3.	Pemantauan Donasi: Memantau penyaluran donasi dari pembelian savior (pembeli).

## Flow Users
Tedapat 3 user, yaitu normal user, fundraiser (penggalang dana), dan admin.

1.	Alur normal user
Setelah user (savior) login, dapat melihat produk yang berada dalam katalog produk. Lalu memilih produk dan beralih ke halaman menu untuk checkout. User (savior) dapat melihat informasi produk serta campaign yang berkaitan dengan produk tersebut, user (savior) juga dapat menambahkan produk lain yang memiliki relasi dengan campaign yang sama sebelum melakukan pembayaran. Uang tersebut otomatis akan tersalurkan ke program donasi tersebut.
Selain itu user (hero) juga dapat membuka toko, setelahnya user (hero) dapat menambahkan produk yang ingin dijual. Setelah mengisi informasi detail terkait produk, user (hero) wajib mengaitkan atau memberikan relasi kepada satu campaign (program donasi) di tiap satu produk yang user (hero) buat.

2.	Alur penggalang
User akan mendaftar sebagai penggalang  (fundraiser), setelah mengisi KYC, pengguna harus menunggu verifikasi oleh admin. Ketika sudah di verifikasi, user sah menjadi dan mendapatkan role sebagai penggalang dana. Selanjutnya penggalang dapat membuka campaign atau program donasi sendiri dengan mengisi informasi yang dibutuhkan tentunya. Penggalang juga dapat melihat list produk hero yang berkaitan dengan program donasi yang ia buat.

3.	Alur admin
Admin adalah pengguna yang memantau aktivitas pengguna dari sisi user dan penggalang, serta memverifikasi data penting seperti saat terdapat user ingin daftar sebagai penggalang dan butuh verifikasi admin terlebih dahulu sebelum lanjut. Selain itu admin juga memantau transaksi dan donasi yang terjadi dalam platform.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
