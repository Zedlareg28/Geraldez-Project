<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Reports | Employee Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #e8f5e9; /* light green background */
    }
    .container {
      max-width: 1200px;
    }
    h3 {
      color: #28a745; /* green heading */
      font-weight: 600;
    }
    .table thead {
      background-color: #28a745; /* green header */
      color: #fff;
    }
    .table-striped > tbody > tr:nth-of-type(odd) {
      background-color: #e6f9e8; /* light green rows */
    }
    .table tr:hover {
      background-color: #d4efdb; /* darker green on hover */
      transition: 0.2s;
    }
    .badge {
      font-size: 0.9rem;
      padding: 0.4em 0.6em;
    }
    .btn {
      min-width: 100px;
    }
    .btn-success {
      background-color: #28a745;
      border-color: #28a745;
    }
    .btn-success:hover {
      background-color: #218838;
      border-color: #1e7e34;
    }
    .form-select, .form-control {
      min-width: 180px;
    }
    @media (max-width: 768px) {
      .d-flex.justify-content-between {
        flex-direction: column;
        gap: 10px;
      }
      .col-auto {
        width: 100%;
      }
      .btn {
        width: 100%;
      }
    }
    .filter-card {
      background-color: #fff;
      padding: 15px;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      margin-bottom: 20px;
    }
    .table-responsive {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      padding: 10px;
    }
  </style>
</head>
<body>
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
    <h3>Employee Reports</h3>
    <div class="d-flex gap-2">
      
      <a href="<?= site_url('reports/export') . '?' . $_SERVER['QUERY_STRING'] ?>" class="btn btn-success">Export CSV</a>
    </div>
  </div>

  <div class="filter-card">
    <form method="get" class="row g-3 align-items-center">
      <div class="col-auto">
        <select name="status" class="form-select">
          <option value=""> All status</option>
          <?php $selectedStatus = isset($selectedStatus) ? $selectedStatus : ''; ?>
          <option value="active" <?= $selectedStatus === 'active' ? 'selected' : '' ?>>Active</option>
          <option value="inactive" <?= $selectedStatus === 'inactive' ? 'selected' : '' ?>>Inactive</option>
        </select>
      </div>
      <div class="col-auto">
        <input type="text" name="position" class="form-control" placeholder="Position" value="<?= esc(isset($positionFilter) ? $positionFilter : '') ?>">
      </div>
      <div class="col-auto d-flex gap-2">
        <button class="btn btn-success">Filter</button>
        <a href="<?= site_url('reports') ?>" class="btn btn-outline-success">Reset</a>
      </div>
    </form>
  </div>

  <div class="table-responsive">
    <table class="table table-striped align-middle text-center">
      <thead>
        <tr>
          <th>Employee ID</th>
          <th>Fullname</th>
          <th>Position</th>
          <th>Salary</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php if (! empty($employees)): ?>
          <?php foreach ($employees as $e): ?>
            <tr>
              <td><?= esc($e['employee_id']) ?></td>
              <td><?= esc($e['fullname']) ?></td>
              <td><?= esc($e['position']) ?></td>
              <td>₱<?= number_format($e['salary'],2) ?></td>
              <td><?= esc($e['phone']) ?></td>
              <td><?= esc($e['email']) ?></td>
              <td>
                <span class="badge bg-<?= $e['status'] === 'active' ? 'success' : 'secondary' ?>">
                  <?= esc($e['status']) ?>
                </span>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="7" class="text-center">No employees found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
