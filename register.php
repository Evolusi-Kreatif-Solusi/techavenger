<?php
// Konfigurasi database
$host = "localhost";
$user = "techavenger";
$pass = "techavenger";
$db = "techavenger"; // Ganti dengan nama database Anda

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Konfigurasi email SMTP
$admin_email = 'info@e17course.com';
$admin_subject = 'Pendaftaran Bootcamp Baru';
$confirm_subject = 'Konfirmasi Pendaftaran Bootcamp';

require_once __DIR__ . '/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/SMTP.php';
require_once __DIR__ . '/PHPMailer/Exception.php';
// Fungsi template email HTML modern untuk konfirmasi pendaftaran
function get_email_template_modern($type, $data) {
    $programTitle = [
        'paid' => 'Bootcamp Berbayar',
        'free' => 'Free Bootcamp',
        'softclass' => 'Kelas Soft Skill',
    ];
    $headline = 'Pendaftaran Anda Terkonfirmasi!';
    $subheadline = 'Selamat datang di ' . $programTitle[$type] . ' PT Edukasi Tujuh Belas. Kami akan membantu Anda dalam perjalanan belajar Anda!';
    $bootcamp = htmlspecialchars($data['bootcamp']);
    $subkelas = htmlspecialchars($data['subkelas'] ?? '');
    $nama = htmlspecialchars($data['nama']);
    $email = htmlspecialchars($data['email']);
    $domisili = htmlspecialchars($data['domisili'] ?? '');
    $profesi = htmlspecialchars($data['profesi'] ?? '');
    $sumber = htmlspecialchars($data['sumber']);
    $input_lainnya = htmlspecialchars($data['input_lainnya'] ?? '');
    $akun_pemberi_informasi = htmlspecialchars($data['akun_pemberi_informasi'] ?? '');
    $file_upload = htmlspecialchars($data['file_upload'] ?? '');
    $avatar = '<div style="width:80px;height:80px;background:#C0392B;border-radius:50%;display:inline-block;margin-right:32px;"></div>';
    $socmed = '<div style="margin:32px 0 0 0;text-align:center;">
        <span style="display:inline-block;width:40px;height:40px;background:#A5A5A5;border-radius:50%;color:#fff;line-height:40px;font-weight:bold;margin:0 8px;font-family:sans-serif;">IG</span>
        <span style="display:inline-block;width:40px;height:40px;background:#A5A5A5;border-radius:50%;color:#fff;line-height:40px;font-weight:bold;margin:0 8px;font-family:sans-serif;">FB</span>
        <span style="display:inline-block;width:40px;height:40px;background:#A5A5A5;border-radius:50%;color:#fff;line-height:40px;font-weight:bold;margin:0 8px;font-family:sans-serif;">IN</span>
        <span style="display:inline-block;width:40px;height:40px;background:#A5A5A5;border-radius:50%;color:#fff;line-height:40px;font-weight:bold;margin:0 8px;font-family:sans-serif;">YT</span>
    </div>';
    return '
    <html><body style="background:#f7f7f7;margin:0;padding:0;font-family:Arial,sans-serif;">
    <div style="max-width:600px;margin:24px auto;background:#fff;border-radius:8px;box-shadow:0 2px 8px #eee;overflow:hidden;">
        <div style="background:#F87171;padding:32px 24px 16px 24px;text-align:center;">
            <h1 style="color:#fff;font-size:2em;margin-bottom:8px;">'.$headline.'</h1>
            <div style="color:#fff;font-size:1.1em;">'.$subheadline.'</div>
        </div>
        <div style="padding:32px 24px 16px 24px;">
            <h2 style="text-align:center;font-size:1.5em;font-weight:bold;margin-bottom:24px;">Konfirmasi Data Pendaftaran</h2>
            <div style="display:flex;align-items:center;justify-content:center;margin-bottom:24px;">
                '.$avatar.'
                <div style="text-align:left;max-width:350px;">
                    <div style="font-weight:bold;font-size:1.1em;margin-bottom:8px;">Data Anda Telah Kami Terima</div>
                    <div style="font-size:1em;margin-bottom:12px;">Terima kasih telah mendaftar. Berikut adalah detail data yang Anda kirimkan untuk program '.$programTitle[$type].'.</div>
                    <table style="font-size:1em;color:#333;">
                        <tr><td style="font-weight:bold;">Nama:</td><td>'.$nama.'</td></tr>
                        <tr><td style="font-weight:bold;">Email:</td><td>'.$email.'</td></tr>
                        <tr><td style="font-weight:bold;">Domisili:</td><td>'.$domisili.'</td></tr>
                        <tr><td style="font-weight:bold;">Profesi:</td><td>'.$profesi.'</td></tr>
                        <tr><td style="font-weight:bold;">Program Bootcamp:</td><td>'.$bootcamp.'</td></tr>
                        '.($subkelas ? '<tr><td style="font-weight:bold;">Kelas yang Dipilih:</td><td>'.$subkelas.'</td></tr>' : '').'
                        <tr><td style="font-weight:bold;">Sumber Informasi:</td><td>'.$sumber.'</td></tr>
                        '.($input_lainnya ? '<tr><td style="font-weight:bold;">Sumber Lainnya:</td><td>'.$input_lainnya.'</td></tr>' : '').'
                        '.($akun_pemberi_informasi ? '<tr><td style="font-weight:bold;">Akun Pemberi Informasi:</td><td>'.$akun_pemberi_informasi.'</td></tr>' : '').'
                        '.($file_upload ? '<tr><td style="font-weight:bold;">File Upload:</td><td>'.$file_upload.'</td></tr>' : '').'
                    </table>
                </div>
            </div>
            <div style="font-size:1em;color:#444;margin-bottom:24px;text-align:center;">
                Kami akan mengirimkan email lanjutan berisi jadwal lengkap dan tautan akses 2 hari sebelum bootcamp dimulai. Mohon periksa kotak masuk (dan folder spam) Anda secara berkala.<br><br>
                Jika ada pertanyaan, jangan ragu untuk menghubungi tim kami.
            </div>
            '.$socmed.'
        </div>
        <div style="background:#f7f7f7;padding:16px;text-align:center;font-size:0.9em;color:#888;">
            &copy; 2025 PT Edukasi Tujuh Belas. All rights reserved.
        </div>
    </div>
    </body></html>';
}
// Fungsi template email HTML
function get_email_template($title, $body) {
    return '
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; background: #f7f7f7; margin:0; padding:0; }
            .container { max-width: 600px; margin: 30px auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px #eee; padding: 32px; }
            .title { font-size: 2em; font-weight: bold; color: #4F46E5; margin-bottom: 16px; text-align: center; }
            .content { font-size: 1.1em; color: #333; margin-bottom: 24px; }
            .footer { font-size: 0.9em; color: #888; text-align: center; margin-top: 32px; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="title">'.$title.'</div>
            <div class="content">'.$body.'</div>
            <div class="footer">PT Edukasi Tujuh Belas &mdash; Bootcamp Registration System</div>
        </div>
    </body>
    </html>
    ';
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function send_phpmailer($to, $subject, $body, $file_path = '', $from = '', $replyto = '') {
    $mail = new PHPMailer(true);
    try {
        // SMTP config
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'e17course@gmail.com'; // Ganti dengan email pengirim Gmail
        $mail->Password = 'pvlhoaziednmyerx'; // Ganti dengan App Password Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom($mail->Username, 'Bootcamp Registration');
        $mail->addAddress($to);
        if ($replyto) $mail->addReplyTo($replyto);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        if ($file_path && file_exists($file_path)) {
            $mail->addAttachment($file_path);
        }
        // Nonaktifkan debug agar tidak tampil ke user
        // $mail->SMTPDebug = 0;
        $mail->send();
        return true;
    } catch (Exception $e) {
        echo '<div style="color:red">Email gagal dikirim: ' . $mail->ErrorInfo . '</div>';
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST['nama'] ?? '');
    $nomor_wa = trim($_POST['nomor_wa'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $domisili = trim($_POST['domisili'] ?? '');
    $profesi = trim($_POST['profesi'] ?? '');
    $kelas_yang_dipilih = trim($_POST['kelas_yang_dipilih'] ?? '');
    $kelas_pilihan = trim($_POST['kelas_pilihan'] ?? '');
    $sumber_informasi = trim($_POST['sumber_informasi'] ?? '');
    $input_lainnya = trim($_POST['input_lainnya'] ?? '');
    $akun_pemberi_informasi = trim($_POST['akun_pemberi_informasi'] ?? '');

    // Handle file upload
    $file_upload = '';
    if (isset($_FILES['file_upload']) && $_FILES['file_upload']['error'] == 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $file_upload = $target_dir . basename($_FILES["file_upload"]["name"]);
        move_uploaded_file($_FILES["file_upload"]["tmp_name"], $file_upload);
    }

    $error = '';
    $missing = [];
    // Validasi field wajib diisi
    if (!$nama) $missing[] = 'Nama Lengkap';
    if (!$nomor_wa) $missing[] = 'Nomor WA';
    if (!$email) $missing[] = 'Email';
    if (!$kelas_yang_dipilih) $missing[] = 'Program';
    if (!$kelas_pilihan) $missing[] = 'Kelas yang Tersedia';
    if (!$sumber_informasi) $missing[] = 'Sumber Informasi';
    // Untuk paid, file upload wajib
    if ($kelas_yang_dipilih === 'paid' && !$file_upload) $missing[] = 'Upload File (Transaksi Pembayaran)';
    // Agreement hanya untuk Free
    if ($kelas_yang_dipilih === 'free') {
        if (empty($_POST['accept_terms'])) $missing[] = 'Syarat & Ketentuan';
    }
    if (empty($missing)) {
        $stmt = $conn->prepare("INSERT INTO formulir_pendaftaran 
            (nama, nomor_wa, email, domisili, profesi, kelas_yang_dipilih, kelas_pilihan, file_upload, sumber_informasi, input_lainnya, akun_pemberi_informasi) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Query error: " . $conn->error);
        }
        $stmt->bind_param("sssssssssss", $nama, $nomor_wa, $email, $domisili, $profesi, $kelas_yang_dipilih, $kelas_pilihan, $file_upload, $sumber_informasi, $input_lainnya, $akun_pemberi_informasi);

        if ($stmt->execute()) {
            $type = ($kelas_yang_dipilih === 'paid') ? 'paid' : (($kelas_yang_dipilih === 'free') ? 'free' : 'softclass');
            $templateData = [
                'nama' => $nama,
                'email' => $email,
                'domisili' => $domisili,
                'profesi' => $profesi,
                'bootcamp' => $kelas_yang_dipilih,
                'subkelas' => $kelas_pilihan,
                'sumber' => $sumber_informasi,
                'input_lainnya' => $input_lainnya,
                'akun_pemberi_informasi' => $akun_pemberi_informasi,
                'file_upload' => $file_upload
            ];
            $confirm_message = get_email_template_modern($type, $templateData);
            send_phpmailer($email, $confirm_subject, $confirm_message, '', $admin_email);
            $admin_message = get_email_template_modern($type, $templateData);
            send_phpmailer($admin_email, $admin_subject, $admin_message, $file_upload, $email);
            echo "<script>alert('Pendaftaran berhasil!'); window.location='register.html';</script>";
        } else {
            $error = 'Gagal mendaftar: ' . $stmt->error;
        }
        $stmt->close();
    } else {
        $error = 'Data wajib belum lengkap!';
    }
    if ($error) {
    // Tampilkan form beserta data yang sudah diisi dan pesan error di halaman yang sama
    // Ambil isi register.html
    $form_html = file_get_contents('register.html');
    $error_message = $error;
    if (!empty($missing)) {
        $error_message = 'Field berikut wajib diisi: <ul style="margin:8px 0 0 0; padding-left:16px; text-align:left;">';
        foreach ($missing as $field) {
            $error_message .= '<li>' . htmlspecialchars($field) . '</li>';
        }
        $error_message .= '</ul>';
    }
    // Sisipkan pesan error di atas form
    $form_html = preg_replace('/(<form[^>]*id="registration-form"[^>]*>)/i', '<div class="mb-4 p-3 bg-red-100 text-red-700 rounded text-center font-semibold">'.$error_message.'</div>$1', $form_html, 1);
    echo $form_html;
    $conn->close();
    exit;
    }
    $conn->close();
    exit;
}
// Jika GET, tampilkan error
// Jika GET, tampilkan form
include 'register_form.php';
