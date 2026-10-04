<?php
require_once '../config/database.php'; require_once '../config/auth.php'; require_once '../config/helpers.php'; require_role('masyarakat');
$st=$pdo->prepare("SELECT COUNT(*) FROM pengaduan WHERE user_id=?");$st->execute([$_SESSION['user']['id']]);$total=$st->fetchColumn();
$st=$pdo->prepare("SELECT COUNT(*) FROM pengaduan WHERE user_id=? AND status='Selesai'");$st->execute([$_SESSION['user']['id']]);$selesai=$st->fetchColumn();
$st=$pdo->prepare("SELECT * FROM pengaduan WHERE user_id=? ORDER BY created_at DESC LIMIT 8");$st->execute([$_SESSION['user']['id']]);$rows=$st->fetchAll();
$page_title='Dashboard Masyarakat';include '../includes/header.php';
?>
<div class="section-head"><div><h2>Halo, <?=e($_SESSION['user']['nama'])?></h2><p class="muted">Pantau laporan yang kamu kirim.</p></div><a class="btn" href="buat_pengaduan.php">+ Buat Pengaduan</a></div>
<div class="stats"><div class="stat">Total Pengaduan<strong><?=$total?></strong></div><div class="stat">Selesai<strong><?=$selesai?></strong></div><div class="stat">Dalam Proses<strong><?=$total-$selesai?></strong></div><div class="stat">Akun<strong>Aktif</strong></div></div>
<div class="section-head"><h3>Pengaduan Terbaru</h3><a href="riwayat.php">Lihat semua</a></div>
<div class="table-wrap"><table class="table"><tr><th>Tiket</th><th>Judul</th><th>Status</th><th>Tanggal</th><th></th></tr>
<?php foreach($rows as $r): ?><tr><td><?=e($r['nomor_tiket'])?></td><td><?=e($r['judul'])?></td><td><?=status_badge($r['status'])?></td><td><?=date('d/m/Y',strtotime($r['created_at']))?></td><td><a href="detail.php?id=<?=$r['id']?>">Detail</a></td></tr><?php endforeach; ?>
<?php if(!$rows): ?><tr><td colspan="5" class="empty">Belum ada pengaduan.</td></tr><?php endif; ?></table></div>
<?php include '../includes/footer.php'; ?>