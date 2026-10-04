<?php
require_once '../config/database.php';require_once '../config/auth.php';require_once '../config/helpers.php';require_role('masyarakat');
$st=$pdo->prepare("SELECT p.*,k.nama kategori FROM pengaduan p JOIN kategori k ON k.id=p.kategori_id WHERE p.user_id=? ORDER BY p.created_at DESC");$st->execute([$_SESSION['user']['id']]);$rows=$st->fetchAll();
$page_title='Riwayat Pengaduan';include '../includes/header.php';?>
<div class="section-head"><div><h2>Riwayat Pengaduan</h2><p class="muted">Semua laporan yang pernah kamu kirim.</p></div><a class="btn" href="buat_pengaduan.php">+ Pengaduan Baru</a></div>
<div class="table-wrap"><table class="table"><tr><th>Tiket</th><th>Judul</th><th>Kategori</th><th>Status</th><th>Tanggal</th><th></th></tr><?php foreach($rows as $r):?><tr><td><?=e($r['nomor_tiket'])?></td><td><?=e($r['judul'])?></td><td><?=e($r['kategori'])?></td><td><?=status_badge($r['status'])?></td><td><?=date('d/m/Y',strtotime($r['created_at']))?></td><td><a href="detail.php?id=<?=$r['id']?>">Detail</a></td></tr><?php endforeach;?></table></div>
<?php include '../includes/footer.php';?>