@extends('layouts.admin')

@section('title', 'Dashboard - Semanario Loretano')

@section('admin-styles')
<style>
    .analytics-chart {
        height: 280px;
        position: relative;
    }
</style>
@endsection

@section('admin-content')
<h4 class="mb-4">Bienvenido, {{ auth()->user()->name ?? 'Usuario' }} 👋</h4>
        
        <div class="row g-4">
            <div class="col-md-3">
                <div class="stat-card">
                    <h6 class="text-muted">Total Noticias</h6>
                    <h2 class="fw-bold text-primary">{{ \App\Models\News::count() }}</h2>
                    <a href="{{ route('news.index') }}" class="text-decoration-none">Ver todas</a>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="stat-card" style="border-left-color: #e74c3c;">
                    <h6 class="text-muted">Publicidad Activa</h6>
                    <h2 class="fw-bold text-danger">{{ \App\Models\Advertisement::where('is_active', true)->count() }}</h2>
                    <a href="{{ route('advertisements.index') }}" class="text-decoration-none">Gestionar</a>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="stat-card" style="border-left-color: #f39c12;">
                    <h6 class="text-muted">Encabezado</h6>
                    <h2 class="fw-bold text-warning">✏️</h2>
                    <a href="{{ route('header.edit') }}" class="text-decoration-none">Editar encabezado</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card" style="border-left-color: #3498db;">
                    <h6 class="text-muted">Visitas hoy</h6>
                    <h2 class="fw-bold text-info">{{ $visitsToday }}</h2>
                    <span class="text-muted small">{{ $uniqueVisitorsToday }} visitantes únicos</span>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-1">
            <div class="col-lg-5">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-white">
                        <h6 class="mb-0"><i class="bi bi-bar-chart-line"></i> Visitas por periodo</h6>
                    </div>
                    <div class="card-body">
                        <div class="analytics-chart">
                            <canvas id="visits-by-period" aria-label="Gráfico de visitas por periodo"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-white">
                        <h6 class="mb-0"><i class="bi bi-graph-up-arrow"></i> Visitas de la última semana</h6>
                    </div>
                    <div class="card-body">
                        <div class="analytics-chart">
                            <canvas id="visits-by-day" aria-label="Gráfico diario de visitas de la última semana"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-1">
            <div class="col-lg-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-white">
                        <h6 class="mb-0"><i class="bi bi-bar-chart"></i> Páginas más visitadas</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                            <span class="text-muted">Visitas registradas</span>
                            <strong>{{ $totalVisits }}</strong>
                        </div>
                        @forelse($topPages as $page)
                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom gap-2">
                                <span class="text-truncate" title="/{{ $page->url }}">/{{ $page->url }}</span>
                                <span class="badge bg-primary rounded-pill">{{ $page->visits }}</span>
                            </div>
                        @empty
                            <p class="text-muted mb-0">Aún no hay visitas públicas registradas.</p>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-white">
                        <h6 class="mb-0"><i class="bi bi-clock-history"></i> Navegación reciente</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>IP</th>
                                        <th>Página</th>
                                        <th>Dispositivo</th>
                                        <th>Origen</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentVisits as $visit)
                                        <tr>
                                            <td><code>{{ $visit->ip_address ?? '-' }}</code></td>
                                            <td class="text-truncate" style="max-width: 170px;" title="/{{ $visit->url }}">/{{ $visit->url }}</td>
                                            <td>{{ $visit->device_type }}</td>
                                            <td class="text-truncate" style="max-width: 150px;" title="{{ $visit->referrer }}">{{ $visit->referrer ? parse_url($visit->referrer, PHP_URL_HOST) ?: $visit->referrer : 'Directo' }}</td>
                                            <td class="text-nowrap">{{ $visit->visited_at->format('d/m H:i') }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5" class="text-center text-muted py-4">Aún no hay visitas públicas registradas.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Acciones rápidas -->
        <div class="card mt-4 shadow-sm">
            <div class="card-header bg-white">
                <h6 class="mb-0"><i class="bi bi-lightning"></i> Acciones Rápidas</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <a href="{{ route('news.create') }}" class="btn btn-outline-primary w-100 py-3">
                            <i class="bi bi-plus-circle"></i><br>
                            Nueva Noticia
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('advertisements.create') }}" class="btn btn-outline-success w-100 py-3">
                            <i class="bi bi-plus-circle"></i><br>
                            Nueva Publicidad
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('header.edit') }}" class="btn btn-outline-warning w-100 py-3">
                            <i class="bi bi-pencil"></i><br>
                            Editar Encabezado
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary w-100 py-3">
                            <i class="bi bi-people"></i><br>
                            Gestionar Usuarios
                        </a>
                    </div>
                </div>
            </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
<script>
    const chartTextColor = '#52606d';
    const chartGridColor = 'rgba(35, 83, 71, 0.12)';

    new Chart(document.getElementById('visits-by-period'), {
        type: 'bar',
        data: {
            labels: @json($visitPeriodLabels),
            datasets: [{
                label: 'Visitas',
                data: @json($visitPeriodData),
                backgroundColor: ['#3498db', '#235347', '#c9a96e', '#e67e22'],
                borderRadius: 4,
                maxBarThickness: 56,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { ticks: { color: chartTextColor }, grid: { display: false } },
                y: { beginAtZero: true, ticks: { color: chartTextColor, precision: 0 }, grid: { color: chartGridColor } }
            }
        }
    });

    new Chart(document.getElementById('visits-by-day'), {
        type: 'line',
        data: {
            labels: @json($weekLabels),
            datasets: [{
                label: 'Visitas',
                data: @json($weekData),
                borderColor: '#235347',
                backgroundColor: 'rgba(35, 83, 71, 0.14)',
                fill: true,
                tension: 0.35,
                pointBackgroundColor: '#c9a96e',
                pointBorderColor: '#c9a96e',
                pointRadius: 4,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { ticks: { color: chartTextColor }, grid: { display: false } },
                y: { beginAtZero: true, ticks: { color: chartTextColor, precision: 0 }, grid: { color: chartGridColor } }
            }
        }
    });
</script>
@endsection