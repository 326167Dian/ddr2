<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeminarController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\RegistrationController;


Route::get('/events/{event}', [EventController::class, 'show'])->middleware('auth')->name('events.show');
Route::post('/events/{event}/register', [RegistrationController::class, 'store'])->middleware('auth')->name('events.register');



Route::get('/donasi', [DonasiController::class, 'create'])->name('donasi.create');
Route::post('/donasi', [DonasiController::class, 'store'])->name('donasi.store');
Route::get('/donatur', [DonasiController::class, 'getdonatur'])->name('donatur.index')->middleware('auth');
Route::get('/donasi/thankyou', [DonasiController::class, 'thankyou'])->name('donasi.thankyou');


Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [HomepageController::class, 'index'])->name('homepage');

Route::get('/homepage', [HomepageController::class, 'index'])->name('homepage');
Route::get('/history', [HistoryController::class, 'index'])->name('history');
Route::get('/structure', [StructureController::class, 'index'])->name('structure');

Route::get('/article', [ArticleController::class, 'index'])->name('article');
Route::get('/article/{article}', [ArticleController::class, 'show'])->name('article.show');

Route::get('/activity', [ActivityController::class, 'index'])->name('activity');
Route::get('/activity/{activity}', [ActivityController::class, 'show'])->name('activity.show');

Route::get('/seminar', [SeminarController::class, 'index'])->name('seminar');
Route::get('/seminar/{seminar}', [SeminarController::class, 'show'])->middleware('auth')->name('seminar.show');
Route::post('/seminar/{seminar}/register', [SeminarController::class, 'store'])->middleware('auth')->name('seminar.register');



Route::get('/profile', [ProfileController::class, 'profile'])->name('profile')->middleware('auth');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
