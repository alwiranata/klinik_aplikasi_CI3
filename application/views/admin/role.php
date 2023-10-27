<div class="container">

    <h1 class="h3 mb-4  text-gray-800"><?= $title; ?> </h1>

    <div class="row">
        <div class="col-lg-6">

            <a href="" class=" btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#newRoleModal">Tambah Role</a>
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?>
            <?= $this->session->flashdata('role_message'); ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Role</th>
                        <th scope="col">Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($role as $no => $r) : ?>

                        <tr>
                            <td scope="col"><?= $no + 1; ?></td>
                            <td scope="col"><?= $r['role']; ?></td>
                            <td scope="col">
                                <a href="<?= base_url('admin/accessRole/') . $r['id']; ?>" class="btn btn-warning active">Akses</a>
                                <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editRoleModal<?= $r['id'] ?>">Edit</a>
                                <a href="<?= base_url('admin/hapusRole/') . $r['id'] ?>" class="btn btn-danger" onclick="return confirm('Yakin Ingin Hapus Data <?= $r['role'] ?>?');">Delete</a>
                            </td>

                        </tr>
                        <?php $no++; ?>

                        <!-- Update Modal -->
                        <div class="modal fade" id="editRoleModal<?= $r['id'] ?>" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title fs-5" id="editNenuModalLabel">Edit Role</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <form action="<?= base_url('admin/editRole/') . $r['id']; ?>" method="post">
                                        <div class="modal-body">
                                            <input type="text" value="<?= $r['id'] ?>" class="form-control" readonly>
                                        </div>
                                        <div class="modal-body">
                                            <input type="text" value="<?= $r['role'] ?>" name="role" class="form-control">


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
</div>

<!-- modal -->


<!-- Modal -->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="newRoleModal" tabindex="-1" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="newNenuModalLabel">Tambah Role</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/tambahRole'); ?>" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="role" name="role" placeholder="Role Name">
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