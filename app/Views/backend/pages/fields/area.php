<?= $this->extend('backend/layout/base') ?>
<?= $this->section('content')?>

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Area Management</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url(route_to('admin.home'))?>" class="home-link">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Area
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
                        Add Area
                    </div>

                </div>
            </div>
            <div class="card-body ">
                <form id="area_form">
                    <div class="row">
                        <input type="hidden" id="ID">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Address</label>
                                <select name="address" class="custom-select" id="address">
                                    <option value= 0 selected>Select Address</option>
                                    <?php foreach ($address as $row): ?>
                                    <option value="<?= $row['fieldID']?>"><?= $row['address'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                    
                                <span class="text-danger error-text address_error"></span>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Field</label>
                                <select name="field" class="custom-select" id="field_ID">
                                    <option value=0 selected>Select Field</option>
                                </select>
                                <span class="text-danger error-text field_error"></span>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Lot Area (m<sup>2</sup>)</label>
                                <input type="text" class="form-control" name="lotArea" id="lotArea" value=0>
                                <span class="text-danger error-text lotArea_error"></span>
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
    <div class="col-md-9 mb-4">
        <div class="card card-box">
            <div class="card-header">
                <div class="clearfix">
                    <div class="pull-left">
                        Area
                    </div>
                </div>
            </div>
            <div class="card-body ">
                <div class="table-responsive">
                    <table class="table table-sm table-borderless table-hover table-stripe" id="areaTable">
                        <thead>
                            <tr>
                                <th class="text-left" scope="col">#</th>
                                <th class="text-left" scope="col">Field</th>
                                <th class="text-left" scope="col">Area</th>
                                <th class="text-left" scope="col">Address</th>
                                <th class="text-left" scope="col">Lot Area (m<sup>2</sup>)</th>
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
$(document).ready(function() {
    // Hide the Cancel button initially
    $('#btnCancel').hide();

    // Add click event listener to the Cancel button
    $('#btnCancel').on('click', function() {
        // Handle the click event here
        // For demonstration, let's just log a message to the console
        $('#ID').val("");
        $('#field_ID').val(0);

        $('#field_ID').prop('disabled', false);
        $('#address').prop('disabled', false);
        
        $('#address').val(0);
        $('#lotArea').val(0);
        $('#btnAdd').text('Add');
        $('#btnCancel').hide();
    });
});

$("#address").on("change", function() {
    var address = $(this).find("option:selected").text();
    if (address != 'Select Address') { // Check if a valid address is selected
            getField(address, function() {
        });
    } else {
        // Reset #field_ID options if 'Select Address' is chosen
        let type = "<option value='0' selected>Select Field</option>";
        $("#field_ID").html(type);
    }
});

function getField(address, callback) {
    $.ajax({
        url: 'get-field',
        type: 'POST',
        dataType: 'json',
        data: {
            ID: address,
            where: 'address'
        },
        success: function(result) {
            let data = "<option value='0'>Select Field</option>";
            data += result;
            $("#field_ID").html(data); // Set the options for #field_ID

            // Call the callback function after options are populated
            if (typeof callback === 'function') {
                callback();
            }
        }
    });
}


function clearErrorOnInputChange(elementID, errorClass) {
    $(elementID).on("change", function() {
        var opt = $(this).find("option:selected").val();
        if (opt !== "0") {
            $('#area_form').find(errorClass).text('');
        } 
    });
}

clearErrorOnInputChange("#field_ID", 'span.field_error');
clearErrorOnInputChange("#address", 'span.address_error');
clearErrorOnInputChange("#lotArea", 'span.lotArea_error');


$(document).on('click', '.editAreaBtn', function(e) {
    e.preventDefault();
    var areaID = $(this).data("id");

    console.log(areaID);
    $.ajax({
        url: 'get-area',
        type: 'POST',
        dataType: 'json',
        data: {
            ID: areaID,
            where: "Area_ID"
        },
        success: function(resp) {
            var resp = resp[0];
            getField(resp.address, function() {
                // Callback function to set values after options are populated
                console.log(resp);
                $('#ID').val(resp.Area_ID);
                var addressValue = resp.address; // Assuming resp.address contains the value of the option to be selected

                // Find the option with the value equal to addressValue
                var optionToSelect = $('#address').find('option').filter(function() {
                    return $(this).text().trim() === addressValue;
                });

                if (optionToSelect.length) {
                    // Set the selected attribute for the found option
                    optionToSelect.prop('selected', true);
                }

                $('#field_ID').val(resp.fieldID);

                $('#address').prop('disabled', true);
                $('#field_ID').prop('disabled', true);
                $('#lotArea').val(resp.Lot_Area);
                $('#btnAdd').text('Update');
                $('#btnCancel').show();
            });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});

$(document).on('click', '.delAreaBtn', function(e) {
    e.preventDefault();
    var ID = $(this).data("id");
    swal({
            title: "Are you sure?",
            text: "You will not be able to recover this record!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
        function() {
            $.ajax({
                url: 'delete-area',
                type: 'POST',
                dataType: 'json',
                data: {
                    ID: ID
                },
                success: function(resp) {
                    if (resp.success) {
                        $('#area_form')[0].reset();
                        $('.table').DataTable().ajax.reload();
                        swal("Deleted!", "Record has been deleted.", "success");
                    } else {
                        swal("Failed!", "Failed to delete" + resp.ID + "!", "error");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
});

$('#areaTable').DataTable({
    scrollCollapse: true,
    autoWidth: false,
    responsive: true,
    paging: true, // Enable paging
    // pageLength: 5,
    searching: true,
    lengthMenu: [5,10,15,20],
    columnDefs: [{
        targets: "datatable-nosort",
        orderable: false,
    }],
    "ajax": {
        "url": "get-areas", // Replace with the actual path to your server-side script
        "type": "POST",
        "dataSrc": "",

    },
    "columns": [
        {
            "data": null,
            "render": function(data, type, row, meta) {
                return meta.row + 1;
            }
        },
        {
            "data": "Field"
        },
        {
            "data": "Area"
        },
        {
            "data": "address"
        },
        {
            "data": "formatted_LotArea"
        },
        {
            "data": "Area_ID",
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

$('#area_form').on('submit', function(e) {
    e.preventDefault();
    var ID  = $('#ID').val();
    var field  = $('#field_ID').val();
    var address  = $('#address').val();
    var form = this;
    var formData = new FormData(form);
    formData.append('address', address);
    formData.append('field', field);
    formData.append('areaID', ID);
    

    var msg, action;
    if (ID == "") {
        action = 'Added';
        msg = "New area added successfuly";
    } else {
        action = 'Updated';
        msg = "Area updated successfuly";
    }
    $.ajax({
        url: 'modify-area',
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
                    swal(action, msg, "success");
                }else{
                    swal("Failed!", "Error occur", "error");
                }
                $('#area_form')[0].reset();
                $('#areaTable').DataTable().ajax.reload();
                $('#btnAdd').text('Add');
                $('#btnCancel').hide();
                $('#ID').val('');
                $('#field_ID').prop('disabled', false);
                $('#address').prop('disabled', false);
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

$(document).on('click','.viewAreaBtn', function(e){
    e.preventDefault();
    var ID = $(this).data("id");
    var modal = $('body').find('div#uni-modal');

    console.log(ID);
    $.ajax({
        url: 'get-area',
        method: 'POST',
        data: {
            ID: ID
        },
        success: function(res) {
            var resp = JSON.parse(res);
            console.log(resp);
            var cropID = resp[0].cropID;
            var areaID = resp[0].Area_ID;
            modal.find('.modal-title').html("Area " + resp[0].Area);
            $("#field").text(resp[0].Field);
            $("#viewAddress").text(resp[0].address);
            $("#viewLotArea").text(resp[0].formatted_LotArea);
            $("#crop").text(resp[0].crop);

            $('#viewTable').DataTable().destroy(); 

            $('#viewTable').DataTable({
                scrollCollapse: true,
                autoWidth: false,
                responsive: true,
                paging: false,
                searching: false,
                pageLength: 5,
                lengthChange: false,
                columnDefs: [{
                    targets: "datatable-nosort",
                    orderable: false,
                    }],
                "ajax": {
                    "url": "get-Area-expenses", // Replace with the actual path to your server-side script
                    "type": "POST",
                    "data": {
                        // "areaID": areaID,
                        "cropID": cropID
                    },
                    "dataSrc": ""
                },
                "columns": [{
                        "data": null,
                        "render": function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        "data": "type"
                    },
                    {
                        "data": "item"
                    },
                    {
                        "data": "Formatted_totAmount"
                    }
                ],
                rowCallback: function(row, data, index) {
                    $(row).find("td").addClass('text-left');
                },
                "drawCallback": function(settings) {
                        // Calculate the sum of all lot areas
                    var totExpenses = 0;
                    $('#viewTable').DataTable().data().each(function(data) {
                        totExpenses += parseFloat(data.totAmount);
                    });

                    $('#expenses').html('₱ ' + totExpenses.toLocaleString('en-US', {maximumFractionDigits: 2}));
                }
            });
        }
    });

    modal.find('.modal-footer').hide();
    modal.modal('show');
});
</script>
<?= $this->endSection() ?>

<?= $this->section('modal_content') ?>
<style>
    .form-group label{
            font-weight: 600;
        }
</style>
<div class="row">
    <!-- <input type="hidden" id="areaID"> -->
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="form-group">
                    <label class="fw-600" for="">Field</label>
                    <p class="pl-10" id="field"></p>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="form-group">
                    <label> Address</label>
                    <p class="pl-10" id="viewAddress"></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="form-group">
                    <label class="fw-600" for="">Lot Area</label>
                    <p class="pl-10" id="viewLotArea"></p>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="form-group">
                    <label class="fw-600" for="">Crop</label>
                    <p class="pl-10" id="crop"></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="fw-600" for="">Total Expenses</label>
                    <p class="pl-10" id="expenses"></p>
                </div>
            </div>
        </div>
        
    </div>
    <div class="col-md-12">
        <h6>Expenses</h6>
        <table class="table table-sm table-borderless table-hover table-stripe" id="viewTable">
            <thead>
                <tr>
                    <th class="text-left" scope="col">#</th>
                    <th class="text-left" scope="col">Type</th>
                    <th class="text-left" scope="col">Item</th>
                    <th class="text-left" scope="col">Amount</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<?= $this->endSection() ?>