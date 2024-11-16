<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"
                    style="background: url('<?= base_url('assets/img/horizon.png') ?>') no-repeat center center; background-size: contain;">
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <!-- Form with POST method and action pointing to Auth Controller -->
                            <form class="user" method="post" action="<?= base_url('register/store'); ?>">
                                <?= csrf_field(); ?>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Full Name" value="<?= set_value('name'); ?>">
                                    <!-- Display error message for name -->
                                    <?php if(isset($validation) && $validation->hasError('name')): ?>
                                        <small class="text-danger"><?= $validation->getError('name'); ?></small>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
                                    <!-- Display error message for email -->
                                    <?php if(isset($validation) && $validation->hasError('email')): ?>
                                        <small class="text-danger"><?= $validation->getError('email'); ?></small>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        <!-- Display error message for password -->
                                        <?php if(isset($validation) && $validation->hasError('password')): ?>
                                            <small class="text-danger"><?= $validation->getError('password'); ?></small>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="password_confirm" name="password_confirm" placeholder="Repeat Password">
                                        <!-- Display error message for password confirmation -->
                                        <?php if(isset($validation) && $validation->hasError('password_confirm')): ?>
                                            <small class="text-danger"><?= $validation->getError('password_confirm'); ?></small>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?= base_url('login'); ?>">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/js/sb-admin-2.min.js'); ?>"></script>
</body>
</html>