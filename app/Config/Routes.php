<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\News;
use App\Controllers\Pages;
//MEMBUAT VIEW
use App\Controllers\Blog;
//TEST HELPER
use App\Controllers\Test;
/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index'); //mengakses controller home method index di views
//MEMBUAT FORMULIR UNGGAH
$routes->get('upload', 'Upload::index');          // Add this line.
$routes->post('upload/upload', 'Upload::upload'); // Add this line.
//VALIDASI FORMULIR
$routes->get('form', 'Form::index');
$routes->post('form', 'Form::index');
// use App\Controllers\View;
//MEMBUAT VIEW
$routes->get('blog', [Blog::class, 'index']);
// $routes->get('view', [View::class, 'view']);
//TEST HELPER
$routes->get('test', [Test::class, 'percobaan']);
//('nama path, [nama class :: class, 'method'])
$routes->get('news', [News::class, 'index']);           // Add this line
$routes->get('news/new', [News::class, 'new']); // Add this line
$routes->post('news', [News::class, 'create']); // Add this line
//URI Routing --> segmen
$routes->get('news/(:segment)', [News::class, 'show']); // Add this line
$routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);

// $routes->get('helloworld', '\App\Controllers\Helloworld::index');

//SEGMEN --> MENGAMBIL SEMUA NILAI SETELAH SESUDAH /SLICE
//ROUTES DI BACA DR ATAS KE BAWAH MAKA KETIKA ADA SEGMEN BERARTI LANGSUNG DIEKSEKUSI