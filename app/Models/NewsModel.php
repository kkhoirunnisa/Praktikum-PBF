<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    // Nama tabel yang akan digunakan oleh model
    protected $table = 'news';
    // Daftar kolom yang diizinkan untuk disimpan atau diubah
    protected $allowedFields = ['title', 'slug', 'body'];
    // Metode untuk mendapatkan berita berdasarkan slugnya
    public function getNews($slug = false)
    {
        // Jika slug tidak diberikan, kembalikan semua berita
        if ($slug === false) {
            return $this->findAll();
        }
        // Jika slug diberikan, ambil berita pertama dengan slug yang sesuai
        return $this->where(['slug' => $slug])->first();
    }
}
