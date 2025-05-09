<?php include '../includes/header.php'; ?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card">
        <div class="card-header text-center bg-primary text-white">
          <h4>Login</h4>
        </div>
        <div class="card-body">
          <form method="post" action="proses_login.php">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" name="username" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
            <p class="text-center mt-3">Belum punya akun? <a href="register.php">Daftar</a></p>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
