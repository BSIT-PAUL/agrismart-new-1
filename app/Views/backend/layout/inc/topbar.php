<div class="header">
    <div class="header-left">
        <div class="menu-icon bi bi-list"></div>
    </div>
    <div class="header-right">
        <!-- <div class="dashboard-setting user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
                    <i class="dw dw-settings2"></i>
                </a>
            </div>
        </div> -->
        <!-- <div class="user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown"  data-color="black">
                    <i class="icon-copy dw dw-notification"></i>
                    <span class="badge notification-active"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="notification-list mx-h-350 customscroll">
                        <ul>
                            <li>
                                <a href="#">
                                    <img src="/backend/images/ui/circle-exclamation-solid.svg" alt="" />
                                    <h3>Alert</h3>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit, sed...
                                    </p>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/backend/images/ui/circle-exclamation-solid.svg" alt="" />
                                    <h3>Alert</h3>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit, sed...
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="user-info-dropdown">
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"  data-color="black">
                    <span class="user-icon">
                        <img src="<?= get_user()->Profile == null ?  base_url('public/images/users/default-avatar.jpg') : base_url('public/images/users/'.get_user()->Profile) ?>"" alt="" class="avatar-photo" />
                    </span>
                    <span class="userName"><?= get_user()->fname == null ?  'null' : get_user()->fname ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    <a id="profile" class="dropdown-item" href="<?= base_url(route_to('admin.profile'))?>"><i class="dw dw-user1"></i> Profile</a>
                    <!-- <a class="dropdown-item" href="profile.html"><i class="dw dw-settings2"></i> Setting</a> -->
                    <a id="logout" class="dropdown-item" href="<?= base_url(route_to('admin.logout'))?>"><i class="dw dw-logout"></i> Log Out</a>
                </div>
            </div>
        </div>
    </div>
</div>
