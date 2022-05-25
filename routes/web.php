<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware(['auth'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/house');
})->middleware(['auth','signed'])->name('verification.verify');

// Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/', function () {
    // return redirect('/login');
    return view('landing3');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
->middleware(['auth'])->name('home');



// Route::resource('house', App\Http\Controllers\HouseController::class)
//     ->middleware('auth');
Route::group(
    ['middleware' => ['auth', 'role:Super Admin|Admin|Staf|Tenant|Owner']],
    function () {
        // uses 'auth' middleware plus all middleware from $middlewareGroups['role']
        Route::resource('profile', App\Http\Controllers\ProfileController::class);
        Route::resource('house', App\Http\Controllers\HouseController::class);
        Route::resource('houseimage', App\Http\Controllers\HouseImageController::class);
        Route::resource('houseowner_bankaccount', App\Http\Controllers\HouseOwnerBankAccountController::class);
        Route::resource('housedoc', App\Http\Controllers\HouseDocController::class);
        Route::resource(
            'houseagreement',
            App\Http\Controllers\HouseAgreementController::class
        );
        Route::resource('houseagreementlinks', App\Http\Controllers\HouseAgreementLinkController::class);
        Route::resource('housemedia', App\Http\Controllers\HouseMediaController::class);
        Route::resource('housetenant', App\Http\Controllers\HouseTenantController::class);
        Route::resource('houseutility', App\Http\Controllers\HouseUtilityController::class);
        Route::resource('houseutilityinfo', App\Http\Controllers\HouseUtilityInfoController::class);
        Route::resource('housetax', App\Http\Controllers\HouseTaxController::class);
        Route::resource('housecost', App\Http\Controllers\HouseCostController::class);
        Route::resource('houseinvoice', App\Http\Controllers\HouseInvoiceController::class);
        Route::resource('housereceipt', App\Http\Controllers\HouseReceiptController::class);

        Route::get(
            'user/tenant',
            'App\Http\Controllers\UserController@index_tenant'
        )->middleware('auth')->name('usertenant');
    }
);



// Route::resource('housedoc', App\Http\Controllers\HouseDocController::class)
//     ->middleware('auth');
// Route::resource(
//     'houseagreement',
//     App\Http\Controllers\HouseAgreementController::class
// )->middleware('auth');
// Route::resource('housemedia', App\Http\Controllers\HouseMediaController::class)
//     ->middleware('auth');
// Route::resource('housetenant', App\Http\Controllers\HouseTenantController::class)
//     ->middleware('auth');
// Route::resource('houseutility', App\Http\Controllers\HouseUtilityController::class)
//     ->middleware('auth');

// Route::resource('housetax', App\Http\Controllers\HouseTaxController::class)
//     ->middleware('auth');

// Route::resource('housecost', App\Http\Controllers\HouseCostController::class)
//     ->middleware('auth');

// Route::resource('houseinvoice', App\Http\Controllers\HouseInvoiceController::class)
//     ->middleware('auth');

// Route::resource('housereceipt', App\Http\Controllers\HouseReceiptController::class)
//     ->middleware('auth');
Route::get(
    'house/user/{userid}',
    'App\Http\Controllers\HouseController@list_house_by_user'
)->middleware('auth');

Route::get(
    'users/admin',
    'App\Http\Controllers\UserController@index'
)->middleware('auth')->name('useradmin');

Route::get(
    'users/staf',
    'App\Http\Controllers\UserController@index_staf'
)->middleware('auth')->name('userstaf');

Route::get(
    'users/owner',
    'App\Http\Controllers\UserController@index_owner'
)->middleware('auth')->name('userowner');

Route::post(
    'users/block/{id}',
    'App\Http\Controllers\UserController@block_user'
)->middleware('auth');

Route::post(
    'users/active/{id}',
    'App\Http\Controllers\UserController@active_user'
)->middleware('auth');

Route::get(
    'user/resend/{id}',
    'App\Http\Controllers\UserController@resend_verify_email'
)->middleware('auth');

Route::resource('users', App\Http\Controllers\UserController::class)
    ->middleware('auth');

Route::resource('products', App\Http\Controllers\ProductController::class)
    ->middleware('auth');

Route::resource('roles', App\Http\Controllers\RoleController::class)
    ->middleware('auth');

Route::resource('permissions', App\Http\Controllers\PermissionController::class)
    ->middleware('auth');

Route::resource('tickets', App\Http\Controllers\TicketController::class)
->middleware('auth');

Route::get(
    'tickets/addUploadHTML',
    'App\Http\Controllers\TicketController@getHTML'
)->middleware('auth');

Route::resource('ticketreplies', App\Http\Controllers\TicketReplyController::class)
    ->middleware('auth', 'role:Owner');

Route::get(
        'tickets/tenant/{tenant_id}',
        'App\Http\Controllers\TicketController@get_tenant_info'
    )->middleware('auth');


Route::resource('todos', App\Http\Controllers\TodoController::class)->middleware('auth', 'role:Owner|Tenant');

Route::get(
    'todos_list',
    'App\Http\Controllers\TodoController@todoApi'
)->middleware('auth');

Route::get(
    '/announcement/listhouse',
    'App\Http\Controllers\AnnouncementController@get_announcement_houses'
)->middleware('auth');

Route::post(
    '/announcement/savehousetoannouce/{ann_id}',
    'App\Http\Controllers\AnnouncementController@save_house_to_annouce'
)->middleware('auth');

Route::resource('announcement', App\Http\Controllers\AnnouncementController::class)->middleware('auth', 'role:Owner|Tenant');

Route::get(
    '/announcement/info/{ann_id}',
    'App\Http\Controllers\AnnouncementController@get_announcement_info'
)->middleware('auth');

Route::resource('sop', App\Http\Controllers\SOPController::class)->middleware('auth', 'role:Admin|Staf|Owner');

Route::get(
    '/sop/download/{docid}',
    'App\Http\Controllers\SOPController@download'
)->middleware('auth')->name('downloadsop');

Route::get(
    '/sop/view/{docid}',
    'App\Http\Controllers\SOPController@view'
)->middleware('auth')->name('viewsop');


Route::get(
    '/docs/download/{docid}',
    'App\Http\Controllers\HouseDocController@download'
)->middleware('auth')->name('downloaddoc');

Route::get(
    '/docs/view/{docid}',
    'App\Http\Controllers\HouseDocController@view'
)->middleware('auth')->name('viewdoc');

Route::get(
    '/agreement/download/{agreementid}',
    'App\Http\Controllers\HouseAgreementController@download'
)->middleware('auth')->name('downloadagreement');

Route::get(
    '/agreement/view/{agreementid}',
    'App\Http\Controllers\HouseAgreementController@view'
)->middleware('auth')->name('viewagreement');

Route::get(
    '/utility/download/{utilityid}',
    'App\Http\Controllers\HouseUtilityController@download'
)->middleware('auth')->name('downloadutility');

Route::get(
    '/utility/view/{utilitytid}',
    'App\Http\Controllers\HouseUtilityController@view'
)->middleware('auth')->name('viewutility');

Route::get(
    '/tax/download/{taxid}',
    'App\Http\Controllers\HouseTaxController@download'
)->middleware('auth')->name('downloadtax');

Route::get(
    '/tax/view/{taxid}',
    'App\Http\Controllers\HouseTaxController@view'
)->middleware('auth')->name('viewtax');

Route::get(
    '/cost/download/{taxid}',
    'App\Http\Controllers\HouseCostController@download'
)->middleware('auth')->name('downloadcost');

Route::get(
    '/cost/view/{taxid}',
    'App\Http\Controllers\HouseCostController@view'
)->middleware('auth')->name('viewcost');

Route::get(
    '/invoices/download/{invoiceid}',
    'App\Http\Controllers\HouseInvoiceController@download'
)->middleware('auth')->name('downloadinvoice');

Route::get(
    '/invoices/view/{invoiceid}',
    'App\Http\Controllers\HouseInvoiceController@view'
)->middleware('auth')->name('viewinvoice');

Route::get(
    '/receipts/download/{invoiceid}',
    'App\Http\Controllers\HouseReceiptController@download'
)->middleware('auth')->name('downloadreceipt');

Route::get(
    '/receipts/view/{invoiceid}',
    'App\Http\Controllers\HouseReceiptController@view'
)->middleware('auth')->name('viewreceipt');


Route::get(
    '/testmultipleupload',
    'App\Http\Controllers\TestController@multipleupload_index'
);

Route::get(
    '/housetenant/tenant/{tenant_id}',
    'App\Http\Controllers\HouseTenantController@get_tenant_info'
)->name('gettenantinfo')->middleware('auth');

Route::post(
    '/housetenant/vehicle/addItemHTML',
    'App\Http\Controllers\HouseTenantController@getHTML'
)->middleware('auth');

Route::post(
    '/invois/generate_receipt',
    'App\Http\Controllers\HouseReceiptController@generate_receipt_4'
)->middleware('auth');

Route::get(
    '/invois/generate_invoice/',
    'App\Http\Controllers\HouseInvoiceController@generate_invoice_3'
)->name('generate_invoice')->middleware('auth');

Route::post(
    '/invois/add_logo',
    'App\Http\Controllers\InvoiceImageController@save_logo'
)->middleware('auth');



Route::get(
    '/invois/get_logo',
    'App\Http\Controllers\InvoiceImageController@get_logo'
)->middleware('auth');

Route::get(
    'invois/addItemHTML',
    'App\Http\Controllers\HouseInvoiceController@getHTML'
)->middleware('auth');

Route::resource('notes', App\Http\Controllers\NoteController::class)
    ->middleware('auth','role:Owner');

Route::get(
    '/change_password',
    'App\Http\Controllers\UserController@change_password'
)->name('change_password')->middleware('auth');

Route::post(
    '/reset-password',
    'App\Http\Controllers\UserController@update_password'
)->name('update_password')->middleware('auth');

Route::get(
    'send-mail',
    function () {

        $details = [
            'title' => 'Mail from Tenant',
            'body' => '<p>This is for testing email using smtp</p><br><p>Thanks</p>'
        ];

        Mail::to('awakenblueheart@gmail.com')->send(new \App\Mail\SendMail($details));

        dd("Email is Sent.");
    }
);