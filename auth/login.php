<?php
session_start(); require_once '../config/database.php'; require_once '../config/auth.php';
if(!empty($_SESSION['user'])) { header('Location: ../index.php'); exit; }
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $email=trim($_POST['email']); $password=$_POST['password'];
 $st=$pdo->prepare("SELECT * FROM users WHERE email=? LIMIT 1"); $st->execute([$email]); $u=$st->fetch();
 if($u && (password_verify($password,$u['password']) || md5($password)===$u['password'])){
   $_SESSION['user']=$u;
   $dest=$u['role']==='admin'?'../admin/dashboard.php':($u['role']==='petugas'?'../petugas/dashboard.php':'../masyarakat/dashboard.php');
   header("Location: $dest"); exit;
 }
 $error='Email atau kata sandi tidak sesuai.';
}
$page_title='Masuk — WargaCare'; include '../includes/header.php';
?>
<div class="login-page"><div class="form-card">
<div class="logo-big"><span>W</span><h2>Masuk ke WargaCare</h2><p class="muted">Kelola dan pantau pengaduan masyarakat.</p></div>
<?php if($error): ?><div class="alert alert-danger"><?=e($error)?></div><?php endif; ?>
<form method="post">
<div class="form-group"><label>Email</label><input class="form-control" type="email" name="email" required></div>
<div class="form-group"><label>Kata Sandi</label><input class="form-control" type="password" name="password" required></div>
<button class="btn" type="submit">Masuk</button>
</form>
<p class="small">Belum punya akun? <a href="register.php">Daftar sebagai masyarakat</a></p>
</div></div>
<?php include '../includes/footer.php'; ?>