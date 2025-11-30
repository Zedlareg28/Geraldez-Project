<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Staff Dashboard | Employee Management System</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      font-family: "Poppins", sans-serif;
      background: #e8f5e9; /* light green background */
      margin: 0;
      padding: 0;
      height: 100vh;
      overflow: hidden;
    }

    /* Sidebar */
    .sidebar {
      width: 260px;
      background: linear-gradient(135deg, #28a745, #218838); /* green gradient */
      color: #fff;
      height: 100vh;
      padding: 30px 20px;
      position: fixed;
      top: 0;
      left: 0;
      transition: all 0.3s ease;
      overflow-y: auto; /* Make sidebar scrollable */
    }

    .sidebar h3 {
      font-weight: 700;
      margin-bottom: 25px;
    }

    .sidebar p {
      font-size: 15px;
      margin-bottom: 20px;
    }

    .sidebar a {
      display: block;
      padding: 12px;
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
      background: #b02a37;
    }

    /* Main Content */
    .main-content {
      margin-left: 260px;
      padding: 40px;
      height: 100vh;
      overflow-y: auto; /* Make the main content scrollable */
    }

    .card-box {
      background: #fff;
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      border-top: 5px solid #28a745; /* green accent */
    }

    .status-box {
      margin-top: 30px;
      background-color: #f1f8f2; /* soft green */
      padding: 25px;
      border-radius: 15px;
      border: 1px solid #c3e6cb;
    }

    .badge {
      font-weight: 500;
    }

    .alert {
      border-radius: 12px;
      font-weight: 500;
    }

    h2 {
      color: #28a745;
    }

    /* Responsive Design */
    @media (max-width: 991px) {
      /* Adjust sidebar */
      .sidebar {
        width: 220px;
        padding: 20px;
      }

      .main-content {
        margin-left: 220px;
        padding: 30px;
      }

      .sidebar a {
        padding: 10px;
      }

      .card-box {
        padding: 20px;
      }

      h2 {
        font-size: 1.5rem;
      }
    }

    @media (max-width: 768px) {
      /* Sidebar collapse on small screens */
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
        display: none;
      }

      .sidebar.active {
        display: block;
      }

      .main-content {
        margin-left: 0;
        padding: 20px;
      }

      .card-box {
        padding: 15px;
      }

      h2 {
        font-size: 1.2rem;
      }

      .sidebar a {
        font-size: 0.9rem;
      }

      /* Toggle sidebar button for mobile */
      .sidebar-toggle {
        display: block;
        background: #28a745;
        color: white;
        border: none;
        padding: 10px;
        font-size: 1.5rem;
        cursor: pointer;
        position: absolute;
        top: 20px;
        left: 20px;
      }
    }
  </style>
</head>

<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h3>Staff Panel</h3>

    <p><strong><?= session()->get('username') ?></strong> (Staff)</p>

    <a href="<?= site_url('employee_list_staff') ?>">
      <i class="bi bi-people-fill"></i> View Employees
    </a>

    <a href="<?= site_url('reports') ?>">
      <i class="bi bi-file-earmark-text-fill"></i> Reports
    </a>

    <a href="<?= site_url('leaves') ?>">
      <i class="bi bi-calendar-x"></i> My Leaves
    </a>
    
    <a href="<?= site_url('/') ?>" class="logout">
      <i class="bi bi-box-arrow-right"></i> Logout
    </a>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <!-- Toggle Button for Mobile -->
    <button class="sidebar-toggle d-md-none" onclick="toggleSidebar()">☰</button>

    <div class="card-box">
      <h2 class="fw-bold">Welcome, <?= session()->get('username') ?>!</h2>
      <p>You can view employees and check system status.</p>

      <div class="status-box">
        <h4>System Status</h4>

        <p>
          Current Mode:
          <span class="badge bg-<?= $status === 'online' ? 'success' : 'danger' ?>">
            <?= ucfirst($status) ?>
          </span>
        </p>

        <?php if ($status === 'maintenance'): ?>
        <div class="alert alert-warning mt-3 shadow-sm">
          <i class="bi bi-exclamation-triangle-fill"></i>
          The system is under maintenance. Some features may not work.
        </div>
        <?php endif; ?>
      </div>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    function toggleSidebar() {
      const sidebar = document.querySelector('.sidebar');
      sidebar.classList.toggle('active');
    }
  </script>

</body>
</html>
