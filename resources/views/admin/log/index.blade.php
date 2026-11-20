
@extends('layouts.app')

@section('content')

<div class="data-page">
    <div class="data-card">

        <div class="data-header">
            <div>
                <h3>Log Aktivitas</h3>
                
            </div>
        </div>

        <div class="data-actions mb-3">
            <a href="{{ route('admin.dashboard') }}" class="data-back">
                <- Kembali ke Dashboard
            </a>
        </div>

        <div class="data-table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Waktu</th>
                        <th>Nama User</th>
                        <th>Aktivitas</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>
                                {{ \Carbon\Carbon::parse($log->waktu_aktivitas)->format('d-m-Y H:i:s') }}
                            </td>
                            <td>{{ $log->user->nama_lengkap ?? '-' }}</td>
                            <td>{{ $log->aktivitas }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">
                                Belum ada aktivitas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="data-pagination">
            {{ $logs->links() }}
        </div>

    </div>
</div>

@endsection
