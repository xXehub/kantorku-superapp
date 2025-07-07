<x-app>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5>Debug User Information - ACTUAL LOGGED IN USER</h5>
        </div>
        <div class="card-body">
            <h6>Current Logged In User Debug:</h6>
            @if(auth()->check())
                <ul>
                    <li><strong>User ID:</strong> {{ auth()->user()->id }}</li>
                    <li><strong>Name:</strong> {{ auth()->user()->name }}</li>
                    <li><strong>Email:</strong> {{ auth()->user()->email }}</li>
                    <li><strong>is_superadmin (raw):</strong> {{ auth()->user()->is_superadmin ? 'true' : 'false' }}</li>
                    <li><strong>isSuperAdmin() method:</strong> {{ auth()->user()->isSuperAdmin() ? 'true' : 'false' }}</li>
                    <li><strong>isAdmin() method:</strong> {{ auth()->user()->isAdmin() ? 'true' : 'false' }}</li>
                    <li><strong>hasNonDefaultPermissions():</strong> {{ auth()->user()->hasNonDefaultPermissions() ? 'true' : 'false' }}</li>
                    <li><strong>Role ID:</strong> {{ auth()->user()->role_id ?? 'null' }}</li>
                    <li><strong>Role Name:</strong> {{ auth()->user()->role->nama_role ?? 'N/A' }}</li>
                    <li><strong>Instansi ID:</strong> {{ auth()->user()->instansi_id ?? 'null' }}</li>
                    <li><strong>App ID:</strong> {{ auth()->user()->app_id ?? 'null' }}</li>
                </ul>
                
                @if(!auth()->user()->isSuperAdmin())
                    <div class="alert alert-warning">
                        <strong>Warning:</strong> You are NOT logged in as superadmin! 
                        Please login as superadmin to test superadmin functionality.
                    </div>
                @else
                    <div class="alert alert-success">
                        <strong>Success:</strong> You are logged in as superadmin.
                    </div>
                @endif
            @else
                <p class="text-danger">Not logged in!</p>
            @endif
            
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
            
            <hr>
            
            <h6>Login as Different Users:</h6>
            <p>To test superadmin functionality, you need to logout and login as the superadmin user.</p>
            <a href="{{ route('logout') }}" class="btn btn-warning" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout Current User
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</div>
</x-app>