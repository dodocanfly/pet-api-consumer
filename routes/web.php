<?php

use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;

Route::resource('pets', PetController::class);
Route::get('pets/{pet}/delete', [PetController::class, 'delete'])->name('pets.delete');
Route::redirect('/', route('pets.index'));
