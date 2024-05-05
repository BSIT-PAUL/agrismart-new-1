<?= $this->extend('backend/layout/base') ?>
<?= $this->section('content')?>

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Water Schedule Management</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url(route_to('admin.home'))?>" class="home-link">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Water Schedule
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
                        Add Schedule
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form id="watering_form">
                    <input type="hidden" id="cropID">
                    <div class="row">
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
                        </div>
                        <div class="row">
                            <div class="col-lg-5 col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label>Area</label>
                                    <select name="area" class="custom-select" id="area">
                                        <option value="0" selected>Select Area</option>
                                    </select>
                                    <span class="text-danger error-text area_error"></span>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-8 col-sm-8">
                                <div class="form-group">
                                    <label>Crop</label>
                                    <input type="text" name='crop' class="form-control" placeholder ="Crop" id='crop' disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Cost</label>
                                <div class="input-group m-0 p-0">
                                    <div class="input-group-prepend" >
                                        <span class="input-group-text" style="border: 1px solid lightgray;" id="sign">₱</span>
                                    </div>
                                    <input type="number" name="cost" class="form-control border-left-0 px-0" id="price" value="0" step="any">
                                </div>
                                <span class="text-danger error-text cost_error"></span>
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
    <div class="col-md-8 mb-4">
        <div class="card card-box">
            <div class="card-header">
                <div class="clearfix">
                    <div class="pull-left">
                        Water Schedule
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-borderless table-hover table-stripe">
                        <thead>
                            <tr>
                                <th class="text-left" scope="col">#</th>
                                <th class="text-left" scope="col">Crop</th>
                                <th class="text-left" scope="col">Area</th>
                                <th class="text-left" scope="col">Field</th>
                                <th class="text-left" scope="col">Cost</th>
                                <th class="text-left" scope="col">Date</th>
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
            url: 'getAreaCrop',
            type: 'POST',
            dataType: 'json',
            data: { 
                ID: field
            },
            success: function(result) {
                // console.log(result);
                let data = "<option value='0' selected>Select Area</option>";
                data += result;
                document.querySelector("#area").innerHTML = data;
                $("#crop").val('');
            }
        });
    } else {
        let type = "<option value='0' selected>Select Area</option>";
        document.querySelector("#area").innerHTML = type;
        $("#crop").val('');
    }

});

$("#area").on("change", function() {
    var area = this.value;
    // console.log(area);
    if (area != 0) {
        $.ajax({
            url: 'get-crop',
            type: 'POST',
            dataType: 'json',
            data: { 
                ID: area
            },
            success: function(resp) {
                var resp = resp[0];
                console.log(resp);
                $("#crop").val(resp.Type + '(' + resp.Variety +')');
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
    columnDefs: [{
        targets: "datatable-nosort",
        orderable: false,
    }],
    "ajax": {
        "url": "get-sched",// Replace with the actual path to your server-side script
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
            "data": "Crop"
        },
        {
            "data": "Area_ID"
        },
        {
            "data": "Field_ID"
        },
        {
            "data": "Formatted_Cost"
        },
        {
            "data": "formatted_Date"
        },
        {
            "data": "ID",
            "render": function(data, type, row) {
                return '<div class="dropdown"> <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" data-color="#1b3133" href="#" role="button" data-toggle="dropdown"> <i class="dw dw-more"></i> </a> <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"> <button class="dropdown-item viewWaterBtn" data-id="' +
                    data +
                    '"><i class="dw dw-eye"></i> View</button> <button class="dropdown-item delWaterBtn" data-id="' +
                    data + '"><i class="dw dw-delete-3"></i> Delete</button> </div> </div>';
                    // <button class="dropdown-item editAreaBtn" data-id="' +
                    // data +
                    // '"><i class="dw dw-edit2"></i> Edit</button>
                     
            }
        }
    ],
    rowCallback: function(row, data, index) {
        $(row).find("td").addClass('text-left');
    }
});

$('#watering_form').on('submit', function(e) {
    e.preventDefault();
    var cropID  = $('#cropID').val();
    var form = this;
    var formData = new FormData(form);
    // formData.append('address', address);
    // formData.append('field', field);
    formData.append('cropID', cropID);
    
    $.ajax({
        url: 'modify-watering',
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
                    swal('Added', 'Watering added successfuly', "success");
                }else{
                    swal("Failed!", "Error occur", "error");
                }
                $('#watering_form')[0].reset();
                $('.table').DataTable().ajax.reload();
                $('#btnAdd').text('Add');
                $('#btnCancel').hide();
                $('#cropID').val('');
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

function clearErrorOnInputChange(elementID, errorClass) {
    $(elementID).on("change", function() {
        var opt = $(this).find("option:selected").val();
        if (opt !== "0"  && opt > 0) {
            $('#supp_form').find(errorClass).text('');
        } 
    });
}

clearErrorOnInputChange("#address", 'span.address_error');
clearErrorOnInputChange("#field", 'span.field_error');
clearErrorOnInputChange("#area", 'span.area_error');


$(document).ready(function() {

    // $('#price').on('input', function() {
    //     var price = $('#price').val();
    //     if(price < 0){
    //         $('#price').val('0.00')
    //     }else{
    //         $('#price').val(price + '.00')
    //     }
    // });
    $('#price').on('input', function() {
        var price = $('#price').val();
        if(price < 0){
            $('#price').val("0.00")
        }
    });
})

$(document).on('click', '.delWaterBtn', function(e) {
    e.preventDefault();
    var ID = $(this).data("id");
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
                url: 'delete-watering',
                type: 'POST',
                dataType: 'json',
                data: {
                    ID: ID
                },
                success: function(resp) {
                    if (resp.success) {
                        // $('#crop_form')[0].reset();
                        $('.table').DataTable().ajax.reload();
                        swal("Deleted!", "Crop watering has been deleted.", "success");
                    } else {
                        swal("Failed!", "Crop watering failed to delete!", "error");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

});

$(document).on('click','.viewWaterBtn', function(e){
    e.preventDefault();
    var ID = $(this).data("id");
    var modal = $('body').find('div#uni-modal');

    console.log(ID);
    $.ajax({
        url: 'get-sched',
        method: 'POST',
        data: {
            ID: ID
        },
        success: function(res) {
            var resp = JSON.parse(res);
            console.log(resp);

            $("#vaddress").text(resp[0].address);
            $("#vfield").text('Field ' + resp[0].Field);
            $("#varea").text('Area ' +resp[0].Area);
            $("#vcrop").text(resp[0].Crop);
            $("#vcost").text(resp[0].Cost);
            $("#vdate").text(resp[0].formatted_Date);
        }
    });
    modal.find('.modal-title').html("Crop Watering");
    modal.find('.modal-footer').hide();
    modal.modal('show');
});
</script>
<?= $this->endSection() ?>

<?= $this->section('modal_content') ?>
    <style>
        .form-group p{
            padding-left: 10px;
        }
        .form-group label{
            font-weight: 600;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="">Address</label>
                        <p id="vaddress"></p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Field</label>
                        <p id="vfield"></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="">Area</label>
                        <p id="varea"></p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="">Crop</label>
                        <p id="vcrop"></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="">Cost</label>
                        <p id="vcost"></p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="">Date Apply</label>
                        <p id="vdate"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>