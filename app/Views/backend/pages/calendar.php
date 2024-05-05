<?= $this->extend('backend/layout/base') ?>
<?= $this->section('content')?>

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Calendar Planner</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= route_to('admin.home')?>">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Calendar
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-2 col-sm-12">
        <div class="row">
            <div class="col-md-12 col-sm-12 my-1 ">
                <div class="card card-box">
                    <div class="text-center my-2">
                        <h5 style="color:rgba(255, 0, 0,0.7)">To do</h5>
                    </div>
                    <div class="card-body ">
                        <div style="height: 150px"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 my-1">
                <div class="card card-box">
                <div class="text-center my-2">
                        <h5 style="color:rgba(255, 0, 0,0.7)">Due Soon</h5>
                    </div>
                    <div class="card-body">
                        <div style="height: 150px"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-10 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="calendar-wrap">
                    <div id="calendar" class="fc fc-bootstrap4 fc-ltr">
                        <!-- This is where the calendar place -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- calendar modal -->
<div id="modal-view-event" class="modal modal-top fade calendar-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h4 class="h4">
                    <span class="event-icon weight-400 mr-3"></span><span class="event-title"></span>
                </h4>
                <div class="event-body"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<div id="modal-view-event-add" class="modal modal-top fade calendar-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="add-event">
                <div class="modal-body">
                    <h4 class="text-blue h4 mb-10">Add Event Detail</h4>
                    <div class="form-group">
                        <label>Event name</label>
                        <input type="text" class="form-control" name="ename">
                    </div>
                    <div class="form-group">
                        <label>Event Date</label>
                        <input type="text" class="datetimepicker form-control" name="edate">
                    </div>
                    <div class="form-group">
                        <label>Event Description</label>
                        <textarea class="form-control" name="edesc"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('stylesheets') ?>

<link rel="stylesheet" type="text/css" href="/backend/src/plugins/fullcalendar/fullcalendar.css" />

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script src="/backend/src/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="/backend/vendors/scripts/calendar-setting.js"></script>

<?= $this->endSection() ?>