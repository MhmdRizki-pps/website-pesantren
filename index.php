<?php include 'includes/header.php'; ?>

<!-- Hero Section -->
<section class="bg-light py-5 text-center">
  <div class="container">
    <h1 class="display-4">Selamat Datang di Ponpes Modern At-Thohiriyah</h1>
    <p class="lead">Pesantren berwawasan moderat, teknologi, dan Qur'ani.</p>
    <a href="pages/register.php" class="btn btn-primary mt-3">Daftar Sekarang</a>
  </div>
</section>

<!-- Tentang Kami -->
<section id="tentang" class="py-5">
  <div class="container">
    <h2 class="mb-4 text-center">Tentang Kami</h2>
    <p>Ponpes At-Thohiriyah merupakan lembaga pendidikan Islam yang menyeimbangkan ilmu agama dan teknologi. Kami percaya pendidikan harus menyiapkan santri menghadapi tantangan zaman modern.</p>
  </div>
</section>

<!-- Kontak -->
<section id="kontak" class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-4">Kontak</h2>
    <div class="row">
      <div class="col-md-6">
        <h5>Alamat:</h5>
        <p>Jl. Pesantren Modern No. 12, Kota Islami</p>
        <h5>Email:</h5>
        <p>info@atthohiriyah.sch.id</p>
        <h5>Telepon:</h5>
        <p>0812-3456-7890</p>
      </div>
      <div class="col-md-6">
        <form method="post" action="#">
          <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama">
          </div>
          <div class="mb-3">
            <label for="pesan" class="form-label">Pesan</label>
            <textarea class="form-control" id="pesan" name="pesan" rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
      </div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
