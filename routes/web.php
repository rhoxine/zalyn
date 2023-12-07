<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ReviewController;

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


require __DIR__ . '/auth.php';


// Route::get('/', function () {
//     $data['user'] = Auth::user();
//     return view('user.home', $data);
// })->name('home');
Route::get('/', [ReviewController::class, 'post_web'])->name('home');
Route::get('/user/services', [ReviewController::class, 'post_services'])->name('services');
Route::get('/user/about', [ReviewController::class, 'post_about'])->name('about');
Route::get('/user/contact', [ReviewController::class, 'post_contact'])->name('contact');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
  

    Route::prefix('services')->middleware('role:Admin')->group(function () {
        Route::get('/', [ServicesController::class, 'index'])->name('admin.services');
        Route::get('/getallservices', [ServicesController::class, 'getallservices'])->name('services.getallservices');
        Route::post('/store', [ServicesController::class, 'store'])->name('services.store');
        Route::get('/edit/{id}', [ServicesController::class, 'edit'])->name('services.edit');
        Route::post('/update/{id}', [ServicesController::class, 'update'])->name('services.update');
        Route::get('/select/{id}', [ServicesController::class, 'select'])->name('services.select');
        Route::delete('/delete/{id}', [ServicesController::class, 'delete'])->name('services.delete');
    });

    Route::prefix('users')->middleware('role:Admin')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.users');
        Route::get('/getallusers', [UserController::class, 'getallusers'])->name('users.getallusers');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('users.update');
        Route::get('/select/{id}', [UserController::class, 'select'])->name('users.select');
        Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
        Route::get('/user/{id}/view', [UserController::class, 'view'])->name('user.view');
        
    });

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('admin.profile');
        Route::post('/changepass', [ProfileController::class, 'changepass'])->name('profile.changepass');
        Route::post('/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/getuser', [ProfileController::class, 'getuser'])->name('profile.getuser');
        Route::get('/getmedhistory', [ProfileController::class, 'getmedhistory'])->name('profile.getmedhistory');
        Route::post('/savemedhistory', [ProfileController::class, 'savemedhistory'])->name('profile.savemedhistory');
    });

    Route::prefix('appointment')->group(function () {
        Route::get('/pending', [AppointmentController::class, 'pending'])->name('appointment.pending');
        Route::get('/approved', [AppointmentController::class, 'approved'])->name('appointment.approved');
        Route::get('/canceled', [AppointmentController::class, 'canceled'])->name('appointment.canceled');
        Route::get('/completed', [AppointmentController::class, 'completed'])->name('appointment.completed');



        Route::get('/getallpending', [AppointmentController::class, 'getallpending'])->name('appointment.getallpending');
        Route::get('/getallapproved', [AppointmentController::class, 'getallapproved'])->name('appointment.getallapproved');
        Route::get('/getallcanceled', [AppointmentController::class, 'getallcanceled'])->name('appointment.getallcanceled');
        Route::get('/getallcompleted', [AppointmentController::class, 'getallcompleted'])->name('appointment.getallcompleted');

        Route::post('/store', [AppointmentController::class, 'store'])->name('appointment.store');
        Route::get('/select/{id}', [AppointmentController::class, 'select'])->name('appointment.select');
        Route::post('/approve/{id}', [AppointmentController::class, 'approve'])->name('appointment.approve');
        Route::post('/cancel/{id}', [AppointmentController::class, 'cancel'])->name('appointment.cancel');
        Route::post('/complete/{id}', [AppointmentController::class, 'complete'])->name('appointment.complete');
    });

    Route::get('/getservicesdata', [ServicesController::class, 'getservicesdata'])->name('services.getservicesdata');

    Route::get('/getappointmentcounts', [AppointmentController::class, 'getappointmentcounts'])->name('appointment.getappointmentcounts');

    Route::prefix('inventory')->group(function () {
        Route::get('/', [InventoryController::class, 'index'])->name('admin.inventory');


        Route::resource('products', InventoryController::class);
        // Route::get('/admin/report_generation', [InventoryController::class, 'reportGeneration'])->name('admin.inventory.filter');
        // Explicitly define routes for edit, update, and destroy actions
        Route::get('/products/{product}/view', [InventoryController::class, 'viewProduct'])->name('products.view');
        Route::get('/products/{product}/edit', [InventoryController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [InventoryController::class, 'update'])->name('products.update');
        Route::delete('/products/{products}', [InventoryController::class, 'destroy'])->name('products.destroy');
        // Route::put('/products/{product}', 'InventoryController@update')->name('products.update');
        Route::get('admin/generate-pdf', [InventoryController::class, 'generatePDF'])->name('admin.generate_pdf');


        //category
        Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::post('/categories', 'CategoryController@store')->name('categories.store');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        Route::resource('categories', CategoryController::class);

        Route::resource('products', InventoryController::class);
        //qty
        Route::get('admin/products/usedQuantities', 'InventoryController@usedQuantities')->name('admin.products.usedQuantities');
        // In your web.php file
        Route::get('/admin/products/{product}/used-quantity', 'InventoryController@getUsedQuantity')->name('products.getUsedQuantity');

        Route::post('/products/updateQuantity', [InventoryController::class, 'updateQuantity'])->name('admin.products.updQuantity');
    });
    Route::prefix('review')->group(function () {
        Route::get('/', [ReviewController::class, 'index'])->name('admin.review');
        Route::post('/store', [ReviewController::class, 'store'])->name('review.store');
        Route::get('/edit/{id}', [ReviewController::class, 'edit'])->name('review.edit');
        Route::put('/update/{review}', [ReviewController::class, 'update'])->name('review.update');
        Route::delete('/delete/{review}', [ReviewController::class, 'destroy'])->name('review.destroy');
    });
    Route::prefix('report')->group(function () {
        // For Inventory Report Generation
        Route::get('/inventory', [InventoryController::class, 'inventoryReportGeneration'])->name('admin.inv_report_generation');
        // web.php

        // GET route
        Route::get('/admin/report/appointments/filter', [AppointmentController::class, 'showFilterForm'])->name('appointments.filter.form');

        // POST route
        Route::post('/admin/report/appointments/filter', [AppointmentController::class, 'filterAppointments'])->name('appointments.filter');
    });
    Route::prefix('website')->group(function () {
        Route::get('/service_content', [WebsiteController::class, 'index'])->name('content.services.index');
        Route::post('/storeServices', [WebsiteController::class, 'services_store'])->name('content.services.store');
        Route::get('/getService', [WebsiteController::class, 'getservices']);
        Route::put('/update/{id}', [WebsiteController::class, 'serviceUpdate'])->name('contents.updateServices');
        Route::delete('/delete/{id}', [WebsiteController::class, 'destroy'])->name('services_destroy');
        Route::get('/footer', [WebsiteController::class, 'footerIndex'])->name('content.footer.index');
        Route::post('/addFooter', [WebsiteController::class, 'storeFooter'])->name('content.footer.store');
        Route::get('/footers/edit/{id}', [WebsiteController::class, 'editFooter'])->name('content.footer.edit');
        Route::put('/footers/update/{id}', [WebsiteController::class, 'updateFooter'])->name('content.footer.update');
        Route::post('/gallery/store', [WebsiteController::class, 'gallerystore'])->name('gallery.store');
        Route::put('/gallery/update/{id}', [WebsiteController::class, 'galleryupdate'])->name('gallery.update');
        Route::delete('/gallery/destroy/{id}', [WebsiteController::class, 'galleryDestroy'])->name('gallery.destroy');
    });
    Route::prefix('patient')->group(function (){
        Route::get('/', [PatientController::class, 'index'])->name('admin.patient_list');
        Route::get('users/profile/{id}', [PatientController::class, 'profile'])->name('users.profile');

    });
});
