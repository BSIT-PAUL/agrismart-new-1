<?= $this->extend('backend/layout/main') ?>
<?= $this->section('content')?>
<div class="login-box box-shadow border-radius-10">
    <div class="login-title">
        <h2 class="text-center">Login</h2>
    </div>
    <?php $validation = \Config\Services::validation();?>
    <form action="<?= base_url(route_to('admin.login.handler')) ?>" method="POST">
        <?= csrf_field()?>
        <?php if(!empty(session()->getFlashdata('success'))):?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success');?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif; ?>
        <?php if(!empty(session()->getFlashdata('fail'))):?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('fail');?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif; ?>
        <div class="input-group custom">
            <input type="text" class="form-control form-control-lg" placeholder="Username" name="username"
                value="<?= set_value('username')?>">
            <div class="input-group-append custom">
                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
            </div>
        </div>
        <?php if($validation->getError('username')):?>
        <div class="d-block text-danger" style="margin-top:-25px; margin-bottom: 15px;">
            <?= $validation->getError('username')?>
        </div>
        <?php endif; ?>
        <div class="input-group custom">
            <input type="password" class="form-control form-control-lg" placeholder="**********" name="password"
                value="<?= set_value('password')?>" id="password">
            <div class="input-group-append custom">
                <button class="btn input-group-text" type="button" id="togglePassword">
                   <i class="icon-copy dw dw-eye"></i>
                </button>
            </div>
        </div>
        <?php if($validation->getError('password')):?>
        <div class="d-block text-danger" style="margin-top:-25px; margin-bottom: 15px;">
            <?= $validation->getError('password')?>
        </div>
        <?php endif; ?>

        <div class="text-right mb-4">
            <div class="forgot-password">
                <a href="<?= route_to('admin.forgot.form') ?>">Forgot Password</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="input-group mb-4 btn-form">
                    <input class="btn btn-lg btn-block btn-success" type="submit" value="Sign In">
                </div>
                <div class="text-center  mb-0 font-weight-light register">
                    Don't have an account?
                    <a class="pl-1" href="<?= route_to('register') ?>">Register</a>
                </div>
            </div>
        </div>
    </form>
</div>


<?= $this->endSection() ?>

<?= $this->section('scripts')?>
<script>
    $(document).ready(function() {
        $('#togglePassword').click(function() {
            var passwordField = $('#password');
            var passwordFieldType = passwordField.attr('type');
            if (passwordFieldType === 'password') {
                passwordField.attr('type', 'text');
                $('#togglePassword i').removeClass('dw dw-eye').addClass('bi bi-eye-slash');
            } else {
                passwordField.attr('type', 'password');
                $('#togglePassword i').removeClass('bi bi-eye-slash').addClass('dw dw-eye');
            }
        });
    });
</script>

<?= $this->endSection() ?>