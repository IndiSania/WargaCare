<?php
require_once '../config/database.php';require_once '../config/auth.php';require_once '../config/helpers.php';require_role('admin');
$counts=[];foreach(['Diajukan','Diverifikasi','Diproses','Ditindaklanjuti','Selesai','Ditolak'] as $s){$st=$pdo->prepare("SELECT COUNT(*) FROM pengaduan WHERE status=?");$st->execute([$s]);$counts[$s]=$st->fetchColumn();}
$total=array_sum($counts);$users=$pdo->query("SELECT COUNT(*) FROM users WHERE role='masyarakat'")->fetchColumn();
$rows=$pdo->query("SELECT p.*,u.nama pelapor,k.nama kategori FROM pengaduan p JOIN users u ON u.id=p.user_id JOIN kategori k ON k.id=p.kategori_id ORDER BY p.created_at DESC LIMIT 12")->fetchAll();
$page_title='Dashboard Administrator';include '../includes/header.php';?>
<div class="section-head"><div><h2>Dashboard Administrator</h2><p class="muted">Ringkasan aktivitas WargaCare.</p></div></div>
<div class="stats"><div class="stat">Total Laporan<strong><?=$total?></strong></div><div class="stat">Masyarakat<strong><?=$users?></strong></div><div class="stat">Dalam Proses<strong><?=$counts['Diproses']+$counts['Ditindaklanjuti']?></strong></div><div class="stat">Selesai<strong><?=$counts['Selesai']?></strong></div></div>
<div class="grid" style="margin-bottom:22px"><?php foreach($counts as $s=>$n):?><div class="card"><div class="muted"><?=e($s)?></div><h2><?=$n?></h2></div><?php endforeach;?></div>
<div class="section-head"><h3>Pengaduan Terbaru</h3></div>
<div class="table-wrap"><table class="table"><tr><th>Tiket</th><th>Pelapor</th><th>Judul</th><th>Kategori</th><th>Status</th></tr><?php foreach($rows as $r):?><tr><td><?=e($r['nomor_tiket'])?></td><td><?=e($r['pelapor'])?></td><td><?=e($r['judul'])?></td><td><?=e($r['kategori'])?></td><td><?=status_badge($r['status'])?></td></tr><?php endforeach;?></table></div>
<?php include '../includes/footer.php';?>