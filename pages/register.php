<?php include '../includes/header.php'; ?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header text-center bg-success text-white">
          <h4>Daftar Akun Baru</h4>
        </div>
        <div class="card-body">
          <form method="post" action="proses_register.php">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" name="nama" required>
            </div>
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" name="username" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Daftar</button>
            <p class="text-center mt-3">Sudah punya akun? <a href="login.php">Login</a></p>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
