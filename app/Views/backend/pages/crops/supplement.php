<?= $this->extend('backend/layout/base') ?>
<?= $this->section('content')?>

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Supplement Management</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url(route_to('admin.home'))?>" class="home-link">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Supplement
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
                        Add Supplement
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="" method="POST" id="supp_form">
                    <input type="hidden" id="suppID">
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
                    <div class="row">
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Supplement Type</label>
                                <select name="type" class="custom-select" id="type">
                                    <option value="0" selected>Select supplement type</option>
                                    <option value="1">Insecticide</option>
                                    <option value="2">Fertilizer</option>
                                </select>
                                <span class="text-danger error-text type_error"></span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Supplement</label>
                                <select name="supp" class="custom-select" id="supp">
                                    <option value="0" selected>Select supplement</option>
                                </select>
                                <input type="text"  style="display: none;" id="newSupp" class="form-control" placeholder="Enter supplement">
                                <span class="text-danger error-text supp_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-7 col-md-7 col-sm-8">
                            <div class="form-group">
                                <label>Price</label>
                                <div class="input-group m-0 p-0">
                                    <div class="input-group-prepend" >
                                        <span class="input-group-text" style="border: 1px solid lightgray;" id="sign">₱</span>
                                    </div>
                                    <input type="number" name="price" class="form-control border-left-0 px-0" id="price" value="0.00" step="any">
                                </div>
                                <span class="text-danger error-text price_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-4">
                            <div class="form-group">
                                <label>Quantity</label>
                                <div class="input-group bootstrap-touchspin ">
                                    <input id="qty" type="number" value="1" name="qty" class="form-control">
                                    <span class="input-group-btn-vertical">
                                        <button class="btn btn-primary bootstrap-touchspin-up " type="button"
                                            id="btnPlus">+</button>
                                        <button class="btn btn-primary bootstrap-touchspin-down " type="button"
                                            id="btnMinus">-</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                            <label>Total Amount</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text disabled-style">₱</span>
                                    </div>
                                    <input id="totAmount" type="text" class="form-control border-0 px-0"  value="0.00" disabled>
                                </div>
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
                        Supplement
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-borderless table-hover table-stripe" id="suppTable">
                        <thead>
                            <tr>
                                <th class="text-center align-content-center" scope="col">#</th>
                                <th class="text-center align-content-center" scope="col">Field</th>
                                <th class="text-center align-content-center" scope="col">Area</th>
                                <th class="text-center align-content-center" scope="col">Seed</th>
                                <th class="text-center align-content-center" scope="col">Supplement</th>
                                <th class="text-center align-content-center" scope="col">Quantity</th>
                                <th class="text-center align-content-center" scope="col">Date Apply</th>
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
<link rel="stylesheet" type="text/css" href="<?= base_url('public/backend/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.css')?>">
<style>
    .disabled-style {
        pointer-events: none; 
    }
    .input-group-prepend .disabled-style{
        background-color: #e9ecef;
        border-color: #ced4da;
    }
</style>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>

<script>
function clearErrorOnInputChange(elementID, errorClass) {
    $(elementID).on("change", function() {
        var opt = $(this).find("option:selected").val();
        if (opt !== "0"  && opt > 0) {
            $('#supp_form').find(errorClass).text('');
        } 
    });
}

clearErrorOnInputChange("#supp", 'span.supp_error');
clearErrorOnInputChange("#type", 'span.type_error');
// clearErrorOnInputChange("#price", 'span.price_error');
// clearErrorOnInputChange("#qty", 'span.qty_error');
clearErrorOnInputChange("#address", 'span.address_error');
clearErrorOnInputChange("#field", 'span.field_error');
clearErrorOnInputChange("#area", 'span.area_error');

$('#suppTable').DataTable({
    scrollCollapse: true,
    autoWidth: false,
    responsive: true,
    pageLength: 5,
    columnDefs: [{
        targets: "datatable-nosort",
        orderable: false,
    }],
    "ajax": {
        "url": "get-supps", // Replace with the actual path to your server-side script
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
            "data": "Field"
        },
        {
            "data": "Area"
        },
        {
            "data": "Seed"
        },
        {
            "data": "Supplement"
        },
        {
            "data": "Quantity"
        },
        {
            "data": "formatted_dateApply"
        },
        {
            "data": "ID",
            "render": function(data, type, row) {
                var url = "<?= route_to('view-supp'); ?>?id=" + btoa(data);
                return '<div class="dropdown"> <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" data-color="#1b3133" href="#" role="button" data-toggle="dropdown"> <i class="dw dw-more"></i> </a> <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"> <button class="dropdown-item viewSuppBtn" data-id="' +
                    data +
                    '"><i class="dw dw-eye"></i> View</button> <button class="dropdown-item delSuppBtn" data-id="' +
                    data + '"><i class="dw dw-delete-3"></i> Delete</button> </div> </div>';
                    // <button class="dropdown-item editSuppBtn" data-id="' +
                    // data +
                    // '"><i class="dw dw-edit2"></i> Edit</button> 
                    
            }
        }
    ],
    rowCallback: function(row, data, index) {
        $(row).find("td").addClass('text-left');
    }
});

$("#address").on("change", function() {
    var addressVal = this.value;
    var address = $(this).find("option:selected").text();
    if (addressVal != 0) {
        
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
        let field = "<option value='0' selected>Select Field</option>";
        document.querySelector("#field").innerHTML = field;

        let area = "<option value='0' selected>Select Area</option>";
        document.querySelector("#area").innerHTML = area;

        $("#crop").val('');
    }

});

$("#field").on("change", function() {
    var field = this.value;
    console.log(field);

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
    console.log(area);
    if (area != 0) {
        $.ajax({
            url: 'get-crop',
            type: 'POST',
            dataType: 'json',
            data: { 
                ID: area
            },
            success: function(resp) {
                // console.log(resp);
                var res = resp[0];
                // console.log(res)
                $("#crop").val(res.Type + '(' + res.Variety +')');
            }
        });
    } else {
        $("#crop").val('');
    }

});

$("#type").on("change", function() {
    var type = this.value;
    // console.log(type);
    if (type != 0) {

        $.ajax({
            url: 'supplement',
            method: 'POST',
            data: {
                type: type
            },
            success: function(result) {
                let data;
                if (type == 1) {
                    data = "<option value='0' selected>Select Insecticide</option>";
                } else {
                    data = "<option value='0' selected>Select Fertilizer</option>";
                }

                data += JSON.parse(result);
                data += "<option value='other'>Other</option>";
                document.querySelector("#supp").innerHTML = data;
            }
        });

    } else {
        let option = "<option value='0' selected>Select Supplement</option>";
        document.querySelector("#supp").innerHTML = option;
        $('#price').val('0.00');
    }

});

$('#supp').on('change', function() {
    var supp = this.value;
    var type = $('#type').val();
    console.log(supp)
    if (supp != 0 && supp != 'other') {
        $.ajax({
            url: 'get-price',
            type: 'POST',
            dataType: 'json',
            data: {
                type: type,
                supp: supp
            },
            success: function(resp) {
                var resp = resp[0];
                console.log(resp);
                $("#price").val(resp.Price);
                updateTotalAmount();
                $('#supp_form').find("span.price_error").text('');
            }
        });
    } else {
        $('#price').val('0.00')
    }
})


function updateTotalAmount() {
    var price = parseFloat($('#price').val());
    var quantity = parseInt($('#qty').val(), 10);
    var totalAmount = isNaN(price) || isNaN(quantity) ? 0 : price * quantity;
    $("#totAmount").val(totalAmount.toFixed(2));
}
$(document).ready(function() {

    $('#price').on('input', function() {
        var price = $('#price').val();
        if(price < 0){
            $('#price').val(0.00)
        }
        updateTotalAmount();
    });

    $('#qty').on('input', function() {
        var price = $('#qty').val();
        if(price < 0){
            $('#qty').val(1)
        }
        updateTotalAmount();
    });

    $('#btnPlus').click(function() {
        var price = parseFloat($('#price').val());
        var value = parseInt($('#qty').val(), 10);
        $('#qty').val(isNaN(value) ? 1 : value + 1);
        updateTotalAmount();
    });

    $('#btnMinus').click(function() {
        var price = parseFloat($('#price').val());
        var value = parseInt($('#qty').val(), 10);
        $('#qty').val(isNaN(value) || value <= 1 ? 1 : value - 1);
        updateTotalAmount();
    });

    $('#supp').change(function() {
        if ($(this).val() === 'other') {
            $('#newSupp').show();
            $('#newSupp').focus();
            $('#supp').hide();
        }
    });

    $('#newSupp').focusout(function() {
        if ($(this).val().trim() === '') {
            $('#supp').val('0');
            $('#supp').show();
            $(this).hide();
        }
    });
});

$(document).on('click', '.delSuppBtn', function(e) {
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
                url: 'delete-supp',
                type: 'POST',
                dataType: 'json',
                data: {
                    ID: ID
                },
                success: function(resp) {
                    if (resp.success) {
                        // $('#crop_form')[0].reset();
                        $('.table').DataTable().ajax.reload();
                        swal("Deleted!", "Supplement has been deleted.", "success");
                    } else {
                        swal("Failed!", "Supplement failed to delete!", "error");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

});

$('#supp_form').on('submit', function(e) {
    e.preventDefault();
    var form = this;

    var ID  = $('#suppID').val();
    var supp  = $('#supp').find("option:selected").text();
    var type  = $('#type').find("option:selected").text();
    var newSupp  = $('#newSupp').val();
    var areaID  = $('#area').val();

    var formData = new FormData(form);
    formData.append('areaID', areaID);
    formData.append('typeVal', type);

    // console.log(seed +' - '+ newSeed)
    if(supp == "Other"){
        formData.append('suppVal', newSupp);
    }else{
        formData.append('suppVal', supp);
    }

    var msg, action;
    if (ID == "") {
        action = 'Added';
        msg = "Supplement added successfuly";
    } else {
        action = 'Updated';
        msg = "Supplement updated successfuly";
    }
    $.ajax({
        url: 'modify-supp',
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
                $('#supp_form')[0].reset();
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

$(document).on('click','.viewSuppBtn', function(e){
    e.preventDefault();
    var ID = $(this).data("id");
    var modal = $('body').find('div#uni-modal');

    console.log(ID);
    $.ajax({
        url: 'get-supps',
        method: 'POST',
        data: {
            ID: ID
        },
        success: function(res) {
            var resp = JSON.parse(res);
            // console.log(resp[0].Supplement);

            $("#vaddress").text(resp[0].address);
            $("#vfield").text('Field ' + resp[0].Field);
            $("#varea").text('Area ' +resp[0].Area);
            $("#vcrop").text(resp[0].Seed);
            $("#vsupplement").text(resp[0].Supplement);
            $("#vdate").text(resp[0].formatted_dateApply);
            $("#vprice").text(resp[0].Formatted_Price);
            $("#vqty").text(resp[0].Quantity);
            $("#vtotAmount").text(resp[0].Formatted_Tot_Amount);
        }
    });
    modal.find('.modal-title').html("Supplement");
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
                    <label for="">Supplement</label>
                    <p id="vsupplement"></p>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="form-group">
                    <label for="">Date Apply</label>
                    <p id="vdate"></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="form-group">
                    <label for="">Quantity</label>
                    <p id="vqty"></p>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="form-group">
                    <label for="">Price (₱)</label>
                    <p id="vprice"></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <label for="">Total Amount (₱)</label>
                    <p id="vtotAmount"></p>
                </div>
            </div>
        </div>
        
    </div>
</div>
<?= $this->endSection() ?>