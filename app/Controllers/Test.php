<?php

namespace App\Controllers;
use CodeIgniter\I18n\Time;


class Test extends BaseController
{
    //HELPER
    public function percobaan()
    {
                return view('test');
        // $time = Time::now('America/Chicago', 'en_US');

        // // Mendapatkan tanggal dalam format 'YYYY-MM-DD'
        // $date = $time->toDateString();

        // // Mendapatkan waktu dalam format 'HH:MM:SS'
        // $time = $time->toTimeString();
        // // Menyiapkan data untuk ditampilkan di view
        // $data = [
        //     'date' => $date,
        //     'time' => $time
        // ];
        // // Menampilkan view dan meneruskan data
        // return view('test', $data);
    }
}
