<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('admin', static function($routes){

    $routes->group('', ['filter'=>'cifilter:auth'], static function($routes){
        // $routes->view('example','example');
        $routes->get('home','AdminController::index',['as'=>'admin.home']);
        $routes->get('logout','AdminController::logoutHandler',['as'=>'admin.logout']);
        $routes->get('profile','AdminController::profile',['as'=>'admin.profile']);
        $routes->post('update-profile-details','AdminController::updateProfile',['as'=>'update-profile-details']);
        $routes->post('update-avatar','AdminController::updateAvatar',['as'=>'update-avatar']);
        $routes->post('change-pass','AdminController::changePassword',['as'=>'change-pass']);

        $routes->post('getTotals','AdminController::getTotals',['as'=>'getTotals']);
        $routes->post('harvestCrops','AdminController::harvestCrops',['as'=>'harvestCrops']);
        $routes->post('harvestCropsChart','AdminController::harvestCropsChart',['as'=>'harvestCropsChart']);
        $routes->post('crop-sales','AdminController::getCropSales',['as'=>'crop-sales']);
        $routes->post('crop-profit','AdminController::getProfit',['as'=>'crop-profit']);
        $routes->post('monthlySales','AdminController::getSales',['as'=>'monthlySales']);
        $routes->post('get-expenses','AdminController::getExpenses',['as'=>'get-expenses']);

        $routes->group('', static function($routes){
            //Field
            $routes->get('field','FieldController::index',['as'=>'field']);
            $routes->post('municipality','FieldController::municipality',['as'=>'municipality']);
            $routes->post('city','FieldController::city',['as'=>'city']);
            $routes->post('brgy','FieldController::barangay',['as'=>'brgy']);
            $routes->post('get-fields','FieldController::getFields',['as'=>'get-fields']);
            $routes->post('get-field','FieldController::getField',['as'=>'get-field']);
            $routes->post('modify-field','FieldController::modifyField',['as'=>'modify-field']);
            $routes->post('delete-field','FieldController::removeField',['as'=>'delete-field']);
            $routes->get('view-field','FieldController::viewField',['as'=>'view-field']);
            $routes->post('get-areas-by-field','FieldController::getAreaByField',['as'=>'get-areas-by-field']);
            //Area
            $routes->get('area','FieldController::area',['as'=>'area']);
            $routes->post('get-areas','FieldController::getAreas',['as'=>'get-areas']);
            $routes->post('get-area','FieldController::getArea',['as'=>'get-area']);
            $routes->post('modify-area','FieldController::modifyArea',['as'=>'modify-area']);
            $routes->post('delete-area','FieldController::removeArea',['as'=>'delete-area']);
            $routes->get('view-area','FieldController::viewArea',['as'=>'view-area']);
            $routes->post('get-areaName','FieldController::getAreaName',['as'=>'get-areaName']);
            $routes->post('get-Area-expenses','FieldController::getExpenses',['as'=>'get-Area-expenses']);
        });
        
        
        $routes->group('', static function($routes){
            //crops
            $routes->post('getAreaCrop','CropController::getAreaCrop',['as'=>'getAreaCrop']);
            $routes->post('getCropTotals','CropController::getCropTotals',['as'=>'getCropTotals']);
            $routes->get('crop','CropController::index',['as'=>'crop']);
            $routes->get('view-crop','CropController::viewCrop',['as'=>'view-crop']);
            $routes->post('get-crops','CropController::getCrops',['as'=>'get-crops']);
            $routes->post('get-crop','CropController::getCrop',['as'=>'get-crop']);
            $routes->post('get-price','CropController::getPrice',['as'=>'get-price']);
            $routes->post('modify-crops','CropController::modifyCrops',['as'=>'modify-crops']);
            $routes->post('delete-crop','CropController::removeCrop',['as'=>'delete-crop']);

            //seed
            // $routes->get('seed','CropController::seed',['as'=>'seed']);
            $routes->post('new-get-seeds','CropController::getSeeds',['as'=>'new-get-seeds']);
            $routes->post('new-get-seed','CropController::getSeed',['as'=>'new-get-seed']);
            // $routes->post('delete-seed','CropController::removeSeed',['as'=>'delete-seed']);
            // $routes->get('view-seed','CropController::viewSeed',['as'=>'view-seed']);

            //supplement
            $routes->get('supplement','CropController::supplement',['as'=>'supp']);
            $routes->get('view-supp','CropController::viewSupp',['as'=>'view-supp']);
            $routes->post('get-supps','CropController::getSupplement',['as'=>'get-supps']);
            $routes->post('supplement','Cropcontroller::supplements',['as'=>'supplement']);
            $routes->post('modify-supp','CropController::modifySupplement',['as'=>'modify-supp']);
            $routes->post('delete-supp','CropController::removeSupp',['as'=>'delete-supp']);

            //watering
            $routes->get('waterSched','CropController::waterSched',['as'=>'water']);
            $routes->post('get-sched','CropController::getwaterSched',['as'=>'get-sched']);
            $routes->post('modify-watering','CropController::modifyWatering',['as'=>'modify-watering']);
            $routes->post('delete-watering','CropController::removeWatering',['as'=>'delete-watering']);
        });
        
        $routes->group('', static function($routes){
            // fertilizer
            $routes->get('fertilizer','SetupController::index',['as'=>'fertilizer']);
            $routes->post('get-fertilizers','SetupController::getFertilizers',['as'=>'get-fertilizers']);
            $routes->post('get-fertilizer','SetupController::getFertilizer',['as'=>'get-fertilizer']);
            $routes->post('modify-fertilizer','SetupController::modifyFertilizer',['as'=>'modify-fertilizer']);
            $routes->post('delete-fertilizer','SetupController::removeFertilizer',['as'=>'delete-fertilizer']);
            $routes->post('set-fertilizer-photo','SetupController::updateFertPhoto',['as'=>'set-fertilizer-photo']);

            // insecticide
            $routes->get('insecticide','SetupController::insecticide',['as'=>'insecticide']);
            $routes->post('get-insecticides','SetupController::getInsecticides',['as'=>'get-insecticides']);
            $routes->post('get-insecticide','SetupController::getInsecticide',['as'=>'get-insecticide']);
            $routes->post('modify-insecticide','SetupController::modifyInsecticide',['as'=>'modify-insecticide']);
            $routes->post('delete-insecticide','SetupController::removeInsecticide',['as'=>'delete-insecticide']);
            $routes->post('set-insecticide-photo','SetupController::updateInsePhoto',['as'=>'set-insecticide-photo']);

            // seed
            $routes->get('seed','SetupController::seed',['as'=>'seed']);
            $routes->post('get-seeds','SetupController::getSeeds',['as'=>'get-seeds']);
            $routes->post('get-seed','SetupController::getSeed',['as'=>'get-seed']);
            $routes->get('view-seed','SetupController::viewSeed',['as'=>'view-seed']);
            $routes->post('modify-seed','SetupController::modifySeed',['as'=>'modify-seed']);
            $routes->post('delete-seed','SetupController::removeSeed',['as'=>'delete-seed']);
        });

        $routes->group('', static function($routes){
            //expenses
            $routes->get('expenses','TrackingController::index',['as'=>'expenses']);

            //sales
            $routes->get('sales','TrackingController::sales',['as'=>'sales']);
            $routes->post('get-sales','TrackingController::getSales',['as'=>'get-sales']);
            $routes->post('modify-sales','TrackingController::modifySales',['as'=>'modify-sales']);
            $routes->post('delete-sales','TrackingController::removeSales',['as'=>'delete-sales']);
        });
        
        $routes->group('', static function($routes){
            $routes->get('calendar','CalendarController::index',['as'=>'calendar']);
        });
        
        $routes->group('', static function($routes){
            //vendor
            $routes->get('vendor','HumanResourceController::index',['as'=>'vendor']);
            $routes->post('get-vendors','HumanResourceController::getVendors',['as'=>'get-vendors']);

            //worker
            $routes->get('worker','HumanResourceController::worker',['as'=>'worker']);
            $routes->post('get-workers','HumanResourceController::getWorkers',['as'=>'get-workers']);
        });

        $routes->group('', static function($routes){
            //planting
            $routes->get('smart_planting_guide','EducationalController::index',['as'=>'planting']);

            //fertilizer
            $routes->get('fertilizer_friend','EducationalController::fertilizer',['as'=>'fertilizer_friend']);

            //pest
            $routes->get('pest_control','EducationalController::pest',['as'=>'pest']);
        });
        
    });

    $routes->group('', ['filter'=>'cifilter:guest'], static function($routes){
        // $routes->view('login','login');
        $routes->get('login','AuthController::loginForm',['as'=>'admin.login.form']);
        $routes->post('login','AuthController::loginHandler',['as'=>'admin.login.handler']);

        // reset
        $routes->get('forgot-password','AuthController::forgotForm',['as'=>'admin.forgot.form']);
        $routes->post('send-password-reset-link','AuthController::sendPasswordResetLink',['as'=>'send-password-reset-link']);
        $routes->get('password/reset/(:any)','AuthController::resetPassword/$1',['as'=>'admin.reset-password']);
        $routes->post('reset-password-handler/(:any)','AuthController::resetPasswordHandler/$1',['as'=>'reset-password-handler']);

        // register
        $routes->get('register', 'AuthController::registrationForm', ['as'=>'register']);
        $routes->post('add_user', 'AuthController::addUser', ['as'=>'add_user']);
    });
});