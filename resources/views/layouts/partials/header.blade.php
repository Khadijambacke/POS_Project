<div class="top-header">
    <div>
        <h5 class="mb-0 fw-bold">@yield('page-title')</h5>
        <small class="text-muted">{{ now()->format('d/m/Y') }}</small>
    </div>
    <div>
        {{ Auth::user()->name }}
    </div>
</div>
