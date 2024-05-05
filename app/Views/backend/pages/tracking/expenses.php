<?= $this->extend('backend/layout/base') ?>
<?= $this->section('content')?>

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Expenses Tracking</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= route_to('admin.home')?>">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Expenses
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card card-box">
            <div class="card-header">
                <div class="clearfix">
                    <div class="pull-left">
                    Expenses
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-borderless table-hover table-stripe">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">#</th>
                                <th class="text-center" scope="col">Crop</th>
                                <th class="text-center" scope="col">Expenses</th>
                                <th class="text-center" scope="col">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('stylesheets') ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
$('.table').DataTable({
    scrollCollapse: true,
    autoWidth: false,
    responsive: true,
    columnDefs: [{
        targets: "datatable-nosort",
        orderable: false,
    }]
});

// $('#add_field_form').on('submit', function(e){
//     e.preventDefault();
//     var csrfName = $('.ci_csrf_data').attr('name');
//     var csrfHash = $('.ci_csrf_data').val();
//     var form = this;
//     var modal = $('body').find('div#field-modal');
//     var formdata = new FormData(form);
//         formdata.append(csrfName, csrfHash);
//     $.ajax({
//         url:$(form).attr('action'),
//         method:$(form).attr('method'),
//         processData: false,
//         dataType:'json',
//         contentType:false,
//         cache:false,
//         beforeSend:function(){
//             toastr.remove();
//             $(form).find('span.error-text').text('');
//         },
//         success:function(response){
//             $('.ci_csrf_data').val(response.token);
//             if ($.isEmptyObject(response.error)){
//                 if(response.status == 1){
//                     $(form)[0].reset();
//                     modal.modal('hide');
//                     alert('nyaa')
//                     toastr.success(response.msg);
//                 }else{
//                     toastr.error(response.msg);
//                 }
//             }else{
//                 $.each(response.error, function(prefix,val){
//                     $(form).find('span.'+prefix+'_error').text(val);
//                 });
//             }
//         }
//     });
// });

</script>
<?= $this->endSection() ?>