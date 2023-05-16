<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Events\Chat;
 
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. ThesedNotification
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


    // Rest Auth
    // Global routes for both lawyer & client
    Route::post('lawyer-register', [App\Http\Controllers\Api\AuthController::class, 'lawyer_register'])->name('lawyer.register');
    Route::post('client-register', [App\Http\Controllers\Api\AuthController::class, 'client_register']);
    Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'login']);
    Route::post('/forget-password', [App\Http\Controllers\Api\AuthController::class, 'forget_password'])->name('password.reset');

    Route::middleware('auth:sanctum')->group( function (){
        Route::post('/change-password', [App\Http\Controllers\Api\AuthController::class, 'change_password']);
        Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);

        // Static Pages
        Route::get('/about', [App\Http\Controllers\Api\FrontEnd\PageController::class, 'about_page']);
        Route::get('/terms-and-conditions', [App\Http\Controllers\Api\FrontEnd\PageController::class, 'terms_page']);
        Route::get('/privacy-policy', [App\Http\Controllers\Api\FrontEnd\PageController::class, 'privacy_page']);
        Route::get('/help', [App\Http\Controllers\Api\FrontEnd\PageController::class, 'help_page']);
        Route::get('/accept-terms', [App\Http\Controllers\Api\FrontEnd\PageController::class, 'agreement_page']);
        Route::post('/accept-terms', [App\Http\Controllers\Api\FrontEnd\PageController::class, 'set_accept_terms']);
        Route::get('/contact', [App\Http\Controllers\Api\FrontEnd\PageController::class, 'contact_us']);

        // // accept terms
        // Route::post('/accept-terms', [App\Http\Controllers\API\FrontEnd\PageController::class, 'set_accept_terms']);

        // News 
        Route::get('/user-news', [App\Http\Controllers\Api\FrontEnd\NewsController::class, 'get_user_news']);

        // Lawyers List
        // Route::get('/lawyers-list', [App\Http\Controllers\Api\FrontEnd\SearchController::class, 'lawyers_list']);
        Route::post('/search-lawyer', [App\Http\Controllers\Api\FrontEnd\SearchController::class, 'search_lawyer']);
        

        // Announcements-Op.
        Route::apiResource('announcements', App\Http\Controllers\Api\AnnouncementController::class)->except(['readSingle']);
        Route::get('/show-announcements', [App\Http\Controllers\Api\AnnouncementController::class, 'readSingle']);

        // Articles
        Route::get('/articles', [App\Http\Controllers\Api\Lawyer\ArticleController::class, 'index']);
        Route::get('/articles/{id}', [App\Http\Controllers\Api\Lawyer\ArticleController::class, 'show']);

       
        // invite lawyer to apply

        // tasks 
        
        Route::apiResource('tasks', App\Http\Controllers\Api\TaskController::class)->except(['updateTask', 'readSingle', 'applyFor', 'assignTask',
        'inprogressTasks', 'changeStatus', 'applicants_count', 'mytodoTasks', 'myInReview', 'myCompleted', 'allTodoTasks', 'invitedTasks',
        'inProgress', 'inReview', 'completed']);
        Route::post('/update-task/{id}', [App\Http\Controllers\Api\TaskController::class, 'update']);

        Route::get('/my-tasks', [App\Http\Controllers\Api\TaskController::class, 'mytodoTasks']);
        Route::get('/my-tasks/{id}', [App\Http\Controllers\Api\TaskController::class, 'showSingle']);

        Route::post('/recommend-task/{id}', [App\Http\Controllers\Api\TaskController::class, 'recommendedTask']);
        Route::delete('/refuse-invitaion/{id}', [App\Http\Controllers\Api\TaskController::class, 'refuseInvitation']);
        Route::get('/invited-tasks', [App\Http\Controllers\Api\TaskController::class, 'invitedTasks']);

        Route::post('/apply-to-task/{id}', [App\Http\Controllers\Api\TaskController::class, 'applyFor']);
        Route::get('/applied-tasks', [App\Http\Controllers\Api\TaskController::class, 'appliedTasks']);
        Route::post('/assign-task', [App\Http\Controllers\Api\TaskController::class, 'assignTask']);
        Route::get('/inprogress-tasks', [App\Http\Controllers\Api\TaskController::class, 'inprogressTasks']);
        Route::post('/upload-task-file/{id}', [App\Http\Controllers\Api\TaskController::class, 'changeStatus']);
        Route::post('/complete-task/{id}', [App\Http\Controllers\Api\TaskController::class, 'completeTask']);
       
        // Chat
        Route::get('/chats', [App\Http\Controllers\Api\ChatController::class, 'chatList']);
        Route::post('/start-chat/{id}', [App\Http\Controllers\Api\ChatController::class, 'start_chat']);
        Route::post('/chat/{chat_id}', [App\Http\Controllers\Api\ChatController::class, 'sendMessage']);
        Route::get('/chat/{chat_id}', [App\Http\Controllers\Api\ChatController::class, 'recieveMessage']);

        // Payment
        Route::post('/pay', [App\Http\Controllers\PaymentController::class, 'pay_for_api'])->name('pay'); 
        Route::post('/refund', [App\Http\Controllers\PaymentController::class, 'refund_api'])->name('refund');
        Route::get('/payment-status', [App\Http\Controllers\PaymentController::class, 'payment_status']); 
        Route::get('/pay-out', [App\Http\Controllers\PaymentController::class, 'pay_out_api']);

        Route::post('/pay-out', [App\Http\Controllers\PaymentController::class, 'pay_out'])->name('pay_out');

        Route::post('/charge-balance', [App\Http\Controllers\PaymentController::class, 'get_ref_code']);

        
        // notifications token
        Route::post('/fcm-token', [App\Http\Controllers\NotificationController::class, 'storeTokenApi']);
        Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'indexApi']);

        Route::get('/transaction-data', [App\Http\Controllers\PaymentController::class, 'getTransaction']); 
        
    });
       
    
    Route::get('/callback', [App\Http\Controllers\PaymentController::class, 'callback'])->name('callback');    
    // Route::get('/kiosk-callback', [App\Http\Controllers\PaymentController::class, 'kiosk_callback'])->name('callback');


    // protected routes
    Route::group(['middleware' => ['auth:sanctum', 'lawyer']], function (){
        
        // Lawyer profile
        Route::post('/update-lawyer-profile', [App\Http\Controllers\Api\Lawyer\LawyerController::class, 'update_profile']);
        
        // Articles-Op.
        Route::apiResource('articles', App\Http\Controllers\Api\Lawyer\ArticleController::class)->except(['update', 'readSpecific', 'myArticles', 'index']);
        Route::post('/update-article/{id}', [App\Http\Controllers\Api\Lawyer\ArticleController::class, 'updateArticle']); //update
        Route::get('/my-articles', [App\Http\Controllers\Api\Lawyer\ArticleController::class, 'myArticles']);
           
        // Distress-Op.
        Route::apiResource('distresses', App\Http\Controllers\Api\Lawyer\DistressController::class)->except(['readSingle', 'updateDistress']);
        Route::get('/show-distresses', [App\Http\Controllers\Api\Lawyer\DistressController::class, 'readSingle']);
        Route::post('/update-distresses/{id}', [App\Http\Controllers\Api\Lawyer\DistressController::class, 'updateDistress']);

        // Tax-Op.
        Route::apiResource('taxes', App\Http\Controllers\Api\Lawyer\TaxController::class)->except(['readSingle']);
        Route::get('/show-taxes', [App\Http\Controllers\Api\Lawyer\TaxController::class, 'readSpecific']);
      
    });

    // protected routes
    Route::group(['middleware' => ['auth:sanctum', 'client']], function (){
        
        // client profile
        Route::post('/update-client-profile', [App\Http\Controllers\Api\Client\ClientController::class, 'update_profile']);
        
        Route::apiResource('consultations', App\Http\Controllers\Api\Client\ConsultationController::class);        

    });
