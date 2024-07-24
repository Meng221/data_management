<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController; //this is controller location if you want open controller file
use App\Http\Controllers\PlansController;
use App\Http\Controllers\AdvisorController;
use App\Http\Controllers\StudentGroupController;
use App\Http\Controllers\ThesisController;
use App\Http\Controllers\ThesisEditController;
use App\Http\Controllers\ScoreAndCommentController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AllowController;
use App\Http\Controllers\AcceptEdit;
use App\Http\Controllers\Admin\AdminAdviserController;
use App\Http\Controllers\Admin\AdminPlansController;
use App\Http\Controllers\Admin\AdminShowController;
use App\Http\Controllers\Admin\AdminThesiswController;
use App\Http\Controllers\Admin\AdminAcceptThesisController;
use App\Http\Controllers\Admin\AdminShowCommentController;



// clients route
Route::get('/', [ProjectController::class, 'home'])->name('home');
Route::middleware(['auth'])->group(function () {

    // Route for teacher
    Route::middleware(['teacher'])->group(function () {
        Route::get('/search', [ScoreAndCommentController::class, 'show'])->name('search');
        Route::post('/submit-score', [ScoreAndCommentController::class, 'store'])->name('submit-score');



        Route::get('/file', [PlansController::class, 'viewfile'])->name('viewfile');

        Route::get('/scorecomment', [ProjectController::class, 'scoreAndComment'])->name('scoreAndComment');
        Route::post('/advisorinsert', [AdvisorController::class, 'insert']);
        Route::get('/thesis', [ThesisController::class, 'show'])->name('thesis');

        // Allow
        Route::get('/accept', [AcceptEdit::class, 'show'])->name('accept');
        Route::get('/request', [AllowController::class, 'show'])->name('request');

        // Routes for Advisor

        Route::get('/advisordelete/{id}', [AdvisorController::class, 'delete'])->name('advisordelete');
        Route::get('/editadvisor/{id}', [AdvisorController::class, 'edit'])->name('editadvisor');
        Route::post('/advisorupdate/{id}', [AdvisorController::class, 'update']);

        // Accept thesis edit
        Route::get('/change/{id}', [AcceptEdit::class, 'change'])->name('change');
        // Allow sending thesis
        Route::get('/allow-thesis/{id}', [ThesisController::class, 'allow'])->name('allow-thesis');

        Route::middleware(['head'])->group(function () {
            Route::get('/allow/{id}', [AllowController::class, 'change'])->name('allow');
        });


    });

    // Sent thesis
    Route::post('/sent-thesis', [ThesisController::class, 'store'])->name('sent-thesis');
    // Route for student
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/defense', [ProjectController::class, 'defense'])->name('defense');
    Route::get('/group', [StudentGroupController::class, 'groupview'])->name('group');
    Route::post('/student-groups', [StudentGroupController::class, 'store'])->name('student-groups.store');
    Route::get('/plan', [ProjectController::class, 'getPost'])->name('plan');
    Route::get('/advisor', [AdvisorController::class, 'getPost'])->name('advisor');
    // ThesisBook edit
    Route::post('/sent-thesis-edit', [ThesisEditController::class, 'store'])->name('sent-thesis-edit');
    Route::get('/show-thesis', [ThesisController::class, 'allowSendingThesis'])->name('show-thesis');
    // Give Score and Comments
    Route::get('comment', [ScoreAndCommentController::class, 'showcomment'])->name('comment');
    Route::get('scores', [ScoreAndCommentController::class, 'showscore'])->name('scores');

    Route::post('addtype', [ProjectController::class, 'addtype'])->name('addtype');
    // Route::get('/edit/{id}', [PlansController::class, 'edit'])->name('edit');

});

Auth::routes();


// Admin routes

Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    // protected admin route
    Route::middleware(['auth','role:SuperAdmin|Admin'])->group(function() {
        Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');
        Route::get('/', [DashboardController::class, 'index'])->name('home');
        Route::get('/defense', [DashboardController::class, 'defense'])->name('defense');
        Route::get('scores', [AdminShowController::class, 'showscore'])->name('scores');
        Route::get('/advisor', [AdminAdviserController::class, 'getPost'])->name('advisor');
        Route::get('/group', [DashboardController::class, 'groupview'])->name('group');
        Route::get('/plan', [AdminPlansController::class, 'getPost'])->name('plan');
        Route::get('/thesis', [AdminThesiswController::class, 'show'])->name('thesis');
        Route::get('/accept', [AdminAcceptThesisController::class, 'show'])->name('accept');
        Route::get('comment', [AdminShowCommentController::class, 'showcomment'])->name('comment');

        Route::post('addtype', [ProjectController::class, 'addtype'])->name('addtype');

        // Routes for Plans
        Route::get('delete/{id}', [PlansController::class, 'delete'])->name('delete');
        Route::get('/edit/{id}', [PlansController::class, 'edit'])->name('edit');
        Route::post('/insert', [PlansController::class, 'insert'])->name('insert');
        Route::post('/update/{id}', [PlansController::class, 'update'])->name('update');

        // Routes for Advisor
        Route::post('/advisorinsert', [AdminAdviserController::class, 'insert']);
        Route::get('/advisordelete/{id}', [AdminAdviserController::class, 'delete'])->name('advisordelete');
        Route::get('/editadvisor/{id}', [AdminAdviserController::class, 'edit'])->name('editadvisor');
        Route::post('/advisorupdate/{id}', [AdminAdviserController::class, 'update'])->name('updateadvisor');
    });
});

