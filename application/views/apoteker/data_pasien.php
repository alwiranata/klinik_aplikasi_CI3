<div class="container-fluid">


    <div class="container-fluid">

        <!-- Page Heading -->

        <div class="container-fluid">

            <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
            <div class="row">
                <div class="col-lg-12">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Umur</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Gejala</th>


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
                                    <td scope="col"><?= $p['tanggal']; ?></td>
                                    <td> <a href="<?= base_url('apoteker/dataGejala') ?> " class=" btn btn-warning active">Cek </a></td>


                                </tr>
                                <?php $no++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
</div>
<!-- modal -->


<!-- Modal -->
<!-- Button trigger modal -->