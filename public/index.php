<?php
// public/index.php

// Aktifkan Error Reporting (PENTING untuk debugging saat development)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Mulai Session jika belum ada
if(!session_id()) session_start();

// Panggil file init (Bootstrapper)
require_once '../app/init.php';

// Jalankan Aplikasi
$app = new App;