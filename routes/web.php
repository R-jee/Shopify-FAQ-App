<?php

use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\ThemePublishController;
use App\Http\Controllers\WebhookJobsController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/index', function () {
    return view('index');
});
Route::get('/p1/database-queue-driver', function () {
    Artisan::call('queue:table');
    Artisan::call('migrate');
    return "Database queue driver Creation has been done.";
});
Route::get('/p1/plans-seeders', function () {
    Artisan::call('db:seed  --class=PlanSeeder');
    return "Seeder Creation has been done.";
});
Route::get('/p1/custom-billable/setup', function () {
    Artisan::call('make:seeder PlanSeeder');
    Artisan::call('make:middleware CustomBillable');
    return "Bilable Middleware Creation has been done.";
});
Route::get('/p1/custom-billable/seeder', function () {
    Artisan::call('db:seed --class=PlanSeeder');
    return "PlanSeeder Creation has been done.";
});
Route::get('/configuration2', function () {
    return view('configuration2');
});

//////////////////////////
Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
//Route::get('/', function () { return view('welcome'); })->middleware(['verify.shopify'])->name('home');

Route::middleware(['verify.shopify'])->group(function () {
    Route::get('', [WebhookJobsController::class, 'checkWebHooks'])->name('home')->middleware(['custom.billable']);
    Route::get('configuration', [ConfigurationController::class, 'index'])->name('configuration')->middleware(['custom.billable']);
    Route::any('save_configuration', [ConfigurationController::class,'saveConfigurationSettings'])->name('save_configuration');

    Route::get('login', function () { return view('login'); })->name('login');
    Route::get('create-webhooks', [WebhookJobsController::class, 'createAllWebhooks'])->name('create_webhooks');
    Route::get('get-webhooks', [WebhookJobsController::class, 'getAllWebhooks'])->name('get_webhooks');
    Route::get('get-script-tags', [WebhookJobsController::class, 'getAllScriptTags'])->name('get_script_tags');
    Route::get('delete-webhooks', [WebhookJobsController::class, 'deleteAllWebhooks'])->name('delete_webhooks');
    Route::get('get-theme-id', [ThemePublishController::class, 'getthemeid'])->name('getthemeid');
    Route::get('store-previoustheme-id', [ConfigurationController::class, 'storepreviousthemeid'])->name('storeprevioustheme_id');

    // Route::get('/billing/{plan?}',[BillingController::class,'index'] )->where('plan', '^([0-9]+|)$')->name(Util::getShopifyConfig('route_names.billing'));
    /* to show all billing plans */
    Route::get('plans', [ConfigurationController::class, 'getAllPlans'])->name('plans');
    /* to get free plan */
    Route::get('free-plan', [ConfigurationController::class , 'freePlan'])->name('free.plan');
    /* to get selected plan */
    Route::get('selected_plan', [ConfigurationController::class, 'userSelectedPlan'])->name('selected.plan');
    Route::get('enable_module', [ConfigurationController::class, 'enableModule'])->name('enable.module');
    Route::get('get_file_json', [ConfigurationController::class, 'getFileJson'])->name('get.file_json');
    Route::get('/setting', [ConfigurationController::class , 'settingPage'])->name('settings');

    Route::get('/push-faq-schema-on-store', [ConfigurationController::class , 'pushFAQSchemaOnStore'])->name('push_faq_schema_on_store');

});

Route::get('handle-themePublishWebhook-request', [WebhookJobsController::class, 'handleThemePublishWebhookRequest'])->name('handle-themePublishWebhook-request');
Route::get('handle-asset-created-onAppInstalled-Or-themeChanged-request', [WebhookJobsController::class, 'AssetCreatedOnAppInstalledOrThemeChangedRequest'])->name('handle-asset-created-onAppInstalled-Or-themeChanged-request');
Route::get('handle-create-scriptTagCallback-request', [WebhookJobsController::class, 'createScriptTagCallback'])->name('handle-create-scriptTagCallback-request');

/* For Debuging purpose */
Route::get('logs-clear', function () {
    Artisan::call('logs:clear');
    return "Log File is cleared";
});
Route::get('clear-cache', function () {
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('optimize:clear');
    Artisan::call('schedule:clear-cache');
    return "Cache is cleared";
});
Route::get('optimize', function () {
    Artisan::call('optimize:clear');
    Artisan::call('optimize');
});
Route::get('fresh-migrate', function () {
    Artisan::call('migrate:fresh');
    return "Migrated is fresh created";
});
Route::get('migrate', function () {
    Artisan::call('migrate');
    return "Migrated is created";
});
Route::get('refresh-migrate', function () {
    Artisan::call('migrate:refresh');
    return "Migrated is fresh created";
});
Route::get('queue-work', function () {
    Artisan::call('queue:work');
    return "queue-work is fresh created";
});


