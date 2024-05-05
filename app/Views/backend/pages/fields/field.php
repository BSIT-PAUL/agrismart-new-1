<?= $this->extend('backend/layout/base') ?>
<?= $this->section('content')?>

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Field Management</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url(route_to('admin.home'))?>" class="home-link">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Field
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
                        Add Field
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form id="field_form">
                <!-- <input type="hidden" name="numRows" id="numRows" /> -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>City</label>
                                <select name="city" class="custom-select" id="city">
                                    <option value=0 selected>Select City</option>
                                    <?php foreach ($fetch as $row): ?>
                                        <option value="<?= $row['City_ID']?>"><?= $row['City']?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="text-danger error-text city_error"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Municipality</label>
                                <select name="muni" class="custom-select" id="municipality">
                                    <option value=0 selected>Select Municipality</option>
                                </select>
                                <span class="text-danger error-text muni_error"></span>
                            </div>   
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Barangay</label>
                                <select value=0 name="brgy" class="custom-select" id="brgy">
                                    <option selected>Select Barangay</option>
                                </select>
                                <span class="text-danger error-text brgy_error"></span>
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
                        Field
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-borderless table-hover table-striped" id="fieldTable">
                        <thead>
                            <tr>
                                <th class="text-left" scope="col">#</th>
                                <th class="text-left" scope="col">Field</th>
                                <th class="text-left" scope="col">Location</th>
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

<?= $this->section('stylesheets') ?>
<link rel="stylesheet" href="<?= base_url('public/backend/src/viewScripts/weather.css')?>">
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>


$('#fieldTable').DataTable({
    scrollCollapse: true,
    autoWidth: false,
    responsive: true,
    paging: true, // Enable paging
    pageLength: 5,
    searching: true,
    lengthMenu: [5,10,15,20],
    columnDefs: [{
        targets: "datatable-nosort",
        orderable: false,
    }],
    "ajax": {
        "url": "get-fields",
        "type": "POST",
        "dataSrc": "",
        "data": {
            userID: $('#userID').val()
        }
    },
    "columns": [{
        "data": null,
            "render": function(data, type, row, meta) {
                return meta.row + 1;
            }
        },
        {
            "data": 'Field'
        },
        {
            "data": "address"
        },
        {
            "data": "fieldID",
            "render": function(data, type, row) {
                var location = row.address;
                var url = "<?= route_to('view-field'); ?>?id=" + btoa(data) + "&address=" + encodeURIComponent(location);
                return '<div class="dropdown"> <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" data-color="#1b3133" href="#" role="button" data-toggle="dropdown"> <i class="dw dw-more"></i> </a> <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"> <button class="dropdown-item viewFieldBtn" data-id="' + data + '"><i class="dw dw-eye"></i> View</button> <button class="dropdown-item delFieldBtn" data-id="' + data + '"><i class="dw dw-delete-3"></i> Delete</button> </div> </div>';
                // return '<div class="dropdown"> <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" data-color="#1b3133" href="#" role="button" data-toggle="dropdown"> <i class="dw dw-more"></i> </a> <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"> <a class="dropdown-item viewFieldBtn" id="' + data + '" href = "' + url + '"><i class="dw dw-eye"></i> View</a> <button class="dropdown-item delFieldBtn" data-id="' + data + '"><i class="dw dw-delete-3"></i> Delete</button> </div> </div>';
            }
        }
    ],
    rowCallback: function(row, data, index) {
        $(row).find("td").addClass('text-left');
    }
});

$("#city").on("change", function() {
    var cityID = this.value;
    if (cityID != 0) {
        $.ajax({
            url: 'municipality',
            method: 'POST',
            data: {
                cityID: cityID
            },
            success: function(result) {
                let data = "<option value=0 selected>Select Municipality</option>";
                data = data + JSON.parse(result);
                document.querySelector("#municipality").innerHTML = data;
            }
        });
    } else {
        let option = "<option value='0' selected>Select Municipality</option>";
        document.querySelector("#municipality").innerHTML = option;

        let brgy = "<option value='0' selected>Select Barangay</option>";
        document.querySelector("#brgy").innerHTML = brgy;

    }
});

$("#municipality").on("change", function() {
    var muniID = this.value;
    if (muniID != 0) {
        $.ajax({
            url: 'brgy',
            method: 'POST',
            data: {
                muniID: muniID
            },
            success: function(result) {
                let data = "<option value='0' selected>Select Barangay</option>";
                data = data + JSON.parse(result);
                document.querySelector("#brgy").innerHTML = data;
            }
        });
    } else {
        let option = "<option value='0' selected>Select Barangay</option>";
        document.querySelector("#brgy").innerHTML = option;
    }
});

$(document).on('click', '.delFieldBtn', function(e) {

    e.preventDefault();
    var ID = $(this).data("id");
    swal({
            title: "Are you sure?",
            text: "You will not be able to recover this field!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
        function() {
            $.ajax({
                url: 'delete-field',
                type: 'POST',
                dataType: 'json',
                data: {
                    ID: ID
                },
                success: function(response) {
                    if (response.success) {
                        // Handle success, maybe update UI
                        $('#field_form')[0].reset();
                        $('.table').DataTable().ajax.reload();
                        swal("Deleted!", "Record has been deleted.", "success");
                    } else {
                        // Handle failure
                        swal("Failed!", "Failed to delete!", "error");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

});

function clearErrorOnInputChange(elementID, errorClass) {
    $(elementID).on("change", function() {
        var opt = $(this).find("option:selected").val();
        if (opt != "0") {
            $('#field_form').find(errorClass).text('');
        } 
    });
}

clearErrorOnInputChange("#city", 'span.city_error');
clearErrorOnInputChange("#municipality", 'span.muni_error');
clearErrorOnInputChange("#brgy", 'span.brgy_error');

$(document).on('click','.viewFieldBtn', function(e){
    e.preventDefault();
    const apiKey = "6b0f8e0e06a446518ce6a060073a6f17";
    const apiUrl = "https://api.openweathermap.org/data/2.5/weather?&units=metric";
    
    var ID = $(this).data("id");
    var modal = $('body').find('div#uni-modal');

    $.ajax({
        url: 'get-field',
        method: 'POST',
        data: {
            ID: ID,
            where: 'fieldID'
        },
        success: function(res) {
            var resp = JSON.parse(res);
            modal.find('.modal-title').html('Field '+ resp[0].Field);
            $("#address").text(resp[0].address);

            // var test = "BRGY.Papaya, Imus, Batangas"

            const parts = resp[0].address.split(',');
            // const parts = test.split(',');
            async  function getWeather(city){

                const response = await fetch(apiUrl + `&appid=${apiKey}` + `&q=${city}`);
                var data = await response.json();

                // console.log(data);

                $('#wcity').html(data.name);
                $('#temp').html(data.main.temp + "°C");
                $("#humid").html(data.main.humidity+"%");
                $("#wind").html(data.wind.speed+"km/h");
            }

            getWeather(parts[1]);
        }
    });

    function formatNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    $('#viewTable').DataTable().destroy(); 

    $('#viewTable').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        paging: true, // Enable paging
        pageLength: 5,
        lengthChange: false,
        searching: false,
        columnDefs: [{
            targets: "datatable-nosort",
            orderable: false,
        }],
        "ajax": {
            "url": "get-areas-by-field", // Replace with the actual path to your server-side script
            // "url": "get-expenses",
            "type": "POST",
            "data": {
                "id": ID
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
                "data": "Area"
            },
            {
                "data": "formatted_LotArea"
            },
            {
                "data": "crop"
            }
        ],
        rowCallback: function(row, data, index) {
            $(row).find("td").addClass('text-left');
        },
        "drawCallback": function(settings) {
            // Calculate the sum of all lot areas
            var totalLotArea = 0;
            $('#viewTable').DataTable().data().each(function(data) {
                totalLotArea += parseFloat(data.Lot_Area);
            });

            // Convert to hectares if greater than 10000 square meters
            if (totalLotArea > 10000) {
                totalLotArea /= 10000; // Convert to hectares
                $('#field_lot_area').html(totalLotArea.toFixed(2) + " ha");
            } else {
                if(totalLotArea === 0.00){
                    $('#field_lot_area').html("--");
                }else{
                    var formattedLotArea = formatNumber(totalLotArea.toFixed(2));
                    $('#field_lot_area').html(formattedLotArea + " m<sup>2</sup>");
                }
            }
        }
    });

    modal.find('.modal-footer').hide();
    modal.modal('show');
});

$('#field_form').on('submit', function(e) {
    e.preventDefault();
    var form = this;
    var formData = new FormData(form);

    var brgyID = $("#brgy").val();
    var muniID = $("#municipality").val();
    var cityID = $("#city").val();
    formData.append('brgy', brgyID);
    formData.append('muni', muniID);
    formData.append('city', cityID);

    $.ajax({
        url: 'modify-field',
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
                swal("Added", "Field successfully added!", "success")
                $('#field_form')[0].reset();
                $('.table').DataTable().ajax.reload();
            } else {
                $.each(resp.error, function(prefix, val){
                    $('span.'+prefix+'_error').text(val);
                })
            }

            // if (resp.success) {
            //     // toastr.success("Field successfully added!"+ resp.id);
            //     swal("Added", "Field successfully added!", "success");
            //     $('.table').DataTable().ajax.reload();

            // } else {
            //     toastr.error("Error occur");
            // }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
    
});




</script>
<?= $this->endSection() ?>

<?= $this->section('modal_content') ?>
<div class="row">
    <div class="col-md-6">
        <div class="row card-box">
            <div class="col-md-12 col-sm-12">
                <div class="form-group py-3">
                    <label for="">Address</label>
                    <p id="address"></p>
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <label>Lot Area</label>
                    <p id="field_lot_area"></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card-box min-height-200px pd-20 mb-20 gradient-custom" >
            <div id="demo1" data-mdb-carousel-init="" class="carousel slide" data-ride="carousel">
                <div class="d-flex justify-content-between mb-4 pb-2">
                    <div>
                        <h2 class="text-dark display-2"><strong id="temp"></strong></h2>
                        <p class="text-dark mb-0" id="wcity"></p>
                    </div>
                    <div>
                        <img src="<?= base_url('public/images/sunny.webp')?>" width="150px">
                    </div>
                </div>
                <div class="row d-flex justify-content-evenly">
                    <div class="col-md-6">
                    <!-- <img src="/images/wind.png" alt="" style="max-width: 20%; max-height: 50%;"> -->
                        <!-- <div class="pull-left"> -->
                        <div class="mb-1 ">
                            <!-- <i class="icon-copy ion-wind" style="color: #868B94;"></i> -->
                            <span class="text-dark mb-0">Wind: <strong id="wind"></strong></span>
                        </div>
                        <!-- </div> -->
                    </div>
                    <div class="col-md-6">
                        <div class="mb-1">
                            <!-- <i class="icon-copy ion-waterdrop" style="color: #868B94;"></i> -->
                            <span class="text-dark mb-0">Humidity: <strong id="humid"></strong></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 my-2 card-box my-0">
        <table class="table table-sm table-borderless table-hover table-stripe" id="viewTable">
            <thead>
                <tr>
                    <th class="text-left" scope="col">#</th>
                    <th class="text-left" scope="col">Area</th>
                    <th class="text-left" scope="col">Lot Area (m<sup>2</sup>)</th>
                    <th class="text-left" scope="col">Crop</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
