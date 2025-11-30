<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register | Employee Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #28a745, #00c851);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: "Poppins", sans-serif;
    }
    .register-card {
      background: #fff;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 450px;
    }
    .register-card h2 {
      text-align: center;
      margin-bottom: 30px;
      font-weight: 600;
      color: #333;
    }
    .form-control {
      border-radius: 10px;
    }
    .btn-success {
      width: 100%;
      border-radius: 10px;
      padding: 10px;
      font-weight: 500;
    }
    .btn-success:hover {
      background-color: #218838;
    }
    .login-link {
      display: block;
      text-align: center;
      margin-top: 15px;
    }
  </style>
</head>
<body>
  <div class="register-card">
    <h2>Create Account</h2>

    <?php if(session()->getFlashdata('error')): ?>
      <div class="alert alert-danger text-center">
        <?= session()->getFlashdata('error') ?>
      </div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('success')): ?>
      <div class="alert alert-success text-center">
        <?= session()->getFlashdata('success') ?>
      </div>
    <?php endif; ?>

    <?= isset($errors) ? '<div class="alert alert-danger">'.esc(json_encode($errors)).'</div>' : '' ?>

    <form action="<?= site_url('register/process') ?>" method="post">
      <?= csrf_field() ?>

      <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" name="fullname" class="form-control" placeholder="Enter your full name" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" placeholder="Choose a username" value="<?= set_value('username') ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Create a password" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Confirm Password</label>
        <input type="password" name="password_confirm" class="form-control" placeholder="Confirm your password" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Role</label>
        <select name="role" class="form-control" required>
          <option value="">-- Select Role --</option>
          <option value="admin">Admin</option>
          <option value="staff">Staff</option>
        </select>
      </div>

      <button type="submit" class="btn btn-success">Register</button>
      <a href="<?= site_url('login') ?>" class="login-link">Already have an account? Login</a>
    </form>
  </div>
</body>
</html>
