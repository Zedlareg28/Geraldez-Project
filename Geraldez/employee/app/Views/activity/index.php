
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Activity Logs | Employee Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background: #e8f5e9;
      font-family: "Poppins", sans-serif;
    }
    .container {
      margin-top: 40px;
    }
    .card {
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
      overflow: hidden;
      border-top: 5px solid #28a745;
    }
    .card-header {
      background: linear-gradient(90deg, #28a745, #218838);
      color: white;
      font-weight: 600;
      font-size: 1.3rem;
    }
    .table thead {
      background: #28a745;
      color: #fff;
    }
    .table-striped > tbody > tr:nth-of-type(odd) {
      background-color: #e6f9e8;
    }
    .table tbody tr:hover {
      background-color: #d4efdb;
      transition: .2s ease-in-out;
    }
    .btn {
      border-radius: 10px;
    }
    .btn-light {
      color: #28a745;
      border-color: #28a745;
    }
    .btn-light:hover {
      background-color: #28a745;
      color: #fff;
    }
  </style>
</head>

<body>
<div class="container">
  <div class="card">

    <!-- HEADER -->
    <div class="card-header d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center gap-3">
        <button type="button" class="btn btn-sm btn-light" onclick="history.back();"><i class="bi bi-arrow-left"></i></button>
        <h5 class="mb-0"><i class="bi bi-clock-history"></i> User Activity Logs</h5>
      </div>

      <div class="d-flex align-items-center gap-2">
        <?php if (session()->get('role') === 'admin'): ?>
          <a href="<?= site_url('admin/leaves') ?>" class="btn btn-sm btn-outline-success">Manage Leaves</a>
        <?php endif; ?>
        <a href="<?= site_url('dashboard/admin') ?>" class="btn btn-sm btn-outline-secondary">Dashboard</a>
      </div>
    </div>

    <!-- BODY -->
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped align-middle mb-0">
          <thead>
            <tr>
              <th>#</th>
              <th>Username</th>
              <th>Activity</th>
              <th>IP Address</th>
              <th>MAC Address</th>
              <th>Date & Time</th>
              <?php if (session()->get('role') === 'admin'): ?>
                <th>Actions</th>
              <?php endif; ?>
            </tr>
          </thead>

          <tbody>
            <?php if (!empty($activities)): foreach ($activities as $a): ?>
            <tr>
              <td><?= esc($a['id']) ?></td>
              <td><?= esc($a['username']) ?></td>
              <td class="text-start"><?= esc($a['activity']) ?></td>
              <td><?= esc($a['ip_address']) ?></td>
              <td><?= esc($a['mac_address']) ?></td>
              <td><?= esc($a['created_at']) ?></td>

              <?php if (session()->get('role') === 'admin'): ?>
                <td>
                  <?php if ($a['username'] !== session()->get('username')): ?>
                    <a href="<?= site_url('admin/users/block/' . urlencode($a['username'])) ?>"
                       class="btn btn-sm btn-danger"
                       onclick="return confirm('Block user <?= esc($a['username']) ?>?')">
                      Block
                    </a>

                    <a href="<?= site_url('admin/users/unblock/' . urlencode($a['username'])) ?>"
                       class="btn btn-sm btn-success"
                       onclick="return confirm('Unblock user <?= esc($a['username']) ?>?')">
                      Unblock
                    </a>
                  <?php else: ?>
                    <span class="text-muted small">—</span>
                  <?php endif; ?>
                </td>
              <?php endif; ?>

            </tr>
            <?php endforeach; else: ?>
              <tr>
                <td colspan="<?= (session()->get('role') === 'admin') ? 7 : 6 ?>" class="text-center">
                  No activity records.
                </td>
              </tr>
            <?php endif; ?>
          </tbody>

        </table>
      </div>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
