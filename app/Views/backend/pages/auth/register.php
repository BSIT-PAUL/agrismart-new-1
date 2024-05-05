<?= $this->extend('backend/layout/main') ?>
<?= $this->section('content')?>
<div class="login-box box-shadow border-radius-10">
    <div class="login-title">
        <h2 class="text-center">Register</h2>
    </div>
    <form method="POST" id="register_form">
        <div class="row mb-0">
            <div class="col-xl-6">
                <div class="input-group custom m-0 mb-3">
                    <input type="text" class="form-control form-control-lg" placeholder="First Name" name="firstname" id="firstname" autocomplete="off">
                </div>
                <span class="text-danger error-text firstname_error"></span>
            </div>
            <div class="col-xl-6">
                <div class="input-group custom m-0">
                    <input type="text" class="form-control form-control-lg" placeholder="Last Name" name="lastname" id="lastname" autocomplete="off">
                </div>
                <span class="text-danger error-text lastname_error"></span>
            </div>
        </div>

        <div class="input-group custom m-0 mt-3">
            <input type="text" class="form-control form-control-lg" placeholder="Email" name="email" id="email" autocomplete="off">
            <div class="input-group-append custom">
                <span class="input-group-text"><i class="icon-copy dw dw-email1"></i></span>
            </div>
        </div>
        <span class="text-danger error-text email_error "></span>

        <div class="input-group custom mt-3 m-0">
            <input type="text" class="form-control form-control-lg" placeholder="Contact" name="contact" id="contact" autocomplete="off">
            <div class="input-group-append custom">
                <span class="input-group-text"><i class="icon-copy dw dw-phone-call"></i></span>
            </div>
        </div>
        <span class="text-danger error-text contact_error"></span>

        <div class="input-group custom m-0 mt-3">
            <input type="text" class="form-control form-control-lg" placeholder="Username" name="username" id="username" autocomplete="off">
            <div class="input-group-append custom">
                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
            </div>
        </div>
        <span class="text-danger error-text username_error"></span>

        <div class="input-group custom m-0 mt-3">
            <input type="password" class="form-control form-control-lg" placeholder="**********" name="password" id="password" autocomplete="off">
            <div class="input-group-append custom">
                <button class="btn input-group-text" type="button" id="togglePassword">
                   <i class="icon-copy dw dw-eye"></i>
                </button>
            </div>
        </div>
        <span class="text-danger error-text password_error"></span>

        <div class="row pt-3">
            <div class="col-sm-12">
                <div class="input-group mb-4 btn-form">
                    <input class="btn btn-lg btn-block btn-success " type="submit" value="Sign In">
                </div>
                <div class="text-center  mb-0 font-weight-light register">
                    Already have an account?
                    <a class="pl-1" href="<?= route_to('admin.login.form') ?>">Log In</a>
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

    $('#register_form').on('submit', function(e) {
        e.preventDefault();
        var form = this;
        var formData = new FormData(form);

        // var firstname = $("#firstname").val();
        // var lastname = $("#lastname").val();
        // var email = $("#email").val();
        // var contact = $("#contact").val();
        // var username = $("#username").val();
        // var password = $("#password").val();

        // formData.append('firstname', firstname);
        // formData.append('lastname', lastname);
        // formData.append('email', email);
        // formData.append('contact', contact);
        // formData.append('username', username);
        // formData.append('password', password);

        $.ajax({
            url: 'add_user',
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend:function(){
                $(form).find('span.error-text').text('');
            },
            success: function(resp) {
                if ($.isEmptyObject(resp.error)) {
                    $('#register_form')[0].reset();
                    swal("Success!", "Your account has been created.", "success");
                    setTimeout(function() {
                        window.location.href = '/admin/login';
                    }, 2000);                  
                } else {
                    $.each(resp.error, function(prefix, val){
                        $('span.'+prefix+'_error').text(val);
                    })
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
</script>

<?= $this->endSection() ?>