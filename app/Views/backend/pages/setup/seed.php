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
                    <input type="hidden" name="seed_ID" id="seed_ID">
                    <div class="row">
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="hidden" name="typeID" id="typeID">
                                <label>Seed</label>
                                <input type="text" name="seedType" class="form-control" placeholder ="Corn" id="type">
                                <span class="text-danger error-text seedType_error"></span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="hidden" name="varietyID" id="varietyID">
                                <label>Seed Type</label>
                                <input type="text" name="seedVariety" class="form-control" placeholder ="Sweet Corn" id="variety">
                                <span class="text-danger error-text seedVariety_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Price (₱)</label>
                                <div class="input-group m-0 p-0">
                                    <div class="input-group-prepend" >
                                        <span class="input-group-text" style="border: 1px solid lightgray;">₱</span>
                                    </div>
                                    <input type="number" name="price" class="form-control" id="price" value = 0 step="any">
                                </div>
                                <span class="text-danger error-text price_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="descp" id="descp"></textarea>
                                <span class="text-danger error-text descp_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-danger cancel-fn px-4 py-2 mt-2" id="btnCancel">Cancel</button>
                        <button type="submit" class="btn btn-primary submit-fn px-4 py-2 mt-2" id="btnAdd">Add</button>
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
    paging: true, // Enable paging
    searching: true,
    lengthMenu: [5,10,15,20],
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
            "data": {"Current_Price" : "CPrice",
                    "Previous_Price" : "PPrice",
                    "FCurrent_Price" : "FCPrice"},
            "render": function(data, type, row) {
                if(data['Previous_Price'] == null || data['Current_Price'] == data['Previous_Price']) {
                    return data['FCurrent_Price'];
                } else if(data['Current_Price'] > data['Previous_Price']) {
                    return '<i class="icon-copy fa fa-long-arrow-up text-danger"></i> '+ data['FCurrent_Price'];
                } else {
                    return '<i class="icon-copy fa fa-long-arrow-down text-success"></i> '+ data['FCurrent_Price'];
                }
            }
        },
        {
            "data": "Seed_ID",
            "render": function(data, type, row) {
                return '<div class="dropdown"> <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" data-color="#1b3133" href="#" role="button" data-toggle="dropdown"> <i class="dw dw-more"></i> </a> <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"> <button class="dropdown-item editSeedBtn" data-id="' +
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

function clearErrorOnInputChange(elementID, errorClass) {
    $(elementID).on("input", function() {
        var opt = $(this).val();
        
        if (opt.trim() !== '') {
            $('#seed_form').find(errorClass).text('');
        } 
    });
}

clearErrorOnInputChange("#type", 'span.seedType_error');
clearErrorOnInputChange("#variety", 'span.seedVariety_error');
clearErrorOnInputChange("#price", 'span.price_error');
clearErrorOnInputChange("#descp", 'span.descp_error');

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
        $('#seed_form')[0].reset();
        $('#seed_ID').val("");
        $('#btnAdd').text('Add');
        $('#btnCancel').hide();
    });

    $('#price').on('input', function() {
        var price = $('#price').val();
        if(price < 0){
            $('#price').val('0')
        }
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
            where: 'Seed_ID'
        },
        success: function(resp) {
            var resp = resp[0];
            $('#seed_ID').val(resp.Seed_ID);
            $('#type').val(resp.Type);
            $('#variety').val(resp.Variety);
            $('#price').val(resp.Current_Price);
            $('#descp').val(resp.Description);
            $('#btnAdd').text('Update');
            $('#btnCancel').show();
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});

    $('#seed_form').on('submit', function(e) {
        e.preventDefault();
        var form = this;
        var formData = new FormData(form);

        var type = $("#type").val();
        var variety = $("#variety").val();
        var price = $("#price").val();
        var descp = $("#descp").val();
        var seed_ID;

        // if($('#seed_ID').val() == '') {
        //     seed_ID = null;
        // } else {
        //     seed_ID = $('#seed_ID').val();
        // }

        formData.append('type', type);
        formData.append('variety', variety);
        formData.append('price', price);
        formData.append('descp', descp);
        // formData.append('seed_ID', seed_ID);

        $.ajax({
            url: 'modify-seed',
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
                    if($('#btnAdd').text() == "Add") {
                        swal("Added", "Seed successfully added!", "success")
                    } else {
                        swal("Updated", "Seed successfully updated!", "success")
                    }
                    $('#seed_form')[0].reset();
                    $('#seed_ID').val('');
                    $('#btnAdd').text('Add');
                    $('#btnCancel').hide();
                    $('.table').DataTable().ajax.reload();
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
                        $('#seed_ID').val("");
                        $('.table').DataTable().ajax.reload();
                        swal("Deleted!", "Record has been deleted.", "success");
                    } else {
                        // Handle failure
                        swal("Failed!", "Failed to delete" + resp.Seed_ID + "!", "error");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

});
</script>
<?= $this->endSection() ?>