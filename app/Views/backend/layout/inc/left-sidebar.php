

<div class="left-side-bar">
    <div class="brand-logo">
        <a href="#" class="mt-3">
            <img src="/backend/images/ui/admin-logo.png" alt="" class="light-logo" />
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            
            <ul id="accordion-menu">
                <li>
                    <a href="<?= base_url(route_to('admin.home'))?>" class="dropdown-toggle no-arrow menu-item" id="dashboard-link">
                        <span class="micon bi bi-house"></span><span class="mtext">Dashboard</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-textarea-resize"></span><span class="mtext">Field Management</span>
                    </a>
                    <ul class="submenu">
                        <li><a class="menu-item" id="field-link" href="<?= base_url(route_to('field'))?>">Field</a></li>
                        <li><a class="menu-item" id="area-link"href="<?= base_url(route_to('area'))?>">Area</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-table"></span><span class="mtext">Crop Management</span>
                    </a>
                    <ul class="submenu">
                        <li><a class="menu-item" id="crop-link" href="<?= base_url(route_to('crop'))?>">Crop</a></li>
                        <li><a class="menu-item" id="supp-link" href="<?= base_url(route_to('supp'))?>">Supplements</a></li>
                        <li><a class="menu-item" id="water-link" href="<?= base_url(route_to('water'))?>">Water Schedule</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-table"></span><span class="mtext">Farm Setup</span>
                    </a>
                    <ul class="submenu">
                        <li><a class="menu-item" id="seed-link" href="<?= base_url(route_to('seed'))?>">Seed</a></li>
                        <li><a class="menu-item" id="fert-link" href="<?= base_url(route_to('fertilizer'))?>">Fertilizer</a></li>
                        <li><a class="menu-item" id="insect-link" href="<?= base_url(route_to('insecticide'))?>">Insectecide</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-archive"></span><span class="mtext"> Educational </span>
                    </a>
                    <ul class="submenu">
                        <li><a class="menu-item" id="friend-link" href="<?= base_url(route_to('fertilizer_friend'))?>">Fertilizer Friend</a></li>
                        <li><a class="menu-item" id="pest-link" href="<?= base_url(route_to('pest'))?>">Pest Control</a></li>
                    </ul>
                </li>
                <!-- <li class="dropdown">
                     <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-command"></span><span class="mtext">Human Resource</span>
                    </a>
                    <ul class="submenu">
                        <li><a class="menu-item" id="worker-link" href="<?= base_url(route_to('worker'))?>">Worker</a></li>
                        <li><a class="menu-item" id="vendor-link" href="<?= base_url(route_to('vendor'))?>">Vendor</a></li>
                    </ul>
                </li> -->
                <!-- <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-command"></span><span class="mtext">Tracking</span>
                    </a>
                    <ul class="submenu">
                        <li><a class="menu-item" id="exp-link" href="<?= base_url(route_to('expenses'))?>">Expenses</a></li>
                        <li><a class="menu-item" id="sales-link" href="<?= base_url(route_to('sales'))?>">Sales</a></li>
                    </ul>
                </li> -->
                <li >
                    <a href="<?= base_url(route_to('sales'))?>" class="dropdown-toggle no-arrow menu-item" id="calendar-link">
                        <span class="micon bi bi-receipt-cutoff"></span><span class="mtext">Sales</span>
                    </a>
                </li>
                <!-- <li >
                    <a href="<?= base_url(route_to('calendar'))?>" class="dropdown-toggle no-arrow menu-item" id="calendar-link">
                        <span class="micon bi bi-receipt-cutoff"></span><span class="mtext">Calendar Planner</span>
                    </a>
                </li> -->
            </ul>
        </div>
    </div>
</div>