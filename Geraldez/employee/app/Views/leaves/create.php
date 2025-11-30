<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Request Leave | Employee Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #e8f5e9; /* light green background */
      padding-top: 30px;
      padding-bottom: 30px;
    }
    .container {
      max-width: 600px;
      background-color: #ffffff;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      border-top: 5px solid #28a745; /* green accent */
    }
    h3 {
      color: #28a745; /* green heading */
      font-weight: 600;
      margin-bottom: 25px;
      text-align: center;
    }
    .form-label {
      font-weight: 500;
      color: #333;
    }
    .form-control, .form-select, textarea {
      border-radius: 12px;
      padding: 10px;
      border: 1px solid #28a74550; /* subtle green border */
    }
    textarea {
      resize: none;
    }
    .btn-primary {
      border-radius: 25px;
      padding: 8px 25px;
      font-weight: 500;
      background-color: #28a745;
      border-color: #28a745;
    }
    .btn-primary:hover {
      background-color: #218838;
      border-color: #1e7e34;
    }
    .btn-secondary {
      border-radius: 25px;
      padding: 8px 25px;
      font-weight: 500;
    }
    .alert {
      border-radius: 12px;
      font-weight: 500;
    }
    @media (max-width: 576px) {
      .btn + .btn {
        margin-left: 0;
        margin-top: 10px;
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h3>Request Leave</h3>

    <?php if(isset($errors) && !empty($errors)): ?>
      <div class="alert alert-danger">
        <?php foreach($errors as $err) echo "<div>".esc($err)."</div>"; ?>
      </div>
    <?php endif; ?>

    <form action="<?= site_url('leaves/store') ?>" method="post">
      <?= csrf_field() ?>

      <div class="mb-3">
        <label class="form-label">Start Date</label>
        <input type="date" name="start_date" class="form-control" value="<?= set_value('start_date') ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">End Date</label>
        <input type="date" name="end_date" class="form-control" value="<?= set_value('end_date') ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Type</label>
        <select name="type" class="form-select" required>
          <option value="annual" <?= set_value('type')==='annual'?'selected':'' ?>>Annual</option>
          <option value="sick" <?= set_value('type')==='sick'?'selected':'' ?>>Sick</option>
          <option value="vacation" <?= set_value('type')==='vacation'?'selected':'' ?>>Vacation</option>
          <option value="other" <?= set_value('type')==='other'?'selected':'' ?>>Other</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Reason</label>
        <textarea name="reason" class="form-control" rows="4" required><?= set_value('reason') ?></textarea>
      </div>

      <div class="d-flex flex-wrap justify-content-center">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="<?= site_url('leaves') ?>" class="btn btn-secondary">Cancel</a>
      </div>
    </form>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
