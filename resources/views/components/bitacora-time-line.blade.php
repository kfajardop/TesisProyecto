@props(['casoId'])

@php
    use App\Models\BitacoraCaso;

    $bitacorasAgrupadas = BitacoraCaso::with('usuario')
        ->where('caso_id', $casoId)
        ->latest()
        ->get()
        ->groupBy(fn($bitacora) => $bitacora->created_at->format('d M Y'));
@endphp

<div class="timeline timeline-inverse">
    @forelse ($bitacorasAgrupadas as $fecha => $items)
        <!-- Fecha -->
        <div class="time-label">
            <span class="bg-success">{{ $fecha }}</span>
        </div>

        @foreach ($items as $bitacora)
            <div>
                <i class="fas fa-comment bg-primary"></i>
                <div class="timeline-item">
                    <span class="time"><i class="far fa-clock"></i> {{ $bitacora->created_at->diffForHumans() }}</span>
                    <h3 class="timeline-header">
                        <strong>{{ $bitacora->usuario->name ?? 'Usuario desconocido' }}</strong>
                        @if ($bitacora->titulo)
                            – {{ $bitacora->titulo }}
                        @endif
                    </h3>
                    <div class="timeline-body">
                        <strong>Observaciones:</strong> {!! nl2br(e($bitacora->descripcion)) !!}
                    </div>
                </div>
            </div>
        @endforeach
    @empty
        <div class="time-label">
            <span class="bg-secondary">Sin registros</span>
        </div>
    @endforelse

    <div><i class="far fa-clock bg-gray"></i></div>
</div>
