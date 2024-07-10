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





// clients route
Route::get('/', [ProjectController::class, 'home'])->name('home');
Route::middleware(['auth'])->group(function () {

    // Route for teacher
    Route::middleware(['teacher'])->group(function () {
        Route::get('/search', [ScoreAndCommentController::class, 'show'])->name('search');
        Route::post('/submit-score', [ScoreAndCommentController::class, 'store'])->name('submit-score');

        Route::post('/sent-thesis', [ThesisController::class, 'store'])->name('sent-thesis');

        Route::get('/file', [PlansController::class, 'viewfile'])->name('viewfile');

        Route::get('/scorecomment', [ProjectController::class, 'scoreAndComment'])->name('scoreAndComment');
        Route::post('/advisorinsert', [AdvisorController::class, 'insert']);
        Route::get('/thesis', [ThesisController::class, 'show'])->name('thesis');

        // Allow
        Route::get('/accept', [AcceptEdit::class, 'show'])->name('accept');
        Route::get('/request', [AllowController::class, 'show'])->name('request');

        // Routes for Advisor
        Route::get('/advisor', [AdvisorController::class, 'getPost'])->name('advisor');
        Route::get('/advisordelete/{id}', [AdvisorController::class, 'delete'])->name('advisordelete');
        Route::get('/editadvisor/{id}', [AdvisorController::class, 'edit'])->name('editadvisor');
        Route::post('/advisorupdate/{id}', [AdvisorController::class, 'update']);

        // Accept thesis edit
        Route::get('/change/{id}', [AcceptEdit::class, 'change'])->name('change');
    });

    // Route for student
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/defense', [ProjectController::class, 'defense'])->name('defense');
    Route::get('/group', [StudentGroupController::class, 'groupview'])->name('group');
    Route::post('/student-groups', [StudentGroupController::class, 'store'])->name('student-groups.store');
    Route::get('/plan', [PlansController::class, 'getPost'])->name('plan');
    // ThesisBook edit
    Route::post('/sent-thesis-edit', [ThesisEditController::class, 'store'])->name('sent-thesis-edit');
    // Give Score and Comments
    Route::get('comment', [ScoreAndCommentController::class, 'showcomment'])->name('comment');
    Route::get('scores', [ScoreAndCommentController::class, 'showscore'])->name('scores');

    // Routes for Plans
    Route::get('delete/{id}', [PlansController::class, 'delete'])->name('delete');
    Route::get('/edit/{id}', [PlansController::class, 'edit'])->name('edit');
    Route::post('/insert', [PlansController::class, 'insert']);
    Route::post('/update/{id}', [PlansController::class, 'update'])->name('update');

    Route::post('addtype', [ProjectController::class, 'addtype'])->name('addtype');

});

Auth::routes();


// Admin routes

Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    // protected admin route
    Route::middleware(['auth'])->group(function() {
        Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');
        Route::get('/', [DashboardController::class, 'index'])->name('home');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });
});



// Route::prefix('admin')->name('admin.')->group(function() {
//     Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');

//     // Default route for /admin to redirect to /admin/login
//     Route::get('/', function () {
//         return redirect()->route('admin.login');
//     });

//     // Protected admin routes
//     Route::middleware(['auth'])->group(function() {
//         Route::get('/', [DashboardController::class])->name('home');
//         Route::get('/dashboard', [DashboardController::class])->name('dashboard');
//     });
// });
