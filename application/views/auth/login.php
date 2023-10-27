<body background="<?= base_url('assets/img/profile/al.jpg') ?>">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-7">

                <div class="  10-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">

                            <div class="col">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">KLINIK</h1>
                                    </div>
                                    <?= $this->session->flashdata('auth_message'); ?>

                                    <form class="user" action="<?= base_url('auth') ?>" method="post">
                                        <div class="form-group">
                                            <input type="text" name="email" class="form-control form-control-user" id="email" aria-describedby="email" value="<?= set_value('email') ?>" placeholder="Email">
                                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" id="password" value="<?= set_value('password') ?>" placeholder="Password">
                                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>

                                    </form>
                                    <hr>

                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('auth/registrasion') ?>"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>