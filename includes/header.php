<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/helpers.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($page_title ?? 'WargaCare') ?></title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<nav class="navbar">
  <a class="brand" href="../index.php"><span>W</span> WargaCare</a>
  <div class="nav-links">
    <?php if (!empty($_SESSION['user'])): ?>
      <a href="../index.php">Beranda</a>
      <?php if ($_SESSION['user']['role']==='masyarakat'): ?>
        <a href="../masyarakat/dashboard.php">Dashboard</a>
        <a href="../masyarakat/buat_pengaduan.php">Buat Pengaduan</a>
      <?php elseif ($_SESSION['user']['role']==='petugas'): ?>
        <a href="../petugas/dashboard.php">Dashboard</a>
      <?php else: ?>
        <a href="../admin/dashboard.php">Dashboard</a>
      <?php endif; ?>
      <a class="nav-logout" href="../auth/logout.php">Keluar</a>
    <?php else: ?>
      <a href="../auth/login.php">Masuk</a>
      <a class="btn btn-small" href="../auth/register.php">Daftar</a>
    <?php endif; ?>
  </div>
</nav>
<main class="container">
