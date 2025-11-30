<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Employee List | Staff</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #e8f5e9; /* light green background */
      font-family: "Segoe UI", sans-serif;
      padding-top: 30px;
      padding-bottom: 30px;
    }
    .container {
      background: #fff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      border-top: 5px solid #28a745; /* green accent */
      margin-top: 40px;
      margin-bottom: 40px;
      max-width: 900px;
    }
    h2 {
      font-weight: bold;
      color: #28a745;
    }
    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      margin-bottom: 25px;
      gap: 10px;
    }
    .search-box input {
      width: 250px;
      border-radius: 25px;
      padding-left: 20px;
      height: 40px;
      border: 1px solid #28a745;
      transition: 0.3s;
    }
    .search-box input:focus {
      outline: none;
      border-color: #218838;
      box-shadow: 0 0 5px rgba(40,167,69,0.3);
    }
    .table thead {
      background: #28a745;
      color: #fff;
    }
    .table tbody tr:hover {
      background: #d4efdb;
      transition: 0.2s;
    }
    .btn-outline-success {
      border-radius: 25px;
      padding: 6px 14px;
      font-size: 0.9rem;
      border-color: #28a745;
      color: #28a745;
    }
    .btn-outline-success:hover {
      background-color: #28a745;
      color: #fff;
    }
    .badge {
      padding: 0.5em 0.8em;
      font-size: 0.85rem;
    }
    .alert {
      border-radius: 12px;
    }
    @media (max-width: 768px) {
      .top-bar {
        flex-direction: column;
        align-items: stretch;
      }
      .search-box input, .top-bar .btn {
        width: 100%;
      }
    }
  </style>
</head>
<body>

<div class="container">
  <div class="top-bar">
    <h2>👨‍💼 Employee List</h2>
    <div class="d-flex flex-wrap gap-2 align-items-center">
      <a href="<?= site_url('dashboard/staff') ?>" class="btn btn-outline-success">⬅ Back to Dashboard</a>
      <div class="search-box">
        <input type="text" class="form-control" placeholder="🔍 Search Employee...">
      </div>
    </div>
  </div>

  <?php if(session()->getFlashdata('message')): ?>
    <div class="alert alert-success shadow-sm"><?= session()->getFlashdata('message') ?></div>
  <?php endif; ?>
  <?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger shadow-sm"><?= session()->getFlashdata('error') ?></div>
  <?php endif; ?>

  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover align-middle text-center">
      <thead>
        <tr>
          <th>#</th>
          <th>Employee ID</th>
          <th>Name</th>
          <th>Position</th>
          <th>Salary</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($employees)): foreach($employees as $e): ?>
          <tr>
            <td><?= $e['id'] ?></td>
            <td><?= esc($e['employee_id']) ?></td>
            <td><?= esc($e['fullname']) ?></td>
            <td><?= esc($e['position']) ?></td>
            <td>₱<?= number_format($e['salary'],2) ?></td>
            <td>
              <?php if($e['status'] == 'active'): ?>
                <span class="badge bg-success">Active</span>
              <?php elseif($e['status'] == 'inactive'): ?>
                <span class="badge bg-secondary">Inactive</span>
              <?php else: ?>
                <span class="badge bg-danger">Resigned</span>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; else: ?>
          <tr>
            <td colspan="6" class="text-center text-muted py-4">No employees found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
