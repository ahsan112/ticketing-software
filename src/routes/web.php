<?php

use App\Http\Controllers\TicketAcceptOrRejectController;
use App\Http\Controllers\TicketCommentController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketDocumentController;
use App\Http\Controllers\TicketTaskController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function () {
    Route::view('/', 'dashboard')->name('dashboard');

    Route::get('tickets/{ticket}/tasks/create', [TicketTaskController::class, 'create'])->name('ticket.tasks.create');
    Route::post('tickets/{ticket}/tasks', [TicketTaskController::class, 'store'])->name('ticket.tasks.store');

    Route::post('tickets/{ticket}/documents', [TicketDocumentController::class, 'create'])->name('ticket.documents');
    Route::get('ticket/documents/{document}/download', [TicketDocumentController::class, 'download'])->name('ticket.document.download');

    Route::post('tickets/{ticket}/comments', [TicketCommentController::class, 'create'])->name('ticket.comments');

    Route::post('tickets/{ticket}/accept', [TicketAcceptOrRejectController::class, 'accept'])->name('ticket.accept');
    Route::post('tickets/{ticket}/reject', [TicketAcceptOrRejectController::class, 'reject'])->name('ticket.reject');

    Route::resource('tickets', TicketController::class);
});

require __DIR__.'/auth.php';
