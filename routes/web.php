<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routess
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


    // Route::get('home', function () {
    //     return view('home');
    // })->name('welcome');


    Auth::routes();
    Route::post('signup', [App\Http\Controllers\AuthController::class, 'signup'])->name('signup');
    Route::post('login', [App\Http\Controllers\AuthController::class, 'signin'])->name('signin');
    Route::post('ckeditor', [App\Http\Controllers\CkeditorController::class, 'upload'])->name('ckeditor.upload');
 
    // site pages
    Route::controller(App\Http\Controllers\Web\PageController::class)->group( function () {
        
        Route::get('/',  'home')->name('home');
        Route::get('about-us',  'about')->name('about');
        Route::get('contact-us',  'contact')->name('contact');
        Route::post('contact-us', 'store_contacts_data')->name('contact.data');
        Route::get('faqs',  'faq')->name('help');
        Route::get('terms',  'terms')->name('terms');
        Route::get('privacy-policy',  'policy')->name('policy');
        Route::get('statement',  'statement')->name('statement');

        // tasks
        Route::get('tasks',  'tasks')->name('tasks.list');
        Route::get('task/{id}',  'show_task')->name('single.task');

        // lawyers
        Route::get('lawyers',  'lawyers')->name('lawyers.list');

        // articles
        Route::get('articles',  'articles')->name('articles.list');
        Route::get('article/{id}',  'show_article')->name('single.article');

        // sos
        Route::get('distresses',  'distresses')->name('sos.list');
        Route::get('distress/{id}',  'show_distress')->name('single.sos');
        
    });

    // Admin Route
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){

        
        Route::get('login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login');
        Route::post('postLogin', [App\Http\Controllers\Admin\AuthController::class, 'postLogin'])->name('postLogin');
        Route::post('logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

        Route::group(['middleware' => ['auth:admin', 'permissionHandler']], function () {

            Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

            Route::resource('admins', App\Http\Controllers\Admin\AdminController::class);
            Route::resource('roles', App\Http\Controllers\Admin\RoleController::class);
            Route::get('updatePermissions', [App\Http\Controllers\Admin\RoleController::class, 'updatePermissions'])->name('roles.updatePermissions');

            Route::resource('lawyers', App\Http\Controllers\Admin\LawyerController::class)->except('create', 'edit', 'update');
            Route::resource('clients', App\Http\Controllers\Admin\ClientController::class)->except('create', 'edit', 'update');
            Route::post('activateLawyer/{id}', [App\Http\Controllers\Admin\LawyerController::class, 'activate'])->name('lawyers.activate');
            Route::get('/lawyers-active', [App\Http\Controllers\Admin\LawyerController::class, 'index_active'])->name('lawyers.active');
            Route::get('/lawyers-notactive', [App\Http\Controllers\Admin\LawyerController::class, 'index_not_active'])->name('lawyers.notactive');

            Route::resource('articles', App\Http\Controllers\Admin\ArticleController::class);
            Route::get('articles/activate/{id}', [App\Http\Controllers\Admin\ArticleController::class, 'activate'])->name('article.activate');

            Route::resource('announcements', App\Http\Controllers\Admin\AnnouncementController::class);
            Route::resource('distresses', App\Http\Controllers\Admin\DistressController::class)->except('show', 'edit', 'update');
            Route::resource('news', App\Http\Controllers\Admin\NewsController::class);
            Route::resource('consultations', App\Http\Controllers\Admin\ConsultationController::class)->except('create', 'show');
            Route::resource('taxes', App\Http\Controllers\Admin\TaxController::class)->except('create', 'show');

            Route::resource('tasks', App\Http\Controllers\Admin\TaskController::class)->except('edit', 'create', 'distroy');
            Route::post('tasks/{task_id}/{user_id}/{assigner_id}', [App\Http\Controllers\Admin\TaskController::class, 'admin_assign'])->name('assign.user');
            Route::post('tasks/finish/{task_id}', [App\Http\Controllers\Admin\TaskController::class, 'admin_complete_task'])->name('tasks.complete');

            Route::resource('pages', App\Http\Controllers\Admin\PageController::class)->except('show');
            // Route::post('pages/store/{id}', [App\Http\Controllers\Admin\PageController::class, 'store'])->name('pages.store');
            // Route::patch('pages/update-field/{id}', [App\Http\Controllers\Admin\PageController::class, 'update_section'])->name('pages.update-field');
            // Route::get('pages/show-specific/{string}', [App\Http\Controllers\Admin\PageController::class, 'show_specific'])->name('pages.show-specific');

            Route::resource('settings', App\Http\Controllers\Admin\SettingsController::class)->except('show', 'store', 'create', 'destroy');
            Route::post('update-info', [App\Http\Controllers\Admin\SettingsController::class, 'updateInfo'])->name('update.info');

            Route::get('chats', [App\Http\Controllers\Admin\ChatController::class, 'index'])->name('chats.index');
            Route::get('chats/{chat_id}', [App\Http\Controllers\Admin\ChatController::class, 'show'])->name('chats.show');

            Route::resource('transactions', App\Http\Controllers\Admin\TransactionController::class)->except('show', 'store', 'create', 'destroy');

            Route::resource('contacts', App\Http\Controllers\Admin\ContactController::class)->except('show', 'store', 'create', 'destroy');

            Route::resource('charging', App\Http\Controllers\Admin\ChargingController::class)->except('show', 'store', 'create', 'destroy');
            
        });

    });


    Route::middleware('auth')->group( function (){
        Route::get('/forget-password', [App\Http\Controllers\AuthController::class, 'forget_password'])->name('forget-password');
        Route::post('/change-password', [App\Http\Controllers\AuthController::class, 'changepass'])->name('change.password');
        Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout']);

        Route::patch('/update-profile', [App\Http\Controllers\AuthController::class, 'update_profile'])->name('update.profile');
        
        // Payment
        Route::post('/pay', [App\Http\Controllers\PaymentController::class, 'pay_for'])->name('pay'); 

        Route::post('tasks', [App\Http\Controllers\Web\TaskController::class, 'store'])->name('tasks.store');

        // send message
        Route::post('chats/room/{id}', [App\Http\Controllers\Api\ChatController::class, 'sendWeb'])->name('send.web');

        // notifications token
        Route::post('/fcm-token', [App\Http\Controllers\NotificationController::class, 'storeToken'])->name('store.token');
        Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.list');

        // payout
        Route::get('/balance', [App\Http\Controllers\PaymentController::class, 'pay_out_form'])->name('balance'); 
        Route::post('/pay-out', [App\Http\Controllers\PaymentController::class, 'pay_out_web'])->name('pay_out_web'); 
        Route::post('/charge-balance', [App\Http\Controllers\PaymentController::class, 'get_ref_code_web'])->name('get_ref_code_web'); 

        Route::get('/transaction-data', [App\Http\Controllers\PaymentController::class, 'getTransaction'])->name('update.transaction'); 

    });

    

    Route::get('/callback', [App\Http\Controllers\PaymentController::class, 'callback'])->name('callback');


    // Client Routes
    Route::group(['prefix' => 'client', 'as' => 'client.' ,'middleware' => ['auth', 'client']], function(){
        Route::get('/dashboard', [App\Http\Controllers\Web\Client\DashboardController::class, 'index'])->name('dashboard');

        Route::get('/settings', [App\Http\Controllers\Web\Client\DashboardController::class, 'profile_settings'])->name('profile');
        
        // Consultation
        Route::get('/consultations',  [App\Http\Controllers\Web\Client\ConsultationController::class, 'index'])->name('consultations.list');

        // Tasks
        // Route::resource('/tasks', App\Http\Controllers\Web\Client\TaskController::class)->except('my_posted_tasks');
        Route::get('tasks', [App\Http\Controllers\Web\TaskController::class, 'index'])->name('tasks.list');
        Route::post('tasks', [App\Http\Controllers\Web\TaskController::class, 'store'])->name('tasks.store');
        Route::patch('edit-task/{id}', [App\Http\Controllers\Web\TaskController::class, 'edit'])->name('tasks.edit');
        Route::delete('tasks/{id}', [App\Http\Controllers\Web\TaskController::class, 'destroy'])->name('tasks.delete');
        Route::get('tasks/{id}', [App\Http\Controllers\Web\TaskController::class, 'show'])->name('show.task');

        // Route::post('pay-for-task', [App\Http\Controllers\PaymentController::class, 'pay_for'])->name('pay-for.task');
        Route::post('/refund', [App\Http\Controllers\PaymentController::class, 'refund'])->name('refund');
        Route::post('complete-task/{id}', [App\Http\Controllers\Web\TaskController::class, 'complete_task'])->name('complete.task');
        Route::post('upload-task-file', [App\Http\Controllers\Web\TaskController::class, 'change_status'])->name('upload.file');
        Route::post('/recommend-task/{id}', [App\Http\Controllers\Web\TaskController::class, 'recommended_task'])->name('invite.lawyer');

        // open chat
        Route::post('chats', [App\Http\Controllers\Web\TaskController::class, 'open_chat'])->name('open.chat');
        Route::get('chats', [App\Http\Controllers\Api\ChatController::class, 'rooms'])->name('rooms');
        Route::get('chats/room/{id}', [App\Http\Controllers\Api\ChatController::class, 'room'])->name('chat.room');

        // Ads
        Route::get('/announcements', [App\Http\Controllers\Web\AnnouncementController::class, 'index'])->name('ads.list');
        Route::post('/announcements', [App\Http\Controllers\Web\AnnouncementController::class, 'store'])->name('ads.store');

    });

    
    // Lawyer Routes
    Route::group(['prefix' => 'lawyer', 'as' => 'lawyer.', 'middleware' => ['auth', 'lawyer']], function(){
        Route::get('/dashboard', [App\Http\Controllers\Web\Lawyer\DashboardController::class, 'index'])->name('dashboard');

        Route::get('/settings', [App\Http\Controllers\Web\Lawyer\DashboardController::class, 'profile_settings'])->name('profile');

        // get chats with data
        Route::post('chats', [App\Http\Controllers\Web\TaskController::class, 'open_chat'])->name('open.chat');
        Route::get('/chats', [App\Http\Controllers\Api\ChatController::class, 'rooms'])->name('rooms');
        Route::get('/chats/room/{id}', [App\Http\Controllers\Api\ChatController::class, 'room'])->name('chat.room');  

        // Lists
        Route::get('lawyer-tasks', [App\Http\Controllers\Web\TaskController::class, 'lawyer_tasks'])->name('lawyer-tasks.list');
        Route::get('others-tasks', [App\Http\Controllers\Web\TaskController::class, 'others_tasks'])->name('others-tasks.list');
        Route::get('offers-tasks', [App\Http\Controllers\Web\TaskController::class, 'offers'])->name('offers-tasks.list');
        Route::get('tasks', [App\Http\Controllers\Web\TaskController::class, 'index'])->name('tasks.list');
        
        // Crud
        Route::post('tasks', [App\Http\Controllers\Web\TaskController::class, 'store'])->name('tasks.store');
        Route::patch('edit-task/{id}', [App\Http\Controllers\Web\TaskController::class, 'edit'])->name('tasks.edit');
        Route::delete('tasks/{id}', [App\Http\Controllers\Web\TaskController::class, 'destroy'])->name('tasks.delete');
        Route::get('tasks/{id}', [App\Http\Controllers\Web\TaskController::class, 'show'])->name('show.task');
        Route::get('task/{id}', [App\Http\Controllers\Web\TaskController::class, 'show_single'])->name('show-single.task');

        Route::post('apply-for-task/{id}', [App\Http\Controllers\Web\TaskController::class, 'apply_for'])->name('apply.task');
        Route::delete('refuse-invitation/{id}', [App\Http\Controllers\Web\TaskController::class, 'refuse_invitation'])->name('refuse.task');
        Route::post('upload-task-file/{id}', [App\Http\Controllers\Web\TaskController::class, 'change_status'])->name('upload.file');
        Route::post('/recommend-task/{id}', [App\Http\Controllers\Web\TaskController::class, 'recommended_task'])->name('invite.lawyer');

        Route::post('complete-task/{id}', [App\Http\Controllers\Web\TaskController::class, 'complete_task'])->name('complete.task');
        Route::post('/refund', [App\Http\Controllers\PaymentController::class, 'refund'])->name('refund');

        // distresses
        Route::get('/sos', [App\Http\Controllers\Web\Lawyer\DistressController::class, 'index'])->name('sos.list');
        Route::post('/sos', [App\Http\Controllers\Web\Lawyer\DistressController::class, 'store'])->name('sos.store');
        Route::patch('edit-sos/{id}', [App\Http\Controllers\Web\Lawyer\DistressController::class, 'edit'])->name('sos.edit');
        Route::delete('sos/{id}', [App\Http\Controllers\Web\Lawyer\DistressController::class, 'destroy'])->name('sos.delete');

        // Taxes
        Route::get('/taxes', [App\Http\Controllers\Web\Lawyer\TaxController::class, 'index'])->name('taxes.list');

        // Ads
        Route::get('/announcements', [App\Http\Controllers\Web\AnnouncementController::class, 'index'])->name('ads.list');
        Route::post('/announcements', [App\Http\Controllers\Web\AnnouncementController::class, 'store'])->name('ads.store');

        // Articles
        Route::get('/articles', [App\Http\Controllers\Web\Lawyer\ArticleController::class, 'index'])->name('articles.list');
        Route::get('/article', [App\Http\Controllers\Web\Lawyer\ArticleController::class, 'create'])->name('articles.create');
        Route::post('/article', [App\Http\Controllers\Web\Lawyer\ArticleController::class, 'store'])->name('articles.store');
        Route::get('/article/{id}', [App\Http\Controllers\Web\Lawyer\ArticleController::class, 'edit'])->name('articles.edit');
        Route::patch('/article/{id}', [App\Http\Controllers\Web\Lawyer\ArticleController::class, 'update'])->name('articles.update');
        Route::delete('/article/{id}', [App\Http\Controllers\Web\Lawyer\ArticleController::class, 'destroy'])->name('articles.delete');

    });




