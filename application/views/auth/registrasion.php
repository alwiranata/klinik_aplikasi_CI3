<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-10 shadow-lg my-5 col-lg-7 mx-auto">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">

                    <div class="col">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Registrasi Akun</h1>
                            </div>
                            <form class="user" action="<?= base_url('auth/registrasion') ?>" method="post">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control form-control-user" id="nama" value="<?= set_value('name') ?>" placeholder="Nama">
                                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="email" class="form-control form-control-user" id="email" value="<?= set_value('email') ?>" placeholder="Email ">
                                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password1" class="form-control form-control-user" id="password1" placeholder="Password">
                                        <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="password2" class="form-control form-control-user" id="password2" placeholder="Confirm Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="role_id" value="<?php echo set_value('role_id'); ?>" id="role_id" placeholder="Tingkatan" required>
                                        <option value="">--PILIH USER--</option>
                                        <option value="2">Dokter</option>
                                        <option value="3">Apoteker</option>

                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Login
                                </button>


                            </form>
                            <hr>

                            <div class="text-center">
                                <a class="small" href="<?= base_url('auth/index') ?>">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>