<!-- Menampilkan judul halaman dengan menggunakan fungsi esc() untuk menghindari serangan XSS -->
<h2><?= esc($title) ?></h2>

<!-- Memeriksa apakah variabel $news tidak kosong dan merupakan sebuah array -->
<?php if (! empty($news) && is_array($news)): ?>
 <!-- Perulangan foreach untuk setiap berita dalam array $news -->
    <?php foreach ($news as $news_item): ?>
<!-- Menampilkan judul berita dengan menggunakan fungsi esc() untuk menghindari serangan XSS -->
        <h3><?= esc($news_item['title']) ?></h3>
 <!-- Menampilkan konten berita dengan menggunakan fungsi esc() untuk menghindari serangan XSS -->
        <div class="main">
            <?= esc($news_item['body']) ?>
        </div>
         <!-- Membuat tautan untuk melihat berita secara lebih detail dengan menggunakan slug berita -->
        <p><a href="/news/<?= esc($news_item['slug'], 'url') ?>">View article</a></p>
    <!-- Selesai perulangan foreach -->
    <?php endforeach ?>

<!-- Jika variabel $news kosong atau bukan array -->
<?php else: ?>
<!-- Menampilkan pesan bahwa tidak ada berita yang ditemukan -->
    <h3>No News</h3>
<!-- Menampilkan pesan yang memberi tahu pengguna bahwa tidak ada berita yang tersedia -->
    <p>Unable to find any news for you.</p>

<?php endif ?>