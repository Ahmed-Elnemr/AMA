<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\Api\Ecommerce\MainCategoryController;
// use App\Http\Controllers\Api\Ecommerce\CategoryController;
// use App\Http\Controllers\Api\Ecommerce\SubCategory;
// use App\Http\Controllers\Api\Ecommerce\BusinessInformationController;
use App\Http\Controllers\Api\Ecommerce\TopRankedController;
use App\Http\Controllers\Api\Ecommerce\PostController;


use App\Http\Controllers\Api\Ecommerce\UserReviewController;
use App\Http\Controllers\Api\Ecommerce\ProductController;
use App\Http\Controllers\Api\Ecommerce\OrdersDetailsController;
use App\Http\Controllers\Api\Ecommerce\FollowerController;
use App\Http\Controllers\Api\Ecommerce\OrderController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\VendorAuthController;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\MyOrderController;
use App\Http\Controllers\Api\ChangePassController;
use App\Http\Controllers\Api\Ecommerce\SubCategoryController;
use App\Http\Controllers\Api\Ecommerce\PostLikeController;
use App\Http\Controllers\Api\Qanda\AnswerController;
use App\Http\Controllers\Api\Stories\StoryController;

use App\Http\Controllers\Api\Chat\ChatRoomsController;
use App\Http\Controllers\Api\Qanda\QuestionController;
use App\Http\Controllers\Api\Stories\StoryLikeController;
use App\Http\Controllers\Api\AddressInformationController;
use App\Http\Controllers\Api\Ecommerce\CategoryController;
use App\Http\Controllers\Api\PersonalInformationController;
use App\Http\Controllers\Api\Ecommerce\MainCategoryController;
use App\Http\Controllers\Api\Ecommerce\BusinessInformationController;
use App\Http\Controllers\Api\LibraryController;
use App\Http\Controllers\Api\OrganizationController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\AdsController;
/**
 * after this comment add your class
 *
 *
 */



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');


Route::post('/updatetokne', [AuthController::class, 'updatetokne'])->middleware('auth:sanctum');

//VendorAuthController

Route::post('/vlogin', [VendorAuthController::class, 'login']);
Route::post('/vregister', [VendorAuthController::class, 'register']);
Route::post('/vme', [VendorAuthController::class, 'me'])->middleware('auth:sanctum');

//SubscriptionController
Route::resource('/subscription', SubscriptionController::class)->middleware('auth:sanctum');


Route::resource('/addresses', AddressInformationController::class)->middleware('auth:sanctum');



Route::resource('/main-category', MainCategoryController::class);
Route::resource('/category', CategoryController::class);
Route::resource('/subcategory', SubCategoryController::class);
Route::resource('/chatrooms', ChatRoomsController::class)->middleware('auth:sanctum');



//**  Story  **//


Route::resource('/stories', StoryController::class)->middleware('auth:sanctum');
Route::resource('/media', MediaController::class)->middleware('auth:sanctum');
Route::resource('/storylike', StoryLikeController::class)->middleware('auth:sanctum');

/**
 * vendors
 */


Route::resource('/notification', NotificationController::class)->middleware('auth:sanctum');

Route::resource('/vendors', BusinessInformationController::class)->middleware('auth:sanctum');
Route::resource('/search', BusinessInformationController::class);


Route::post('/editlogo',[BusinessInformationController::class, 'editlogo'])->middleware('auth:sanctum');
Route::post('/editcover',[BusinessInformationController::class, 'editcover'])->middleware('auth:sanctum');
Route::post('/editbio',[BusinessInformationController::class, 'editbio'])->middleware('auth:sanctum');
Route::post('/addcontact',[BusinessInformationController::class, 'addcontact'])->middleware('auth:sanctum');
Route::post('/deletecontact',[BusinessInformationController::class, 'deletecontact'])->middleware('auth:sanctum');

//Question
Route::resource('/questions', QuestionController::class)->middleware('auth:sanctum');

Route::resource('/profile', ProfileController::class)->middleware('auth:sanctum');

//
Route::resource('/answer', AnswerController::class)->middleware('auth:sanctum');
Route::get('/answer-more', [AnswerController::class, 'more'])->middleware('auth:sanctum');
##################                ACOUNT      ##################
//personal details
Route::resource('/personal-informations', PersonalInformationController::class)->middleware('auth:sanctum');
//change password
Route::resource('/change-password', ChangePassController::class)->middleware('auth:sanctum');
//yor order
Route::resource('/myorder', MyOrderController::class)->middleware('auth:sanctum');
Route::resource('/order', OrderController::class)->middleware('auth:sanctum');



//OrdersDetailsController

Route::resource('/orders-details', OrdersDetailsController::class)->middleware('auth:sanctum');
//address information
Route::resource('/address-information', AddressInformationController::class)->middleware('auth:sanctum');


// top rank
Route::resource('/top-ranked', TopRankedController::class);


//PostController
Route::resource('/post', PostController::class)->middleware('auth:sanctum');

//FollowerController
Route::resource('/follower', FollowerController::class)->middleware('auth:sanctum');

//vendor review : UserReviewController
Route::resource('/review', UserReviewController::class)->middleware('auth:sanctum');


Route::resource('/products', ProductController::class)->middleware('auth:sanctum');

//
Route::resource('/library', LibraryController::class)->middleware('auth:sanctum');


//


Route::resource('/ads', AdsController::class)->middleware('auth:sanctum');

Route::resource('/organization', OrganizationController::class)->middleware('auth:sanctum');

Route::resource('/post-like', PostLikeController::class)->middleware('auth:sanctum');



 
