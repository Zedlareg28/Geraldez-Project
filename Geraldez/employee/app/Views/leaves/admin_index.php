<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Leave Requests - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #e8f5e9; /* light green background */
      padding: 30px 0;
    }
    .container {
      background-color: #fff;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      border-top: 5px solid #28a745; /* green accent */
      max-width: 1000px;
    }
    h3 {
      color: #28a745;
      font-weight: 600;
      margin-bottom: 25px;
      text-align: center;
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
    .btn-danger {
      background-color: #dc3545;
      border-color: #dc3545;
    }
    .btn-danger:hover {
      background-color: #b02a37;
      border-color: #941a28;
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
      border-radius: 12px;
      text-transform: capitalize;
      padding: 0.5em 0.7em;
    }
    @media (max-width: 768px) {
      .table-responsive {
        overflow-x: auto;
      }
      .btn {
        margin-top: 5px;
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h3>All Leave Requests</h3>

    <?php if(session()->getFlashdata('message')): ?>
      <div class="alert alert-success shadow-sm"><?= session()->getFlashdata('message') ?></div>
    <?php endif; ?>

    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover align-middle text-center">
        <thead>
          <tr>
            <th>#</th>
            <th>User ID</th>
            <th>Start</th>
            <th>End</th>
            <th>Type</th>
            <th>Reason</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php if(! empty($leaves)): foreach($leaves as $l): ?>
          <tr>
            <td><?= esc($l['id']) ?></td>
            <td><?= esc($l['user_id']) ?></td>
            <td><?= esc($l['start_date']) ?></td>
            <td><?= esc($l['end_date']) ?></td>
            <td><?= esc($l['type']) ?></td>
            <td><?= esc($l['reason']) ?></td>
            <td>
              <span class="badge bg-<?= $l['status']==='approved'?'success':($l['status']==='rejected'?'danger':'secondary') ?>">
                <?= esc($l['status']) ?>
              </span>
            </td>
            <td>
              <?php if($l['status']==='pending'): ?>
                <a href="<?= site_url('admin/leaves/approve/'.$l['id']) ?>" class="btn btn-sm btn-success">Approve</a>
                <a href="<?= site_url('admin/leaves/reject/'.$l['id']) ?>" class="btn btn-sm btn-danger">Reject</a>
              <?php else: ?>
                <span class="text-muted">No actions</span>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; else: ?>
          <tr>
            <td colspan="8" class="text-center text-muted py-4">No requests.</td>
          </tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
