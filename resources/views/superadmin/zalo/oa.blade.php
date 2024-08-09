@extends('superadmin.layout.index')

@section('content')
    <div class="container">
        <!-- Display success and error messages -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <h2>Thông tin Zalo OA</h2>
        <div class="card mb-3">
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="zaloOaInfo">Thông tin Zalo OA</label>
                        <select class="form-control" id="zaloOaInfo">
                            <option value="" disabled selected>Chọn OA</option>
                            @forelse ($connectedApps as $app)
                                <option value="{{ $app->oa_id }}" data-access-token="{{ $app->access_token }}"
                                    data-refresh-token="{{ $app->refresh_token }}" data-is-active="{{ $app->is_active }}">
                                    {{ $app->name }}
                                </option>
                            @empty
                                <option value="">Không có ứng dụng nào</option>
                            @endforelse
                        </select>
                    </div>
                    <a href="https://oauth.zaloapp.com/v4/oa/permission?app_id=632881483670360761&redirect_uri=https%3A%2F%2Faicrm.vn%2F"
                        class="btn btn-primary" target="_blank">Kết nối Zalo OA</a>
                </form>
            </div>
        </div>

        @if ($connectedApps->isEmpty())
            <div class="alert alert-danger" role="alert">
                Không có dữ liệu Zalo OA. Vui lòng kiểm tra token hoặc địa chỉ API.
            </div>
        @endif

        <h2>OA Đang Kích Hoạt:</h2>
        <div class="card mb-3">
            <div class="card-body">
                <p id="activeOaName">
                    @php
                        $activeOa = $connectedApps->firstWhere('is_active', 1);
                        echo $activeOa ? $activeOa->name : 'Chưa có OA nào được kích hoạt';
                    @endphp
                </p>
            </div>
        </div>

        <h2>Lấy Access Token</h2>
        <div class="card mb-3">
            <div class="card-body">
                <form id="accessTokenForm">
                    <div class="form-group">
                        <label for="tokenType">Loại access token</label>
                        <select class="form-control" id="tokenType">
                            <option>OA Access Token</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="accessToken">Access token</label>
                        <input type="text" class="form-control" id="accessToken" readonly>
                    </div>
                    <div class="form-group">
                        <label for="refreshToken">Refresh token</label>
                        <input type="text" class="form-control" id="refreshToken" readonly>
                    </div>
                    <button type="button" class="btn btn-primary" id="getAccessTokenBtn" disabled>Lấy Access Token</button>
                    <button type="button" class="btn btn-secondary" id="resetBtn">Reset</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('zaloOaInfo').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const oaId = selectedOption.value;

            document.getElementById('accessToken').value = selectedOption.getAttribute('data-access-token') || '';
            document.getElementById('refreshToken').value = selectedOption.getAttribute('data-refresh-token') || '';
            document.getElementById('getAccessTokenBtn').disabled = false;
        });

        document.getElementById('getAccessTokenBtn').addEventListener('click', function() {
            const oaId = document.getElementById('zaloOaInfo').value;

            if (oaId) {
                const url = `{{ route('super.zalo.getAccessTokenForOa', ['oaId' => '__oaId__']) }}`.replace(
                    '__oaId__', oaId);

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        if (data.access_token) {
                            document.getElementById('accessToken').value = data.access_token;
                            document.getElementById('refreshToken').value = data.refresh_token;

                            // Hiển thị thông báo thành công
                            Swal.fire({
                                icon: 'success',
                                title: 'Thành công',
                                text: 'Lấy Access Token thành công!',
                            });

                            // Cập nhật trạng thái OA
                            fetch(`{{ route('super.zalo.updateOaStatus', ['oaId' => '__oaId__']) }}`.replace(
                                    '__oaId__', oaId), {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                            .getAttribute('content')
                                    },
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        // Cập nhật tên OA đang kích hoạt
                                        updateActiveOaName();
                                    } else {
                                        console.error('Error:', data.message);
                                    }
                                })
                                .catch(error => console.error('Fetch Error:', error));
                        } else {
                            console.error('Error:', data.error);
                        }
                    })
                    .catch(error => console.error('Fetch Error:', error));
            } else {
                console.error('No OA selected');
            }
        });

        function updateActiveOaName() {
            fetch('{{ route('super.zalo.getActiveOaName') }}')
                .then(response => response.json())
                .then(data => {
                    if (data.active_oa_name) {
                        document.getElementById('activeOaName').textContent = data.active_oa_name;
                    } else {
                        document.getElementById('activeOaName').textContent = 'Chưa có OA nào được kích hoạt';
                    }
                })
                .catch(error => console.error('Fetch Error:', error));
        }

        document.getElementById('resetBtn').addEventListener('click', function() {
            document.getElementById('accessToken').value = '';
            document.getElementById('refreshToken').value = '';
            document.getElementById('zaloOaInfo').selectedIndex = 0;
            document.getElementById('getAccessTokenBtn').disabled = true;
        });
    </script>
@endsection
