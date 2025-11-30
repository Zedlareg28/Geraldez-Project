<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>System Maintenance | Employee Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #6c757d, #adb5bd);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: "Poppins", sans-serif;
      margin: 0;
    }
    .maintenance-box {
      background: #fff;
      padding: 45px;
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.16);
      text-align: center;
      width: 100%;
      max-width: 600px;
    }
    .maintenance-box h2 {
      font-weight: 600;
      color: #333;
      margin-bottom: 20px;
    }
    .maintenance-box p {
      color: #555;
      margin-bottom: 30px;
    }
    .btn-refresh {
      border-radius: 10px;
      padding: 12px 25px;
      font-weight: 500;
      background-color: #6c757d;
      color: white;
      border: none;
      text-decoration: none;
      display: inline-block;
    }
    .btn-refresh:hover {
      background-color: #565e64;
      color: #fff;
    }
  </style>
</head>
<body>
  <div class="maintenance-box">
    <h2>🚧 System Under Maintenance</h2>
    <p>We’re performing scheduled maintenance.<br>
    Please check back later when the system is back online.</p>

    
    <a href="<?= site_url('/login') ?>" class="btn-refresh">Return to Login</a>
  </div>
</body>
</html>
