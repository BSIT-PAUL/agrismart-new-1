<?= $this->extend('backend/layout/base') ?>
<?= $this->section('content')?>

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Sales Tracking</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= route_to('admin.home')?>" class="home-link">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Sales
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card card-box">
            <div class="card-header">
                <div class="clearfix">
                    <div class="pull-left">
                        Add Transaction
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form id="sales_form">
                    <input type="hidden" id="cropID">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Address</label>
                                <select name="address" class="custom-select" id="address">
                                    <option value="0" selected>Select Address</option>
                                    <?php foreach ($address as $row): ?>
                                    <option value="<?= $row['fieldID'] ?>"><?= $row['address'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="text-danger error-text address_error"></span>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Field</label>
                                <select name="field" class="custom-select" id="field">
                                    <option value="0" selected>Select Field</option>
                                </select>
                                <span class="text-danger error-text field_error"></span>
                            </div>
                        </div>
                        
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Area</label>
                                <select name="area" class="custom-select" id="area">
                                    <option value="0" selected>Select Area</option>
                                </select>
                                <span class="text-danger error-text area_error"></span>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Crop</label>
                                <input type="text" name='crop' class="form-control" placeholder ="Crop" id='crop' disabled>
                            </div>
                        </div>
                        <!-- <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Volume (kg)</label>
                                <input type="number" name="vol" class="form-control" step="any" id="vol">
                                <span class="text-danger error-text vol_error"></span>
                            </div>
                        </div> -->
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Amount</label>
                                <div class="input-group m-0 p-0">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="border: 1px solid lightgray;">₱</span>
                                    </div>
                                    <input type="number" name="amount" class="form-control border-left-0 px-0" value="0" id="amount" step="any">
                                </div>
                                <span class="text-danger error-text amount_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary submit-fn px-4 py-2 mt-2">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-9 mb-4">
        <div class="card card-box">
            <div class="card-header">
                <div class="clearfix">
                    <div class="pull-left">
                        Sales
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-borderless table-hover table-stripe">
                        <thead>
                            <tr>
                                <th class="text-center align-content-center" scope="col">#</th>
                                <th class="text-center align-content-center" scope="col">Address</th>
                                <th class="text-center align-content-center" scope="col">Area</th>
                                <th class="text-center align-content-center" scope="col">Crop</th>
                                <th class="text-center align-content-center" scope="col">Sales</th>
                                <th class="text-center align-content-center" scope="col">Transaction Date</th>
                                <th class="text-center align-content-center" scope="col">Action</th>
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

function clearErrorOnInputChange(elementID, errorClass) {
    $(elementID).on("change", function() {
        var opt = $(this).find("option:selected").val();
        if (opt !== "0") {
            $('#sales_form').find(errorClass).text('');
        } 
    });
}

function clearErrorOnInput(elementID, errorClass) {
    $(elementID).on("input", function() {
        var opt = $(this).val();
        if (opt.trim() != '') {
            $('#sales_form').find(errorClass).text('');
        } 
    });
}

$(document).ready(function () {
    $('#amount').on('input', function() {
        var price = $('#amount').val();
        if(price < 0){
            $('#amount').val('0')
        }
    });
});
// clearErrorOnInput('#vol', 'span.vol_error');
clearErrorOnInput('#amount', 'span.amount_error');
clearErrorOnInputChange("#address", 'span.address_error');
clearErrorOnInputChange("#field", 'span.field_error');
clearErrorOnInputChange("#area", 'span.area_error');

$("#address").on("change", function() {
    // var address = this.value;
    var address = $(this).find("option:selected").text();
    if (address != 0) {
        
        $.ajax({
            url: 'get-field',
            type: 'POST',
            dataType: 'json',
            data: { 
                ID: address,
                where: 'address'
            },
            success: function(result) {
                let data = "<option value='0' selected>Select Field</option>";
                data += result;
                document.querySelector("#field").innerHTML = data;
            }
        });
    } else {
        let type = "<option value='0' selected>Select Field</option>";
        document.querySelector("#field").innerHTML = type;
    }

});

$("#field").on("change", function() {
    var field = this.value;
    if (field != 0) {
        $.ajax({
            url: 'get-area',
            type: 'POST',
            dataType: 'json',
            data: { 
                ID: field,
                where: 'fieldID',
                tab: 'supp'
            },
            success: function(result) {
                // console.log(result);
                let data = "<option value='0' selected>Select Area</option>";
                data += result;
                document.querySelector("#area").innerHTML = data;
                $("#crop").val('');
                $("#cropID").val('');
            }
        });
    } else {
        let type = "<option value='0' selected>Select Area</option>";
        document.querySelector("#area").innerHTML = type;
        $("#crop").val('');
        $("#cropID").val('');
    }

});

$("#area").on("change", function() {
    var area = this.value;
    // console.log(area);
    if (area != 0) {
        $.ajax({
            url: 'get-crops',
            type: 'POST',
            dataType: 'json',
            data: { 
                ID: area
            },
            success: function(resp) {
                var resp = resp[0];
                // console.log(resp);
                $("#crop").val(resp.seedType);
                $("#cropID").val(resp.Crop_ID);
                
            }
        });
    } else {
        $("#crop").val('');
        $("#cropID").val('');
    }

});

$('.table').DataTable({
    scrollCollapse: true,
    autoWidth: false,
    responsive: true,
    paging: true, // Enable paging
    pageLength: 7,
    searching: true,
    lengthMenu: [5,10,15,20],
    columnDefs: [{
        targets: "datatable-nosort",
        orderable: false,
    }],
    "ajax": {
        "url": "get-sales",// Replace with the actual path to your server-side script
        "type": "POST",
        "dataSrc": ""
    },
    "columns": [
        {
            "data": null,
            "render": function(data, type, row, meta) {
                return meta.row + 1;
            }
        },
        {
            "data": "address"
        },
        {
            "data": "Area"
        },
        {
            "data": "CropName"
        },
        {
            "data": "FormattedAmount"
        },
        {
            "data": "formatted_dateCreated"
        },
        {
            "data": "MarketID",
            "render": function(data, type, row) {
                return '<div class="dropdown"> <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" data-color="#1b3133" href="#" role="button" data-toggle="dropdown"> <i class="dw dw-more"></i> </a> <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"> <button class="dropdown-item delSalesBtn" data-id="' +
                    data + '"><i class="dw dw-delete-3"></i> Delete</button> </div> </div>';
            }
        }
    ],
    rowCallback: function(row, data, index) {
        $(row).find("td").addClass('text-left');
    }
});

$('#sales_form').on('submit', function(e) {
    e.preventDefault();
    var cropID  = $('#cropID').val();
    var form = this;
    var formData = new FormData(form);
    formData.append('cropID', cropID);

    $.ajax({
        url: 'modify-sales',
        type: 'POST',
        data: formData,
        processData: false,
        dataType: 'json',
        contentType: false, 
        beforeSend:function(){
            $(form).find('span.error-text').text('');
        },
        success: function(resp) {
            // console.log(resp);
            if ($.isEmptyObject(resp.error)) {
                if(resp.status == 1){
                    swal('Added', 'Sales added successfuly', "success");
                }else{
                    swal("Failed!", "Error occur", "error");
                }
                $('#sales_form')[0].reset();
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

$(document).on('click', '.delSalesBtn', function(e) {
    e.preventDefault();
    var ID = $(this).data("id");
    console.log(ID)
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
                url: 'delete-sales',
                type: 'POST',
                dataType: 'json',
                data: {
                    ID: ID
                },
                success: function(resp) {
                    if (resp.success) {
                        // $('#crop_form')[0].reset();
                        $('.table').DataTable().ajax.reload();
                        swal("Deleted!", "Sales record has been deleted.", "success");
                    } else {
                        swal("Failed!", "Sales record failed to delete!", "error");
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