<div class="container-fluid">

    <h1 class="h3 mb-4  text-gray-800"><?= $title; ?> </h1>



    <div class="row">
        <div class="col-lg-12">

            <a href="" class=" btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#newSubMenu">Tambah Sub Menu</a>
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?>
            <?= $this->session->flashdata('sub_menu_message'); ?>
            <?php if (!empty(validation_errors())) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo validation_errors(); ?>
                </div>
            <?php endif; ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Url</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($subMenu as $sm) : ?>

                        <tr>
                            <td scope="col"><?= $no; ?></td>
                            <td scope="col"><?= $sm['title']; ?></td>
                            <td scope="col"><?= $sm['menu']; ?></td>
                            <td scope="col"><?= $sm['url']; ?></td>
                            <td scope="col"><?= $sm['icon']; ?></td>
                            <td scope="col">
                                <a href="" class=" btn btn-success" data-bs-toggle="modal" data-bs-target="#editSubMenuModal<?= $sm['id'] ?>">Edit</a>
                                <a href="<?= base_url('menu/hapusSubMenu/') . $sm['id'] ?>" class="btn btn-danger" onclick="return confirm('Yakin Ingin Hapus Data <?= $sm['title'] ?>');">Delete</a>
                            </td>

                        </tr>
                        <?php $no++; ?>
                        <!--Edit  Modal -->
                        <div class="modal fade" id="editSubMenuModal<?= $sm['id'] ?>" tabindex="-1" aria-labelledby="editSubMenuModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title fs-5" id="editSubMenuModalLabel">Edit Sub Menu</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="<?= base_url('menu/editSubMenu/') . $sm['id']; ?>" method="post">
                                        <div class="modal-body">

                                            <div class=" mb-3">
                                                <input type="hidden" class="form-control" name="id" value="<?= $sm['id'] ?>" readonly>
                                            </div>

                                            <div class=" mb-3">
                                                <input type="text" class="form-control" name="title" value="<?= $sm['title'] ?>">
                                            </div>

                                            <div class="form-group">
                                                <select name="menu_id" id="menu_id" class="form-control">
                                                    <?php foreach ($menu as $m) : ?>
                                                        <option value="<?= $m['id'] ?>"><?= $m['menu'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>

                                            <div class=" mb-3">
                                                <input type="text" class="form-control" name="url" value="<?= $sm['url'] ?>">
                                            </div>

                                            <div class=" mb-3">
                                                <input type="text" class="form-control" name="icon" value="<?= $sm['icon'] ?>">
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


<!--Tambah Modal -->
<div class="modal fade" id="newSubMenu" tabindex="-1" aria-labelledby="newSubMenuLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="newSubNenuModalLabel">Tambah Sub Menu</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('menu/tambahSubMenu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Submenu Title">
                    </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id'] ?>"><?= $m['menu'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="Submenu Url">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu Icon">
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="is_active" value="1" id="defaultCheck1">
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