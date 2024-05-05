<?= $this->extend('backend/layout/base') ?>
<?= $this->section('content')?>

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Pest Control</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= route_to('admin.home')?>">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Pest Control
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
        <div class="da-card">
            <div class="da-card-photo">
                <img src="/backend/images/ui/1.png" alt="">
                <div class="da-overlay">
                    <div class="da-social">
                        <ul class="clearfix">
                            <li>
                                <p>---Description--</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="da-card-content">
                <h5 class="h5 mb-10">---Content---</h5>
                <p class="mb-0">---Description---</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
        <div class="da-card">
            <div class="da-card-photo">
                <img src="/backend/images/ui/1.png" alt="">
                <div class="da-overlay">
                    <div class="da-social">
                        <ul class="clearfix">
                            <li>
                                <p>---Description--</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="da-card-content">
                <h5 class="h5 mb-10">---Content---</h5>
                <p class="mb-0">---Description---</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
        <div class="da-card">
            <div class="da-card-photo">
                <img src="/backend/images/ui/1.png" alt="">
                <div class="da-overlay">
                    <div class="da-social">
                        <ul class="clearfix">
                            <li>
                                <p>---Description--</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="da-card-content">
                <h5 class="h5 mb-10">---Content---</h5>
                <p class="mb-0">---Description---</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
        <div class="da-card">
            <div class="da-card-photo">
                <img src="/backend/images/ui/1.png" alt="">
                <div class="da-overlay">
                    <div class="da-social">
                        <ul class="clearfix">
                            <li>
                                <p>---Description--</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="da-card-content">
                <h5 class="h5 mb-10">---Content---</h5>
                <p class="mb-0">---Description---</p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>