<?= $this->extend('backend/layout/base') ?>
<?= $this->section('content')?>

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Seed Management</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url(route_to('admin.home'))?>" class="home-link">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Seed
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-md-5 mb-4">
        <div class="card card-box">
            <div class="card-header">
                <div class="clearfix">
                    <div class="text-left">
                        Add Seed
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form id="seed_form">
                    <input type="hidden" name="ID" id="ID">
                    <div class="row">
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="hidden" name="typeID" id="typeID">
                                <label>Seed</label>
                                <input type="text" name="seedType" class="form-control" placeholder ="Corn" id="type">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="hidden" name="varietyID" id="varietyID">
                                <label>Seed Type</label>
                                <input type="text" name="seedVariety" class="form-control" placeholder ="Sweet Corn" id="variety">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Price (₱)</label>
                                <input type="text" class="form-control" id="price">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" id="descp"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-danger cancel-fn px-4 py-2 mt-2" id="btnCancel">Cancel</button>
                        <button class="btn btn-primary submit-fn px-4 py-2 mt-2" id="btnAdd">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-9 col-md-7 mb-4">
        <div class="card card-box">
            <div class="card-header">
                <div class="clearfix">
                    <div class="pull-left">
                        Seed
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-borderless table-hover table-stripe">
                        <thead>
                            <tr>
                                <th class="text-left" scope="col">#</th>
                                <th class="text-left" scope="col">Seed</th>
                                <th class="text-left" scope="col">Variety</th>
                                <th class="text-left" scope="col">Description</th>
                                <th class="text-left" scope="col">Price</th>
                                <th class="text-left" scope="col">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

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
        "url": "get-seeds", // Replace with the actual path to your server-side script
        "type": "POST",
        "dataSrc": ""
    },
    "columns": [{
        "data": null,
            "render": function(data, type, row, meta) {
                return meta.row + 1;
            }
        },
        {
            "data": "Type"
        },
        {
            "data": "Variety"
        },
        {
            "data": "Description",
            "render": function(data, type, row) {
                // Set the maximum length for description
                var maxLength = 50; // Change this to your desired maximum length
                if (data.length > maxLength) {
                    return data.substr(0, maxLength) + '...';
                } else {
                    return data;
                }
            }
        },
        {
            "data": {"formatted_price": "Price"},
            "render": function(data, type, row) {
                if(data['Price'] >= 2000){
                    return '<i class="icon-copy fa fa-long-arrow-up text-success"></i> '+ data['formatted_price']; 
                }else{
                    return '<i class="icon-copy fa fa-long-arrow-down text-danger"></i> '+ data['formatted_price']; 
                }
            }
        },
        {
            "data": "seedID",
            "render": function(data, type, row) {
                var url = "<?= route_to('view-seed'); ?>?id=" + btoa(data);
                return '<div class="dropdown"> <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" data-color="#1b3133" href="#" role="button" data-toggle="dropdown"> <i class="dw dw-more"></i> </a> <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"> <a class="dropdown-item viewSeedBtn" id="' +
                    data +
                    '" href= "'+url+'"><i class="dw dw-eye"></i> View</a> <button class="dropdown-item editSeedBtn" data-id="' +
                    data +
                    '"><i class="dw dw-edit2"></i> Edit</button> <button class="dropdown-item delSeedBtn" data-id="' +
                    data + '"><i class="dw dw-delete-3"></i> Delete</button> </div> </div>';
            }
        }
    ],
    rowCallback: function(row, data, index) {
        $(row).find("td").addClass('text-left');
    }
});


$(document).ready(function() {
    // Hide the Cancel button initially
    $('#btnCancel').hide();

    // Add click event listener to the button that shows the Cancel button
    $('.editSeedBtn').on('click', function() {
        // Show the Cancel button
        $('#btnCancel').show();
    });

    // Add click event listener to the Cancel button
    $('#btnCancel').on('click', function() {
        // Handle the click event here
        // For demonstration, let's just log a message to the console
        $('#ID').val("");
        $('#type').val("");
        $('#variety').val("");
        $('#price').val("");
        $('#descp').val("");
        $('#btnAdd').text('Add');
        $('#btnCancel').hide();
    });
});

$(document).on('click', '.editSeedBtn', function(e) {
    e.preventDefault();
    var seedID = $(this).data("id");
    $.ajax({
        url: 'get-seed',
        type: 'POST',
        dataType: 'json',
        data: { 
            ID: seedID,
            where: 's.seedID'
        },
        success: function(resp) {
            var resp = resp[0];
            $('#ID').val(resp.ID);
            $('#type').val(resp.Type);
            $('#variety').val(resp.Variety);
            $('#price').val(resp.Price);
            $('#descp').val(resp.Description);
            $('#btnAdd').text('Update');
            $('#btnCancel').show();
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});

// $(document).on('click', '.viewSeedBtn', function(e) {
//     e.preventDefault();
//     var field_id = $(this).data("id");
//     console.log(field_id);
//     var modal = $('body').find('div#uni-modal');
//     var modal_title = "Field ID";
//     var modal_btn_text = "";
//     var modal_body =
//         '<input type="hidden" name="<?= csrf_token()?>" value="<?= csrf_hash() ?>" class="ci_csrf_data"> <div class="form-group row"> <div class="col-sm-12 col-md-6"> <label for="" class="col-form-label">Seed</label> <div class="col-sm-12 col-md-12"> <select class="custom-select col-12"> <option selected="">Choose...</option> <option value="1">One</option> <option value="2">Two</option> <option value="3">Three</option> </select> </div> </div> <div class="col-sm-12 col-md-6"> <label for="" class="col-form-label">Seed Type</label> <div class="col-sm-12 col-md-12"> <select class="custom-select col-12"> <option selected="">Choose...</option> <option value="1">One</option> <option value="2">Two</option> <option value="3">Three</option> </select> </div> </div> <div class="col-sm-12 col-md-12"> <label for="" class="my-2">Area</label> <div class="col-sm-12 col-md-12"> <select class="custom-select col-12"> <option selected="">Choose...</option> <option value="1">One</option> <option value="2">Two</option> <option value="3">Three</option> </select> </div> </div> </div>';
//     modal.find('.modal-title').html(modal_title);
//     modal.find('.modal-body').html(modal_body);
//     modal.find('.modal-footer').hide();
//     modal.find('input.error-text').html('');
//     modal.find('input[type="text"]').val('');
//     modal.modal('show');
// });

$(document).on('click', '.delSeedBtn', function(e) {
    e.preventDefault();
    var seedID = $(this).data("id");
    swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
        function() {
            $.ajax({
                url: 'delete-seed',
                type: 'POST',
                dataType: 'json',
                data: {
                    ID: seedID
                },
                success: function(resp) {
                    if (resp.success) {
                        $('#seed_form')[0].reset();
                        $('.table').DataTable().ajax.reload();
                        swal("Deleted!", "Record has been deleted.", "success");
                    } else {
                        // Handle failure
                        swal("Failed!", "Failed to delete" + resp.ID + "!", "error");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

});

// $('#modal_form').on('submit', function(e) {
//     e.preventDefault();
//     var csrfName = $('.ci_csrf_data').attr('name');
//     var csrfHash = $('.ci_csrf_data').val();
//     var form = this;
//     var modal = $('body').find('div#uni-modal');
//     var formdata = new FormData(form);
//     formdata.append(csrfName, csrfHash);
//     $.ajax({
//         url: $(form).attr('action'),
//         method: $(form).attr('method'),
//         data: formdata,
//         processData: false,
//         dataType: 'json',
//         contentType: false,
//         cache: false,
//         beforeSend: function() {
//             toastr.remove();
//             $(form).find('span.error-text').text('');
//         },
//         success: function(response) {
//             $('.ci_csrf_data').val(response.token);

//             if ($.isEmptyObject(response.error)) {
//                 if (response.status == 1) {
//                     $(form)[0].reset();
//                     modal.modal('hide');
//                     toastr.success(response.msg);
//                 } else {
//                     toastr.error(response.msg);

//                 }
//             } else {
//                 $.each(response.error, function(prefix, val) {
//                     $(form).find('span.' + prefix + '_error').text(val);
//                 });
//             }
//         }
//     });
// });

</script>
<?= $this->endSection() ?>