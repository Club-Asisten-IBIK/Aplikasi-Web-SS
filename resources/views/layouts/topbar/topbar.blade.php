<div class="d-flex justify-content-between align-items-center mb-2">
    <div>
        @isset($breadcrumb)
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1" style="background:transparent;">
                    @foreach ($breadcrumb as $item)
                        @if ($loop->last)
                            <li class="breadcrumb-item active" aria-current="page">{{ $item }}</li>
                        @else
                            <li class="breadcrumb-item text-secondary">{{ $item }}</li>
                        @endif
                    @endforeach
                </ol>
            </nav>
        @endisset
        <h2 class="fw-bold" style="color:#c63e42;">{{ $title ?? 'Dashboard' }}</h2>
        <p class="text-muted mb-0" style="font-size:1.05rem;">
            {{ $subtitle ?? 'Manage your team members and their account permission here.' }}
        </p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <span class="text-muted">Hallo, Admin</span>
        <span class="position-relative">
            <i class="bi bi-bell" style="font-size:1.3rem;color:#c63e42;"></i>
            <span class="badge bg-danger position-absolute top-0 start-100 translate-middle p-1"
                style="font-size:.7rem;border-radius:999px;">1</span>
        </span>
        <img src="https://randomuser.me/api/portraits/men/1.jpg" class="rounded-circle" width="38" height="38"
            alt="">
    </div>
</div>
