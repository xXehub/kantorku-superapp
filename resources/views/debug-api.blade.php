<!DOCTYPE html>
<html>

<head>
    <title>🔐 KantorKu SuperApp API Debug & Testing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        .token-display {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
            font-family: 'Courier New', monospace;
            font-size: 11px;
            word-break: break-all;
            position: relative;
        }

        .copy-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 5px 10px;
            font-size: 10px;
        }

        pre {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            font-size: 11px;
            max-height: 400px;
            overflow-y: auto;
        }

        .endpoint-btn {
            margin: 3px;
            font-size: 12px;
        }

        .status-badge {
            font-size: 10px;
            padding: 2px 6px;
        }

        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-light">
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-4">
                    <i class="fas fa-shield-alt text-primary"></i>
                    KantorKu SuperApp API Debug & Testing
                </h1>
                <p class="text-center text-muted">CUMAN GAWE TEST API</p>
            </div>
        </div>

        <!-- Login Section -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5><i class="fas fa-sign-in-alt"></i> 1. Login & Get Token</h5>
                    </div>
                    <div class="card-body">
                        <form id="loginForm">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="superadmin@surabaya.go.id" placeholder="Email" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" value="superadmin123"
                                    placeholder="Password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-key"></i> Login & Get Token
                            </button>
                        </form>
                        <div id="loginResult" class="mt-3"></div>
                        <div id="tokenDisplay" class="token-display d-none">
                            <button class="copy-btn btn btn-sm btn-outline-secondary" onclick="copyToken()">
                                <i class="fas fa-copy"></i> Copy
                            </button>
                            <strong>🎫 Access Token:</strong><br>
                            <span id="tokenValue"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5><i class="fas fa-bolt"></i> 2. Quick API Tests</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <h6>🔐 Authentication</h6>
                                <button onclick="testEndpoint('/api/auth/profile', 'GET')"
                                    class="btn btn-info endpoint-btn">
                                    <i class="fas fa-user"></i> Profile
                                </button>
                                <button onclick="testEndpoint('/api/auth/tokens', 'GET')"
                                    class="btn btn-info endpoint-btn">
                                    <i class="fas fa-list"></i> Tokens
                                </button>
                                <button onclick="logout()" class="btn btn-danger endpoint-btn">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </div>
                            <div class="col-12 mb-2">
                                <h6>👥 Users</h6>
                                <button onclick="testEndpoint('/api/panel/users', 'GET')"
                                    class="btn btn-warning endpoint-btn">
                                    <i class="fas fa-users"></i> List
                                </button>
                                <button onclick="testEndpoint('/api/panel/users/1', 'GET')"
                                    class="btn btn-warning endpoint-btn">
                                    <i class="fas fa-user"></i> Get #1
                                </button>
                            </div>
                            <div class="col-12 mb-2">
                                <h6>🎭 Roles</h6>
                                <button onclick="testEndpoint('/api/panel/roles', 'GET')"
                                    class="btn btn-success endpoint-btn">
                                    <i class="fas fa-users-cog"></i> List
                                </button>
                                <button onclick="testEndpoint('/api/panel/roles/1', 'GET')"
                                    class="btn btn-success endpoint-btn">
                                    <i class="fas fa-user-tag"></i> Get #1
                                </button>
                            </div>
                            <div class="col-12 mb-2">
                                <h6>🔑 Permissions</h6>
                                <button onclick="testEndpoint('/api/panel/permissions', 'GET')"
                                    class="btn btn-secondary endpoint-btn">
                                    <i class="fas fa-key"></i> List
                                </button>
                                <button onclick="testEndpoint('/api/panel/permissions/1', 'GET')"
                                    class="btn btn-secondary endpoint-btn">
                                    <i class="fas fa-lock"></i> Get #1
                                </button>
                            </div>
                            <div class="col-12">
                                <h6>📊 Info</h6>
                                <button onclick="testEndpoint('/api/panel/dashboard', 'GET')"
                                    class="btn btn-primary endpoint-btn">
                                    <i class="fas fa-chart-bar"></i> Dashboard
                                </button>
                                <button onclick="testEndpoint('/api/info/stats', 'GET')"
                                    class="btn btn-outline-primary endpoint-btn">
                                    <i class="fas fa-info"></i> Stats
                                </button>
                            </div>
                        </div>
                        <div id="quickTestResult" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- API Documentation -->
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <h5><i class="fas fa-book"></i> Complete API Endpoints</h5>
                <small>Import the Postman collection: <code>KantorKu-SuperApp-API.postman_collection.json</code></small>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>🔐 Authentication</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>Method</th>
                                        <th>Endpoint</th>
                                        <th>Auth</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><span class="badge bg-success">POST</span></td>
                                        <td>/api/auth/login</td>
                                        <td>❌</td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge bg-primary">GET</span></td>
                                        <td>/api/auth/profile</td>
                                        <td>✅</td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge bg-warning">PUT</span></td>
                                        <td>/api/auth/profile</td>
                                        <td>✅</td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge bg-primary">GET</span></td>
                                        <td>/api/auth/tokens</td>
                                        <td>✅</td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge bg-success">POST</span></td>
                                        <td>/api/auth/logout</td>
                                        <td>✅</td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge bg-success">POST</span></td>
                                        <td>/api/auth/logout-all</td>
                                        <td>✅</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <h6>👥 Users</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>Method</th>
                                        <th>Endpoint</th>
                                        <th>Auth</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><span class="badge bg-primary">GET</span></td>
                                        <td>/api/panel/users</td>
                                        <td>🔐 Admin</td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge bg-success">POST</span></td>
                                        <td>/api/panel/users</td>
                                        <td>🔐 Admin</td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge bg-primary">GET</span></td>
                                        <td>/api/panel/users/{id}</td>
                                        <td>🔐 Admin</td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge bg-warning">PUT</span></td>
                                        <td>/api/panel/users/{id}</td>
                                        <td>🔐 Admin</td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge bg-danger">DELETE</span></td>
                                        <td>/api/panel/users/{id}</td>
                                        <td>🔐 Admin</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6>🎭 Roles</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>Method</th>
                                        <th>Endpoint</th>
                                        <th>Auth</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><span class="badge bg-primary">GET</span></td>
                                        <td>/api/panel/roles</td>
                                        <td>🔐 Admin</td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge bg-success">POST</span></td>
                                        <td>/api/panel/roles</td>
                                        <td>🔐 Admin</td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge bg-primary">GET</span></td>
                                        <td>/api/panel/roles/{id}</td>
                                        <td>🔐 Admin</td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge bg-warning">PUT</span></td>
                                        <td>/api/panel/roles/{id}</td>
                                        <td>🔐 Admin</td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge bg-danger">DELETE</span></td>
                                        <td>/api/panel/roles/{id}</td>
                                        <td>🔐 Admin</td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge bg-primary">GET</span></td>
                                        <td>/api/panel/roles/{id}/permissions</td>
                                        <td>🔐 Admin</td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge bg-warning">PUT</span></td>
                                        <td>/api/panel/roles/{id}/permissions</td>
                                        <td>🔐 Admin</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <h6>🔑 Permissions</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>Method</th>
                                        <th>Endpoint</th>
                                        <th>Auth</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><span class="badge bg-primary">GET</span></td>
                                        <td>/api/panel/permissions</td>
                                        <td>🔐 Admin</td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge bg-success">POST</span></td>
                                        <td>/api/panel/permissions</td>
                                        <td>🔐 Admin</td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge bg-primary">GET</span></td>
                                        <td>/api/panel/permissions/{id}</td>
                                        <td>🔐 Admin</td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge bg-warning">PUT</span></td>
                                        <td>/api/panel/permissions/{id}</td>
                                        <td>🔐 Admin</td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge bg-danger">DELETE</span></td>
                                        <td>/api/panel/permissions/{id}</td>
                                        <td>🔐 Admin</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <h6>📊 Dashboard & Debug</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>Method</th>
                                        <th>Endpoint</th>
                                        <th>Auth</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><span class="badge bg-primary">GET</span></td>
                                        <td>/api/panel/dashboard</td>
                                        <td>🔐 Admin</td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge bg-primary">GET</span></td>
                                        <td>/api/info/app</td>
                                        <td>❌</td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge bg-primary">GET</span></td>
                                        <td>/api/info/stats</td>
                                        <td>❌</td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge bg-primary">GET</span></td>
                                        <td>/api/debug/token-auth</td>
                                        <td>✅</td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge bg-primary">GET</span></td>
                                        <td>/api/debug/database</td>
                                        <td>❌</td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge bg-primary">GET</span></td>
                                        <td>/api/debug/health</td>
                                        <td>❌</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Response Display -->
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h5><i class="fas fa-terminal"></i> API Response</h5>
            </div>
            <div class="card-body">
                <div id="responseDisplay">
                    <p class="text-muted">API responses will appear here...</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentToken = localStorage.getItem('api_token') || '';

        $('#loginForm').on('submit', function(e) {
            e.preventDefault();
            const data = Object.fromEntries(new FormData(this).entries());

            $.ajax({
                url: '/api/auth/login',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(data),
                success: function(response) {
                    if (response.success) {
                        currentToken = response.data.token;
                        localStorage.setItem('api_token', currentToken);
                        $('#tokenValue').text(currentToken);
                        $('#tokenDisplay').removeClass('d-none');

                        $('#loginResult').html(`
                            <div class="alert alert-success">
                                <strong>✅ Login Success!</strong><br>
                                User: ${response.data.user.name}<br>
                                Super Admin: ${response.data.user.is_super_admin ? 'Yes' : 'No'}
                            </div>
                        `);

                        showResponse(response, '/api/auth/login', 'POST');
                    }
                },
                error: function(xhr) {
                    const response = xhr.responseJSON || {};
                    $('#loginResult').html(`
                        <div class="alert alert-danger">
                            <strong>❌ Login Failed</strong><br>
                            ${response.message || 'Unknown error'}
                        </div>
                    `);
                    showResponse(response, '/api/auth/login', 'POST', xhr.status);
                }
            });
        });

        function testEndpoint(url, method = 'GET') {
            if (!currentToken) {
                showQuickResult('❌ Please login first!', 'danger');
                return;
            }

            $.ajax({
                url: url,
                type: method,
                headers: {
                    'Authorization': 'Bearer ' + currentToken,
                    'Content-Type': 'application/json'
                },
                success: function(response) {
                    let message = '✅ Success';
                    if (response.data) {
                        if (Array.isArray(response.data)) {
                            message += `: ${response.data.length} items`;
                        } else if (response.data.recordsTotal !== undefined) {
                            message += `: ${response.data.recordsTotal} records`;
                        } else if (response.data.user) {
                            message += `: ${response.data.user.name}`;
                        }
                    }
                    showQuickResult(message, 'success');
                    showResponse(response, url, method);
                },
                error: function(xhr) {
                    const response = xhr.responseJSON || {};
                    showQuickResult(`❌ Failed: ${response.message || xhr.statusText}`, 'danger');
                    showResponse(response, url, method, xhr.status);
                }
            });
        }

        function logout() {
            if (!currentToken) {
                showQuickResult('❌ No active token!', 'danger');
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
                    showQuickResult('✅ Logout Success', 'success');
                    showResponse(response, '/api/auth/logout', 'POST');
                },
                error: function(xhr) {
                    const response = xhr.responseJSON || {};
                    showQuickResult(`❌ Logout Failed: ${response.message}`, 'danger');
                    showResponse(response, '/api/auth/logout', 'POST', xhr.status);
                }
            });
        }

        function showQuickResult(message, type) {
            $('#quickTestResult').html(`<div class="alert alert-${type}">${message}</div>`);
        }

        function showResponse(data, endpoint, method, status = 200) {
            const statusColor = status >= 400 ? 'danger' : 'success';
            const timestamp = new Date().toLocaleTimeString();

            $('#responseDisplay').html(`
                <div class="mb-3">
                    <span class="badge bg-${statusColor}">${status}</span>
                    <strong>${method}</strong> ${endpoint}
                    <small class="text-muted float-end">${timestamp}</small>
                </div>
                <pre>${JSON.stringify(data, null, 2)}</pre>
            `);
        }

        function copyToken() {
            const token = document.getElementById('tokenValue').textContent;
            navigator.clipboard.writeText(token).then(function() {
                showQuickResult('✅ Token copied to clipboard!', 'success');
            });
        }

        // Load saved token on page load
        if (currentToken) {
            $('#tokenValue').text(currentToken);
            $('#tokenDisplay').removeClass('d-none');
        }
    </script>
</body>

</html>
