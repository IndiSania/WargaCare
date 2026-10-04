<?php
require_once '../config/database.php';require_once '../config/auth.php';require_once '../config/helpers.php';require_role('petugas');
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['update'])){
 $id=(int)$_POST['id'];$status=$_POST['status'];$valid=['Diajukan','Diverifikasi','Diproses','Ditindaklanjuti','Selesai','Ditolak'];
 if(in_array($status,$valid)){ $st=$pdo->prepare("UPDATE pengaduan SET status=? WHERE id=?");$st->execute([$status,$id]); if(trim($_POST['tanggapan']??'')){ $st=$pdo->prepare("INSERT INTO tanggapan(pengaduan_id,user_id,isi) VALUES(?,?,?)");$st->execute([$id,$_SESSION['user']['id'],trim($_POST['tanggapan'])]);}}
}
$q=trim($_GET['q']??'');$sql="SELECT p.*,u.nama,k.nama kategori FROM pengaduan p JOIN users u ON u.id=p.user_id JOIN kategori k ON k.id=p.kategori_id";$params=[];
if($q){$sql.=" WHERE p.nomor_tiket LIKE ? OR p.judul LIKE ? OR u.nama LIKE ?";$params=["%$q%","%$q%","%$q%"];}
$sql.=" ORDER BY p.created_at DESC";$st=$pdo->prepare($sql);$st->execute($params);$rows=$st->fetchAll();
$page_title='Dashboard Petugas';include '../includes/header.php';?>
<div class="section-head"><div><h2>Dashboard Petugas</h2><p class="muted">Kelola laporan masyarakat dan berikan tanggapan.</p></div></div>
<form class="search"><input class="form-control" name="q" value="<?=e($q)?>" placeholder="Cari tiket, judul, atau nama warga"><button class="btn">Cari</button></form>
<div class="table-wrap"><table class="table"><tr><th>Tiket</th><th>Pelapor</th><th>Judul</th><th>Status</th><th>Aksi</th></tr>
<?php foreach($rows as $r):?><tr><td><?=e($r['nomor_tiket'])?></td><td><?=e($r['nama'])?></td><td><?=e($r['judul'])?></td><td><?=status_badge($r['status'])?></td><td><a href="detail.php?id=<?=$r['id']?>">Kelola</a></td></tr><?php endforeach;?>
</table></div>
<?php include '../includes/footer.php';?>