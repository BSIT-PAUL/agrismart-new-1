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
                        <a href="<?= route_to('admin.home')?>">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="<?= route_to('field')?>">Field</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        View Field
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- <div class="card"> -->

<!-- <a href="<?= route_to('field')?>"><button class="btn btn-primary"><-</button></a> -->

<div class="card card-box">
    <div class="card-header">
        <div class="clearfix">
            <div class="pull-left" id="field">
                <!-- Field + ID -->
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="">Address</label>
                            <p id="address"></p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>Lot Area</label>
                            <p id="field_lot_area"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 my-2">
                <table class="table table-sm table-borderless table-hover table-stripe">
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

    </div>
</div>
<!-- </div> -->

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// var urlParams = new URLSearchParams(window.location.search);// Get the "id" parameter and decode it
// var decodedId = atob(urlParams.get("id"));
// var location = decodeURIComponent(urlParams.get("location"));
var params = new URLSearchParams(window.location.search);
var ID = atob(params.get("id"));

document.addEventListener('DOMContentLoaded', function() {
    $.ajax({
            url: 'get-field',
            method: 'POST',
            data: {
                ID: ID,
                where: 'fieldID'
            },
            success: function(res) {
                var resp = JSON.parse(res);
                document.getElementById("field").innerText = 'Field '+ resp[0].Field;
                document.getElementById("address").innerText = resp[0].address;
            }
        });
    
    // document.getElementById("address").innerText = location;
});

function formatNumber(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

$('.table').DataTable({
    scrollCollapse: true,
    autoWidth: false,
    responsive: true,
    columnDefs: [{
        targets: "datatable-nosort",
        orderable: false,
    }],
    "ajax": {
        "url": "get-areas-by-field", // Replace with the actual path to your server-side script
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
        $('.table').DataTable().data().each(function(data) {
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
</script>

<?= $this->endSection() ?>