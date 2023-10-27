<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="card mb-3" style="max-width: 550px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" class="img-fluid rounded-start" alt="...">
            </div>

            <div class="col-md-8 mt-5">
                <div class="card-body">
                    <h5 class="card-title">Nama : <?= $user['name']; ?></h5>
                    <p class="card-text"> Aktif : <?= $user['tugas']; ?></p>
                    <p class="card-text"><small class="text-body-secondary">Terdaftar dari : <?= date('d M Y', $user['date_created']);  ?></small></p>
                </div>
            </div>
        </div>
    </div>

</div>