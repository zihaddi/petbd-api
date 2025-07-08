<?php

use App\Enums\TokenAbility;
use App\Http\Controllers\Api\Admin\AuthClientController;
use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\BrandController;
use App\Http\Controllers\Api\Admin\ComplianceController;
use App\Http\Controllers\Api\Admin\ContactController;
use App\Http\Controllers\Api\Admin\CountryInfoController;
use App\Http\Controllers\Api\Admin\CurrencyController;
use App\Http\Controllers\Api\Admin\CustomerReviewController;
use App\Http\Controllers\Api\Admin\EmailTemplateController;
use App\Http\Controllers\Api\Admin\EventCategoryController;
use App\Http\Controllers\Api\Admin\EventController;
use App\Http\Controllers\Api\Admin\FaqCategoryController;
use App\Http\Controllers\Api\Admin\FaqController;
use App\Http\Controllers\Api\Admin\GenderController;
use App\Http\Controllers\Api\Admin\LanguageController;
use App\Http\Controllers\Api\Admin\MetaController;
use App\Http\Controllers\Api\Admin\NewsCategoryController;
use App\Http\Controllers\Api\Admin\NewsController;
use App\Http\Controllers\Api\Admin\PageController;
use App\Http\Controllers\Api\Admin\PaymentGatewayController;
use App\Http\Controllers\Api\Admin\PlanController;
use App\Http\Controllers\Api\Admin\PortfolioCategoryController;
use App\Http\Controllers\Api\Admin\PortfolioController;
use App\Http\Controllers\Api\Admin\ReleaseNoteController;
use App\Http\Controllers\Api\Admin\RoleController;
use App\Http\Controllers\Api\Admin\RolePermissionController;
use App\Http\Controllers\Api\Admin\SmsTemplateController;
use App\Http\Controllers\Api\Admin\SocialLinkController;
use App\Http\Controllers\Api\Admin\SubscribeController;
use App\Http\Controllers\Api\Admin\TagController;
use App\Http\Controllers\Api\Admin\TeamMemberController;
use App\Http\Controllers\Api\Admin\TreeEntityController;
use App\Http\Controllers\Api\Admin\TrustedBrandController;
use App\Http\Controllers\Api\Admin\TutorialCategoryController;
use App\Http\Controllers\Api\Admin\TutorialController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\PartnerController;
use App\Http\Controllers\Api\Admin\FeatureController;
use App\Http\Controllers\Api\Admin\YearController;
use App\Http\Controllers\Api\Admin\DynamicHeaderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\Email;
use App\Http\Controllers\Api\Admin\TvChannelController;
use App\Http\Controllers\Api\Admin\TvProgramController;
use App\Http\Controllers\Api\Admin\MediaContentController;

//Auth
Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('adminAuth.login');
    Route::post('/otp-resend', 'reqOtpResend')->name('adminAuth.otp_resend');
    Route::post('/otp-verify', 'reqOtpVerify')->name('adminAuth.otp_verify');
    Route::post('/set-password', 'setNewPassword')->name('adminAuth.set_password');
    Route::post('/forgot-password', 'forgotPassword')->name('adminAuth.forgotPassword');
});

//Use Refresh Token
Route::middleware(['auth:sanctum', 'ability:' . TokenAbility::ISSUE_ACCESS_TOKEN->value])->group(function () {
    Route::post('/refresh-token', [AuthController::class, 'refreshToken']);
});

//Use Access Token
Route::middleware(['auth:sanctum', 'ability:' . TokenAbility::ACCESS_API->value])->group(function () {
    // Auth
    Route::controller(AuthController::class)->group(function () {
        Route::post('/user', 'getUser')->name('adminAuth.getUser');
        Route::post('/logout', 'logout')->name('adminAuth.logout');
    });
    // Tree Entity
    Route::controller(TreeEntityController::class)->name('tree-entity.')->prefix('tree-entity')->group(function () {
        Route::get('build-menu', 'buildmenu')->name('build-menu');
        Route::post('main-menu', 'treemenuNew')->name('tree-menu');
        Route::post('update-menu', 'updateMenu')->name('update-menu');
        Route::post('delete-menu', 'deleteMenu')->name('delete-menu');
        Route::post('restore/{id}', 'restore')->name('restore');
    });

    Route::apiResource('tree-entity', TreeEntityController::class);
    Route::apiResource('auth-client', AuthClientController::class);
    Route::controller(AuthClientController::class)->group(function () {
        Route::post('auth-client/all', 'index')->name('auth-client.all');
        Route::post('auth-client/restore/{id}', 'restore')->name('tree-entity.restore');
    });

    // Roles
    Route::apiResource('roles', RoleController::class);
    Route::controller(RoleController::class)->group(function () {
        Route::post('roles/all', 'index')->name('roles.all');
        Route::post('roles/restore/{id}', 'restore')->name('roles.restore');
    });

    //use when required
    //->middleware([
    //     'index' => 'check.permission:view',
    //     'store' => 'check.permission:add',
    //     'update' => 'check.permission:edit',
    //     'destroy' => 'check.permission:delete',
    // ])

    // Role Permissions
    Route::controller(RolePermissionController::class)->group(function () {
        Route::post('role-permissions/show/{id}', 'show')->name('roles.show');
        Route::post('role-permissions/permission-update/{id}', 'pupdate')->name('roles.permission-update');
    });


    //Users
    Route::apiResource('users', UserController::class);
    Route::controller(UserController::class)->group(function () {
        Route::post('users/all', 'index')->name('users.all');
        Route::post('users/restore/{id}', 'restore')->name('users.restore');
    });
});
