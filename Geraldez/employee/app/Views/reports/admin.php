
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Admin Reports | Employee Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; background-color: #eefaf0; }
    .container { max-width: 1200px; }
    h3 { color: #1e8f5a; font-weight:600; }
    .filter-card, .table-responsive { background:#fff; border-radius:10px; box-shadow:0 2px 8px rgba(0,0,0,0.05); padding:12px; }
    .table thead { background: linear-gradient(90deg,#0f7b3f,#1e8f5a); color:#fff; }
    .badge { font-size:.9rem; padding:.35em .56em; }
    .btn-success { background:#28a745; border-color:#28a745; }
    .summary .card { border-left:6px solid rgba(30,143,90,0.12); }
    @media (max-width:768px){ .d-flex.flex-wrap { flex-direction:column; gap:8px; } .btn { width:100%; } }
  </style>
</head>
<body>
<div class="container py-4">

  <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
    <h3>Admin — Employee Reports</h3>
    <div class="d-flex gap-2">
      <a href="<?= site_url('dashboard/admin') ?>" class="btn btn-outline-success">Admin Dashboard</a>
      <a href="<?= site_url('reports/export') . '?' . $_SERVER['QUERY_STRING'] ?>" class="btn btn-success">Export Employees</a>
      <a href="<?= site_url('reports/leaves/export') . '?' . $_SERVER['QUERY_STRING'] ?>" class="btn btn-success">Export Leaves</a>
    </div>
  </div>

  <div class="filter-card mb-3">
    <form method="get" class="row g-3 align-items-center">
      <div class="col-auto">
        <select name="status" class="form-select">
          <?php $selectedStatus = isset($selectedStatus) ? $selectedStatus : ''; ?>
          <option value="">All status</option>
          <option value="active" <?= $selectedStatus === 'active' ? 'selected' : '' ?>>Active</option>
          <option value="inactive" <?= $selectedStatus === 'inactive' ? 'selected' : '' ?>>Inactive</option>
        </select>
      </div>

      <div class="col-auto">
        <input type="text" name="position" class="form-control" placeholder="Position" value="<?= esc(isset($positionFilter) ? $positionFilter : '') ?>">
      </div>

      <div class="col-auto">
        <input type="text" name="user_id" class="form-control" placeholder="Filter by User ID (for leaves)" value="<?= esc(isset($userIdFilter) ? $userIdFilter : '') ?>">
      </div>

      <div class="col-auto d-flex gap-2">
        <button class="btn btn-success">Filter</button>
        <a href="<?= site_url('reports/leaves') ?>" class="btn btn-outline-secondary">View Leaves Report</a>
        <a href="<?= site_url('reports') ?>" class="btn btn-outline-success">Reset</a>
      </div>
    </form>
  </div>

  <?php if (isset($counts) && is_array($counts)): ?>
    <div class="row summary mb-3 g-3">
      <div class="col-auto">
        <div class="card p-2">
          <div class="small text-muted">Pending</div>
          <div class="h4 mb-0"><?= (int) ($counts['pending'] ?? 0) ?></div>
        </div>
      </div>
      <div class="col-auto">
        <div class="card p-2">
          <div class="small text-muted">Approved</div>
          <div class="h4 text-success mb-0"><?= (int) ($counts['approved'] ?? 0) ?></div>
        </div>
      </div>
      <div class="col-auto">
        <div class="card p-2">
          <div class="small text-muted">Rejected</div>
          <div class="h4 text-danger mb-0"><?= (int) ($counts['rejected'] ?? 0) ?></div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <div class="table-responsive">
    <table class="table table-striped align-middle text-center mb-0">
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
        <?php if (! empty($employees)): foreach ($employees as $e): ?>
          <tr>
            <td><?= esc($e['employee_id']) ?></td>
            <td class="text-start ps-3"><?= esc($e['fullname']) ?></td>
            <td><?= esc($e['position']) ?></td>
            <td>₱<?= number_format($e['salary'],2) ?></td>
            <td><?= esc($e['phone']) ?></td>
            <td><?= esc($e['email']) ?></td>
            <td><span class="badge bg-<?= $e['status'] === 'active' ? 'success' : 'secondary' ?>"><?= esc($e['status']) ?></span></td>
          </tr>
        <?php endforeach; else: ?>
          <tr><td colspan="7" class="text-center">No employees found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
