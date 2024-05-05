<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title><?= isset($title) ? $title : ""?> Agrismart</title>

    <!-- Site favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/backend/images/ui/site_icon.png" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/backend/vendors/styles/core.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/backend/vendors/styles/icon-font.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/backend/vendors/styles/style.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('public/backend/vendors/sweetalert/sweet-alert.css') ?>">

    <?= $this->renderSection('stylesheets')?>
</head>
<style>
    :root{
        --green-font: #1B5E1F;
    }
    .login-page{
        background-image: url('/backend/images/ui/login_bg.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    .login-box{
        background-color: rgba(249, 245, 233,0.8);
    }
    .login-title h2,
    .forgot-password a,
    .register a
    {
        color: var(--green-font);
        font-weight: 700;
    }
    .btn-form input{
        background-color: var(--green-font);
        color: #fff;
    }

</style>
<body class="login-page">
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <?= $this->renderSection('content')?>
        </div>
    </div>
    <!-- js -->
    
    <script src="<?= base_url('public/backend/vendors/scripts/core.js') ?>"></script>
    <script src="<?= base_url('public/backend/vendors/scripts/script.min.js') ?>"></script>
    <script src="<?= base_url('public/backend/vendors/scripts/process.js') ?>"></script>
    <script src="<?= base_url('public/backend/vendors/scripts/layout-settings.js') ?>"></script>
    <script src="<?= base_url('public/backend/vendors/sweetalert/sweet-alert.min.js') ?>"></script>
    
    <?= $this->renderSection('scripts')?>
</body>

</html>