<?php
// Ambil data POST jika ada
$nama = htmlspecialchars($_POST['nama'] ?? '');
$nomor_wa = htmlspecialchars($_POST['nomor_wa'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');
$domisili = htmlspecialchars($_POST['domisili'] ?? '');
$profesi = htmlspecialchars($_POST['profesi'] ?? '');
$kelas_yang_dipilih = htmlspecialchars($_POST['kelas_yang_dipilih'] ?? 'paid');
$sumber_informasi = htmlspecialchars($_POST['sumber_informasi'] ?? 'relasi');
$input_lainnya = htmlspecialchars($_POST['input_lainnya'] ?? '');
$akun_pemberi_informasi = htmlspecialchars($_POST['akun_pemberi_informasi'] ?? '');
$error = $error ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Bootcamp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/main.css">
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen flex flex-col">
    <main class="flex-1 flex items-center justify-center pt-32 pb-16">
        <div class="w-full max-w-4xl bg-white rounded-xl shadow-lg p-0 flex flex-col md:flex-row overflow-hidden">
            <div class="w-full md:w-1/2 p-10 bg-white flex flex-col justify-center">
                <h2 class="text-2xl font-bold mb-8 text-purple-700">General Information</h2>
                <?php if ($error): ?>
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded text-center font-semibold">
                    <?= $error ?>
                </div>
                <?php endif; ?>
                <form id="registration-form" action="register.php" method="post" enctype="multipart/form-data" class="space-y-6">
                    <div>
                        // ...existing code...
                        <label for="nama" class="block text-sm font-medium mb-2">Nama Lengkap*</label>
                        <input type="text" id="nama" name="nama" maxlength="100" required class="block w-full border-b border-purple-700 focus:border-purple-700 focus:ring-0 bg-white/30 py-2 px-2 text-black outline-none rounded" value="<?= $nama ?>">
                    </div>
                    <div class="flex gap-4">
                        <div class="w-1/2">
                            <label for="domisili" class="block text-sm font-medium mb-2">Domisili</label>
                            <input type="text" id="domisili" name="domisili" maxlength="100" class="block w-full border-b border-purple-700 focus:border-purple-700 focus:ring-0 bg-white/30 py-2 px-2 text-black outline-none rounded" value="<?= $domisili ?>">
                        </div>
                        <div class="w-1/2">
                            <label for="profesi" class="block text-sm font-medium mb-2">Profesi</label>
                            <input type="text" id="profesi" name="profesi" maxlength="100" class="block w-full border-b border-purple-700 focus:border-purple-700 focus:ring-0 bg-white/30 py-2 px-2 text-black outline-none rounded" value="<?= $profesi ?>">
                        </div>
                    </div>
                    <div>
                        <label for="file_upload" class="block text-sm font-medium mb-2">Upload File</label>
                        <input type="file" id="file_upload" name="file_upload" accept=".pdf,.jpg,.jpeg,.png" class="block w-full border-b border-purple-700 focus:border-purple-700 focus:ring-0 bg-white/30 py-2 px-2 text-black outline-none rounded">
                    </div>
                    <div>
                        <label for="nomor_wa" class="block text-sm font-medium mb-2">Nomor WA*</label>
                        <input type="text" id="nomor_wa" name="nomor_wa" maxlength="20" required class="block w-full border-b border-purple-700 focus:border-purple-700 focus:ring-0 bg-white/30 py-2 px-2 text-black outline-none rounded" value="<?= $nomor_wa ?>">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium mb-2">Email</label>
                        <input type="email" id="email" name="email" maxlength="100" class="block w-full border-b border-purple-700 focus:border-purple-700 focus:ring-0 bg-white/30 py-2 px-2 text-black outline-none rounded" value="<?= $email ?>">
                    </div>
                    <div>
                        <label for="kelas_yang_dipilih" class="block text-sm font-medium mb-2">Program*</label>
                        <select id="kelas_yang_dipilih" name="kelas_yang_dipilih" required class="block w-full border-b border-purple-700 focus:border-purple-700 focus:ring-0 bg-white/30 py-2 px-2 text-black outline-none rounded">
                            <option value="paid" <?= $kelas_yang_dipilih=='paid'?'selected':'' ?>>Paid</option>
                            <option value="free" <?= $kelas_yang_dipilih=='free'?'selected':'' ?>>Free</option>
                            <option value="softclass" <?= $kelas_yang_dipilih=='softclass'?'selected':'' ?>>Softclass</option>
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var selectProgram = document.getElementById('kelas_yang_dipilih');
                    selectProgram.addEventListener('change', function() {
                        document.getElementById('registration-form').submit();
                    });
                });
                </script>
                        </select>
                        </div>
                        <div>
                            // ...existing code...
                    <div>
                        <label for="sumber_informasi" class="block text-sm font-medium mb-2">Sumber Informasi*</label>
                        <select id="sumber_informasi" name="sumber_informasi" required class="block w-full border-b border-purple-700 focus:border-purple-700 focus:ring-0 bg-white/30 py-2 px-2 text-black outline-none rounded">
                            <option value="relasi" <?= $sumber_informasi=='relasi'?'selected':'' ?>>Relasi</option>
                            <option value="instagram" <?= $sumber_informasi=='instagram'?'selected':'' ?>>Instagram</option>
                            <option value="tiktok" <?= $sumber_informasi=='tiktok'?'selected':'' ?>>Tiktok</option>
                            <option value="facebook" <?= $sumber_informasi=='facebook'?'selected':'' ?>>Facebook</option>
                            <option value="linkedin" <?= $sumber_informasi=='linkedin'?'selected':'' ?>>LinkedIn</option>
                            <option value="WA Group" <?= $sumber_informasi=='WA Group'?'selected':'' ?>>WA Group</option>
                            <option value="Website" <?= $sumber_informasi=='Website'?'selected':'' ?>>Website</option>
                            <option value="Undangan Email" <?= $sumber_informasi=='Undangan Email'?'selected':'' ?>>Undangan Email</option>
                            <option value="Telegroup" <?= $sumber_informasi=='Telegroup'?'selected':'' ?>>Telegroup</option>
                            <option value="lainnya" <?= $sumber_informasi=='lainnya'?'selected':'' ?>>Lainnya</option>
                        </select>
                    </div>
                    <?php if ($sumber_informasi=='lainnya'): ?>
                    <div id="input_lainnya_container">
                        <label for="input_lainnya" class="block text-sm font-medium mb-2">Sebutkan sumber lainnya</label>
                        <input type="text" id="input_lainnya" name="input_lainnya" maxlength="255" class="block w-full border-b border-purple-700 focus:border-purple-700 focus:ring-0 bg-white/30 py-2 px-2 text-black outline-none rounded" value="<?= $input_lainnya ?>">
                    </div>
                    <?php endif; ?>
                    <div>
                        <label for="akun_pemberi_informasi" class="block text-sm font-medium mb-2">Akun Pemberi Informasi</label>
                        <input type="text" id="akun_pemberi_informasi" name="akun_pemberi_informasi" maxlength="100" class="block w-full border-b border-purple-700 focus:border-purple-700 focus:ring-0 bg-white/30 py-2 px-2 text-black outline-none rounded" value="<?= $akun_pemberi_informasi ?>">
                    </div>
                    <div class="flex items-center mt-4">
                        <input type="checkbox" id="accept_terms" name="accept_terms" class="mr-2">
                        <label for="accept_terms" class="text-sm">Saya menerima <a href="#" class="underline">Syarat & Ketentuan</a></label>
                    </div>
                    <div class="mt-8">
                        <button type="submit" class="w-full bg-purple-700 text-white font-bold py-3 rounded-full shadow hover:bg-purple-800 transition">Daftar Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
