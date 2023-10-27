<!--  -->

<div class="container">

    <h3 class="mt-3 mb-3"><?= $title; ?></h3>

    <?= $this->session->flashdata('profile_message') ?>
    <!-- Table USer -->
    <a href="<?= base_url('profile/tambahProfile'); ?>" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#newProfileModal">Tambah Profile</a>
    <?= form_error('id', '<div class="alert alert-danger" role="alert">', '</div>') ?>
    <?= form_error('name', '<div class="alert alert-danger" role="alert">', '</div>') ?>
    <?= form_error('image', '<div class="alert alert-danger" role="alert">', '</div>') ?>
    <?= form_error('email', '<div class="alert alert-danger" role="alert">', '</div>') ?>
    <?= form_error('tugas', '<div class="alert alert-danger" role="alert">', '</div>') ?>
    <?= form_error('role_id', '<div class="alert alert-danger" role="alert">', '</div>') ?>
    <?= form_error('is_active', '<div class="alert alert-danger" role="alert">', '</div>') ?>

    <div class="table-responsive">
        <table class="table table-striped ">
            <thead>
                <th>No.</th>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Image</th>
                <th>Tugas </th>
                <th>User</th>

                <th>Aksi</th>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($profile as $p) : ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $p['id'] ?></td>
                        <td><?= $p['name'] ?></td>
                        <td><?= $p['email'] ?></td>
                        <td>
                            <?php if (!$p['image']) {
                                echo "No Image";
                            } else { ?>
                                <img src="<?= base_url('assets/img/profile/' . $p['image']); ?>" alt="" width="100px">
                            <?php } ?>
                        </td>
                        <td><?= $p['tugas'] ?></td>
                        <td><?= $p['role_id'] ?></td>

                        <td>
                            <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editProfileModal<?= $p['id'] ?>">Edit</a>
                            <a href="<?= base_url('profile/deleteProfile/') . $p['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin Ingin Hapus Data <?= $p['name'] ?>?');">Delete</a>
                        </td>
                    </tr>
                    <?php $no++; ?>
                    <!--Edit  Modal -->
                    <div class="modal fade" id="editProfileModal<?= $p['id'] ?>" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title fs-5" id="editProfileModalLabel">Edit Profile</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="<?= base_url('profile/editProfile/') . $p['id']; ?>" method="post">
                                    <div class="modal-body">

                                        <div class=" mb-3">
                                            <input type="hidden" class="form-control" name="id" value="<?= $p['id'] ?>" readonly>
                                        </div>

                                        <div class=" mb-3">
                                            <input type="text" class="form-control" name="name" value="<?= $p['name'] ?>">
                                        </div>

                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email" value="<?= $p['email'] ?>">
                                        </div>



                                        <div class=" mb-3">
                                            <input type="password" class="form-control" name="password" value="<?= $p['password'] ?>">
                                        </div>

                                        <div class=" mb-3">
                                            <input type="text" class="form-control" name="tugas" value="<?= $p['tugas'] ?>">
                                        </div>

                                        <div class=" mb-3">
                                            <input type="file" class="form-control" name="image" value="<?= $p['image'] ?>">
                                        </div>

                                        <div class="form-group">
                                            <select name="role_id" class="form-control" id="role_id">
                                                <option value="<?= $p['role_id'] ?>"><?= $p['role_id'] ?></option>
                                                <option value="1">Admin</option>
                                                <option value="2">Dokter</option>
                                                <option value="3">Apoteker</option>
                                            </select>
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
                <?php endforeach; ?>

            </tbody>
        </table>

    </div>


</div>

<!-- Modal -->
<div class="modal fade" id="newProfileModal" tabindex="-1" aria-labelledby="newProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="newProfileModalLabel">Tambah Profile</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('profile/tambahProfile'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="id" name="id" placeholder="ID">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="name" placeholder="Name">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="email" placeholder="Email">
                    </div>
                    <div class="mb-3">
                        <input type="file" class="form-control" name="userfile" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" placeholder="password">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="tugas" placeholder="Tugas">
                    </div>
                    <div class="form-group">
                        <select name="role_id" class="form-control" id="role_id">
                            <option value="">Level</option>
                            <option value="1">Admin</option>
                            <option value="2">Dokter</option>
                            <option value="3">Apoteker</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="is_active" value="1">
                            <label class="form-check-label" for="is_active">
                                Active?
                            </label>
                        </div>
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