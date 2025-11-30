<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard | Employee Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      font-family: "Poppins", sans-serif;
      background: #e6f2e6; /* Light green background */
      margin: 0;
      padding: 0;
      min-height: 100vh;
    }

    /* Sidebar */
    .sidebar {
      width: 260px;
      background: linear-gradient(135deg, #0f7b3f, #28a745); /* Green gradient */
      color: #fff;
      height: 100vh;
      padding: 30px 20px;
      position: fixed;
      top: 0;
      left: 0;
      transition: 0.3s;
    }

    .sidebar h3 {
      font-weight: 700;
      margin-bottom: 30px;
    }

    .sidebar a {
      display: block;
      padding: 12px 15px;
      color: #fff;
      text-decoration: none;
      margin-bottom: 10px;
      border-radius: 10px;
      transition: 0.2s;
      font-weight: 500;
    }

    .sidebar a:hover {
      background: rgba(255, 255, 255, 0.25);
    }

    .sidebar .logout {
      background: #dc3545;
    }
    .sidebar .logout:hover {
      background: #bb2d3b;
    }

    /* Main Content */
    .main-content {
      margin-left: 260px;
      padding: 40px;
      min-height: 100vh;
    }

    .card-box {
      background: #fff;
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }

    .status-box {
      background-color: #f0fff0; /* light green */
      padding: 25px;
      border-radius: 15px;
      border: 1px solid #c3f7d3; /* soft green border */
      margin-top: 20px;
    }

    .btn-warning {
      background-color: #28a745;
      border-color: #28a745;
      color: #fff;
    }

    .btn-warning:hover {
      background-color: #0f7b3f;
      border-color: #0f7b3f;
      color: #fff;
    }

    .badge-success {
      background-color: #28a745;
    }
    .badge-danger {
      background-color: #c0392b;
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
        padding: 20px;
      }

      .main-content {
        margin-left: 0;
        padding: 20px;
      }

      .card-box {
        padding: 20px;
      }

      .status-box {
        padding: 15px;
      }
    }
  </style>
</head>

<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h3>Admin Panel</h3>
    <p class="mb-3"><strong><?= session()->get('username') ?></strong> (Admin)</p>

    <a href="<?= site_url('employees') ?>">
      <i class="bi bi-people-fill"></i> Manage Employees
    </a>
    
    <a href="<?= site_url('activity') ?>">
      <i class="bi bi-clock-history"></i> User Activity
    </a>

    <a href="<?= site_url('admin/leaves') ?>">
      <i class="bi bi-calendar-check"></i> Manage Leaves
    </a>

    <a href="<?= site_url('reports') ?>">
      <i class="bi bi-file-earmark-text-fill"></i> Users Status Reports
    </a>

    <a href="<?= site_url('reports/leaves') ?>">
      <i class="bi bi-calendar-week"></i> Leaves Report
    </a>

    <a href="<?= site_url('/') ?>" class="logout">
      <i class="bi bi-box-arrow-right"></i> Logout
    </a>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <div class="card-box">
      <h2 class="fw-bold">Welcome, <?= session()->get('username') ?></h2>
      <p>You have full access to manage employees and system data.</p>

      <div class="status-box">
        <h4>System Status</h4>
        <p>
          Current Mode:
          <span class="badge bg-<?= $status === 'online' ? 'success' : 'danger' ?>">
            <?= ucfirst($status) ?>
          </span>
        </p>

        <form action="<?= site_url('admin/system/toggle') ?>" method="post">
          <button type="submit" class="btn btn-warning w-20">
            <i class="bi bi-arrow-repeat"></i>
            Switch to <?= $status === 'online' ? 'Maintenance' : 'Online' ?> Mode
          </button>
        </form>

        <?php if (session()->getFlashdata('message')): ?>
          <div class="alert alert-success mt-3"><?= session()->getFlashdata('message') ?></div>
        <?php endif; ?>
      </div>
    </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
