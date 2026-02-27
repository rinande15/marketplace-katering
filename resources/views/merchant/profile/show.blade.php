@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h2 class="fw-bold mb-4">Profile Merchant</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="row">
                <div class="col-md-8">
                    <h4 class="fw-bold">{{ $merchant->company_name }}</h4>

                    <hr>

                    <p>
                        <strong>Alamat:</strong><br>
                        {{ $merchant->address }}
                    </p>

                    <p>
                        <strong>No. Telepon:</strong><br>
                        {{ $merchant->phone }}
                    </p>

                    <p>
                        <strong>Deskripsi:</strong><br>
                        {{ $merchant->description ?? 'Belum ada deskripsi.' }}
                    </p>

                    <p>
                        <strong>Bergabung Sejak:</strong><br>
                        {{ $merchant->created_at->format('d M Y') }}
                    </p>
                </div>

                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="{{ route('merchant.profile.edit') }}"
                        class="btn btn-warning">
                        ✏ Edit Profile
                    </a>

                    <a href="{{ route('merchant.dashboard') }}"
                        class="btn btn-secondary">
                        ← Kembali ke Dashboard
                    </a>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection