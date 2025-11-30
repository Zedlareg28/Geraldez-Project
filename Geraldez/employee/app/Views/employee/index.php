<!doctype html>
<html>
<head>
  <title>Employee List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root{
      --brand-green: #1e8f5a;
      --brand-green-dark: #0f7b3f;
      --muted: #6c757d;
      --card-bg: #ffffff;
      --page-bg: #eef7f1;
    }

    html,body{height:100%}
    body {
      background: linear-gradient(180deg, var(--page-bg) 0%, #f7fbf8 100%);
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 36px;
      color: #223;
    }

    .wrapper {
      max-width: 1200px;
      margin: 0 auto;
    }

    .header {
      display:flex;
      justify-content:space-between;
      align-items:center;
      gap:16px;
      margin-bottom:18px;
    }

    .brand {
      display:flex;
      align-items:center;
      gap:12px;
    }

    .brand .logo {
      width:56px;
      height:56px;
      border-radius:10px;
      background: linear-gradient(135deg, var(--brand-green-dark), var(--brand-green));
      display:flex;
      align-items:center;
      justify-content:center;
      color:#fff;
      font-weight:700;
      font-size:20px;
      box-shadow: 0 6px 18px rgba(16,128,80,0.12);
    }

    .brand h2 {
      margin:0;
      font-size:1.25rem;
      color:var(--brand-green-dark);
      font-weight:700;
    }

    .card {
      background: var(--card-bg);
      padding:20px;
      border-radius:12px;
      box-shadow: 0 8px 28px rgba(20,60,40,0.06);
      margin-bottom:18px;
      border-left: 6px solid rgba(30,143,90,0.08);
    }

    .top-actions {
      display:flex;
      gap:10px;
      align-items:center;
    }

    .search-box input {
      width:260px;
      border-radius:999px;
      padding:10px 16px;
      border:1px solid #e6eee7;
      box-shadow:none;
    }

    .btn {
      border-radius: 10px;
    }

    .table thead th {
      background: linear-gradient(90deg, var(--brand-green-dark), var(--brand-green));
      color:#fff;
      border:0;
      vertical-align:middle;
      font-weight:600;
      text-transform:uppercase;
      font-size:0.85rem;
      letter-spacing:0.02em;
    }

    .table {
      border-radius:8px;
      overflow:hidden;
      background: transparent;
    }

    .table tbody tr:hover {
      background: rgba(30,143,90,0.03);
    }

    .badge-status {
      padding:6px 10px;
      border-radius:999px;
      font-weight:600;
      font-size:0.85rem;
    }

    .badge-active { background: rgba(34,139,86,0.12); color: var(--brand-green-dark); }
    .badge-inactive { background: rgba(108,117,125,0.08); color: var(--muted); }
    .badge-resigned { background: rgba(192,57,43,0.08); color: #b02a37; }

    .actions a { margin-right:6px; }

    @media (max-width: 900px) {
      .search-box input { width:160px; }
      .header {flex-direction:column; align-items:flex-start; gap:12px}
      .top-actions{width:100%; justify-content:space-between}
    }
  </style>
</head>
<body>
<div class="wrapper">

  <div class="header">
    <div class="brand">
      <div class="logo">EM</div>
      <div>
        <h2>Employee Management</h2>
        <div style="font-size:0.85rem;color:var(--muted)">Manage employees, leaves and reports</div>
      </div>
    </div>

    <div class="top-actions">
      <a href="<?= site_url('dashboard/admin') ?>" class="btn btn-outline-secondary">⬅ Back</a>

      <div class="search-box">
        <input type="text" class="form-control" placeholder="Search employee..." aria-label="Search">
      </div>

      <a href="<?= site_url('employees/create') ?>" class="btn btn-success">+ Add Employee</a>
    </div>
  </div>

  <?php if(session()->getFlashdata('message')): ?>
    <div class="card" style="border-left-color:rgba(34,139,86,0.18);">
      <div class="text-success"><?= session()->getFlashdata('message') ?></div>
    </div>
  <?php endif; ?>
  <?php if(session()->getFlashdata('error')): ?>
    <div class="card" style="border-left-color:rgba(192,57,43,0.12);">
      <div class="text-danger"><?= session()->getFlashdata('error') ?></div>
    </div>
  <?php endif; ?>

  <div class="card">
    <div class="table-responsive">
      <table class="table table-borderless align-middle mb-0">
        <thead>
          <tr>
            <th style="width:48px">#</th>
            <th>Employee ID</th>
            <th>Name</th>
            <th>Position</th>
            <th>Salary</th>
            <th>Status</th>
            <th style="width:200px;">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if(!empty($employees)): foreach($employees as $e): ?>
            <tr>
              <td><?= $e['id'] ?></td>
              <td><?= esc($e['employee_id']) ?></td>
              <td><strong><?= esc($e['fullname']) ?></strong></td>
              <td><?= esc($e['position']) ?></td>
              <td>₱<?= number_format($e['salary'],2) ?></td>
              <td>
                <?php if($e['status'] == 'active'): ?>
                  <span class="badge-status badge-active">Active</span>
                <?php elseif($e['status'] == 'inactive'): ?>
                  <span class="badge-status badge-inactive">Inactive</span>
                <?php else: ?>
                  <span class="badge-status badge-resigned">Resigned</span>
                <?php endif; ?>
              </td>
              <td class="actions">
                <a href="<?= site_url('employees/'.$e['id']) ?>" class="btn btn-sm btn-outline-info">View</a>
                <a href="<?= site_url('employees/edit/'.$e['id']) ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                <a href="<?= site_url('employees/delete/'.$e['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this employee?')">Delete</a>
              </td>
            </tr>
          <?php endforeach; else: ?>
            <tr>
              <td colspan="7" class="text-center text-muted py-4">No employees found.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
