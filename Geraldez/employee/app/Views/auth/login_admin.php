<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #0f7b3f, #28a745); /* Green gradient background */
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: "Poppins", sans-serif;
    }
    .login-card {
      background: #fff;
      padding: 40px;
      border-radius: 15px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.2);
    }
    .login-card h2 {
      margin-bottom: 25px;
      font-weight: 600;
      color: #0f7b3f;
    }
    .btn-danger {
      background-color: #0f7b3f;
      border: none;
    }
    .btn-danger:hover {
      background-color: #28a745;
    }
    a {
      color: #0f7b3f;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="login-card">
    <h2 class="text-center">Admin Login</h2>

    <?php if(session()->getFlashdata('error')): ?>
      <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= site_url('admin/login/process') ?>" method="post">
      <div class="mb-3">
        <label class="form-label">Admin Username</label>
        <input type="text" name="username" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-danger w-100">Login</button>

      <a href="<?= site_url('login') ?>" class="d-block text-center mt-3">Staff Login</a>
    </form>
  </div>
</body>
</html>
