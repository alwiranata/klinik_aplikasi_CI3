<div class="container-fluid">

    <!-- Page Heading -->

    <div class="container-fluid">
        <h1 class="h4 mb-4 text-gray-800"><?= $title ?></h1>

        <div class="container">
            <?= $this->session->flashdata('gejala_message'); ?>
            <?php foreach ($pasien as $no => $p) : ?>
                <div class="rows">

                    <div class="col-lg">
                        <div class="card card-margin">
                            <div class="card-header no-border">
                                <h5 class="card-title"><?= $p['nama'] ?></h5>
                            </div>
                            <div class="card-body pt-0">
                                <div class="widget-49">
                                    <div class="widget-49-title-wrapper">
                                        <div class="widget-49-date-primary">
                                            <span class="widget-49-date-day"><?= $no + 1; ?></span>
                                        </div>
                                        <div class="widget-49-meeting-info">
                                            <span class="widget-49-pro-title">Berat Badan : <?= $p['berat'] ?></span>
                                            <span class="widget-49-pro-title">Tensi : <?= $p['tensi'] ?></span>

                                        </div>
                                    </div>
                                    <div class="widget-49-title-wrapper mt-3">

                                        <div class="widget-49-meeting-info">

                                            <span class="widget-49-pro-title">Gejala : <?= $p['gejala'] ?></span>

                                            <span class="widget-49-pro-title">Lama Gejala : <?= $p['hari'] ?></span>

                                            <span class="widget-49-pro-title">Resep : <?= $p['resep'] ?></span>


                                        </div>

                                    </div>


                                    <div class="widget-49-meeting-action">
                                        <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editGejalaModal<?= $p['id'] ?>">Edit</a>
                                        <a href=" <?= base_url('dokter/dataPasien') ?>" class="btn btn-primary">Kembali</a>
                                    </div>
                                </div>

                                <!--Edit  Modal -->
                                <div class="modal fade" id="editGejalaModal<?= $p['id'] ?>" tabindex="-1" aria-labelledby="editGejalaModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title fs-5" id="editGejalaModalLabel">Edit Gejala</h3>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="<?= base_url('dokter/editGejala/') . $p['id']; ?>" method="post">
                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <input type="hidden" class="form-control" name="id" value="<?= $p['id'] ?>" placeholder="Id" readonly>
                                                    </div>

                                                    <div class="mb-3">
                                                        <input type="text" class="form-control" name="berat" value="<?= $p['berat'] ?>" placeholder="Berat">
                                                    </div>

                                                    <div class="mb-3">
                                                        <textarea rows="3" cols="60" type="text" class="form-control" id="gejala" name="gejala" placeholder="Gejala"><?= $p['gejala'] ?></textarea>
                                                    </div>

                                                    <div class="mb-3">
                                                        <input type="text" class="form-control" name="hari" value="<?= $p['hari'] ?>" placeholder="Lama Gejala">
                                                    </div>

                                                    <div class=" mb-3">
                                                        <?php
                                                        if ($p['tensi'] == 'Rendah') {
                                                            $Rendah = 'selected';
                                                        } elseif ($p['tensi'] == 'Normal') {
                                                            $Normal = 'selected';
                                                        } elseif ($p['tensi'] == 'Tinggi') {
                                                            $Tinggi = 'selected';
                                                        }
                                                        ?>
                                                        <select class="form-select" name="tensi">
                                                            <option value="">-Tensi-</option>
                                                            <option value="Rendah" <?= !empty($Rendah) ? $Rendah : '' ?>>Rendah</option>
                                                            <option value="Normal" <?= !empty($Normal) ? $Normal : '' ?>>Normal</option>
                                                            <option value="Tinggi" <?= !empty($Tinggi) ? $Tinggi : '' ?>>Tinggi</option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <textarea rows="3" cols="60" type="text" class="form-control" id="resep" name="resep" placeholder="Resep"><?= $p['resep'] ?></textarea>
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
                        </div>
                    </div>

                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>