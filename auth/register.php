<?php
session_start(); require_once '../config/database.php'; require_once '../config/auth.php';
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $nama=trim($_POST['nama']); $email=trim($_POST['email']); $hp=trim($_POST['no_hp']); $alamat=trim($_POST['alamat']); $password=$_POST['password'];
 if(strlen($password)<6) $error='Kata sandi minimal 6 karakter.';
 else {
  try{
   $st=$pdo->prepare("INSERT INTO users(nama,email,password,no_hp,alamat,role) VALUES(?,?,?,?,?,'masyarakat')");
   $st->execute([$nama,$email,password_hash($password,PASSWORD_DEFAULT),$hp,$alamat]);
   header('Location: login.php?registered=1'); exit;
  }catch(PDOException $e){$error='Email sudah digunakan.';}
 }
}
$page_title='Daftar — WargaCare'; include '../includes/header.php';
?>
<div class="form-card"><h2>Buat Akun Masyarakat</h2><p class="muted">Daftarkan akun untuk membuat dan memantau pengaduan.</p>
<?php if($error): ?><div class="alert alert-danger"><?=e($error)?></div><?php endif; ?>
<form method="post">
<div class="form-group"><label>Nama Lengkap</label><input class="form-control" name="nama" required></div>
<div class="form-group"><label>Email</label><input class="form-control" type="email" name="email" required></div>
<div class="form-group"><label>Nomor HP</label><input class="form-control" name="no_hp"></div>
<div class="form-group"><label>Alamat</label><textarea name="alamat" rows="3"></textarea></div>
<div class="form-group"><label>Kata Sandi</label><input class="form-control" type="password" name="password" minlength="6" required></div>
<button class="btn" type="submit">Buat Akun</button>
</form></div>
<?php include '../includes/footer.php'; ?>