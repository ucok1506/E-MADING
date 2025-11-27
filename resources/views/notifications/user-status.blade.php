@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Status Artikel Saya</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Judul Artikel</th>
                                    <th>Tanggal Submit</th>
                                    <th>Status</th>
                                    <th>Tanggal Review</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(auth()->user()->articleApprovals()->with('artikel')->latest()->get() as $approval)
                                <tr>
                                    <td>{{ $approval->artikel->judul }}</td>
                                    <td>{{ $approval->tanggal_submit->format('d/m/Y H:i') }}</td>
                                    <td>
                                        @if($approval->status == 'pending')
                                            <span class="badge badge-warning">Menunggu</span>
                                        @elseif($approval->status == 'approved')
                                            <span class="badge badge-success">Disetujui</span>
                                        @else
                                            <span class="badge badge-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $approval->tanggal_review ? $approval->tanggal_review->format('d/m/Y H:i') : '-' }}
                                    </td>
                                    <td>
                                        @if($approval->status == 'rejected' && $approval->alasan_penolakan)
                                            <small class="text-danger">{{ $approval->alasan_penolakan }}</small>
                                        @elseif($approval->status == 'approved')
                                            <small class="text-success">Artikel telah dipublikasikan</small>
                                        @else
                                            <small class="text-muted">Menunggu review admin</small>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada artikel yang disubmit</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection