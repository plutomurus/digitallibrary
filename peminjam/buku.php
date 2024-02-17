  <div class="row justify-content-center">
  <?php foreach($getData as $row) :  ?>
      <div class="card mx-1 mt-2" style="width: 18rem;">
        <img src="../assets/image/404.jpg" class="card-img-top mt-1" alt="...">
        <div class="card-body d-flex flex-column justify-content-between">
          <div>
            <h5 class="card-title"><?= $row["Judul"] ?></h5>
            <p class="card-text text-truncate"><?= $row["Deskripsi"] ?></p>
          </div>
            <div class="mt-3">
              <a href="?page=peminjaman&id=<?= $row["BukuID"] ?>" class="btn btn-primary w-100">Lihat <i class="bi bi-eye-fill ms-1"></i></a>
            </div>
        </div>
      </div>
  <?php endforeach; ?>
  </div>