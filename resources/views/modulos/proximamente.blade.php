@extends('adminlte::page')

@section('title', $titulo)

@section('content_header')
  <h3 class="mb-0">{{ $titulo }}</h3>
  <p class="text-body-secondary mb-0">Gestión de {{ mb_strtolower($titulo) }}</p>
@stop

@section('content')

  <div class="card mb-4">
    <div class="card-header">
      <h5 class="card-title mb-0"><i class="{{ $icono }} me-2"></i>Listado de {{ mb_strtolower($titulo) }}</h5>
    </div>
    <div class="card-body p-0">
      <table class="table table-striped mb-0">
        <thead>
          <tr>
            <th style="width: 60px">#</th>
            <th>Nombre</th>
            <th>Estado</th>
            <th style="width: 120px">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td colspan="4" class="text-center py-5">
              <i class="bi bi-hourglass-split text-warning" style="font-size: 2.5rem"></i>
              <h5 class="mt-2 mb-1">Próximamente</h5>
              <p class="text-body-secondary mb-0">Este módulo está en desarrollo.</p>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

@stop
