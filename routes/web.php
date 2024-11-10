<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DomicilioController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\RepartidorController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Rutas para usuarios
    Route::resource('users', UserController::class);

        // routes/web.php

Route::get('/domicilios/cliente', [DomicilioController::class, 'indexCliente'])->name('domicilios.index_cliente');

    // Rutas para domicilios
    Route::resource('domicilios', DomicilioController::class);

    // Rutas para productos
    // routes/web.php

Route::get('/productos/cliente', [ProductoController::class, 'indexCliente'])->name('productos.index_cliente');

    Route::resource('productos', ProductoController::class);

    // Rutas para solicitudes
    Route::resource('solicitudes', SolicitudController::class);

    
    // Rutas para solicitudes
    Route::resource('repartidores', controller: RepartidorController::class);
});



require __DIR__.'/auth.php';
