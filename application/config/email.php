<?php
defined('BASEPATH') or exit('No direct script access allowed');

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.gmail.com'; // Ganti dengan host SMTP yang sesuai
$config['smtp_port'] = 587; // Port SMTP Gmail
$config['smtp_user'] = 'posmailer23nov@gmail.com'; // Ganti dengan alamat email Anda
$config['smtp_pass'] = 'gvaa mhmk qblt ibmv'; // Ganti dengan token OAuth2
$config['smtp_crypto'] = 'tls'; // Gunakan 'ssl' jika Anda ingin menggunakan port 465
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['wordwrap'] = TRUE;
$config['newline'] = "\r\n"; // Pengaturan baris baru
