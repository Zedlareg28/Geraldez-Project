<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Employee | Employee Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #007bff, #00c6ff);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: "Poppins", sans-serif;
    }
    .employee-card {
      background: #fff;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 700px;
    }
    .employee-card h2 {
      text-align: center;
      margin-bottom: 30px;
      font-weight: 600;
      color: #333;
    }
    .form-control {
      border-radius: 10px;
    }
    .btn {
      border-radius: 10px;
      padding: 10px 20px;
      font-weight: 500;
    }
    .btn-primary:hover {
      background-color: #0069d9;
    }
    .btn-secondary:hover {
      background-color: #6c757d;
    }
    .alert {
      border-radius: 10px;
    }
  </style>
</head>
<body>
  <div class="employee-card">
    <h2>Edit Employee</h2>

    <?php if(session()->getFlashdata('errors')): ?>
      <div class="alert alert-danger">
        <?php foreach(session()->getFlashdata('errors') as $err): ?>
          <div><?= esc($err) ?></div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form action="<?= site_url('employees/update/'.$employee['id']) ?>" method="post">
      <?= csrf_field() ?>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Employee ID</label>
          <input type="text" name="employee_id" class="form-control" value="<?= esc($employee['employee_id']) ?>" disabled>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Full Name</label>
          <input type="text" name="fullname" class="form-control" value="<?= esc($employee['fullname']) ?>" required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Position</label>
          <input type="text" name="position" class="form-control" value="<?= esc($employee['position']) ?>" required>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Salary</label>
          <input type="number" step="0.01" name="salary" class="form-control" value="<?= esc($employee['salary']) ?>">
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Phone</label>
          <input type="text" name="phone" class="form-control" value="<?= esc($employee['phone']) ?>">
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="<?= esc($employee['email']) ?>">
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-control">
          <option value="active" <?= $employee['status']=='active' ? 'selected' : '' ?>>Active</option>
          <option value="inactive" <?= $employee['status']=='inactive' ? 'selected' : '' ?>>Inactive</option>
          <option value="resigned" <?= $employee['status']=='resigned' ? 'selected' : '' ?>>Resigned</option>
        </select>
      </div>

      <div class="text-center mt-4">
        <button type="submit" class="btn btn-primary">Update Employee</button>
        <a href="<?= site_url('employees') ?>" class="btn btn-secondary">Back</a>
      </div>
    </form>
  </div>
</body>
</html>
