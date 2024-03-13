
# Kurnia Khoirun Nisa (220302038)

## CodeIgniter4

### WELCOME TO CODEIGNITER4
CodeIgniter4 adalah framework pengembangan aplikasi untuk membangun situs web menggunakan PHP. Tujuan penggunaan CodeIgniter4 untuk memberikan solusi sederhana dan efisien untuk pengembangan aplikasi web berbasis PHP.

**Persyaratan Server :**

PHP dan Ekstensi yang Diperlukan
- PHP versi 7.4 atau lebih dengan ekstensi PHP berikut diaktifkan : intl, mbstring, json.
Basis Data yang Didukung
- MySQL(V5.1+)
- Oracle
- PostgreSQL
- MSSQL, dll.

### INSTALASI COMPOSER

CodeIgniter4 memiliki 2 metode instalasi yaitu download manual dan menggunakan composer. Berikut langkah-langkah instalasi menggunakan composer melalui terminal :

- CodeIgniter4 memerlukan Composer 2.0.14 atau lebih baru. Cek versi composer pada terminal `composer -v` 
- Atur directory untuk menyimpan proyek Anda, lalu salin perintah berikut `composer create-project codeigniter4/appstarter project-root`
    
    note : project-root merupakan nama folder root proyek
- Upgrading composer `composer update`
Kelebihan : Instalasi dan update prosesnya mudah

### INSTALASI MANUAL 
Langkah-langkan instalasi CI secara manual :
- Download starter project dari repository
- Lakukan ekstrak pada folder zip yang telah di download

Kelebihan : Hanya perlu mendownload dan menjalankan
### MENJALANKAN APLIKASI ANDA 
**Konfigurasi Awal**
- Rename file **env** menjadi **.env**
- Buka file **app/Config/App.php** set `$indexPage = 'index.php'`. Jika tidak ingin menyertakan index.php maka atur `$indexPage = ''`
- Pada **.env**  $baseURL set `app.baseURL = 'http://example.com/'`
- Pada file **app/Config/Database.php** atau file **.env**, setel `CI_ENVIRONMENT` ke `development`
**Menjalankan Proyek Anda**

- Buka terminal pada folder proyek Anda
- Masukkan perintah `php spark serve` di root proyek Anda
- Klik pada server yang tersedia, contoh `http://localhost:8080`
### HALAMAN STATIS
Hal pertama yang dilakukan adalah menyiapkan aturan perutean untuk menangani halaman statis.

**Menetapkan Aturan Perutean**
- Buka file rute pada **app/Config/Routes.php**. Tambahkan source code berikut, setelah arahan rute untuk **'/'**.
```
use App\Controllers\Pages;
$routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);
```
**Buat Controller Halaman**

- Buat file **Pages.php** pada **app/Controller/** dengan source code berikut
```
<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function view($page = 'home')
    {
        // ...
    }
}
```
**Buat Tampilan**

- Buat file **header.php** pada **app/Views/templates/** dan tambahkan source code berikut
```
<!doctype html>
<html>
<head>
    <title>CodeIgniter Tutorial</title>
</head>
<body>

    <h1><?= esc($title) ?></h1>
 ```
 - Buat file **footer.php** pada **app/Views/templates/** yang menyertakan source code berikut
 ```
 <em>&copy; 2022</em>
</body>
</html>
 ```
 **Menambahkan Logika Ke Controller**
 
 - Buat dua file bernama **home.php** dan **about.php** dalam direktori **app/Views/pages**. Dalam file tersebut bisa ketikkan beberapa teks apa pun contoh "Hello World!"
 - Pada Controller **Pages.php** tambahkan source code berikut
 ```
<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException; // Add this line

class Pages extends BaseController
{
    // ...

    public function view($page = 'home')
    {
        if (! is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new PageNotFoundException($page);
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        return view('templates/header', $data)
            . view('pages/' . $page)
            . view('templates/footer');
    }
}
 ```
Sekarang kunjungi **localhost:8080/home**. Maka akan dirutekan dengan benar ke *view()* metode *Pages* pada Controller.

### NEWS SECTION (BAGIAN BERITA)
**Buat Database untuk Digunakan**

- Buat database **ci4tutorial**. Jalankan perintah SQL di bawah ini (MySQL)
```
CREATE TABLE news (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    title VARCHAR(128) NOT NULL,
    slug VARCHAR(128) NOT NULL,
    body TEXT NOT NULL,
    PRIMARY KEY (id),
    UNIQUE slug (slug)
);
```
- Lakukan insert data dengan perintah SQL berikut
```
INSERT INTO news VALUES
(1,'Elvis sighted','elvis-sighted','Elvis was sighted at the Podunk internet cafe. It looked like he was writing a CodeIgniter app.'),
(2,'Say it isn\'t so!','say-it-isnt-so','Scientists conclude that some programmers have a sense of humor.'),
(3,'Caffeination, Yes!','caffeination-yes','World\'s largest coffee shop open onsite nested coffee shop for staff only.');
```
**Hubungkan ke Database Anda**
- File konfigurasi lokal pada **.env** lakukan konfigurasi Database dan aktifkan baris kodenya.
```
database.default.hostname = localhost
database.default.database = ci4tutorial
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
```
Note : Isikan informasi Database sesuai milik Anda

**Buat Model Berita(News) Serta Tambahkan Metode NewsModel::getNews()**

- Buka direktori **app/Models** dan buat file **NewsModel.php**, tambahkan source code berikut
```
<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table = 'news';
    public function getNews($slug = false)
    {
        if ($slug === false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
}
```
**Menambahkan Aturan Perutean**

- Ubah file **app/Config/Routes.php** dengan menambahkan perutean sehingga seperti berikut
```
<?php

// ...

use App\Controllers\News; // Add this line
use App\Controllers\Pages;

$routes->get('news', [News::class, 'index']);           // Add this line
$routes->get('news/(:segment)', [News::class, 'show']); // Add this line

$routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);
```
**Buat Controler Berita(News)**

- Buat Controller **News.php** di direktori **app/Controllers/**
```
<?php

namespace App\Controllers;

use App\Models\NewsModel;

class News extends BaseController
{
    public function index()
    {
        $model = model(NewsModel::class);

        $data['news'] = $model->getNews();
    }

    public function show($slug = null)
    {
        $model = model(NewsModel::class);

        $data['news'] = $model->getNews($slug);
    }
}
```
- Lengkapi News::index() Method
```
<?php

namespace App\Controllers;

use App\Models\NewsModel;

class News extends BaseController
{
    public function index()
    {
        $model = model(NewsModel::class);

        $data = [
            'news'  => $model->getNews(),
            'title' => 'News archive',
        ];

        return view('templates/header', $data)
            . view('news/index')
            . view('templates/footer');
    }

    // ...
}
```
**Buat File Tampilan News/Indeks**

- Buat **app/Views/news/index.php** dan tambahkan source code berikut
```
<h2><?= esc($title) ?></h2>

<?php if (! empty($news) && is_array($news)): ?>

    <?php foreach ($news as $news_item): ?>

        <h3><?= esc($news_item['title']) ?></h3>

        <div class="main">
            <?= esc($news_item['body']) ?>
        </div>
        <p><a href="/news/<?= esc($news_item['slug'], 'url') ?>">View article</a></p>

    <?php endforeach ?>

<?php else: ?>

    <h3>No News</h3>

    <p>Unable to find any news for you.</p>

<?php endif ?>
```
**Lengkapi News::show() Method**
```
<?php

namespace App\Controllers;

use App\Models\NewsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class News extends BaseController
{
    // ...

    public function show($slug = null)
    {
        $model = model(NewsModel::class);

        $data['news'] = $model->getNews($slug);

        if (empty($data['news'])) {
            throw new PageNotFoundException('Cannot find the news item: ' . $slug);
        }

        $data['title'] = $data['news']['title'];

        return view('templates/header', $data)
            . view('news/view')
            . view('templates/footer');
    }
}
```
**Buat news/view File View**

- Pada directori **app/Views/news** buat file **view.php**. Masukkan source code berikut pada file view.php
```
<h2><?= esc($news['title']) ?></h2>
<p><?= esc($news['body']) ?></p>
```
Arahkan browser Anda ke halaman "news" yaitu **localhost:8080/news**. Akan ditampilkan daftar item berita yang masing masing menampilkan satu artikel saja.
### BUAT ITEM BERITA(NEWS)
Aktifkan Filter CSRF

- Buka file **app/Config/Filters.php** dan perbarui **$methods** properti sebagai berikut
```
<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
    // ...

    public $methods = [
        'post' => ['csrf'],
    ];

    // ...
}
```
**Menambahkan Aturan Perutean**

- Tambahkan aturan rute berikut ke file **app/Config/Routes.php**
```
<?php

// ...

use App\Controllers\News;
use App\Controllers\Pages;

$routes->get('news', [News::class, 'index']);
$routes->get('news/new', [News::class, 'new']); // Add this line
$routes->post('news', [News::class, 'create']); // Add this line
$routes->get('news/(:segment)', [News::class, 'show']);

$routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);
```
**Buat View Create**

- Buat tampilan baru yaitu file **create.php** di **app/Views/news/** dengan source code berikut
```
<h2><?= esc($title) ?></h2>

<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<form action="/news" method="post">
    <?= csrf_field() ?>

    <label for="title">Title</label>
    <input type="input" name="title" value="<?= set_value('title') ?>">
    <br>

    <label for="body">Text</label>
    <textarea name="body" cols="45" rows="4"><?= set_value('body') ?></textarea>
    <br>

    <input type="submit" name="submit" value="Create news item">
</form>
```
**Tambahkan News::new() untuk Menampilkan Formulir pada Controller *News***
- Buat method untuk menampilkan form HTML yang telah dibuat
```
<?php

namespace App\Controllers;

use App\Models\NewsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class News extends BaseController
{
    // ...

    public function new()
    {
        helper('form');

        return view('templates/header', ['title' => 'Create a news item'])
            . view('news/create')
            . view('templates/footer');
    }
}
```
**Tambahkan News::create() untuk Membuat Item News(Berita)**
- Buat method untuk membuat item berita dari data yang dikirimkan
```
<?php

namespace App\Controllers;

use App\Models\NewsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class News extends BaseController
{
    // ...

    public function create()
    {
        helper('form');

        $data = $this->request->getPost(['title', 'body']);

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($data, [
            'title' => 'required|max_length[255]|min_length[3]',
            'body'  => 'required|max_length[5000]|min_length[10]',
        ])) {
            // The validation fails, so returns the form.
            return $this->new();
        }

        // Gets the validated data.
        $post = $this->validator->getValidated();

        $model = model(NewsModel::class);

        $model->save([
            'title' => $post['title'],
            'slug'  => url_title($post['title'], '-', true),
            'body'  => $post['body'],
        ]);

        return view('templates/header', ['title' => 'Create a news item'])
            . view('news/success')
            . view('templates/footer');
    }
}
```
**Return Halaman Sukses**

- Buat tampilan di **app/Views/news/** dengan membuat file **success.php**
`<p>News item created successfully.</p>`

**Updating / Perbarui NewsModel**

- Pada **app/Models/NewsModels.php** tambahkan source code berikut
```
<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table = 'news';

    protected $allowedFields = ['title', 'slug', 'body'];
}
```
Sekarang arahkan browser Anda ke halaman */news/new* untuk menambahkan beberapa berita. **localhost:8080/news/new**
### STRUKTUR APLIKASI
**Direktori Default**

Instalasi baru memiliki lima direktori yaitu **app/, public/, writable/, tests/ dan vendor/** atau **system/**. Masing Masing direktori ini memiliki peran yang sangat spesifik.

**App**

Direktori **app** adalah folder yang berisi kode inti dari aplikasi termasuk controller, models, view, dan lain sebagainya.

**System**

Direktori *system* adalah folder yang berisi inti dari framework Codeigniter termasuk helper dan lain sebagainya.

**Public**

Direktori **public** berisi semua file yang dapat diakses langsung oleh pengguna melalui web server seperti file *index.php*.

**Writable**

Direktori **writable** digunakan untuk menyimpan data yang memerlukan akses tulis seperti file log, cache, atau upload.

**Test**

Direktori **test** berisi file file yang berhubungan dengan pengujian aplikasi.

**Vendor**

Direktori **vendor** berisi file yang digunakan framewrok.
### MODEL, VIEW, DAN CONTROLLER
**Apa itu MVC?**

MVC merupakan sebuah pola desain arsitektur dalam sistem pengembangan website yang terdiri dari 3 komponen yaitu Model, View, Controller.

- Model --> Mengelola data aplikasi. Pada umumnya menangani interaksi dengan database. Model biasanya menulis data pada database dengan mekanisme seperti edit, update, maupun delete data. Letak direktori Model **app/Models**

- View --> file sederhana, dengan sedikit atau tanpa logika, yang menampilkan informasi kepada pengguna. Letak direktori view **app/Views**

- Controller --> Controller menerima Request dari browser yang digunakan pengguna. Ia bertindak sebagai perantara antara model dan view. Letak direktori Controller **app/controller**

**Alur Kerja MVC**

Controller menerima permintaan dari pengguna lalu berinteraksi dengan Model database jika perlu kemudian mengembalikan hasilnya kembali ke browser dalam bentuk kode HTML yang ditafsirkan oleh browser menjadi format yang dapat dibaca manusia dan ditampilkan kepada pengguna.
### VIEWS
Tampilan hanyalah sebuah halaman web atau fragmen halaman seperti header, footer, dan sidebar.

**Membuat Tampilan**

- Buat file **blog_view.php** pada **app/Views** masukkan source code berikut
```
<html>
    <head>
        <title>My Blog</title>
    </head>
    <body>
        <h1>Welcome to my Blog!</h1>
    </body>
</html>
```
**Menampilkan View**

- Untuk memuat dan menampilkan file tampilan tertentu. Anda akan menggunakan kode berikut di Controller `return view('name');`
- Buat file bernama **Blog.php** di direktori **app/Controllers** dan letakkan source code berikut
```
<?php

namespace App\Controllers;

class Blog extends BaseController
{
    public function index()
    {
        return view('blog_view');
    }
}
```
- Pada routes **app/Config/Routes.php** tambahkan source code berikut
```
use App\Controllers\Blog;

$routes->get('blog', [Blog::class, 'index']);
```
Untuk mengecek tampilan Views yang telah dibuat kunjungi situs URL **localhost:8080/index.php/blog/**
### HELPERS
**Helper Date**

File helper date berisi fungsi yang membantu dalam bekerja dengan tanggal/date. Helper ini dimuat dengan menggunakan kode berikut
```
<?php

helper('date');
```
Contoh Penerapannya

- Pada direktori **app/Views/** buat file **Test.php** untuk menerapkan beberapa kode percobaan. Isikan file tersebut dengan source code berikut
```
helper('date');
echo date('Y-M-d H:i:s', now('Asia/Jakarta'));
```
- Buatlah Controller dengan nama **Test.php** pada **app/Controllers/** dengan source code berikut
```
<?php

namespace App\Controllers;

class Test extends BaseController
{
    //HELPER
    public function percobaan()
    {
                return view('test');
    }
}
```
- Lakukan Perutean pada **app/Config/Routes.php**
```
<?php
use App\Controllers\Test;
$routes->get('test', [Test::class, 'percobaan']);
```
Untuk mengecek ouputnya buka pada browser **localhost:8080/test** maka akan menampilkan **2024-Mar-13 13:39:01** *tahun-Bulan-Tanggal Jam:Menit:Detik*

**Helper Number**

File Helper Number berisi fungsi yang membantu bekerja dengan data numerik. Helper ini dimuat dengan menggunakan kode berikut
```
<?php
helper('number');
```
Contoh Penerapannya

- Dengan menggunakan file Routes, Views, controller yang telah dibuat di atas. Masukkan source code berikut pada Views.
```
<?
helper("number");
echo number_to_size(456). '<br>'; // Returns 456 Bytes
echo number_to_size(4567). '<br>'; // Returns 4.5 KB
echo number_to_size(45678). '<br>'; // Returns 44.6 KB
echo number_to_size(456789). '<br>'; // Returns 447.8 KB
echo number_to_size(3456789). '<br>'; // Returns 3.3 MB
echo number_to_size(12345678912345). '<br>';// Returns 1.8 GB
echo number_to_size(123456789123456789). '<br>'; // Returns 11,228.3 TB
```
- Pada file Controllers dan Routes tidak dilakukan perubahan
- Untuk mengecek ouputnya buka pada browser **localhost:8080/test**
