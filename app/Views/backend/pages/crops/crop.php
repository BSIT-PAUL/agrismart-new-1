<?= $this->extend('backend/layout/base') ?>
<?= $this->section('content')?>

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Crop Management</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url(route_to('admin.home'))?>" class="home-link">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Crop
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
                    <div class="pull-left">
                        Add Crop
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form id="crop_form">
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
                                    <label>Lot Area (m<sup>2</sup>)</></label>
                                    <input type="text"name='lotArea' class="form-control" placeholder ="Lot Area" id='lotArea' disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Seed</label>
                                <select name="seed" class="custom-select" id="seed">
                                    <option value="0" selected>Select Seed</option>
                                    <?php foreach ($fetch as $row): ?>
                                        <option value="<?= $row['ID'] ?>"><?= $row['Type'] ?></option>
                                    <?php endforeach; ?>
                                    <option value="other">Other</option>
                                </select>
                                <input type="text" style="display: none;" id="newSeed" class="form-control" placeholder="Enter seed">
                                <span class="text-danger error-text seed_error"></span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Seed Type</label>
                                <select name="type" class="custom-select" id="type">
                                    <option value="0" selected>Select Seed Type</option>
                                    <option value='other'>Other</option>
                                </select>
                                <input type="text"  style="display: none;" id="newType" class="form-control" placeholder="Enter seed type">
                                <span class="text-danger error-text type_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-7 col-md-12">
                            <div class="form-group">
                                <label>Price (kg)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="border: 1px solid lightgray;">₱</span>
                                    </div>
                                    <input type="number" name="price" class="form-control border-left-0 px-0" value="0.00" id="price" step="any">
                                </div>
                                <span class="text-danger error-text price_error"></span>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-12">
                            <div class="form-group">
                                <label>Quantity</label>
                                <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                    <input id="qty" type="number" value="1"  name="qty" class="form-control">
                                    <span class="input-group-btn-vertical">
                                        <button class="btn btn-primary bootstrap-touchspin-up " type="button" id="btnPlus">+</button>
                                        <button class="btn btn-primary bootstrap-touchspin-down " type="button" id="btnMinus">-</button>
                                    </span>
                                </div>
                                <span class="text-danger error-text qty_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="text-center"><Strong>Predictions</Strong></label>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Expenses</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="background-color: #e9ecef; border-color: #ced4da;">₱</span>
                                    </div>
                                    <input id="pExpenses" type="text" class="form-control border-0 px-0" value="0.00" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Profit</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="background-color: #e9ecef; border-color: #ced4da;">₱</span>
                                    </div>
                                    <input id="pProfit" type="text" class="form-control border-0 px-0" value="0.00" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
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
                        Crop
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-borderless table-hover table-stripe" id="cropTable">
                        <thead>
                            <tr>
                                <th class="text-left align-content-center" scope="col">#</th>
                                <th class="text-left align-content-center" scope="col">Field</th>
                                <th class="text-left align-content-center" scope="col">Area</th>
                                <th class="text-left align-content-center" scope="col">Seed-Type</th>
                                <th class="text-left align-content-center" scope="col">Quantity (kg)</th>
                                <th class="text-left align-content-center" scope="col">Plant Date</th>
                                <th class="text-left align-content-center" scope="col">Harvest Date</th>
                                <th class="text-left align-content-center" scope="col">Action</th>
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

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('public/backend/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js')?>"></script>

<script>

function updateTotalAmount() {
    var lotArea = parseInt($('#lotArea').val());
    var seedVol = parseInt($('#qty').val());
    var cropID = $('#seed').val();
    var crop = $('#seed').find("option:selected").text();
    var VarietyID = $('#type').val();
    var Variety = $('#type').find("option:selected").text();
    if(cropID != 0 && VarietyID != 0){
        $.ajax({
            url: "https://jayr21.pythonanywhere.com/api/predict-profit",
            method: 'POST',
            contentType: "application/json",
            data : JSON.stringify({
            "LotArea": lotArea,
            "crop": crop,
            "Variety": Variety,
            "SeedVolume": seedVol
            }),
            headers: {
                "Access-Control-Allow-Origin" : '*',
                "Access-Control-Allow-Methods": "*"
                },
            success: function(res){
                // console.log(res.PREDICTION)
                $("#pProfit").val(res.PREDICTION.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            }
        });

        $.ajax({
            url: "https://jayr21.pythonanywhere.com/api/predict-expenses",
            method: 'POST',
            contentType: "application/json",
            data : JSON.stringify({
            "LotArea": lotArea,
            "crop": crop,
            "Variety": Variety,
            "SeedVolume": seedVol
            }),
            headers: {
                "Access-Control-Allow-Origin" : '*',
                "Access-Control-Allow-Methods": "*"
                },
            success: function(res){
                // console.log(res.PREDICTION)
                $("#pExpenses").val(res.PREDICTION.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","))
            }
        });
    }
}

$(document).ready(function() {
    // $('#crop-modal').modal('show');

    $('#price').on('input', function() {
        var price = $('#price').val();
        if(price <= 0){
            $('#price').val('0.00')
        }
    });

    $('#qty').on('input', function() {
        var price = $('#qty').val();
        if(price <= 0){
            $('#qty').val('1')
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

    $('#seed').change(function() {
        if ($(this).val() === 'other') {
            $('#newSeed').show();
            $('#newSeed').focus();
            $('#seed').hide();

            $('#newType').show();
            $('#type').val('other');
            // console.log($('#type').val());
            // $('#newType').focus();
            $('#type').hide();
        }
    });

    $('#newSeed').focusout(function() {
        if ($(this).val().trim() === '') {
            $('#seed').val('0');
            $('#seed').show();
            $(this).hide();

            $('#type').val('other');
            $('#type').show();
            $('#newType').hide();
        }
    });

    $('#type').change(function() {
        if ($(this).val() === 'other') {
            $('#newType').show();
            $('#newType').focus();
            $('#type').hide();
        }
    });

    $('#newType').focusout(function() {
        if ($(this).val().trim() === ''  && $('#newSeed').val().trim() === '') {
            $('#type').val('0');
            $('#type').show();
            $(this).hide();
        }
    });

});

function clearErrorOnInputChange(elementID, errorClass) {
    $(elementID).on("change", function() {
        var opt = $(this).find("option:selected").val();
        if (opt !== "0") {
            $('#crop_form').find(errorClass).text('');
        } 
    });
}

clearErrorOnInputChange("#seed", 'span.seed_error');
clearErrorOnInputChange("#type", 'span.type_error');
clearErrorOnInputChange("#price", 'span.price_error');
clearErrorOnInputChange("#qty", 'span.qty_error');
clearErrorOnInputChange("#address", 'span.address_error');
clearErrorOnInputChange("#field", 'span.field_error');
clearErrorOnInputChange("#area", 'span.area_error');

$('#cropTable').DataTable({
    scrollCollapse: true,
    autoWidth: false,
    responsive: true,
    columnDefs: [{
        targets: "datatable-nosort",
        orderable: false,
    }],
    "ajax": {
        "url": "get-crops", // Replace with the actual path to your server-side script
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
            "data": "Field"
        },
        {
            "data": "Area"
        },
        {
            "data": "seedType"
        },
        {
            "data": "quantity"
        },
        {
            "data": "formatted_plantDate"
        },
        {
            "data": "formatted_harvestDate"
        },
        {
            "data": "Crop_ID",
            "render": function(data, type, row) {
                var url = "<?= route_to('view-crop'); ?>?id=" + btoa(data);
                return '<div class="dropdown"> <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" data-color="#1b3133" href="" role="button" data-toggle="dropdown"> <i class="dw dw-more"></i> </a> <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"> <button class="dropdown-item viewCropBtn" data-id="' +
                    data +
                    '"><i class="dw dw-eye"></i> View</button> <button class="dropdown-item delCropBtn" data-id="' +
                    data + '"><i class="dw dw-delete-3"></i> Delete</button> </div> </div>';
                    // <button class="dropdown-item editCropBtn" data-id="' +
                    // data +
                    // '"><i class="dw dw-edit2"></i> Edit</button>
                     
            }
        }
    ],
    rowCallback: function(row, data, index) {
        $(row).find("td").addClass('text-left');
    }
});


$("#seed").on("change", function() {
    var seedID = this.value;
    var seed = $(this).find("option:selected").text();
    updateTotalAmount();
    if (seedID != 0 && seedID != 'other') {
        // console.log(seedID);
        // console.log(modalAddValue);
        $.ajax({
            url: 'new-get-seed',
            type: 'POST',
            dataType: 'json',
            data: { 
                ID: seed,
                where: 's.Type'
            },
            success: function(result) {
                // console.log(result);
                
                let data = "<option value='0' selected>Select Seed Type</option>";
                data += result;
                document.querySelector("#type").innerHTML = data;
            }
        });
    } else {
        
        // $('#type').val('other');
        // let type = "<option value='0' selected>Select Seed Type</option><option value='other' selected>Other</option>";
        // document.querySelector("#type").innerHTML = type;
        
    }

});

$("#type").on("change", function() {
    var type = this.value;
    var seed = $('#seed').val();
    updateTotalAmount();
    if(type != 0 && type != 'other'){
        $.ajax({
            url: 'get-price',
            type: 'POST',
            dataType: 'json',
            data: { 
                type: type,
                seed: seed
            },
            success: function(resp) {
                var resp = resp[0];
                // console.log(resp);
                $("#price").val(resp.Current_Price);
                
            }
        });
    }else{
        console.log('update');
        $("#price").val('0.00');
    }
    

});

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
                where: 'fieldID'
            },
            success: function(result) {
                // console.log(result);
                let data = "<option value='0' selected>Select Area</option>";
                data += result;
                document.querySelector("#area").innerHTML = data;
                $("#lotArea").val('');
            }
        });
    } else {
        let type = "<option value='0' selected>Select Area</option>";
        document.querySelector("#area").innerHTML = type;
        $("#lotArea").val('');
    }

});

$("#area").on("change", function() {
    var area = this.value;
    updateTotalAmount();
    // console.log(area);
    if (area != 0) {
        $.ajax({
            url: 'get-area',
            type: 'POST',
            dataType: 'json',
            data: { 
                ID: area,
                where: 'Area_ID'
            },
            success: function(resp) {
                // console.log(result);
                var resp = resp[0];
                $("#lotArea").val(resp.formatted_LotArea);
            }
        });
    } else {
        $("#lotArea").val('');
    }

});

$(document).on('click', '.delCropBtn', function(e) {
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
                url: 'delete-crop',
                type: 'POST',
                dataType: 'json',
                data: {
                    ID: ID
                },
                success: function(resp) {
                    if (resp.success) {
                        // console.log('nyat')
                        // $('#crop_form')[0].reset();
                        $('#cropTable').DataTable().ajax.reload();
                        swal("Deleted!", "Crop has been deleted.", "success");
                    } else {
                        swal("Failed!", "Crop failed to delete!", "error");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

});

function resetFields(){
    $('#seed').val('0');
    $('#seed').show();
    $('#newSeed').hide();

    $('#type').val('0');
    $('#type').show();
    $('#newType').hide();

    $('#crop_form')[0].reset();
    $('.table').DataTable().ajax.reload();
    $('#btnAdd').text('Add');
    $('#btnCancel').hide();
    $('#cropID').val('');
}

$('#crop_form').on('submit', function(e) {
    // console.log('submit')
    e.preventDefault();
    var form = this;

    var ID  = $('#cropID').val();
    var areaID  = $('#area').val();
    var seedCon  = $('#seed').val();
    var seed  = $('#seed').find("option:selected").text();
    var newSeed  = $('#newSeed').val();
    var typeCon  = $('#type').val();
    var type  = $('#type').find("option:selected").text();
    var newType  = $('#newType').val();

    var formData = new FormData(form);
    formData.append('areaID', areaID);

    if(seedCon == "other"){
        $('#type').val('other');
        formData.append('seedVal', newSeed);
    } else {
        formData.append('seedVal', seed);
    }

    // if(newType.trim() === ""){
    //     $('#type').val('0');
    //     console.log('nya')
    //     formData.append('type', $('#type').val());
    // } else {
    //     $('#type').val('other');
    //     formData.append('typeVal', newType);
    // }

    if(typeCon == "other"){
        if(newType.trim() === ""){
            $('#type').val('0');
            console.log('nya')
            formData.append('type', $('#type').val());
        } 
        else {
            $('#type').val('other');
            formData.append('typeVal', newType);
            formData.append('type', $('#type').val());
            // console.log('elses')
        }
    } else {
        formData.append('type', $('#type').val());
        formData.append('typeVal', type);
        // console.log('else')
    }

    // formData.forEach(function(value, key){
    //     console.log(key + ': ' + value);
    // });

    // console.log('');
    var msg, action;
    if (ID == "") {
        action = 'Added';
        msg = "Crop added successfully";
    } else {
        action = 'Updated';
        msg = "Crop updated successfully";
    }
    $.ajax({
        url: 'modify-crops',
        type: 'POST',
        data: formData,
        processData: false,
        dataType: 'json',
        contentType: false, 
        beforeSend:function(){
            $(form).find('span.error-text').text('');
        },
        success: function(resp) {
            if ($.isEmptyObject(resp.error)) {
                if(resp.status == 1){
                    swal(action, msg, "success");
                } else {
                    swal("Failed!", "Error occurred", "error");
                }
                resetFields();
            } else {
                $.each(resp.error, function(prefix, val){
                    $('span.'+prefix+'_error').text(val);
                });
            }
        },
        error: function(xhr, status, error) {
            // console.log(error);
            console.error(xhr.responseText);
        }
    });
});

$(document).on('click','.viewCropBtn', function(e){
    e.preventDefault();
    var ID = $(this).data("id");
    var modal = $('body').find('div#uni-modal');

    var profit = $('#profit').val();
    


    // console.log(ID);
    $.ajax({
        url: 'get-crops',
        method: 'POST',
        data: {
            ID: ID
        },
        success: function(res) {
            var resp = JSON.parse(res);
            // console.log(resp);
            var lotArea;
            $("#vaddress").text(resp[0].address);
            $("#vfield").text('Field ' + resp[0].Field);
            $("#varea").text('Area ' +resp[0].Area);
            $("#vseed").text(resp[0].seedType);
            // $("#supplement").text(resp[0].Supplement);
            $("#vplant").text(resp[0].formatted_plantDate);
            $.ajax({
                url: 'get-area',
                type: 'POST',
                dataType: 'json',
                data: { 
                    ID: resp[0].Area_ID,
                    where: 'Area_ID'
                },
                success: function(resp1) {
                    // console.log(result);
                    var resp1 = resp1[0];
                    lotArea = resp1.Lot_Area
                
                    if(resp[0].formatted_harvestDate == null){
                        if(resp[0].predictedHarvestDate != null){
                            $("#vharvest").text(resp[0].predictedHarvestDate + "  (Predicted)");

                            $.ajax({
                                url: "https://jayr21.pythonanywhere.com/api/predict-profit",
                                method: 'POST',
                                contentType: "application/json",
                                data : JSON.stringify({
                                "LotArea": parseInt(lotArea),
                                "crop": resp[0].Type,
                                "Variety": resp[0].Variety,
                                "SeedVolume": parseInt(resp[0].quantity)
                                }),
                                headers: {
                                    "Access-Control-Allow-Origin" : '*',
                                    "Access-Control-Allow-Methods": "*"
                                    },
                                success: function(res){
                                    // console.log(res.PREDICTION)
                                    $("#profit")[0].innerHTML = ('₱' + res.PREDICTION.toLocaleString('en-US', {maximumFractionDigits: 2})) + "(Predicted)"
                                }
                            });
                        }
                
                        
                    }else{
                        $("#vharvest").text(resp[0].formatted_harvestDate);
                    }
                }
            })
            $("#vprice").text(resp[0].Formatted_Price);
            $("#vqty").text(resp[0].quantity + ' kg');
            // $("#totAmount").text(resp[0].Formatted_Tot_Amount);

            $('#viewTable').DataTable().destroy(); 

            $('#viewTable').DataTable({
                scrollCollapse: true,
                autoWidth: false,
                responsive: true,
                paging: true,
                searching: false,
                lengthChange: false,
                pageLength: 5,
                columnDefs: [{
                    targets: "datatable-nosort",
                    orderable: false,
                    }],
                "ajax": {
                    "url": "get-Area-expenses", // Replace with the actual path to your server-side script
                    "type": "POST",
                    "data": {
                        // "areaID": areaID,
                        "cropID": ID,
                        "con": 'crop'
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

                    $('#expensesNyat').text(totExpenses);
                    $('#expenses').html('₱' + totExpenses.toLocaleString('en-US', {maximumFractionDigits: 2}));

                    $.ajax({
                        url: 'getCropTotals',
                        method: 'POST',
                        data: {
                            ID: ID
                        },
                        success: function(res) {
                            var resp = JSON.parse(res);
                            // console.log(resp)
                            if(resp && resp.length > 0){
                                $('#salesNyat').removeClass('d-none');
                                var sales = parseFloat(resp[0].totSales);
                                $('#sales').text(resp[0].formatted_totSales);
                                $('#profit').html('₱' + (sales - totExpenses).toLocaleString('en-US', {maximumFractionDigits: 2}));
                            }else{
                                $('#salesNyat').addClass('d-none');
                            } 
                            
                        }
                    });
                }
            });
        }
    });

    
    modal.find('.modal-title').html("Crop");
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
    .form-group p{
        padding-left: 10px;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-6 col-md-4 col-sm-12">
                <div class="form-group">
                    <label for="">Address</label>
                    <p id="vaddress"></p>
                </div>
            </div>
            <div class="col-lg-6 col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Field</label>
                    <p id="vfield"></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-4 col-sm-12">
                <div class="form-group">
                    <label for="">Area</label>
                    <p id="varea"></p>
                </div>
            </div>
            <div class="col-lg-6 col-md-4 col-sm-12">
                <div class="form-group">
                    <label for="">Crop</label>
                    <p id="vseed"></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-4 col-sm-12">
                <div class="form-group">
                    <label for="">Plant Date</label>
                    <p id="vplant"></p>
                </div>
            </div>
            <div class="col-lg-6 col-md-4 col-sm-12">
                <div class="form-group">
                    <label for="">Harvest Date</label>
                    <p id="vharvest"></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-4 col-sm-12">
                <div class="form-group">
                    <label for="">Seed Volume</label>
                    <p id="vqty"></p>
                </div>
            </div>
            <div class="col-lg-6 col-md-4 col-sm-12">
                <div class="form-group">
                    <label for="">Price (₱)</label>
                    <p id="vprice"></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="form-group">
                    <label for="">Total Expenses</label>
                    <p id="expenses"></p>
                    <p id="expensesNyat" class="d-none"></p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12" id="salesNyat">
                <div class="form-group" >
                    <label for="">Sales</label>
                    <p id="sales" class=""></p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="form-group">
                    <label for="">Profit</label>
                    <p id="profit"></p>
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