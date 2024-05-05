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
                        <a href="<?= route_to('admin.home')?>">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="<?= route_to('seed')?>">Seed</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        View Seed
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="card card-box">
            <div class="card-header">
                <div class="clearfix">
                    <div class="pull-left" id = "seed">
                        
                    </div>
                </div>
            </div>
            <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Location</label>
                                        <p id="location">Bangkal, Bulihan, Nasugbu, Batangas</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Lot Area</label>
                                        <p id = "lot_area">1,000 m<sup>2</sup></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="div">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur, saepe laboriosam neque ex repellat iure, nisi asperiores nulla aspernatur ipsam dolores eum quasi, odit laborum ad! Explicabo in deserunt harum aliquam ex iure, modi nam saepe vel dignissimos? Eius possimus architecto dolor blanditiis soluta! Nobis a quia accusantium illum asperiores, consequatur dolorum cum! Corrupti exercitationem veritatis magnam recusandae optio dicta architecto voluptatem, iure et, voluptate commodi consequatur ad mollitia tempore voluptatibus quod id totam hic, vel officiis aut cupiditate soluta rem quibusdam! Cumque, earum accusantium. Fugiat non ad inventore voluptas eos distinctio, ipsum quidem, dolorem magnam consequatur, velit nemo nam.
                        </div>
                        <!-- <div class="col-md-12 my-2">
                            <table class="table table-sm table-borderless table-hover table-stripe">
                                <thead>
                                    <tr>
                                        <th class="text-left" scope="col">#</th>
                                        <th class="text-left" scope="col">Area</th>
                                        <th class="text-left" scope="col">Lot Area (m<sup>2</sup>)</th>
                                    </tr>
                                </thead>
                            </table>
                        </div> -->
                    </div>
                
            </div>
        </div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // var urlParams = new URLSearchParams(window.location.search);// Get the "id" parameter and decode it
    // var decodedId = atob(urlParams.get("id"));
    // var location = decodeURIComponent(urlParams.get("location"));
    var params = new URLSearchParams(window.location.search);
    var ID = atob(params.get("id"));

    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById("seed").innerText = "Seed " + ID;
        
        // $.ajax({
        //     url: 'get-area',
        //     method: 'POST',
        //     data: {
        //         ID: ID
        //     },
        //     success: function(resp) {
        //         document.getElementById("location").innerText = "Area " + resp.Location;
        //     }
        // });
    });

//     $('.table').DataTable({
//     scrollCollapse: true,
//     autoWidth: false,
//     responsive: true,
//     columnDefs: [{
//         targets: "datatable-nosort",
//         orderable: false,
//     }],
//     "ajax": {
//         "url": "get-area", // Replace with the actual path to your server-side script
//         "type": "POST",
//         "data": {
//             "id": ID
//         },
//         "dataSrc": ""
//     },
//     "columns": [{
//             "data": null,
//             "render": function(data, type, row, meta) {
//                 return meta.row + 1;
//             }
//         },
//         {
//             "data": "ID"
//         },
//         {
//             "data": "Lot_Area"
//         }
//     ],
//     rowCallback: function(row, data, index) {
//         $(row).find("td").addClass('text-left');
//     },
//     "drawCallback": function(settings) {
//             // Calculate the sum of all lot areas
//         var totalLotArea = 0;
//         $('.table').DataTable().data().each(function(data) {
//             totalLotArea += parseFloat(data.Lot_Area);
//         });

//         // Convert to hectares if greater than 10000 square meters
//         if (totalLotArea > 10000) {
//             totalLotArea /= 10000; // Convert to hectares
//             $('#field_lot_area').html(totalLotArea.toFixed(2) + " ha");
//         } else {
//             $('#field_lot_area').html(totalLotArea.toFixed(2) + "m<sup>2</sup>");
//         }
//     }
// });
</script>

<?= $this->endSection() ?>