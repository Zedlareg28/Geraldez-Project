<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Leaves Report</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #e8f5e9; /* light green background */
      padding: 30px 0;
    }
    .container {
      max-width: 1200px;
    }
    h3 {
      color: #28a745;
      font-weight: 600;
      margin-bottom: 20px;
      text-align: center;
    }
    .card-summary {
      background-color: #fff;
      border-left: 5px solid #28a745;
      border-radius: 10px;
      padding: 15px 20px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      text-align: center;
    }
    .card-summary .fs-4 {
      font-weight: 700;
    }
    .btn {
      border-radius: 25px;
    }
    .btn-success {
      background-color: #28a745;
      border-color: #28a745;
    }
    .btn-success:hover {
      background-color: #218838;
      border-color: #1e7e34;
    }
    .btn-outline-secondary {
      border-radius: 25px;
    }
    .form-select, .form-control {
      border-radius: 25px;
    }
    .table-responsive {
      margin-top: 20px;
      background-color: #fff;
      padding: 10px;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    table {
      margin: 0;
    }
    .table thead {
      background-color: #28a745;
      color: #fff;
    }
    .table-striped > tbody > tr:nth-of-type(odd) {
      background-color: #e6f9e8;
    }
    .table tbody tr:hover {
      background-color: #d4efdb;
      transition: 0.2s;
    }
    .badge {
      border-radius: 12px;
      text-transform: capitalize;
      padding: 0.4em 0.7em;
    }
    .badge.pending {
      background-color: #ffc107;
      color: #fff;
    }
    @media (max-width: 768px) {
      .table-responsive {
        overflow-x: auto;
      }
      .btn, .form-select, .form-control {
        width: 100%;
        margin-top: 5px;
      }
    }
  </style>
</head>
<body>
<div class="container py-4">

  <h3>Leave Requests Report</h3>

  <!-- Export button -->
  <div class="d-flex justify-content-end mb-3">
    <a href="<?= site_url('reports/leaves/export') . '?' . $_SERVER['QUERY_STRING'] ?>" class="btn btn-success">Export CSV</a>
  </div>

  <!-- Summary cards -->
  <div class="row mb-3 g-3">
    <?php $c = isset($counts) ? $counts : ['pending'=>0,'approved'=>0,'rejected'=>0]; ?>
    <div class="col-md-4">
      <div class="card-summary">
        <div>Pending</div>
        <div class="fs-4 fw-bold"><?= (int) ($c['pending'] ?? 0) ?></div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card-summary">
        <div>Approved</div>
        <div class="fs-4 fw-bold text-success"><?= (int) ($c['approved'] ?? 0) ?></div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card-summary">
        <div>Rejected</div>
        <div class="fs-4 fw-bold text-danger"><?= (int) ($c['rejected'] ?? 0) ?></div>
      </div>
    </div>
  </div>

  <!-- Filter form -->
  <form method="get" class="row g-2 mb-3 align-items-end">
    <div class="col-auto">
      <label>Status</label>
      <select name="status" class="form-select">
        <?php $selectedStatus = isset($selectedStatus) ? $selectedStatus : ''; ?>
        <option value="">All status</option>
        <option value="pending" <?= $selectedStatus === 'pending' ? 'selected' : '' ?>>Pending</option>
        <option value="approved" <?= $selectedStatus === 'approved' ? 'selected' : '' ?>>Approved</option>
        <option value="rejected" <?= $selectedStatus === 'rejected' ? 'selected' : '' ?>>Rejected</option>
      </select>
    </div>

    <?php if (session()->get('role') === 'admin'): ?>
    <div class="col-auto">
      <label>User ID</label>
      <input type="text" name="user_id" class="form-control" placeholder="Filter by User ID" value="<?= esc(isset($userIdFilter) ? $userIdFilter : '') ?>">
    </div>
    <?php endif; ?>

    <div class="col-auto d-flex gap-2">
      <button class="btn btn-success">Filter</button>
      <a href="<?= site_url('reports/leaves') ?>" class="btn btn-outline-secondary">Reset</a>
    </div>
  </form>

  <!-- Table -->
  <div class="table-responsive">
    <table class="table table-striped align-middle text-center">
      <thead>
        <tr>
          <th>#</th>
          <th>User ID</th>
          <th>Start</th>
          <th>End</th>
          <th>Type</th>
          <th>Reason</th>
          <th>Status</th>
          <th>Created</th>
        </tr>
      </thead>
      <tbody>
        <?php if (! empty($leaves)): foreach ($leaves as $l): ?>
        <tr>
          <td><?= esc($l['id']) ?></td>
          <td><?= esc($l['user_id']) ?></td>
          <td><?= esc($l['start_date']) ?></td>
          <td><?= esc($l['end_date']) ?></td>
          <td><?= esc($l['type']) ?></td>
          <td><?= esc($l['reason']) ?></td>
          <td>
            <span class="badge <?= $l['status']==='pending' ? 'pending' : ($l['status']==='approved' ? 'bg-success' : 'bg-danger') ?>">
              <?= esc($l['status']) ?>
            </span>
          </td>
          <td><?= esc($l['created_at']) ?></td>
        </tr>
        <?php endforeach; else: ?>
        <tr>
          <td colspan="8" class="text-center">No records found.</td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
