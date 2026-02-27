@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h2 class="fw-bold mb-4">Profile Customer</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="row">
                <div class="col-md-8">
                    <p>Nama: {{ auth()->user()->name }}</p>
                    <p>Email: {{ auth()->user()->email }}</p>
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