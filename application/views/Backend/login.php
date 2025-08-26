<!doctype html><html><head><meta charset="utf-8"><title>Admin Login</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"></head><body>
<div class="container" style="max-width:420px;margin-top:80px;">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Admin Login</h4>
      <?php if(isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
      <?php endif; ?>
      <form method="post" action="<?php echo base_url('admin/login') ?>">
        <div class="form-group">
          <label>Email</label>
          <input class="form-control" name="email" required>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input class="form-control" type="password" name="password" required>
        </div>
        <button class="btn btn-primary">Login</button>
      </form>
    </div>
  </div>
</div>
</body></html>
