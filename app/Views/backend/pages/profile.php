<?= $this->extend('backend/layout/base') ?>
<?= $this->section('content')?>
<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Profile</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url(route_to('admin.home'))?>" class="home-link">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Profile
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
        <div class="pd-20 card-box height-100-p">
            <div class="profile-photo">
                <a href="javascript:;" class="edit-avatar"><i class="fa fa-pencil"></i></a>
                <input type="file" name="user_profile" id="user_profile" class="d-none">
                <img src="<?= get_user()->Profile == null ?  base_url('public/images/users/default-avatar.jpg') : base_url('public/images/users/'.get_user()->Profile )?>" alt="" class="avatar-photo">
            </div>
            <h5 class="text-center h5 mb-0 userName"><?= get_user()->fname == null ?  'null' : get_user()->fname ?></h5>
            <p class="text-center text-muted font-14" id="email"><?= get_user()->Email == null ?  'null' : get_user()->Email ?></p>
        </div>
    </div>
    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
        <div class="card-box height-100-p overflow-hidden">
            <div class="profile-tab height-100-p">
                <div class="tab height-100-p">
                    <ul class="nav nav-tabs customtab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#personal_details" role="tab">Personal Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#change_password" role="tab">Change Password</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <!-- Timeline Tab start -->
                        <div class="tab-pane fade show active" id="personal_details" role="tabpanel">
                            <div class="pd-20">
                                <form action="<?= route_to('update-profile-details')?>" method="POST" id="details_form">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">First Name</label>
                                                <input type="text" name="fname" value="<?= get_user()->First_Name ?>" class="form-control" placeholder="Enter First Name">
                                                <span class="text-danger error-text fname_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Last Name</label>
                                                <input type="text" name="lname" value="<?= get_user()->Last_Name ?>" class="form-control" placeholder="Enter Last Name">
                                                <span class="text-danger error-text lname_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Contact</label>
                                                <input type="text" name="contact" value="<?= get_user()->Contact ?>" class="form-control" placeholder="Enter Last Name">
                                                <span class="text-danger error-text contact_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Email Address</label>
                                                <input type="text" name="email" value="<?= get_user()->Email ?>" class="form-control" placeholder="Enter email address">
                                                <span class="text-danger error-text email_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Timeline Tab End -->
                        <!-- Tasks Tab start -->
                        <div class="tab-pane fade" id="change_password" role="tabpanel">
                            <div class="pd-20 profile-task-wrap">
                                <form action="<?= route_to('change-pass') ?>" method="POST" id="change_pass_form">
                                    <input type="hidden" name="<?= csrf_token()?>" value="<?= csrf_hash()?>" class="ci_csrf_data">
                                    <div class="row">
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Username</label>
                                                <input type="text" class="form-control" placeholder ="Enter Username" value="<?= get_user()->Username ?>" name="username">
                                                <span class="text-danger error-text username_error"></span> 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Current password</label>
                                                <input type="password" class="form-control" placeholder ="Enter current password" name="current_password" data-input="current_password">
                                                <!-- <div class="input-group-append custom pr-2 pt-3">
                                                    <button class="btn input-group-text" type="button" id="current_password" data-input="current_password">
                                                        <i class="icon-copy dw dw-eye"></i>
                                                    </button>
                                                </div> -->
                                                <span class="text-danger error-text current_password_error"></span> 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">New password</label>
                                                <input type="password" class="form-control" placeholder ="Enter new password" name="new_password" data-input="new_password">
                                                <!-- <div class="input-group-append custom pr-2 pt-3">
                                                    <button class="btn input-group-text" type="button" id="new_password">
                                                        <i class="icon-copy dw dw-eye"></i>
                                                    </button>
                                                </div> -->
                                                <span class="text-danger error-text new_password_error"></span> 
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Confirm password</label>
                                                <input type="password" class="form-control" placeholder ="Retype new password" name="confirm_password" data-input="confirm_password">
                                                <!-- <div class="input-group-append custom pr-2 pt-3">
                                                    <button class="btn input-group-text" type="button" id="confirm_password">
                                                        <i class="icon-copy dw dw-eye"></i>
                                                    </button>
                                                </div> -->
                                                <span class="text-danger error-text confirm_password_error"></span> 
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Tasks Tab End -->
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts')?>
<script>
        // Function to toggle password visibility
        // function togglePasswordVisibility(inputId, buttonId) {
        //     var input = $('#' + inputId);
        //     var button = $('#' + buttonId);
            
        //     // Toggle input type between 'password' and 'text'
        //     if (input.attr('type') === 'password') {
        //         input.attr('type', 'text');
        //         button.find('i').removeClass('dw dw-eye').addClass('bi bi-eye-slash');
        //     } else {
        //         input.attr('type', 'password');
        //         button.find('i').removeClass('bi bi-eye-slash').addClass('dw dw-eye');
        //     }
        // }
        
        // // Event handler for clicking on the eye button
        // $('#current_password, #new_password, #confirm_password').on('click', function() {
        //     var inputId = $(this).attr('data-input');
        //     var buttonId = $(this).attr('id');
        //     console.log(inputId + '-' + buttonId)
        //     togglePasswordVisibility(inputId, buttonId);
        // });
        
    $('.edit-avatar').on('click', function(e){
        e.preventDefault();
        $user_profile = $('#user_profile').click();
    });

    $('#user_profile').ijaboCropTool({
          preview : '.avatar-photo',
          setRatio:1,
          allowedExtensions: ['jpg', 'jpeg','png'],
          buttonsText:['Crop','Cancel'],
          buttonsColor:['#30bf7d','#ee5155', -15],
          processUrl: '<?= base_url(route_to('update-avatar')) ?>',
          onSuccess:function(message, element, stats){
            if(stats == 1){
                swal('Success', message, 'success');
            }else{
                swal("Error", message, "error");
            }
          },
          onError:function(message, element, status){
            swal("Error", message, "error");
          }
    });


    $('#details_form').on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: 'update-profile-details',
            method: 'POST',
            data: formData, 
            processData: false,
            dataType: 'json',
            contentType: false, 
            beforeSend:function(){
                toastr.remove();
                $(this).find('span.error-text').text('');
            },
            success: function(resp) {
                if ($.isEmptyObject(resp.error)) {
                    if(resp.status == 1){
                        $('.userName').each(function(){
                            $(this).html(resp.user_info.Last_Name+ ', '+resp.user_info.First_Name);
                        });
                        $('#email').text(resp.user_info.Email);
                        swal("Success", resp.msg, "success");
                    }else{
                        swal("Failed", resp.msg, "error");
                    }
                } else {
                    $.each(resp.error, function(prefix, val){
                        $('span.'+prefix+'_error').text(val);
                    })
                }
            }

        })
    })

    $('#change_pass_form').on('submit', function(e){
        e.preventDefault();
        var csrfName = $('.ci_csrf_data').attr('name');
        var csrfHash = $('.ci_csrf_data').val();
        var form = this;
        var formData = new FormData(form);
            formData.append(csrfName, csrfHash);

        $.ajax({
            url: 'change-pass',
            method: 'POST',
            data: formData, 
            processData: false,
            dataType: 'json',
            contentType: false, 
            beforeSend:function(){
                $('#change_pass_form').find('span.error-text').text('');
            },
            success: function(resp) {
                $(form).val(resp.token);

                if ($.isEmptyObject(resp.error)) {
                    if(resp.status == 1){
                        $(form)[0].reset();
                        // $('.userName').each(function(){
                        //     $(this).html(resp.user_info.Last_Name+ ', '+resp.user_info.First_Name);
                        // });
                        swal("Success", resp.msg, "success");
                    }else{
                        swal("Failed", resp.msg, "error");
                    }
                } else {
                    $.each(resp.error, function(prefix, val){
                        $('span.'+prefix+'_error').text(val);
                    })
                }
            }

        })
    })


</script>
    
<?= $this->endSection() ?>