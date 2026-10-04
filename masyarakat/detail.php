<?php
require_once '../config/database.php';require_once '../config/auth.php';require_once '../config/helpers.php';require_role('masyarakat');
$id=(int)($_GET['id']??0);$st=$pdo->prepare("SELECT p.*,k.nama kategori FROM pengaduan p JOIN kategori k ON k.id=p.kategori_id WHERE p.id=? AND p.user_id=?");$st->execute([$id,$_SESSION['user']['id']]);$r=$st->fetch();
if(!$r){header('Location: dashboard.php');exit;}
$st=$pdo->prepare("SELECT t.*,u.nama FROM tanggapan t JOIN users u ON u.id=t.user_id WHERE t.pengaduan_id=? ORDER BY t.created_at");$st->execute([$id]);$comments=$st->fetchAll();
$page_title='Detail Pengaduan';include '../includes/header.php';
?>
<div class="section-head"><div><h2><?=e($r['judul'])?></h2><p class="muted"><?=e($r['nomor_tiket'])?></p></div><?=status_badge($r['status'])?></div>
<div class="detail-grid"><div class="card"><h3>Informasi Laporan</h3><p><b>Kategori:</b> <?=e($r['kategori'])?></p><p><b>Lokasi:</b> <?=e($r['lokasi'])?></p><p><b>Dibuat:</b> <?=date('d M Y H:i',strtotime($r['created_at']))?></p><hr><p><?=nl2br(e($r['isi']))?></p><?php if($r['foto']):?><p><img src="../uploads/pengaduan/<?=e($r['foto'])?>" style="max-width:100%;border-radius:12px"></p><?php endif;?></div>
<div class="card"><h3>Riwayat Tanggapan</h3><div class="timeline"><?php foreach($comments as $c):?><div class="timeline-item"><b><?=e($c['nama'])?></b><div class="small muted"><?=date('d M Y H:i',strtotime($c['created_at']))?></div><p><?=nl2br(e($c['isi']))?></p></div><?php endforeach;?><?php if(!$comments):?><p class="empty">Belum ada tanggapan.</p><?php endif;?></div></div></div>
<?php include '../includes/footer.php'; ?>