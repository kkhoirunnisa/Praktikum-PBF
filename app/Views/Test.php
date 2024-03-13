<?php
helper('date');
echo date('Y-M-d H:i:s', now('Asia/Jakarta'));



//HELPER
helper("number");
echo number_to_size(456). '<br>'; // Returns 456 Bytes
echo number_to_size(4567). '<br>'; // Returns 4.5 KB
echo number_to_size(45678). '<br>'; // Returns 44.6 KB
echo number_to_size(456789). '<br>'; // Returns 447.8 KB
echo number_to_size(3456789). '<br>'; // Returns 3.3 MB
echo number_to_size(12345678912345). '<br>';// Returns 1.8 GB
echo number_to_size(123456789123456789). '<br>'; // Returns 11,228.3 TB

//SERVICE
// $timer = \Config\Services::timer();
// var_dump($timer);

//BUILD YOUR FIRST APPLICATION
// echo "Hello World!"; -->

//LIBRARY REFERENCES
// <!-- LIBRARI DATE TIME -->
// <!-- <!DOCTYPE html>
// <html lang="en">
// <head>
//     <meta charset="UTF-8">
//     <meta name="viewport" content="width=device-width, initial-scale=1.0">
//     <title>Current Date and Time</title>
// </head>
// <body>
//     <h1>Current Date and Time</h1>


