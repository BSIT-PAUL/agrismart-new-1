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
                        <a href="<?= base_url(route_to('admin.home'))?>" class="home-link">Home</a>
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
    <?php foreach ($fetch as $row): ?>
        <div class="col-lg-3 col-md-4 col-sm-12 mb-30">
            <div class="da-card">
                <div class="da-card-photo">
                    <div class="m-5">
                        <img src="<?= base_url('public/images/insecticides/' . $row['Picture']); ?>" style="border-radius: 100%;" alt="">
                    </div>
                    <div class="da-overlay da-slide-bottom">
                    <div class="da-social">
                            <ul class="clearfix">
                                <li>
                                    <p><?= $row['Description'] ?></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="da-card-content">
                    <h5 class="h5 mb-10"><?= $row['Insecticide'] ?></h5>
                    <p class="mb-0"><?= $row['ICurrent_Price'] ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>


<?= $this->endSection() ?>