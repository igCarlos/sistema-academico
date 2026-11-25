<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {

  Route::view('/dashboard', 'dashboard')
    ->name('dashboard');

  // Módulos en construcción (muestran "Próximamente")
  $modulos = [
    'categorias' => ['titulo' => 'Categorías', 'icono' => 'bi bi-tags'],
    'marcas'     => ['titulo' => 'Marcas', 'icono' => 'bi bi-award'],
    'productos'  => ['titulo' => 'Productos', 'icono' => 'bi bi-box-seam'],
    'inventario' => ['titulo' => 'Inventario', 'icono' => 'bi bi-boxes'],
    'clientes'   => ['titulo' => 'Clientes', 'icono' => 'bi bi-people'],
    'ventas'     => ['titulo' => 'Ventas', 'icono' => 'bi bi-cart3'],
    'reportes'   => ['titulo' => 'Reportes', 'icono' => 'bi bi-bar-chart-line'],
  ];

  foreach ($modulos as $slug => $modulo) {
    Route::view("/{$slug}", 'modulos.proximamente', $modulo)
      ->name($slug);
  }
});
