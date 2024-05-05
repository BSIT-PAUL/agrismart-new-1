<?= $this->extend('backend/layout/base') ?>
<?= $this->section('content')?>

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Fertilizer Friend</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url(route_to('admin.home'))?>" class="home-link">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Fertilizer Friend
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="row clearfix">
    <?php foreach ($fetch as $row): ?>
        <div class="col-lg-3 col-md-3 col-sm-12 mb-30">
            <div class="da-card">
                <div class="da-card-photo">
                    <div class="m-5">
                        <img src="<?= base_url('public/images/fertilizers/' . $row['Picture']); ?>" style="border-radius: 100%;" alt="">
                    </div>
                </div>
                <div class="da-card-content">
                    <h5 class="h5 mb-10 text-center"><?= $row['Fertilizer'] ?></h5>
                    <p><?= $row['Description'] ?></p>
                    <p class="mb-0"><?= $row['FCurrent_Price'] ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>