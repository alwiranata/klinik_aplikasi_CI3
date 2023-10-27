<div class="container-fluid">

    <!-- Page Heading -->

    <div class="container-fluid">



        <h1 class="h4 mb-4 text-gray-800"><?= $title ?></h1>

        <div class="row">
            <div class="col-lg-12">

                <a href="" class=" btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#newPasienModal">Tambah Data</a>

                <?= form_error('nama', '<div class="alert alert-danger" role="alert">', '</div>') ?>
                <?= form_error('gender', '<div class="alert alert-danger" role="alert">', '</div>') ?>
                <?= form_error('umur', '<div class="alert alert-danger" role="alert">', '</div>') ?>
                <?= form_error('tanggal', '<div class="alert alert-danger" role="alert">', '</div>') ?>
                <?= form_error('berat', '<div class="alert alert-danger" role="alert">', '</div>') ?>
                <?= form_error('gejala', '<div class="alert alert-danger" role="alert">', '</div>') ?>
                <?= form_error('hari', '<div class="alert alert-danger" role="alert">', '</div>') ?>
                <?= form_error('tensi', '<div class="alert alert-danger" role="alert">', '</div>') ?>
                <?= form_error('resep', '<div class="alert alert-danger" role="alert">', '</div>') ?>

                <?= $this->session->flashdata('pasien_message'); ?>
                <table class="table table-hover">

                    <thead>
                        <tr>

                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Umur</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Gejala</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($pasien as $p) : ?>

                            <tr>
                                <td scope="col"><?= $no; ?></td>
                                <td scope="col"><?= $p['nama']; ?></td>
                                <td scope="col"><?= $p['gender']; ?></td>
                                <td scope="col"><?= $p['umur']; ?></td>
                                <td scope="col"> <?= date('d M Y', $p['tanggal']); ?></td>
                                <td>
                                    <a href="<?= base_url('dokter/gejala'); ?> " class="btn btn-warning active">
                                        lihat
                                    </a>
                                </td>
                                <td scope="col">

                                    <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editPasienModal<?= $p['id'] ?>">Edit</a>
                                    <a href=" <?= base_url('dokter/hapusPasien/') . $p['id'] ?>" class="btn btn-danger" onclick="return confirm('Yakin Ingin Hapus Data <?= $p['nama'] ?>?');">Delete</a>
                                </td>

                            </tr>
                            <?php $no++; ?>
                            <!--Edit  Modal -->
                            <div class="modal fade" id="editPasienModal<?= $p['id'] ?>" tabindex="-1" aria-labelledby="editPasienModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title fs-5" id="editNenuModalLabel">Edit Pasien</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="<?= base_url('dokter/editPasien/') . $p['id']; ?>" method="post">
                                            <div class="modal-body">

                                                <div class=" mb-3">

                                                    <input type="hidden" class="form-control" name="id" value="<?= $p['id'] ?>" readonly>
                                                </div>

                                                <div class=" mb-3">
                                                    <input type="text" class="form-control" name="nama" value="<?= $p['nama'] ?>" placeholder="nama">
                                                </div>

                                                <div class=" mb-3">
                                                    <?php
                                                    if ($p['gender'] == 'L') {
                                                        $L = 'selected';
                                                    } elseif ($p['gender'] == 'P') {
                                                        $P = 'selected';
                                                    }
                                                    ?>
                                                    <select class="form-select" name="gender">
                                                        <option value="">-Gender-</option>
                                                        <option value="L" <?= !empty($L) ? $L : '' ?>> Laki Laki</option>
                                                        <option value="P" <?= !empty($P) ? $P : '' ?>>Perempuan</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <input type="text" class="form-control" name="umur" value="<?= $p['umur'] ?>" placeholder="Umur">
                                                </div>



                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
            </div>
        <?php endforeach; ?>
        </tbody>
        </table>
        </div>
    </div>


</div>
<!-- modal -->


<!-- Modal -->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="newPasienModal" tabindex="-1" aria-labelledby="newPasienModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="newPasienModalLabel">Data Pasien</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('dokter/tambahDataPasien'); ?>" method="post">
                <div class="modal-body">

                    <div class="mb-3">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <select name="gender" id="gender" class="form-control">
                            <option value="">Gender</option>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="umur" name="umur" placeholder="Umur">
                    </div>
                    <div class="modal-header">
                        <h4 class="title fs-5">Gejala</h4>

                    </div>
                    <div class=" mb-3 mt-3">

                        <input type="text" class="form-control" id="berat" name="berat" placeholder="Berat">
                    </div>
                    <div class="mb-3">
                        <textarea rows="3" cols="60" type="text" class="form-control" id="gejala" name="gejala" placeholder="Gejala"></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="Hari" name="hari" placeholder="Lama Gejala">
                    </div>
                    <div class="form-group">
                        <select name="tensi" id="tensi" class="form-control">
                            <option value="">Tensi</option>
                            <option value="Rendah">Rendah</option>
                            <option value="Normal">Normal</option>
                            <option value="Tinggi">Tinggi</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <textarea rows="3" cols="60" type="text" class="form-control" id="resep" name="resep" placeholder="Resep"></textarea>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save </button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>