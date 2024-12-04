<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\ScheduleEventController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AdminDashboardController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{user}', [MessageController::class, 'chat'])->name('messages.chat');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
});

Route::middleware('guest')->group(function () {
    Route::get('admin/login', [AdminAuthController::class, 'showLoginForm'])
        ->name('admin.login');
    Route::post('admin/login', [AdminAuthController::class, 'login']);
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::post('/logout', [AdminAuthController::class, 'logout']) ->name('admin.logout');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.AdminDashboard');
    
    
    // User management routes
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users.index');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
});


Route::get('/schedule', [ScheduleEventController::class, 'index'])->name('schedule.index');
Route::post('/schedule', [ScheduleEventController::class, 'store'])->name('schedule.store');
Route::get('/schedule/events', [ScheduleEventController::class, 'getEvents'])->name('schedule.events');
Route::get('/schedule/pdf', [ScheduleEventController::class, 'generatePDF'])->name('schedule.pdf');
Route::get('/schedule/export', [ScheduleController::class, 'export'])->name('schedule.export');
Route::get('/schedule/events', [ScheduleController::class, 'events'])->name('schedule.events');

Route::post('/schedule/clear-highlight', function () {
    session()->forget('newEventId');
    return response()->json(['success' => true]);
})->name('schedule.clear-highlight');


Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
Route::resource('announcements', AnnouncementController::class);
Route::post('announcements/pdf', [AnnouncementController::class, 'generatePDF'])->name('announcements.pdf');

Route::get('/announcements/featured', [AnnouncementController::class, 'getFeatured']);
Route::get('/announcements/stats', [AnnouncementController::class, 'getStats']);
Route::get('/announcements/latest', [AnnouncementController::class, 'getLatest']);

Route::get('/schedule/{schedule}/edit', [ScheduleController::class, 'edit'])->name('schedule.edit');
Route::put('/schedule/{schedule}', [ScheduleController::class, 'update'])->name('schedule.update');
Route::delete('/schedule/{schedule}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');

Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcements.store');

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.AdminDashboard');

require __DIR__.'/auth.php';