<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title><?= isset($title) ? $title : ""?> AgriSmart Planner</title>

    <!-- Site favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('public/backend/images/ui/site_icon.png')?>" />

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- CSS -->

    <link rel="stylesheet" type="text/css" href="<?= base_url('public/backend/vendors/styles/core.css')?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/backend/vendors/styles/icon-font.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('public/backend/vendors/datatables/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('public/backend/vendors/datatables/dataTables.bootstrap5.css')?>">
    <link rel="stylesheet" href="<?= base_url('public/backend/vendors/toastr/toastr.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('public/backend/vendors/toastr/toastr.css')?>">
    <?= $this->renderSection('stylesheets')?>
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/backend/vendors/styles/style.css')?>">
    <link rel="stylesheet" href="<?= base_url('public/backend/vendors/sweetalert/sweet-alert.css')?>">
    <link rel="stylesheet" href="<?= base_url('public/extra-assets/ijaboCropTool/ijaboCropTool.min.css')?>">

</head>
<style>
:root {
    --green: #08a464;
    --light-green: #f0f4ec;
}

.left-side-bar {
    background-color: var(--green);
}

.activeTo {
    background: rgba(0, 0, 0, .4);
}

.dropdown-toggle:active .submenu {
    display: block !important;
}

/* Style the active menu item */
.menu-item.activeTo {
    background-color: rgba(0, 0, 0, 0.4);
}

.dropDownDisplay {
    display: block;
}

.header {
    background-color: var(--light-green);
}

.header .header-left .menu-icon {
    color: var(--green);
}

.left-side-bar .close-sidebar {
    color: #ffffff;
}

body {
    background-color: rgba(208, 208, 208, 0.8);
}

.menu-icon,
.header-right .user-notification .dropdown .dropdown-toggle,
.user-info-dropdown .dropdown .dropdown-toggle {
    color: #fff;
}
</style>

<body>
    <input type="hidden" name="User_ID" value="<?=get_user()->user_login_ID?>" id="userID" />
    <?php include('inc/topbar.php'); ?>


    <?php include('inc/left-sidebar.php'); ?>
    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div>
                    <?= $this->renderSection('content') ?>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="uni-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-top modal-lg">
            <form class="modal-content" action="" method="POST" id="modal_form">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Large modal
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    <?= $this->renderSection('modal_content') ?>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button> -->
                    <button type="submit" class="btn btn-primary action">
                        Save changes
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- <div class="modal fade bs-example-modal-lg" id="uni-modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" style="display: block;" aria-modal="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Large modal
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div> -->
    <!-- js -->

    <script src="<?= base_url('public/backend/vendors/scripts/core.js')?>"></script>
    <script src="<?= base_url('public/backend/vendors/scripts/script.min.js')?>"></script>
    <!-- <script src="<?= base_url('public/backend/vendors/scripts/process.js')?>"></script> -->
    <script src="<?= base_url('public/backend/vendors/scripts/layout-settings.js')?>"></script>
    <script src="<?= base_url('public/backend/vendors/sweetalert/sweet-alert.min.js')?>"></script>
    <script src="<?= base_url('public/backend/vendors/datatables/dataTables.js')?>"></script>
    <script src="<?= base_url('public/backend/vendors/datatables/dataTables.bootstrap5.js')?>"></script>
    <script src="<?= base_url('public/backend/vendors/toastr/toastr.min.js')?>"></script>
    <script src="<?= base_url('public/extra-assets/ijaboCropTool/ijaboCropTool.min.js')?>"></script>
    <script>
    toastr.options = {
        'progressBar': true,
    }
    </script>

    <script>
    $(document).ready(function() {
        // Restore the state of dropdown-toggle when the page loads
        $('.dropdown-toggle').each(function() {
            var dropdownId = $(this).attr('id');
            var optionState = localStorage.getItem(dropdownId);
            if (optionState === 'off') {
                $(this).siblings('.submenu').hide();
            }
        });
        // When a menu item is clicked
        $('.menu-item').on('click', function(e) {
            e.stopPropagation(); // Prevent event propagation to avoid closing the submenu when clicking on a menu item
            // e.preventDefault();
            $(this).closest('.submenu').removeAttr('style');
            $('.menu-item').removeClass('activeTo'); // Remove 'activeTo' class from all menu items
            $(this).addClass('activeTo');

            // Add dropDownDisplay class to the submenu associated with the clicked menu item
            var menuItemId = $(this).attr('id'); // Get the ID of the clicked menu item
            localStorage.setItem('activeMenuItem',
            menuItemId); // Store the ID of the clicked menu item in localStorage
        });

        // Restore the active menu item when the page loads
        var activeMenuItem = localStorage.getItem('activeMenuItem');
        if (activeMenuItem) {
            if(activeMenuItem == "remove"){
                $('.menu-item').removeClass('activeTo');
            }else{
                $('#' + activeMenuItem).addClass('activeTo');
                $('#' + activeMenuItem).closest('.submenu').toggle();
                $('#' + activeMenuItem).closest('.dropdown').addClass('show');
            }
            
        } 
        else {
        // If no activeMenuItem is set in localStorage, set the 'dashboard' menu item as active
            $('#dashboard-link').addClass('activeTo');
            localStorage.setItem('activeMenuItem', 'dashboard-link');
        }

        $('#profile').on('click', function(e) {
            // e.preventDefault(); // Prevent the default behavior of the link
            // e.stopPropagation(); // Prevent event propagation to avoid closing the dropdown when clicking on a dropdown item

            localStorage.setItem('activeMenuItem', 'remove');
            $('.menu-item').removeClass('activeTo');
            // localStorage.removeItem('activeMenuItem');
        });

        $('#logout').on('click', function(e) {
            // e.preventDefault(); // Prevent the default behavior of the link
            e.stopPropagation();
            
            localStorage.removeItem('activeMenuItem');
        });

        $('.home-link').on('click', function(e) {
        // e.preventDefault(); // Prevent default link behavior
        $('#dashboard-link').trigger('click'); // Trigger click event on 'dashboard-link'
        window.location.href = $(this).attr('href');
    });
    });

    

   
    </script>
    <?= $this->renderSection('scripts')?>
</body>

</html>