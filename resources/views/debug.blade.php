@extends('layouts.app')

@section('title', 'Debug User - Panel')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5>Debug User Information</h5>
        </div>
        <div class="card-body">
            <h6>Current User Debug:</h6>
            <ul>
                <li><strong>User ID:</strong> {{ auth()->user()->id ?? 'Not logged in' }}</li>
                <li><strong>Name:</strong> {{ auth()->user()->name ?? 'N/A' }}</li>
                <li><strong>Email:</strong> {{ auth()->user()->email ?? 'N/A' }}</li>
                <li><strong>is_superadmin (raw):</strong> {{ auth()->user()->is_superadmin ? 'true' : 'false' }}</li>
                <li><strong>isSuperAdmin() method:</strong> {{ auth()->user()->isSuperAdmin() ? 'true' : 'false' }}</li>
                <li><strong>isAdmin() method:</strong> {{ auth()->user()->isAdmin() ? 'true' : 'false' }}</li>
                <li><strong>hasNonDefaultPermissions():</strong> {{ auth()->user()->hasNonDefaultPermissions() ? 'true' : 'false' }}</li>
                <li><strong>Role ID:</strong> {{ auth()->user()->role_id ?? 'null' }}</li>
                <li><strong>Role Name:</strong> {{ auth()->user()->role->nama_role ?? 'N/A' }}</li>
                <li><strong>Instansi ID:</strong> {{ auth()->user()->instansi_id ?? 'null' }}</li>
                <li><strong>App ID:</strong> {{ auth()->user()->app_id ?? 'null' }}</li>
            </ul>
            
            <hr>
            
            <h6>Available Apps (first 5):</h6>
            @php
                $apps = App\Models\MasterApp::take(5)->get();
            @endphp
            @if($apps->count() > 0)
                <ul>
                    @foreach($apps as $app)
                        <li>
                            <strong>{{ $app->nama_app }}</strong> (ID: {{ $app->id }}) - 
                            <a href="{{ route('panel.apps.edit', $app->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No apps found</p>
            @endif
        </div>
    </div>
</div>
@endsection
