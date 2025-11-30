<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Leaves | Employee Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #e8f5e9; /* light green background */
      padding-top: 30px;
      padding-bottom: 30px;
    }
    .container {
      background-color: #ffffff;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      border-top: 5px solid #28a745; /* green accent */
      max-width: 900px;
    }
    h3 {
      color: #28a745;
      font-weight: 600;
      margin-bottom: 25px;
      text-align: center;
    }
    .btn-primary, .btn-secondary {
      border-radius: 25px;
      padding: 8px 20px;
      font-weight: 500;
    }
    .btn-primary {
      background-color: #28a745;
      border-color: #28a745;
    }
    .btn-primary:hover {
      background-color: #218838;
      border-color: #1e7e34;
    }
    .btn-secondary {
      background-color: #6c757d;
      border-color: #6c757d;
      color: #fff;
    }
    .btn-secondary:hover {
      background-color: #5a6268;
      border-color: #545b62;
    }
    table {
      margin-top: 20px;
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
      font-size: 0.9rem;
      padding: 0.5em 0.7em;
      border-radius: 12px;
      text-transform: capitalize;
    }
    @media (max-width: 768px) {
      .table-responsive {
        overflow-x: auto;
      }
      .btn {
        width: 100%;
        margin-top: 10px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
      <h3>My Leave Requests</h3>
      <div class="d-flex flex-wrap gap-2">
        <a href="<?= site_url('dashboard/staff') ?>" class="btn btn-secondary">⬅ Back to Dashboard</a>
        <a href="<?= site_url('leaves/create') ?>" class="btn btn-primary">Request Leave</a>
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
            <th>Start Date</th>
            <th>End Date</th>
            <th>Type</th>
            <th>Status</th>
            <th>Reason</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($leaves)): foreach($leaves as $l): ?>
            <tr>
              <td><?= esc($l['id']) ?></td>
              <td><?= esc($l['start_date']) ?></td>
              <td><?= esc($l['end_date']) ?></td>
              <td><?= esc($l['type']) ?></td>
              <td>
                <span class="badge bg-<?= $l['status']==='approved'?'success':($l['status']==='rejected'?'danger':'secondary') ?>">
                  <?= esc($l['status']) ?>
                </span>
              </td>
              <td><?= esc($l['reason']) ?></td>
            </tr>
          <?php endforeach; else: ?>
            <tr>
              <td colspan="6" class="text-center text-muted py-4">No leave requests.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
