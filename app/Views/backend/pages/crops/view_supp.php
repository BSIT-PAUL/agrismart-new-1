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
                        <a href="<?= route_to('admin.home')?>">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="<?= route_to('supp')?>">Supplement</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        View Supplement
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="card card-box">
    <div class="card-header">
        <div class="clearfix">
            <div class="pull-left" id="supp">
                Supplement
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
                            <label>Field</label>
                            <p id="field"></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="">Area</label>
                            <p id="area"></p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="">Crop</label>
                            <p id="crop"></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="">Supplement</label>
                            <p id="supplement"></p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="">Price (₱)</label>
                            <p id="price"></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="">Quantity</label>
                            <p id="qty"></p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="">Total Amount (₱)</label>
                            <p id="totAmount"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('stylesheets') ?>
    <style>
        .card .card-body .form-group p{
            padding-left: 10px;
        }
        .card .card-body .form-group label{
            font-weight: 600;
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>

var params = new URLSearchParams(window.location.search);
var ID = atob(params.get("id"));

document.addEventListener('DOMContentLoaded', function() {
    $.ajax({
        url: 'get-supps',
        method: 'POST',
        data: {
            ID: ID
        },
        success: function(res) {
            var resp = JSON.parse(res);
            console.log(resp[0].Supplement);

            $("#address").text(resp[0].address);
            $("#field").text('Field ' + resp[0].Field);
            $("#area").text('Area ' +resp[0].Area);
            $("#crop").text(resp[0].Seed);
            $("#supplement").text(resp[0].Supplement);
            $("#price").text(resp[0].Formatted_Price);
            $("#qty").text(resp[0].Quantity);
            $("#totAmount").text(resp[0].Formatted_Tot_Amount);
        }
    });
});

// $('.table').DataTable({
//     scrollCollapse: true,
//     autoWidth: false,
//     responsive: true,
//     paging: false,
//     searching: false,
//     columnDefs: [{
//         targets: "datatable-nosort",
//         orderable: false,
//         }]
//     // }],
//     // "ajax": {
//     //     "url": "get-area", // Replace with the actual path to your server-side script
//     //     "type": "POST",
//     //     "data": {
//     //         "id": ID
//     //     },
//     //     "dataSrc": ""
//     // },
//     // "columns": [{
//     //         "data": null,
//     //         "render": function(data, type, row, meta) {
//     //             return meta.row + 1;
//     //         }
//     //     },
//     //     {
//     //         "data": "ID"
//     //     },
//     //     {
//     //         "data": "Lot_Area"
//     //     }
//     // ],
//     // rowCallback: function(row, data, index) {
//     //     $(row).find("td").addClass('text-left');
//     // },
//     // "drawCallback": function(settings) {
//     //         // Calculate the sum of all lot areas
//     //     var totalLotArea = 0;
//     //     $('.table').DataTable().data().each(function(data) {
//     //         totalLotArea += parseFloat(data.Lot_Area);
//     //     });

//     //     // Convert to hectares if greater than 10000 square meters
//     //     if (totalLotArea > 10000) {
//     //         totalLotArea /= 10000; // Convert to hectares
//     //         $('#field_lot_area').html(totalLotArea.toFixed(2) + " ha");
//     //     } else {
//     //         $('#field_lot_area').html(totalLotArea.toFixed(2) + "m<sup>2</sup>");
//     //     }
//     // }
// });
</script>

<?= $this->endSection() ?>