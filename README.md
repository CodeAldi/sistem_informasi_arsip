## About this project

Sebelumnya ini adalah project sistem informasi yang saya buat antara bulan akhir juli hingga tanggal 13 agustus. Project ini saya ajukan sebagai simple crud dari test assesment divisi web development

## langkah langkah menjalankan project ini

-   install xampp
-   lalu letakan folder file ini di dalam folder httdocs
-   jalankan server apache dan mysql
-   buat database bernama sistem_informasi_arsip
-   lalu jalankan php artisan migrate --seed
-   untuk login sebagai super admin gunakan :
-   username : super admin
-   password : 123456

## Super admin

super admin dapat melakukan hal berikut :
-CRUD user dosenpj,kabag,dan mahasiswa.

## Dosen pj

dosen pj dapat melakukan hal berikut :
Read,Delete data sertifikat yang diupload mahasiswa, dan melakukan update dengan cara approve/reject sertifikat yang diupload

## Kabag

hanya dapat Read saja, lalu download data

## mahasiswa

dapat melakukan CRUD sertifikat
