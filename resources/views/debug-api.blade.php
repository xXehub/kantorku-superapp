<x-app>
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            Development Tools
                        </div>
                        <h2 class="page-title">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon me-2">
                                <path d="M12 2L2 7l10 5 10-5-10-5z" />
                                <path d="M2 17l10 5 10-5" />
                                <path d="M2 12l10 5 10-5" />
                            </svg>
                            API Debug & Testing
                        </h2>
                    </div>
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            @guest
                                <a href="{{ route('login') }}" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="icon me-1">
                                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                                        <polyline points="10,17 15,12 10,7" />
                                        <line x1="15" y1="12" x2="3" y2="12" />
                                    </svg>
                                    Login
                                </a>
                            @else
                                <span class="badge bg-success fs-6 me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="icon me-1">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                    {{ auth()->user()->name }}
                                </span>
                            @endguest
                            <a href="{{ route('client') }}" class="btn btn-outline-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="icon me-1">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                    <polyline points="9,22 9,12 15,12 15,22" />
                                </svg>
                                Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <!-- Login Card -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="icon me-2">
                                        <rect x="3" y="11" width="18" height="11" rx="2"
                                            ry="2" />
                                        <circle cx="12" cy="16" r="1" />
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                    </svg>
                                    API Authentication
                                </h3>
                            </div>
                            <div class="card-body">
                                <form id="loginForm">
                                    <div class="mb-3">
                                        <label class="form-label required">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Enter email address" value="superadmin@surabaya.go.id"
                                            required>
                                        <small class="form-hint">Use superadmin@surabaya.go.id for testing</small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label required">Password</label>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Enter password" value="superadmin123" required>
                                        <small class="form-hint">Default password: superadmin123</small>
                                    </div>
                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-primary w-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon me-1">
                                                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                                                <polyline points="10,17 15,12 10,7" />
                                                <line x1="15" y1="12" x2="3" y2="12" />
                                            </svg>
                                            Get API Token
                                        </button>
                                    </div>
                                </form>

                                <div id="loginResult" class="mt-3"></div>

                                <div id="tokenDisplay" class="d-none mt-3">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <strong>🎫 Access Token</strong>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    onclick="copyToken()">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="icon">
                                                        <rect x="9" y="9" width="13" height="13"
                                                            rx="2" ry="2" />
                                                        <path
                                                            d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1" />
                                                    </svg>
                                                    Copy
                                                </button>
                                            </div>
                                            <code id="tokenValue"
                                                class="d-block p-2 bg-white border rounded text-break small"></code>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Tests Card -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="icon me-2">
                                        <polygon points="13,2 3,14 12,14 11,22 21,10 12,10 13,2" />
                                    </svg>
                                    Quick API Tests
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <button class="btn btn-outline-primary w-100"
                                            onclick="testEndpoint('/api/user')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon me-1">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                                <circle cx="12" cy="7" r="4" />
                                            </svg>
                                            User Profile
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-outline-primary w-100"
                                            onclick="testEndpoint('/api/panel/dashboard')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon me-1">
                                                <rect x="3" y="3" width="18" height="18" rx="2"
                                                    ry="2" />
                                                <rect x="9" y="9" width="6" height="6" />
                                            </svg>
                                            Dashboard
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-outline-primary w-100"
                                            onclick="testEndpoint('/api/panel/users')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon me-1">
                                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                                <circle cx="9" cy="7" r="4" />
                                                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                            </svg>
                                            Users
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-outline-success w-100"
                                            onclick="testEndpoint('/api/debug/auth-test')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon me-1">
                                                <path d="M12 2L2 7l10 5 10-5-10-5z" />
                                                <path d="M2 17l10 5 10-5" />
                                                <path d="M2 12l10 5 10-5" />
                                            </svg>
                                            Flexible Auth Test
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-outline-info w-100"
                                            onclick="testEndpoint('/api/auth/check')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon me-1">
                                                <circle cx="12" cy="12" r="3" />
                                                <path d="M12 1v6" />
                                                <path d="M12 17v6" />
                                            </svg>
                                            Check Auth Status
                                        </button>
                                    </div>
                                </div>
                                <button class="btn btn-outline-danger w-100" onclick="logout()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="icon me-1">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                        <polyline points="16,17 21,12 16,7" />
                                        <line x1="21" y1="12" x2="9" y2="12" />
                                    </svg>
                                    Logout & Clear Token
                                </button>

                                <div id="quickTestResult" class="mt-3"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Custom API Tester -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="icon me-2">
                                        <path d="M8 2v4" />
                                        <path d="M16 2v4" />
                                        <rect width="18" height="18" x="3" y="4" rx="2" />
                                        <path d="M3 10h18" />
                                        <path d="M8 14h.01" />
                                        <path d="M12 14h.01" />
                                        <path d="M16 14h.01" />
                                        <path d="M8 18h.01" />
                                        <path d="M12 18h.01" />
                                        <path d="M16 18h.01" />
                                    </svg>
                                    Custom API Tester
                                </h3>
                                <div class="card-subtitle">Test any endpoint with custom parameters</div>
                            </div>
                            <div class="card-body">
                                <form id="customApiForm">
                                    <div class="row mb-3">
                                        <div class="col-md-2">
                                            <label class="form-label">Method</label>
                                            <select name="method" class="form-select">
                                                <option value="GET">GET</option>
                                                <option value="POST">POST</option>
                                                <option value="PUT">PUT</option>
                                                <option value="DELETE">DELETE</option>
                                            </select>
                                        </div>
                                        <div class="col-md-10">
                                            <label class="form-label">URL Endpoint</label>
                                            <div class="input-group">
                                                <span class="input-group-text">{{ url('/') }}</span>
                                                <input type="text" name="endpoint" class="form-control"
                                                    placeholder="/api/panel/users" value="/api/user">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Request Body (JSON) - Optional</label>
                                            <textarea name="body" class="form-control" rows="4" placeholder='{"key": "value"}'></textarea>
                                            <small class="form-hint">Only for POST, PUT, DELETE methods</small>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Custom Headers - Optional</label>
                                            <textarea name="headers" class="form-control" rows="4" placeholder='{"Custom-Header": "value"}'></textarea>
                                            <small class="form-hint">JSON format, Authorization header will be added
                                                automatically</small>
                                        </div>
                                    </div>

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon me-1">
                                                <path d="M5 12l5 5L20 7" />
                                            </svg>
                                            Send Request
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary"
                                            onclick="clearCustomForm()">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon me-1">
                                                <path d="M3 6h18" />
                                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                            </svg>
                                            Clear
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- API Documentation -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="icon me-2">
                                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                                    </svg>
                                    API Endpoints Reference
                                </h3>
                                <div class="card-subtitle">
                                    <span class="text-muted">Import Postman collection:</span>
                                    <code class="ms-1">KantorKu-SuperApp-API.postman_collection.json</code>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="text-muted mb-3">🔐 Authentication</h4>
                                        <div class="table-responsive mb-4">
                                            <table class="table table-sm">
                                                <tbody>
                                                    <tr>
                                                        <td><span class="badge bg-blue">POST</span></td>
                                                        <td><code>/api/auth/login</code></td>
                                                        <td>Login & get token</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="badge bg-blue">POST</span></td>
                                                        <td><code>/api/auth/logout</code></td>
                                                        <td>Logout current session</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="badge bg-green">GET</span></td>
                                                        <td><code>/api/user</code></td>
                                                        <td>Get user profile</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <h4 class="text-muted mb-3">👥 User Management</h4>
                                        <div class="table-responsive mb-4">
                                            <table class="table table-sm">
                                                <tbody>
                                                    <tr>
                                                        <td><span class="badge bg-green">GET</span></td>
                                                        <td><code>/api/panel/users</code></td>
                                                        <td>List all users</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="badge bg-blue">POST</span></td>
                                                        <td><code>/api/panel/users</code></td>
                                                        <td>Create new user</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="badge bg-green">GET</span></td>
                                                        <td><code>/api/panel/users/{id}</code></td>
                                                        <td>Get user details</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="text-muted mb-3">🎭 Role Management</h4>
                                        <div class="table-responsive mb-4">
                                            <table class="table table-sm">
                                                <tbody>
                                                    <tr>
                                                        <td><span class="badge bg-green">GET</span></td>
                                                        <td><code>/api/panel/roles</code></td>
                                                        <td>List all roles</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="badge bg-blue">POST</span></td>
                                                        <td><code>/api/panel/roles</code></td>
                                                        <td>Create new role</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="badge bg-green">GET</span></td>
                                                        <td><code>/api/panel/roles/{id}</code></td>
                                                        <td>Get role details</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <h4 class="text-muted mb-3">📊 Dashboard & Stats</h4>
                                        <div class="table-responsive mb-4">
                                            <table class="table table-sm">
                                                <tbody>
                                                    <tr>
                                                        <td><span class="badge bg-green">GET</span></td>
                                                        <td><code>/api/panel/dashboard</code></td>
                                                        <td>Dashboard statistics</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="badge bg-green">GET</span></td>
                                                        <td><code>/api/info/stats</code></td>
                                                        <td>Public statistics</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="badge bg-green">GET</span></td>
                                                        <td><code>/api/info/app</code></td>
                                                        <td>App information</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Response Display -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="icon me-2">
                                        <rect x="2" y="3" width="20" height="14" rx="2"
                                            ry="2" />
                                        <line x1="8" y1="21" x2="16" y2="21" />
                                        <line x1="12" y1="17" x2="12" y2="21" />
                                    </svg>
                                    API Response
                                </h3>
                            </div>
                            <div class="card-body">
                                <div id="responseDisplay">
                                    <div class="empty">
                                        <div class="empty-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                                <polyline points="14,2 14,8 20,8" />
                                                <line x1="16" y1="13" x2="8" y2="13" />
                                                <line x1="16" y1="17" x2="8" y2="17" />
                                                <polyline points="10,9 9,9 8,9" />
                                            </svg>
                                        </div>
                                        <p class="empty-title">No API calls yet</p>
                                        <p class="empty-subtitle text-muted">
                                            API responses will appear here after you make requests
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let currentToken = localStorage.getItem('api_token') || '';

        // Set CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Handle login form submission
        $('#loginForm').on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            // Show loading state
            const submitBtn = $(this).find('button[type="submit"]');
            const originalHtml = submitBtn.html();
            submitBtn.html(
                '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Authenticating...'
                ).prop('disabled', true);

            $.ajax({
                url: '/api/auth/login',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success && response.data && response.data.token) {
                        currentToken = response.data.token;
                        localStorage.setItem('api_token', currentToken);
                        $('#tokenValue').text(currentToken);
                        $('#tokenDisplay').removeClass('d-none');

                        $('#loginResult').html(`
                            <div class="alert alert-success">
                                <div class="d-flex">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-2">
                                            <polyline points="20,6 9,17 4,12"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="alert-title">Login successful!</h4>
                                        <div class="text-muted">Welcome back, ${response.data.user.name}. You can now test API endpoints.</div>
                                    </div>
                                </div>
                            </div>
                        `);

                        showResponse(response, '/api/auth/login', 'POST');
                    } else {
                        throw new Error('Invalid response format');
                    }
                },
                error: function(xhr) {
                    const response = xhr.responseJSON || {};
                    $('#loginResult').html(`
                        <div class="alert alert-danger">
                            <div class="d-flex">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-2">
                                        <circle cx="12" cy="12" r="10"/>
                                        <line x1="15" y1="9" x2="9" y2="15"/>
                                        <line x1="9" y1="9" x2="15" y2="15"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="alert-title">Login failed</h4>
                                    <div class="text-muted">${response.message || xhr.statusText}</div>
                                </div>
                            </div>
                        </div>
                    `);
                    showResponse(response, '/api/auth/login', 'POST', xhr.status);
                },
                complete: function() {
                    // Reset button state
                    submitBtn.html(originalHtml).prop('disabled', false);
                }
            });
        });

        function testEndpoint(url, method = 'GET') {
            // Support both session-based and token-based authentication
            const headers = {
                'Content-Type': 'application/json'
            };

            // Add token if available
            if (currentToken) {
                headers['Authorization'] = 'Bearer ' + currentToken;
            }

            // Add CSRF token for session-based requests
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            if (csrfToken && !currentToken) {
                headers['X-CSRF-TOKEN'] = csrfToken;
            }

            $.ajax({
                url: url,
                type: method,
                headers: headers,
                xhrFields: {
                    withCredentials: true // Important for session-based auth
                },
                success: function(response) {
                    let message = 'API call successful';
                    if (response.data) {
                        if (Array.isArray(response.data)) {
                            message += ` - ${response.data.length} items returned`;
                        } else if (response.data.auth_method) {
                            message += ` (Auth: ${response.data.auth_method})`;
                        }
                    }
                    showQuickResult(message, 'success');
                    showResponse(response, url, method);
                },
                error: function(xhr) {
                    const response = xhr.responseJSON || {};
                    let errorMsg = response.message || xhr.statusText;
                    if (xhr.status === 401) {
                        errorMsg = 'Authentication failed. Try logging in first.';
                    }
                    showQuickResult(`API call failed: ${errorMsg}`, 'danger');
                    showResponse(response, url, method, xhr.status);
                }
            });
        }

        function logout() {
            if (!currentToken) {
                showQuickResult('No active session to logout', 'warning');
                return;
            }

            $.ajax({
                url: '/api/auth/logout',
                type: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + currentToken,
                    'Content-Type': 'application/json'
                },
                success: function(response) {
                    currentToken = '';
                    localStorage.removeItem('api_token');
                    $('#tokenDisplay').addClass('d-none');
                    $('#loginResult').html('');
                    showQuickResult('Logout successful', 'success');
                    showResponse(response, '/api/auth/logout', 'POST');
                },
                error: function(xhr) {
                    const response = xhr.responseJSON || {};
                    showQuickResult(`Logout failed: ${response.message}`, 'danger');
                    showResponse(response, '/api/auth/logout', 'POST', xhr.status);
                }
            });
        }

        function showQuickResult(message, type) {
            const icons = {
                'success': '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-2"><polyline points="20,6 9,17 4,12"/></svg>',
                'danger': '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>',
                'warning': '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>'
            };
            $('#quickTestResult').html(`<div class="alert alert-${type}">${icons[type] || ''}${message}</div>`);
        }

        function showResponse(data, endpoint, method, status = 200, requestBody = null) {
            const statusColor = status >= 400 ? 'danger' : 'success';
            const timestamp = new Date().toLocaleTimeString();
            const methodColors = {
                'GET': 'green',
                'POST': 'blue',
                'PUT': 'yellow',
                'DELETE': 'red'
            };

            let requestSection = '';
            if (requestBody && (method === 'POST' || method === 'PUT' || method === 'DELETE')) {
                requestSection = `
                    <div class="mt-3">
                        <h4 class="text-muted mb-2">📤 Request Body</h4>
                        <pre class="bg-light p-3 rounded border"><code>${JSON.stringify(requestBody, null, 2)}</code></pre>
                    </div>
                `;
            }

            $('#responseDisplay').html(`
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <div>
                        <span class="badge bg-${statusColor}">${status}</span>
                        <span class="badge bg-${methodColors[method] || 'secondary'} ms-1">${method}</span>
                        <strong class="ms-2">${endpoint}</strong>
                    </div>
                    <small class="text-muted">${timestamp}</small>
                </div>
                
                ${requestSection}
                
                <div class="mt-3">
                    <h4 class="text-muted mb-2">📥 Response Body</h4>
                    <div class="card">
                        <div class="card-body p-0">
                            <pre class="bg-dark p-3 m-0 rounded"><code>${JSON.stringify(data, null, 2)}</code></pre>
                        </div>
                    </div>
                </div>
                
                ${data.success !== undefined ? `
                    <div class="mt-3">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card ${data.success ? 'border-success' : 'border-danger'}">
                                    <div class="card-body text-center">
                                        <div class="text-${data.success ? 'success' : 'danger'} mb-2">
                                            ${data.success ? 
                                                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><polyline points="20,6 9,17 4,12"/></svg>' : 
                                                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>'
                                            }
                                        </div>
                                        <h4 class="card-title">${data.success ? 'Success' : 'Failed'}</h4>
                                        <p class="text-muted">${data.message || 'No message'}</p>
                                    </div>
                                </div>
                            </div>
                            ${data.data ? `
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Data Summary</h4>
                                        </div>
                                        <div class="card-body">
                                            ${Array.isArray(data.data) ? 
                                                `<p><strong>${data.data.length}</strong> items returned</p>` : 
                                                `<p>Object with <strong>${Object.keys(data.data).length}</strong> properties</p>`
                                            }
                                        </div>
                                    </div>
                                </div>
                            ` : ''}
                        </div>
                    </div>
                ` : ''}
            `);
        }

        function copyToken() {
            const token = document.getElementById('tokenValue').textContent;
            navigator.clipboard.writeText(token).then(function() {
                showQuickResult('Token copied to clipboard!', 'success');
            }).catch(function() {
                // Fallback for older browsers
                const tokenElement = document.getElementById('tokenValue');
                tokenElement.select();
                document.execCommand('copy');
                showQuickResult('Token copied to clipboard!', 'success');
            });
        }

        // Handle custom API form submission
        $('#customApiForm').on('submit', function(e) {
            e.preventDefault();

            if (!currentToken) {
                showQuickResult('Please login first to test API endpoints', 'warning');
                return;
            }

            const method = $('select[name="method"]').val();
            const endpoint = $('input[name="endpoint"]').val();
            const bodyText = $('textarea[name="body"]').val().trim();
            const headersText = $('textarea[name="headers"]').val().trim();

            if (!endpoint) {
                showQuickResult('Please enter an endpoint URL', 'warning');
                return;
            }

            // Parse request body
            let requestBody = null;
            if (bodyText && (method === 'POST' || method === 'PUT' || method === 'DELETE')) {
                try {
                    requestBody = JSON.parse(bodyText);
                } catch (e) {
                    showQuickResult('Invalid JSON in request body', 'danger');
                    return;
                }
            }

            // Parse custom headers
            let customHeaders = {};
            if (headersText) {
                try {
                    customHeaders = JSON.parse(headersText);
                } catch (e) {
                    showQuickResult('Invalid JSON in custom headers', 'danger');
                    return;
                }
            }

            // Prepare headers
            const headers = {
                'Authorization': 'Bearer ' + currentToken,
                'Content-Type': 'application/json',
                ...customHeaders
            };

            // Show loading state
            const submitBtn = $(this).find('button[type="submit"]');
            const originalHtml = submitBtn.html();
            submitBtn.html(
                '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Sending...'
                ).prop('disabled', true);

            // Make AJAX request
            const ajaxConfig = {
                url: endpoint,
                type: method,
                headers: headers,
                success: function(response) {
                    showQuickResult('Custom API call successful', 'success');
                    showResponse(response, endpoint, method, 200, requestBody);
                },
                error: function(xhr) {
                    const response = xhr.responseJSON || {};
                    showQuickResult(
                        `Custom API call failed: ${response.message || xhr.statusText}`,
                        'danger');
                    showResponse(response, endpoint, method, xhr.status, requestBody);
                },
                complete: function() {
                    submitBtn.html(originalHtml).prop('disabled', false);
                }
            };

            // Add body for POST, PUT, DELETE methods
            if (requestBody && (method === 'POST' || method === 'PUT' || method === 'DELETE')) {
                ajaxConfig.data = JSON.stringify(requestBody);
            }

            $.ajax(ajaxConfig);
        });

        function clearCustomForm() {
            $('#customApiForm')[0].reset();
            $('select[name="method"]').val('GET');
            $('input[name="endpoint"]').val('/api/user');
        }
        // Make functions globally available
        window.testEndpoint = testEndpoint;
        window.logout = logout;
        window.copyToken = copyToken;
        window.clearCustomForm = clearCustomForm;

        // Load saved token on page load
        if (currentToken) {
            $('#tokenValue').text(currentToken);
            $('#tokenDisplay').removeClass('d-none');
        }
    });
</script>
