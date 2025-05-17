<?php


use App\Http\Controllers\Backend\IntroStepController;
use App\Http\Controllers\Backend\LabelController;
use App\Http\Controllers\Backend\PartnerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Backend\FormController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\CompanyController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\Auth\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PageConfigController;
use App\Http\Controllers\Backend\SupportPolicyController;
use App\Http\Controllers\Backend\SupportController;
use App\Models\PageConfig;

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

Route::prefix('admin')->name('admin.')->group(function () {

    route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'login'])->name('login');

        Route::post('login', [AuthController::class, 'authenticate']);
    });

    Route::prefix('intro-steps')->name('intro-steps.')->group(function () {
        Route::get('/', [IntroStepController::class, 'save'])->name('save');
        Route::post('/', [IntroStepController::class, 'update'])->name('update');
    });

    route::middleware('auth')->group(function () {
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/', [DashboardController::class, 'index'])->name('index');

        Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web']], function () {
            \UniSharp\LaravelFilemanager\Lfm::routes();
        });

            Route::prefix('partners')->name('partners.')->group(function () {
                Route::get('/', [PartnerController::class, 'index'])->name('index');
                Route::post('save/{id?}', [PartnerController::class, 'save'])->name('save');
                Route::get('edit/{id}', [PartnerController::class, 'edit'])->name('edit');
                Route::post('update-status', [PartnerController::class, 'updateStatus'])->name('update-status');
                Route::delete('delete/{id}', [PartnerController::class, 'delete'])->name('delete');
                Route::post('update-locations', [PartnerController::class, 'updateLocations'])->name('update-locations');
            });

        Route::group(['prefix' => 'labels', 'controller' => LabelController::class, 'as' => 'labels.'], function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::put('update/{id}', 'update')->name('update');
            Route::delete('destroy/{id}', 'destroy')->name('destroy');
            Route::post('update-status', 'updateStatus')->name('update.status');
        });

        Route::prefix('/company')->name('company.')->group(function () {
            Route::get('/', [CompanyController::class, 'index'])->name('index');
            Route::get('/search', [CompanyController::class, 'search'])->name('search');
            Route::delete('/delete/{id}', [CompanyController::class, 'delete'])->name('delete');
            Route::post('/update/{id}', [CompanyController::class, 'update'])->name('update');
            Route::post('/store', [CompanyController::class, 'store'])->name('store');
            Route::get('/detail/{id}', [CompanyController::class, 'detail'])->name('detail');
        });

        Route::prefix('category')->name('category.')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('create', [CategoryController::class, 'create'])->name('create');
            Route::post('store', [CategoryController::class, 'store'])->name('store');
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [CategoryController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [CategoryController::class, 'destroy'])->name('destroy');
            Route::post('update-status', [CategoryController::class, 'updateCategoryStatus'])->name('updateStatus');
        });

        route::controller(ContactController::class)->group(function () {
            route::get('contact', 'show')->name('contact.show');
            route::post('contact', 'update')->name('contact.update');
        });

        Route::prefix('supports')->controller(SupportController::class)->group(function () {
            Route::get('/', 'index')->name('supports.index');
            Route::get('create', 'create')->name('supports.create');
            Route::post('store', 'store')->name('supports.store');
            Route::get('edit/{id}', 'edit')->name('supports.edit');
            Route::put('update/{id}', 'update')->name('supports.update');
            Route::delete('destroy/{id}', 'destroy')->name('supports.destroy');
        });

        Route::prefix('/support-policy')->name('supportPolicy.')->group(function () {
            Route::get('/', [SupportPolicyController::class, 'index'])->name('index');
            Route::get('/search', [SupportPolicyController::class, 'search'])->name('search');
            Route::delete('/delete/{id}', [SupportPolicyController::class, 'delete'])->name('delete');
            Route::post('/update/{id}', [SupportPolicyController::class, 'update'])->name('update');
            Route::post('/store', [SupportPolicyController::class, 'store'])->name('store');
            Route::get('/detail/{id}', [SupportPolicyController::class, 'detail'])->name('detail');
        });

        // BANNER ROUTE
        Route::controller(SliderController::class)->name('slider.')->group(function () {
            Route::get('sliders', 'index')->name('index');
            Route::get('sliders/create', 'create')->name('create');
            Route::post('sliders/store', 'save')->name('store');
        });

        // NEWS ROUTE
        Route::resource('news', NewsController::class);
        Route::post('news/change-status', [NewsController::class, 'changeStatus'])->name('news.change-status');

        Route::prefix('/product')->name('product.')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/search', [ProductController::class, 'search'])->name('search');
            Route::delete('/delete/{id}', [ProductController::class, 'delete'])->name('delete');
            Route::post('/update/{id}', [ProductController::class, 'update'])->name('update');
            Route::post('/store', [ProductController::class, 'store'])->name('store');
            Route::get('/detail/{id}', [ProductController::class, 'detail'])->name('detail');
            Route::get('/add', [ProductController::class, 'add'])->name('add');
            route::post('delete-image/{id}', [ProductController::class, 'deleteImage'])->name('delete-image');
            route::post('change-status', [ProductController::class, 'changeStatus'])->name('change.status');
            route::post('update-display-position', [ProductController::class, 'updateDisplayPosition'])->name('updateDisplayPosition');
            Route::get('products/search', [ProductController::class, 'search'])->name('products.search');
        });

        Route::prefix('page-config')->name('pageConfig.')->group(function () {
            Route::get('', [PageConfigController::class, 'index'])->name('index');
            Route::get('add', [PageConfigController::class, 'add'])->name('add');
            Route::post('store', [PageConfigController::class, 'store'])->name('store');
            Route::get('detail/{id}', [PageConfigController::class, 'edit'])->name('detail');
            Route::post('update/{id}', [PageConfigController::class, 'update'])->name('update');
            Route::delete('delete/{id}', [PageConfigController::class, 'delete'])->name('delete');
        });

        // FORM ROUTE
        Route::controller(FormController::class)->group(function () {
            Route::get('form', 'index')->name('form.index');
            Route::post('form', 'updateEmail');
            Route::delete('form/{form}', 'destroy')->name('form.destroy');
        });
    });
});

Route::post('upload', function (Request $request) {
    if ($request->hasFile('upload')) {
        $image = $request->file('upload');
        $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
        Storage::disk('public')->put('images' . '/' . $filename, file_get_contents($image->getPathName()));
        $path = 'images' . '/' . $filename;
        $url = Storage::url($path);
        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        $msg = 'Image uploaded successfully';

        return "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg');</script>";
    }
})->name('ckeditor.upload');

route::get('filemanager-browse', function () {

    $paths = glob(public_path('storage/images/*'));

    $fileName = [];

    foreach ($paths as $path) {
        $fileName[] = basename($path);
    }
    return view('filemanager-browse', compact('fileName'));
})->name('filemanager.browse');
