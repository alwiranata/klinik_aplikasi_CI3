<div class="container-fluid">

    <h1 class="h3 mb-4  text-gray-800"><?= $title; ?> </h1>



    <div class="row">
        <div class="col-lg-6">

            <a href="" class=" btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#newMenuModal">Tambah Menu</a>
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?>
            <?= $this->session->flashdata('menu_message'); ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($menu as $m) : ?>

                        <tr>
                            <td scope="col"><?= $no; ?></td>
                            <td scope="col"><?= $m['menu']; ?></td>
                            <td scope="col">
                                <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editMenuModal<?= $m['id'] ?>">Edit</a>
                                <a href=" <?= base_url('menu/hapusMenu/') . $m['id'] ?>" class="btn btn-danger" onclick="return confirm('Yakin Ingin Hapus Data <?= $m['menu'] ?>?');">Delete</a>
                            </td>

                        </tr>
                        <?php $no++; ?>
                        <!--Edit  Modal -->
                        <div class="modal fade" id="editMenuModal<?= $m['id'] ?>" tabindex="-1" aria-labelledby="editMenuModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title fs-5" id="editNenuModalLabel">Edit Menu</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="<?= base_url('menu/editMenu/') . $m['id']; ?>" method="post">
                                        <div class="modal-body">

                                            <div class=" mb-3">

                                                <input type="text" class="form-control" name="id" value="<?= $m['id'] ?>" readonly>
                                            </div>

                                            <div class=" mb-3">
                                                <input type="text" class="form-control" name="menu" value="<?= $m['menu'] ?>">
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


</div>
<!-- modal -->


<!-- Modal -->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="newMenuModal" tabindex="-1" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="newNenuModalLabel">Tambah Menu</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('menu/tambahMenu'); ?>" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu Name">
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