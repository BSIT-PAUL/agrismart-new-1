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
                        <a href="<?= route_to('area')?>">Area</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        View Area
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="card card-box">
    <div class="card-header">
        <div class="clearfix">
            <div class="pull-left" id="area">
                <!-- Field + ID -->
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <input type="hidden" id="areaID">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="">Field</label>
                            <p id="field"></p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>Address</label>
                            <p id="address"></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="">Lot Area</label>
                            <p id="lotArea"></p>
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
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Total Expenses</label>
                            <p id="expenses"></p>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-md-12">
                <h6>Expenses</h6>
                <table class="table table-sm table-borderless table-hover table-stripe">
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

    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('stylesheets') ?>
    <style>
        .form-group p{
            padding-left: 10px;
        }
        .form-group label{
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
            $("#area").text("Area " + resp[0].Area);
            $("#field").text(resp[0].Field);
            $("#address").text(resp[0].address);
            $("#lotArea").text(resp[0].formatted_LotArea);
            $("#crop").text(resp[0].crop);

            $('.table').DataTable({
                scrollCollapse: true,
                autoWidth: false,
                responsive: true,
                paging: false,
                searching: false,
                pageLength: 5,
                columnDefs: [{
                    targets: "datatable-nosort",
                    orderable: false,
                    }],
                "ajax": {
                    "url": "get-expenses", // Replace with the actual path to your server-side script
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
                    $('.table').DataTable().data().each(function(data) {
                        totExpenses += parseFloat(data.totAmount);
                    });

                    $('#expenses').html('₱ ' + totExpenses.toLocaleString('en-US', {maximumFractionDigits: 2}));
                }
            });
        }
    });
});
</script>

<?= $this->endSection() ?>