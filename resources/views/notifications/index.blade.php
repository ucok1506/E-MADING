@extends('layouts.dashboard')

@section('title', 'Notifikasi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-bell me-2"></i>Notifikasi</h2>
    <button class="btn btn-primary" onclick="markAllAsRead()">
        <i class="fas fa-check-double me-1"></i>Tandai Semua Dibaca
    </button>
</div>

@if($notifications->count() > 0)
    <div class="card">
        <div class="card-body p-0">
            @foreach($notifications as $notification)
            <div class="notification-item p-3 border-bottom {{ $notification->is_read ? 'bg-light' : 'bg-white' }}" 
                 data-id="{{ $notification->id }}">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center mb-1">
                            <i class="fas fa-{{ $notification->type === 'success' ? 'check-circle text-success' : ($notification->type === 'warning' ? 'exclamation-triangle text-warning' : ($notification->type === 'danger' ? 'times-circle text-danger' : 'info-circle text-info')) }} me-2"></i>
                            <h6 class="mb-0 {{ !$notification->is_read ? 'fw-bold' : '' }}">{{ $notification->title }}</h6>
                            @if(!$notification->is_read)
                                <span class="badge bg-primary ms-2">Baru</span>
                            @endif
                        </div>
                        <p class="mb-1 text-muted">{{ $notification->message }}</p>
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i>{{ $notification->created_at->diffForHumans() }}
                        </small>
                    </div>
                    <div class="ms-3">
                        @if(!$notification->is_read)
                            <button class="btn btn-sm btn-outline-primary" onclick="markAsRead({{ $notification->id }})">
                                <i class="fas fa-check"></i>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="mt-4">
        {{ $notifications->links() }}
    </div>
@else
    <div class="text-center py-5">
        <i class="fas fa-bell-slash fa-4x text-muted mb-3"></i>
        <h4>Tidak ada notifikasi</h4>
        <p class="text-muted">Notifikasi akan muncul di sini ketika ada aktivitas baru</p>
    </div>
@endif

<script>
function markAsRead(id) {
    fetch(`/notifications/${id}/read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const item = document.querySelector(`[data-id="${id}"]`);
            item.classList.remove('bg-white');
            item.classList.add('bg-light');
            item.querySelector('.fw-bold')?.classList.remove('fw-bold');
            item.querySelector('.badge')?.remove();
            item.querySelector('.btn-outline-primary')?.remove();
            updateNotificationCount();
        }
    });
}

function markAllAsRead() {
    fetch('/notifications/mark-all-read', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    });
}
</script>
@endsection