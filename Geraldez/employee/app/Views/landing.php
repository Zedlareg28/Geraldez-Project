<?php
use App\Models\SystemStatusModel;

$model = new SystemStatusModel();
$row = $model->first();
$status = $row ? ($row['status'] ?? 'online') : 'online';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ASSCAT Employee Management System</title>

<style>
    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        background: url('https://scontent.fcgy2-1.fna.fbcdn.net/v/t39.30808-6/488223551_2588203281376826_2789501207399824061_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=833d8c&_nc_eui2=AeGkZgbkwZxYF1ZiPOOu6HVlyFL1PFa3dW_IUvU8Vrd1b3JUPcvV-Qk2P4SCjP5aQuJM1UbrEy_1P-nVW69kMC9D&_nc_ohc=7A6mm2pLAIcQ7kNvwGtP9YJ&_nc_oc=AdntOY6hSO20NzYRqVZJS-sF5N-54gVhEoZ4Rhl4dBiZGhZ3X-QoOvKmR6AGc9A2Sas&_nc_zt=23&_nc_ht=scontent.fcgy2-1.fna&_nc_gid=HdXmEOaUH9xOPO1ZeSfvIw&oh=00_Afj44Et7pgJeeahm69by-unb9NaeKhQdWm7JZSc9lZlOzA&oe=692F1B57') no-repeat center center;
        background-size: cover;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: Arial, sans-serif;
        color: white;
        text-align: center;
    }
    .overlay {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(15, 123, 63, 0.7);
        z-index: 1;
    }
    .container {
        position: relative;
        z-index: 2;
        padding: 20px;
    }
    .logo-container {
        display: inline-block;
        background-color: #0f7b3f;
        padding: 15px;
        border-radius: 15px;
        margin-bottom: 20px;
    }
    img.logo { width: 150px; height: auto; }
    h1 { font-size: 28px; margin-bottom: 30px; font-weight: 700; }
    .btn-group a {
        display: block;
        width: 220px;
        margin: 10px auto;
        padding: 12px;
        background: white;
        color: #0f7b3f;
        text-decoration: none;
        border-radius: 10px;
        font-size: 18px;
        font-weight: bold;
        transition: 0.3s;
    }
    .btn-group a:hover { background: #c3f7d3; }
    .maintenance {
        display: block;
        background: #c0392b;
        color: white;
        margin: 20px auto;
        padding: 15px;
        width: 300px;
        border-radius: 12px;
        font-size: 18px;
        font-weight: bold;
    }
</style>
</head>
<body>
<div class="overlay"></div>
<div class="container">
    <div class="logo-container">
        <img class="logo" src="https://scontent.fcgy2-3.fna.fbcdn.net/v/t39.30808-6/591074083_1663818168390287_5126324889096568210_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeHNi_cMmUmXEG-atYE1CtTbCdtKq5FZNpQJ20qrkVk2lM47puPfJ_m9IUPOuNnq5AJLUVzQCBOuNGvzg-q45IXi&_nc_ohc=IdFCiWVG4U4Q7kNvwEl69JC&_nc_oc=AdnkASlnjHFwsS7qALp-OsHTt7ew2LHWVYG0QK-KIbU15lzr99LzzsK8c5jxz31nLgs&_nc_zt=23&_nc_ht=scontent.fcgy2-3.fna&_nc_gid=DWpkUAJGcv2-s00Ns4miGg&oh=00_AfhFkuoKN8QQ4bht7BLctZ3EWRPztzAlhBeO5X3BDm4tvw&oe=692F3280" alt="ASSCAT Logo">
    </div>

    <h1>ASSCAT Employee Management System</h1>

    <?php if ($status === 'maintenance'): ?>
        <span class="maintenance">🚧 System Under Maintenance. Please check back later.</span>
    <?php else: ?>
        <div class="btn-group">
            <a href="<?= site_url('admin/login') ?>">Admin Login</a>
            <a href="<?= site_url('staff/login') ?>">Staff Login</a>
            <a href="<?= site_url('register') ?>">Register</a>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
