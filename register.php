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

    // Validasi sederhana
    if ($nama && $nomor_wa && $kelas_yang_dipilih && $sumber_informasi) {
        $stmt = $conn->prepare("INSERT INTO formulir_pendaftaran 
            (nama, nomor_wa, email, domisili, profesi, kelas_yang_dipilih, file_upload, sumber_informasi, input_lainnya, akun_pemberi_informasi) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssss", $nama, $nomor_wa, $email, $domisili, $profesi, $kelas_yang_dipilih, $file_upload, $sumber_informasi, $input_lainnya, $akun_pemberi_informasi);

        if ($stmt->execute()) {
            // Email ke admin
            $admin_title = "Pendaftaran Baru Bootcamp";
            $admin_body = "Ada pendaftar baru dengan detail:<br><br>"
                . "<b>Nama:</b> $nama<br>"
                . "<b>Nomor WA:</b> $nomor_wa<br>"
                . "<b>Email:</b> $email<br>"
                . "<b>Domisili:</b> $domisili<br>"
                . "<b>Profesi:</b> $profesi<br>"
                . "<b>Kelas yang Dipilih:</b> $kelas_yang_dipilih<br>"
                . "<b>Sumber Informasi:</b> $sumber_informasi<br>"
                . ($sumber_informasi === 'lainnya' ? "<b>Input Lainnya:</b> $input_lainnya<br>" : "")
                . "<b>Akun Pemberi Informasi:</b> $akun_pemberi_informasi<br>";
            $admin_message = get_email_template($admin_title, $admin_body);
            send_phpmailer($admin_email, $admin_subject, $admin_message, $file_upload, $email);

            // Email ke pendaftar
            $user_title = "Terima Kasih Telah Mendaftar!";
            $user_body = "Selamat, data Anda sudah kami terima.<br>Kami akan segera memproses pendaftaran Anda.<br><br>Berikut data Anda:<br>"
                . "<b>Nama:</b> $nama<br>"
                . "<b>Nomor WA:</b> $nomor_wa<br>"
                . "<b>Email:</b> $email<br>"
                . "<b>Domisili:</b> $domisili<br>"
                . "<b>Profesi:</b> $profesi<br>"
                . "<b>Kelas yang Dipilih:</b> $kelas_yang_dipilih<br>"
                . "<b>Sumber Informasi:</b> $sumber_informasi<br>"
                . ($sumber_informasi === 'lainnya' ? "<b>Input Lainnya:</b> $input_lainnya<br>" : "")
                . "<b>Akun Pemberi Informasi:</b> $akun_pemberi_informasi<br><br>Salam sukses,<br>Tim Bootcamp PT Edukasi Tujuh Belas";
            $confirm_message = get_email_template($user_title, $user_body);
            send_phpmailer($email, $confirm_subject, $confirm_message, '', $admin_email);

            echo "<script>alert('Pendaftaran berhasil!'); window.location='register.html';</script>";
        } else {
            echo "<script>alert('Gagal mendaftar: ' . $conn->error); window.location='register.html';</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Data wajib belum lengkap!'); window.location='register.html';</script>";
    }
    $conn->close();
    exit;
}
// Jika GET, tampilkan error
http_response_code(405);
echo 'Method Not Allowed';
