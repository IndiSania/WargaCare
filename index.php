<?php
$page_title='WargaCare — Pengaduan Masyarakat';
include 'includes/header.php';
?>
<section class="hero">
  <div class="small">PLATFORM PENGADUAN MASYARAKAT</div>
  <h1>Sampaikan laporan.<br>Bangun lingkungan lebih baik.</h1>
  <p>WargaCare membantu masyarakat menyampaikan pengaduan secara terstruktur, memantau proses penanganan, dan mendapatkan tanggapan dari petugas.</p>
  <?php if(empty($_SESSION['user'])): ?>
    <a class="btn" href="auth/register.php">Mulai Membuat Laporan</a>
    <a class="btn btn-secondary" href="auth/login.php">Masuk ke Akun</a>
  <?php else: ?>
    <a class="btn" href="<?= $_SESSION['user']['role']==='admin'?'admin/dashboard.php':($_SESSION['user']['role']==='petugas'?'petugas/dashboard.php':'masyarakat/dashboard.php') ?>">Buka Dashboard</a>
  <?php endif; ?>
</section>
<div class="grid">
  <div class="card"><h3>Pelaporan Terstruktur</h3><p class="muted">Kirim pengaduan lengkap dengan kategori, lokasi, dan bukti pendukung.</p></div>
  <div class="card"><h3>Lacak Status</h3><p class="muted">Pantau perkembangan laporan dari pengajuan hingga selesai.</p></div>
  <div class="card"><h3>Tanggapan Petugas</h3><p class="muted">Setiap laporan dapat memperoleh tanggapan dan pembaruan penanganan.</p></div>
</div>
<?php include 'includes/footer.php'; ?>