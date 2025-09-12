<?php
// Konfigurasi email
$admin_email = 'halo@bootcamp.com';
$admin_subject = 'Pendaftaran Bootcamp Baru';
$confirm_subject = 'Konfirmasi Pendaftaran Bootcamp';

// Fungsi kirim email sederhana
function send_email($to, $subject, $message, $from = null) {
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    if ($from) {
        $headers .= "From: $from\r\n";
    }
    return mail($to, $subject, $message, $headers);
}

// Fungsi simpan data ke file CSV
function save_to_csv($data, $filename = 'registrations.csv') {
    $file = fopen($filename, 'a');
    fputcsv($file, $data);
    fclose($file);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $bootcamp = trim($_POST['bootcamp-choice'] ?? '');
    $timestamp = date('Y-m-d H:i:s');

    // Validasi sederhana
    if ($name && $email && $phone && $bootcamp) {
        // Simpan ke CSV
        save_to_csv([$timestamp, $name, $email, $phone, $bootcamp]);

        // Kirim email ke admin
        $admin_message = "<b>Pendaftaran Baru:</b><br>Nama: $name<br>Email: $email<br>Telepon: $phone<br>Program: $bootcamp<br>Waktu: $timestamp";
        send_email($admin_email, $admin_subject, $admin_message, $email);

        // Kirim email konfirmasi ke pendaftar
        $confirm_message = "<b>Terima kasih telah mendaftar Bootcamp!</b><br>Data Anda:<br>Nama: $name<br>Email: $email<br>Telepon: $phone<br>Program: $bootcamp<br><br>Kami akan menghubungi Anda dalam 1x24 jam.";
        send_email($email, $confirm_subject, $confirm_message, $admin_email);

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Data tidak lengkap']);
    }
    exit;
}
// Jika GET, tampilkan error
http_response_code(405);
echo 'Method Not Allowed';
