<?php
require_once '../config/database.php'; require_once '../config/auth.php'; require_once '../config/helpers.php'; require_role('masyarakat');
$cats=$pdo->query("SELECT * FROM kategori ORDER BY nama")->fetchAll();$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $judul=trim($_POST['judul']);$kategori=(int)$_POST['kategori'];$isi=trim($_POST['isi']);$lokasi=trim($_POST['lokasi']);$foto=null;
 if(!empty($_FILES['foto']['name'])){
  $ext=strtolower(pathinfo($_FILES['foto']['name'],PATHINFO_EXTENSION));
  if(in_array($ext,['jpg','jpeg','png','webp']) && $_FILES['foto']['size']<=3*1024*1024){
   $foto=uniqid('laporan_').'.'.$ext; move_uploaded_file($_FILES['foto']['tmp_name'],'../uploads/pengaduan/'.$foto);
  } else $error='Foto harus JPG, PNG, atau WEBP dan maksimal 3 MB.';
 }
 if(!$error && $judul && $isi && $lokasi){
  $ticket=generate_ticket();$st=$pdo->prepare("INSERT INTO pengaduan(user_id,kategori_id,nomor_tiket,judul,isi,lokasi,foto) VALUES(?,?,?,?,?,?,?)");
  $st->execute([$_SESSION['user']['id'],$kategori,$ticket,$judul,$isi,$lokasi,$foto]);
  header('Location: detail.php?id='.$pdo->lastInsertId().'&success=1');exit;
 }
}
$page_title='Buat Pengaduan';include '../includes/header.php';
?>
<div class="form-card"><h2>Buat Pengaduan</h2><p class="muted">Sampaikan informasi secara jelas agar laporan mudah ditindaklanjuti.</p>
<?php if($error): ?><div class="alert alert-danger"><?=e($error)?></div><?php endif; ?>
<form method="post" enctype="multipart/form-data">
<div class="form-group"><label>Judul Pengaduan</label><input class="form-control" name="judul" maxlength="180" required></div>
<div class="form-group"><label>Kategori</label><select name="kategori" required><?php foreach($cats as $c):?><option value="<?=$c['id']?>"><?=e($c['nama'])?></option><?php endforeach;?></select></div>
<div class="form-group"><label>Lokasi Kejadian</label><input class="form-control" name="lokasi" required placeholder="Contoh: Jalan Raya Bangsri"></div>
<div class="form-group"><label>Isi Pengaduan</label><textarea name="isi" rows="7" required placeholder="Jelaskan kejadian, kondisi, dan informasi penting lainnya..."></textarea></div>
<div class="form-group"><label>Bukti Foto <span class="small">(opsional, maksimal 3 MB)</span></label><input class="form-control" type="file" name="foto" accept=".jpg,.jpeg,.png,.webp"></div>
<button class="btn" type="submit">Kirim Pengaduan</button></form></div>
<?php include '../includes/footer.php'; ?>