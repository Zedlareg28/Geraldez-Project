<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Activity Logs</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
  <div class="container">
    <h2 class="mb-4">User Activity Logs</h2>
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Activity</th>
          <th>IP Address</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($logs as $log): ?>
          <tr>
            <td><?= $log['id'] ?></td>
            <td><?= esc($log['username']) ?></td>
            <td><?= esc($log['activity']) ?></td>
            <td><?= esc($log['ip_address']) ?></td>
            <td><?= $log['created_at'] ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
