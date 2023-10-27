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

                                        <a href=" <?= base_url('apoteker/dataPasien') ?>" class="btn btn-primary">Kembali</a>
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