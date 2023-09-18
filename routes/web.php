<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Web\AnswerController;
use App\Http\Controllers\Web\LogoutController;
use App\Http\Controllers\CommentPostController;
use App\Http\Controllers\Web\TopRankedController;
use App\Http\Controllers\Web\OrderDetailsController;
use App\Http\Livewire\Admin\SubscriptionPkgLivewire;
use App\Http\Controllers\Web\UserDetailsWebController;
use App\Http\Controllers\Web\SubscriptionWebController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\StripeController;
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

Route::group(['middleware' => ['auth']], function () {
    /**
     * Logout Route
     */
    Route::get('/logout', [LogoutController::class, 'perform'])->name('logout.perform');
});

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', function () {
//     return view('landin-page.landing-page');
// });

Route::get('/', function () {
    return view('landin-page2.landing-page');
});

Route::get('stripe', [StripeController::class, 'stripe']);
Route::post('stripe', [StripeController::class, 'stripePost'])->name('stripe.post');


Route::get('privacy',function(){
    return view('privacy.privacy');
})->name('privacy');
//delete Acount


/////////////////////////////////////////delete acount /////////////////


Route::get('delete-acount',function(){
    return view('deleteAcount.delete-acount');
})->name('delete-acount');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',

// ])->group(function () {
//     Route::group(
//         [
//             'prefix' => LaravelLocalization::setLocale(),
//             'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
//         ],function(){
//             // Route::get('delete-acount',function(){
//             //     return view('deleteAcount.delete-acount');
//             // })->name('delete-acount');
//             // ->middleware('checkAuth')
//         });

// });



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'admin'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::group(
        [
            'prefix' => LaravelLocalization::setLocale(),
            'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
        ],
        function () {
            //DASHBOARD

            Route::get('admin-dashboard', function () {
                return view('admin.dashboard');
            })->name('admin-dashboard');
            //user details
            Route::get('user-details/{id}', [UserDetailsWebController::class, 'index'])->name('user-details');
            Route::get('subscription-details/{userId}', [SubscriptionWebController::class, 'index'])->name('sub-details');

            // Route::get('subscription-details/{id}', [UserDetailsWebController::class, 'index'])->name('sub-details');

            // Route::get('test/{userId}', SubscriptionPkgLivewire::class)->name('test');

            // Route::get('notification', function () {
            //     return view('admin.notification');
            // })->name('notification');

            //users
            Route::get('user', function () {
                return view('admin.users');
            })->name('users');
             //vendors
             Route::get('vendors', function () {
                return view('admin.vendors');
            })->name('vendors');
            // Route::get('vendors', function () {
            //     return view('admin.vendor_v2');
            // })->name('vendors');
            // // notifications
            Route::get('notification', function () {
                return view('admin.notification');
            })->name('notification');
            //categories
            Route::get('main-categories', function () {
                return view('admin.main-category');
            })->name('mainCategories');
            Route::get('categories', function () {
                return view('admin.category');
            })->name('categories');
            Route::get('sub-categories', function () {
                return view('admin.sub-category');
            })->name('subCategories');
            //stories
            Route::get('stories', function () {
                return view('admin.stories');
            })->name('stories');
            //Questions
            Route::get('questions', function () {
                return view('admin.questions');
            })->name('questions');
            //Answers
            Route::get('answers/{questionID}', [AnswerController::class, 'index'])->name('answers');
            //chat

            Route::get('chat', function () {
                return view('admin.chat');
            })->name('chat');
            //Media
            Route::get('media', function () {
                return view('admin.media');
            })->name('media');
            //library
            Route::get('library', function () {
                return view('admin.library');
            })->name('library');
            //
            //product
            Route::get('product', function () {
                return view('admin.product');
            })->name('product');
            //
            //organization
            Route::get('organization', function () {
                return view('admin.organization');
            })->name('organization');
            //
            //post
            Route::get('post', function () {
                return view('admin.post');
            })->name('post');
            //
            //offers
            Route::get('offers', function () {
                return view('admin.offers');
            })->name('offers');
            //
            //top ranked
            Route::get('top-ranked', function () {
                return view('admin.top-ranked');
            })->name('top-ranked');
            //
            //
            Route::get('create-top-ranked', function () {
                return view('admin.create-top-ranked');
            })->name('create-top-ranked');
            // Reports
            //user
            Route::get('user-report', function () {
                return view('admin.user-report');
            })->name('user-report');
            //post
            Route::get('post-report', function () {
                return view('admin.post-report');
            })->name('post-report');
            //product
            Route::get('product-report', function () {
                return view('admin.product-report');
            })->name('product-report');
            //order
            Route::get('order', function () {
                return view('admin.order');
            })->name('order');
            /// order -details
            Route::get('order/{orderId}', [OrderDetailsController::class, 'index'])->name('order-details');
            /// post -comments
            Route::get('post/{postid}', [CommentPostController::class, 'index'])->name('comment-post');
            //order
            Route::get('ads', function () {
                return view('admin.ads');
            })->name('ads');
            /// order -details

            //package
            Route::get('package', function () {
                return view('admin.package');
            })->name('package');




            Route::get('/{page}', [AdminController::class, 'index']);
        }
    );
});
