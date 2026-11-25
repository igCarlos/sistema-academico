@extends('adminlte::page')

@section('title', 'Panel principal')

@section('content_header')
  <h3 class="mb-0">Panel principal</h3>
  <p class="text-body-secondary mb-0">Resumen general de MarketPro</p>
@stop

@section('content')

  {{-- Bienvenida --}}
  <div class="card mb-4">
    <div class="card-body">
      <h4 class="fw-bold">¡Bienvenido a MarketPro!</h4>
      <p class="mb-3">Usuario conectado: <strong>{{ auth()->user()->name }}</strong></p>
      <p class="mb-0">Sistema de gestión comercial de productos, inventario y ventas.</p>
    </div>
  </div>

  {{-- Info boxes --}}
  <div class="row">
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon text-bg-primary shadow-sm"><i class="bi bi-box-seam"></i></span>
        <div class="info-box-content">
          <span class="info-box-number">Productos</span>
        </div>
      </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon text-bg-danger shadow-sm"><i class="bi bi-tags"></i></span>
        <div class="info-box-content">
          <span class="info-box-number">Categorías</span>
        </div>
      </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon text-bg-success shadow-sm"><i class="bi bi-people"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">{{ \App\Models\User::count() }}</span>
          <span class="info-box-number">Usuarios</span>
        </div>
      </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon text-bg-warning shadow-sm"><i class="bi bi-cart-check"></i></span>
        <div class="info-box-content">
          <span class="info-box-number">Ventas</span>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    {{-- Monthly Recap Report --}}
    <div class="col-lg-8">
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="card-title mb-0"><i class="bi bi-graph-up me-2"></i>Monthly Recap Report</h5>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
              <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
              <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="d-flex flex-column align-items-center justify-content-center text-center py-5" style="min-height: 250px">
            <i class="bi bi-bar-chart-line text-primary" style="font-size: 3rem"></i>
            <p class="text-body-secondary mt-2 mb-0">Aún no hay datos para mostrar.</p>
          </div>
        </div>
      </div>
    </div>

    {{-- Información del sistema --}}
    <div class="col-lg-4">
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="card-title mb-0"><i class="bi bi-info-circle me-2"></i>Información del sistema</h5>
        </div>
        <div class="card-body">
          <p><strong>Sistema:</strong> MarketPro</p>
          <p><strong>Versión:</strong> 1.0</p>
          <p><strong>Estado:</strong> <span class="badge text-bg-success">En desarrollo</span></p>
          <hr>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger w-100">
              <i class="bi bi-box-arrow-right me-1"></i> Cerrar sesión
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  @php
    $usuarios = \App\Models\User::latest()->take(8)->get();
    $totalUsuarios = \App\Models\User::count();
    $iniciales = fn ($nombre) => collect(explode(' ', trim($nombre)))
      ->filter()->take(2)->map(fn ($p) => mb_strtoupper(mb_substr($p, 0, 1)))->implode('');
  @endphp

  <div class="row">
    {{-- Usuarios registrados --}}
    <div class="col-lg-7">
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="card-title mb-0"><i class="bi bi-people me-2"></i>Usuarios registrados</h5>
          <div class="card-tools">
            <span class="badge text-bg-primary">{{ $totalUsuarios }} en total</span>
            <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
              <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
              <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-striped align-middle mb-0">
              <thead>
                <tr>
                  <th>Usuario</th>
                  <th>Correo</th>
                  <th>Registrado</th>
                  <th>Estado</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($usuarios as $usuario)
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <span class="rounded-circle text-bg-primary d-inline-flex align-items-center justify-content-center me-2 fw-bold"
                              style="width: 36px; height: 36px; font-size: .85rem">
                          {{ $iniciales($usuario->name) }}
                        </span>
                        {{ $usuario->name }}
                      </div>
                    </td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->created_at?->format('d/m/Y') }}</td>
                    <td>
                      @if ($usuario->id === auth()->id())
                        <span class="badge text-bg-success">En línea</span>
                      @else
                        <span class="badge text-bg-secondary">Desconectado</span>
                      @endif
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4" class="text-center py-4 text-body-secondary">No hay usuarios registrados.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    {{-- Chat --}}
    <div class="col-lg-5">
      <div class="card direct-chat direct-chat-primary mb-4">
        <div class="card-header">
          <h5 class="card-title mb-0"><i class="bi bi-chat-dots me-2"></i>Chat</h5>
          <div class="card-tools">
            <span class="badge text-bg-primary">3</span>
            <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
              <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
              <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="direct-chat-messages" style="height: 260px">

            <div class="direct-chat-msg">
              <div class="direct-chat-infos clearfix">
                <span class="direct-chat-name float-start">Soporte MarketPro</span>
                <span class="direct-chat-timestamp float-end">{{ now()->format('d/m/Y H:i') }}</span>
              </div>
              <span class="direct-chat-img rounded-circle text-bg-secondary d-inline-flex align-items-center justify-content-center fw-bold">SM</span>
              <div class="direct-chat-text">¡Hola! Bienvenido al sistema. ¿En qué podemos ayudarte?</div>
            </div>

            <div class="direct-chat-msg end">
              <div class="direct-chat-infos clearfix">
                <span class="direct-chat-name float-end">{{ auth()->user()->name }}</span>
                <span class="direct-chat-timestamp float-start">{{ now()->format('d/m/Y H:i') }}</span>
              </div>
              <span class="direct-chat-img rounded-circle text-bg-primary d-inline-flex align-items-center justify-content-center fw-bold">{{ $iniciales(auth()->user()->name) }}</span>
              <div class="direct-chat-text">Hola, estoy revisando el panel principal.</div>
            </div>

            <div class="direct-chat-msg">
              <div class="direct-chat-infos clearfix">
                <span class="direct-chat-name float-start">Soporte MarketPro</span>
                <span class="direct-chat-timestamp float-end">{{ now()->format('d/m/Y H:i') }}</span>
              </div>
              <span class="direct-chat-img rounded-circle text-bg-secondary d-inline-flex align-items-center justify-content-center fw-bold">SM</span>
              <div class="direct-chat-text">Perfecto. Los módulos de productos y ventas estarán disponibles próximamente.</div>
            </div>

          </div>
        </div>
        <div class="card-footer">
          <form onsubmit="return false;">
            <div class="input-group">
              <input type="text" name="message" placeholder="Escribe un mensaje..." class="form-control">
              <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Enviar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@stop
