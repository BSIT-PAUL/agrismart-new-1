<?= $this->extend('backend/layout/base') ?>
<?= $this->section('content')?>
<div class="xs-pd-20-10 pd-ltr-20">
    <div class="title pb-20">
        <div class="d-flex flex-wrap justify-content-between align-items-center pb-0 pb-md-3">
            <h2 class="h3 mb-0">Dashboard</h2>
            <div class="form-group mb-md-0">
                <div class="dropdown bootstrap-select form-control form-control-sm">
                    <select class="form-control form-control-sm selectpicker" tabindex="-98" id="yr">
                        <option value="0">Reporting Year</option>
                        <?php foreach ($yr as $row): ?>
                            <option value="<?= $row['yr']?>"> Year <?= $row['yr']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row pb-10">
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark" id="totSales"></div>
                            <div class="font-14 text-secondary weight-500">
                            Total Sales
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#00eccf">
                                <i class="icon-copy fa fa-money"></i> <!-- Money icon -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark" id="totExpenses"></div>
                            <div class="font-14 text-secondary weight-500">
                                Total Expenses
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#ff5b5b">
                                <i class="icon-copy fa fa-calculator"></i> <!-- Calculator icon -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark" id="totProfit"></div>
                            <div class="font-14 text-secondary weight-500">
                                Total Profit
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon">
                                <i class="icon-copy fa fa-line-chart" data-color="#ffcc00" aria-hidden="true"></i> <!-- Line chart icon -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark" id="harvestCrops"></div>
                            <div class="font-14 text-secondary weight-500">
                                Harvest Crops
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon">
                                <i class="icon-copy fa fa-leaf" data-color="#339933" aria-hidden="true"></i> <!-- Leaf icon -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <div class="row pb-10">
        <div class="col-md-5" >
            <div class="card-box" style="position: relative">
                <div class="h5 pt-4 px-4">Harvested Crop Distribution</div>
                <!-- <div class="d-flex align-content-center align-content-center w-100"> -->
                    <div id="harvestCropsChart" style="min-height: 40px; margin-left: 10px;"></div>
                <!-- </div> -->
            </div>
        </div>
        <div class="col-md-7">
            <div class="card-box pd-20 mb-20" style="position: relative">
                <div class="h5 mb-md-0">Yearly Crop Metrics</div>
                <div id="areaChart" style="min-height: 350px;"></div>
            </div>
        </div>
        
    </div>
    
    <div class="row pb-10">
        <div class="col-md-7 mb-20" >
            <div class="card-box height-100-p pd-20" style="position: relative">
                <div class="h5 pt-4 px-4">Monthly Sales Trends</div>
                <!-- <div class="d-flex align-content-center align-content-center w-100"> -->
                <div id="line" style="min-height: 315px;"></div>
                <!-- </div> -->
            </div>
        </div>
        <div class="col-md-5 mb-20">
            <div class="card-box pd-20" style="position: relative">
                <div class="h5 pt-4 px-4">Expenses Overview</div>
                <div class="table-responsive" >
                    <table class="table table-sm table-borderless table-hover table-stripe" style="min-height: 215px;" id="dashboardTable">
                        <thead>
                            <tr>
                                <th class="text-left" scope="col">#</th>
                                <th class="text-left" scope="col">Type</th>
                                <th class="text-left" scope="col">Product</th>
                                <th class="text-left" scope="col">Price</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        
</div>

    <!-- <div class="row">
        <div class="col-lg-4 col-md-6 mb-20">
            <div class="card-box height-100-p pd-20 min-height-200px">
                <div class="d-flex justify-content-between pb-10">
                    <div class="h5 mb-0">--content---</div>
                    <div class="dropdown">
                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" data-color="#1b3133"
                            href="#" role="button" data-toggle="dropdown">
                            <i class="dw dw-more"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                            <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                            <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                        </div>
                    </div>
                </div>
                <div class="user-list">
                     <ul>
                        <li class="d-flex align-items-center justify-content-between">
                            <div class="name-avatar d-flex align-items-center pr-2">
                                <div class="avatar mr-2 flex-shrink-0">
                                    <img src="/backend/vendors/images/photo1.jpg" class="border-radius-100 box-shadow"
                                        width="50" height="50" alt="" />
                                </div>
                                <div class="txt">
                                    <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5"
                                        data-color="#265ed7">4.9</span>
                                    <div class="font-14 weight-600">Dr. Neil Wagner</div>
                                    <div class="font-12 weight-500" data-color="#b2b1b6">
                                        Pediatrician
                                    </div>
                                </div>
                            </div>
                            <div class="cta flex-shrink-0">
                                <a href="#" class="btn btn-sm btn-outline-primary">Schedule</a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center justify-content-between">
                            <div class="name-avatar d-flex align-items-center pr-2">
                                <div class="avatar mr-2 flex-shrink-0">
                                    <img src="/backend/vendors/images/photo2.jpg" class="border-radius-100 box-shadow"
                                        width="50" height="50" alt="" />
                                </div>
                                <div class="txt">
                                    <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5"
                                        data-color="#265ed7">4.9</span>
                                    <div class="font-14 weight-600">Dr. Ren Delan</div>
                                    <div class="font-12 weight-500" data-color="#b2b1b6">
                                        Pediatrician
                                    </div>
                                </div>
                            </div>
                            <div class="cta flex-shrink-0">
                                <a href="#" class="btn btn-sm btn-outline-primary">Schedule</a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center justify-content-between">
                            <div class="name-avatar d-flex align-items-center pr-2">
                                <div class="avatar mr-2 flex-shrink-0">
                                    <img src="/backend/vendors/images/photo3.jpg" class="border-radius-100 box-shadow"
                                        width="50" height="50" alt="" />
                                </div>
                                <div class="txt">
                                    <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5"
                                        data-color="#265ed7">4.9</span>
                                    <div class="font-14 weight-600">Dr. Garrett Kincy</div>
                                    <div class="font-12 weight-500" data-color="#b2b1b6">
                                        Pediatrician
                                    </div>
                                </div>
                            </div>
                            <div class="cta flex-shrink-0">
                                <a href="#" class="btn btn-sm btn-outline-primary">Schedule</a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center justify-content-between">
                            <div class="name-avatar d-flex align-items-center pr-2">
                                <div class="avatar mr-2 flex-shrink-0">
                                    <img src="/backend/vendors/images/photo4.jpg" class="border-radius-100 box-shadow"
                                        width="50" height="50" alt="" />
                                </div>
                                <div class="txt">
                                    <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5"
                                        data-color="#265ed7">4.9</span>
                                    <div class="font-14 weight-600">Dr. Callie Reed</div>
                                    <div class="font-12 weight-500" data-color="#b2b1b6">
                                        Pediatrician
                                    </div>
                                </div>
                            </div>
                            <div class="cta flex-shrink-0">
                                <a href="#" class="btn btn-sm btn-outline-primary">Schedule</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-20">
            <div class="card-box height-100-p pd-20 min-height-200px">
                <div class="d-flex justify-content-between">
                    <div class="h5 mb-0">---content---</div>
                    <div class="dropdown">
                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" data-color="#1b3133"
                            href="#" role="button" data-toggle="dropdown">
                            <i class="dw dw-more"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                            <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                            <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                        </div>
                    </div>
                </div>

                <div id="diseases-chart"></div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 mb-20">
            <div class="card-box height-100-p pd-20 min-height-200px">
                <div class="d-flex justify-content-between">
                    <div class="h5 mb-0">---content---</div>
                    <div class="dropdown">
                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" data-color="#1b3133"
                            href="#" role="button" data-toggle="dropdown">
                            <i class="dw dw-more"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                            <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                            <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                        </div>
                    </div>
                </div>

                <div id="diseases-chart"></div>
            </div>
        </div>
    </div> -->



    <!-- <div class="title pb-20 pt-20">
        <h2 class="h3 mb-0">---Content---</h2>
    </div> -->

    <!-- <div class="row">
        <div class="col-md-4 mb-20">
            <a href="#" class="card-box d-block mx-auto pd-20 text-secondary">
                <div class="img pb-30">
                <img src="/backend/images/ui/4.png" alt="" />
                </div>
                <div class="content">
                    <h3 class="h4">---Content---</h3>
                    <p class="max-width-200">
                    ---Description---
                    </p>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-20">
            <a href="#" class="card-box d-block mx-auto pd-20 text-secondary">
                <div class="img pb-30">
                    <img src="/backend/images/ui/4.png" alt="" />
                </div>
                <div class="content">
                    <h3 class="h4">---Content---</h3>
                    <p class="max-width-200">
                    ---Description---
                    </p>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-20">
            <a href="#" class="card-box d-block mx-auto pd-20 text-secondary">
                <div class="img pb-30">
                <img src="/backend/images/ui/4.png" alt="" />
                </div>
                <div class="content">
                    <h3 class="h4">---Content---</h3>
                    <p class="max-width-200">
                    ---Description---
                    </p>
                </div>
            </a>
        </div>
    </div> -->
</div>

<?= $this->endSection() ?>

<?= $this->section('stylesheets') ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script src="<?= base_url('public/backend/src/plugins/apexcharts/apexcharts.min.js')?>"></script>
<!-- <script src="/backend/vendors/scripts/dashboard3.js"></script> -->
<script src="<?= base_url('public/backend/src/viewScripts/home/charts.js')?>"></script>
<script src="<?= base_url('public/backend/src/viewScripts/home/home.js')?>"></script>

<script>
    // $('#dashboardTable').DataTable().destroy();
    function tables(year = 0){
        $('#dashboardTable').DataTable().destroy();
        $('#dashboardTable').DataTable({
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            paging: true, // Enable paging
            pageLength: 5,
            searching: false,
            // lengthMenu: [5,10,15,20],
            lengthChange: false,
            columnDefs: [{
                targets: "datatable-nosort",
                orderable: false,
            }],
            "ajax": {
                "url": "get-expenses",
                "type": "POST",
                "dataSrc": "",
                "data": {
                yr: year
                }
            },
            "columns": [{
                "data": null,
                    "render": function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    "data": 'type'
                },
                {
                    "data": "item"
                },
                {
                    "data": "Formatted_totAmount",
                }
            ]
        });
        // $('#dashboardTable').DataTable().destroy();
    }
    tables();

    $('#yr').on('change', function(e){
        e.preventDefault();
        let year = $(this).val();
        tables(year);
    });
</script>
<?= $this->endSection() ?>