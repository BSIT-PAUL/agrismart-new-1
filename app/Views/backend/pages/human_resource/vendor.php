<?= $this->extend('backend/layout/base') ?>
<?= $this->section('content')?>

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Vendor Management</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= route_to('admin.home')?>">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Vendor
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card card-box">
            <div class="card-header">
                <div class="clearfix">
                    <div class="pull-left">
                        Add Vendor
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Firstname</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Lastname</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <div class="form-group">
                                <label>Contact</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Rate</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary submit-fn px-4 py-2 mt-2">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8 mb-4">
        <div class="card card-box">
            <div class="card-header">
                <div class="clearfix">
                    <div class="pull-left">
                        Vendor
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-borderless table-hover table-stripe">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">#</th>
                                <th class="text-center" scope="col">Firtsname</th>
                                <th class="text-center" scope="col">Lastname</th>
                                <th class="text-center" scope="col">Contact</th>
                                <th class="text-center" scope="col">Commission Rate</th>
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
    }],
    "ajax": {
        "url": "get-vendors", // Replace with the actual path to your server-side script
        "type": "POST",
        "dataSrc": ""
    },
    "columns": [{"data": null,
            "render": function(data, type, row, meta) {
                return meta.row + 1;
            }
        },
        {
            "data": "First_Name"
        },
        {
            "data": "Last_Name"
        },
        {
            "data": "Contact"
        },
        {
            "data": "Commission_Rate"
        },
        {
            "data": "ID",
            "render": function(data, type, row) {
                return '<div class="dropdown"> <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" data-color="#1b3133" href="#" role="button" data-toggle="dropdown"> <i class="dw dw-more"></i> </a> <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"> <button class="dropdown-item viewAreaBtn" data-id="' +
                    data +
                    '"><i class="dw dw-eye"></i> View</button> <button class="dropdown-item editAreaBtn" data-id="' +
                    data +
                    '"><i class="dw dw-edit2"></i> Edit</button> <button class="dropdown-item delAreaBtn" data-id="' +
                    data + '"><i class="dw dw-delete-3"></i> Delete</button> </div> </div>';
            }
        }
    ],
    rowCallback: function(row, data, index) {
        $(row).find("td").addClass('text-left');
    }
});
// $(document).on('click','#add_field_btn', function(e){
//     e.preventDefault();
//     var modal = $('body').find('div#field-modal');
//     var modal_title = "Add Field";
//     var modal_btn_text = "ADD";
//     modal.find('.modal-title').html(modal_title);
//     modal.find('.modal-footer > button.action').html(modal_btn_text);
//     modal.find('input.error-text').html('');
//     modal.find('input[type="text"]').val('');
//     modal.modal('show');
// });

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

// new DataTable('#example');
// var fields_DT = $('#fields-table').DataTable({
//     scrollCollapse:true,
//     responsive:true,
//     autowidth:false,
//     processing:true,
//     serverSide:true,
//     ajax:"<?= route_to('get-fields')?>",
//     dom:"IBfrtip",
//     info:true,
//     fnCreatedRow:function(row, data, index){
//         $('td',row).eq(0).html(index + 1);
//         // $('td',row).parent().attr('data-index',data[0].attr('data-ordering',data[4]))
//     },
//     columnDefs:[
//         {orderable:false, targets:[0,1,2,3]}
//     ]
// });
</script>
<?= $this->endSection() ?>