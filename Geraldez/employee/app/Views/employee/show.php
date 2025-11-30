<!doctype html>
<html>
<head>
  <title>Employee Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f4f6f9;
      font-family: "Segoe UI", sans-serif;
    }
    .container {
      max-width: 700px;
      background: #fff;
      margin-top: 60px;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    h2 {
      font-weight: 700;
      color: #333;
      border-bottom: 3px solid #007bff;
      display: inline-block;
      padding-bottom: 5px;
      margin-bottom: 25px;
    }
    dt {
      color: #555;
      font-weight: 600;
    }
    dd {
      color: #333;
      margin-bottom: 15px;
    }
    .badge {
      font-size: 0.9rem;
      padding: 8px 12px;
      border-radius: 8px;
    }
    .btn {
      border-radius: 20px;
      padding: 8px 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>👔 Employee Details</h2>
    <dl class="row mt-4">
      <dt class="col-sm-4">Employee ID:</dt>
      <dd class="col-sm-8"><?= esc($employee['employee_id']) ?></dd>

      <dt class="col-sm-4">Full Name:</dt>
      <dd class="col-sm-8"><?= esc($employee['fullname']) ?></dd>

      <dt class="col-sm-4">Position:</dt>
      <dd class="col-sm-8"><?= esc($employee['position']) ?></dd>

      <dt class="col-sm-4">Salary:</dt>
      <dd class="col-sm-8">₱<?= number_format($employee['salary'],2) ?></dd>

      <dt class="col-sm-4">Phone:</dt>
      <dd class="col-sm-8"><?= esc($employee['phone']) ?></dd>

      <dt class="col-sm-4">Email:</dt>
      <dd class="col-sm-8"><?= esc($employee['email']) ?></dd>

      <dt class="col-sm-4">Status:</dt>
      <dd class="col-sm-8">
        <?php if($employee['status'] == 'active'): ?>
          <span class="badge bg-success">Active</span>
        <?php elseif($employee['status'] == 'inactive'): ?>
          <span class="badge bg-secondary">Inactive</span>
        <?php else: ?>
          <span class="badge bg-danger">Resigned</span>
        <?php endif; ?>
      </dd>
    </dl>

    <div class="mt-4 text-end">
      <a href="<?= site_url('employees/edit/'.$employee['id']) ?>" class="btn btn-warning">✏️ Edit</a>
      <a href="<?= site_url('employees') ?>" class="btn btn-secondary">⬅️ Back</a>
    </div>
  </div>
</body>
</html>
