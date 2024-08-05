@extends('superadmin.layout.index')

@section('content')
    <div class="container">
        <h2>Thông tin Zalo OA</h2>
        <div class="card mb-3">
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="zaloOaInfo">Thông tin Zalo OA</label>
                        <select class="form-control" id="zaloOaInfo">
                            @if (!empty($connectedApps['data']) && isset($connectedApps['data']['oa_id'], $connectedApps['data']['name']))
                                <option value="{{ $connectedApps['data']['oa_id'] }}">
                                    {{ $connectedApps['data']['name'] }}
                                </option>
                            @else
                                <option value="">Không có ứng dụng nào</option>
                            @endif
                        </select>
                    </div>
                    <a href="https://oauth.zaloapp.com/v4/oa/permission?app_id=632881483670360761&redirect_uri=https%3A%2F%2Faicrm.vn%2F"
                        class="btn btn-primary" target="_blank">Kết nối Zalo OA</a>
                </form>
            </div>
        </div>

        <!-- Xử lý lỗi và thông báo -->
        @if (empty($connectedApps['data']))
            <div class="alert alert-danger" role="alert">
                Không thể lấy dữ liệu từ API. Vui lòng kiểm tra token hoặc địa chỉ API.
            </div>
        @endif

        <h2>Lấy Access Token</h2>
        <div class="card mb-3">
            <div class="card-body">
                <form id="accessTokenForm">
                    <div class="form-group">
                        <label for="tokenType">Loại access token</label>
                        <select class="form-control" id="tokenType">
                            <option>User Access Token</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="accessToken">Access token</label>
                        <input type="text" class="form-control" id="accessToken" value="" readonly>
                    </div>
                    <div class="form-group">
                        <label for="refreshToken">Refresh token</label>
                        <input type="text" class="form-control" id="refreshToken" value="" readonly>
                    </div>
                    <button type="button" class="btn btn-primary" id="getAccessTokenBtn">Lấy Access Token</button>
                    <button type="button" class="btn btn-secondary">Reset</button>
                </form>
            </div>
        </div>

        <h2>Thông tin ứng dụng</h2>
        <div class="card mb-3">
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="appStatus">Trạng thái</label>
                        <div>
                            <span class="badge badge-success">Đã kích hoạt</span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="appId">ID ứng dụng</label>
                            <input type="text" class="form-control" id="appId"
                                value="{{ $connectedApps['data']['oa_id'] ?? '' }}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="appSecret">Khóa bí mật của ứng dụng</label>
                            <input type="password" class="form-control" id="appSecret" value="********************"
                                readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="appName">Tên hiển thị</label>
                            <input type="text" class="form-control" id="appName"
                                value="{{ $connectedApps['data']['name'] ?? '' }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="contactPhone">Điện thoại liên hệ</label>
                            <input type="text" class="form-control" id="contactPhone" value="+84 868 582 002">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="contactEmail">Email liên hệ</label>
                            <input type="email" class="form-control" id="contactEmail" value="phamtuanphongsme@gmail.com">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="appCategory">Danh mục</label>
                            <select class="form-control" id="appCategory">
                                <option selected>{{ $connectedApps['data']['cate_name'] ?? '' }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="appDescription">Mô tả</label>
                            <textarea class="form-control" id="appDescription">{{ $connectedApps['data']['description'] ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="appIcon">Icon ứng dụng (512 x 512)</label>
                        <input type="file" class="form-control-file" id="appIcon">
                    </div>
                    <div class="form-group">
                        <label for="packageValidThrough">Gói dịch vụ hết hạn vào</label>
                        <input type="text" class="form-control" id="packageValidThrough"
                            value="{{ $connectedApps['data']['package_valid_through_date'] ?? '' }}" readonly>
                    </div>
                    <button type="button" class="btn btn-primary">Lưu thay đổi</button>
                </form>
            </div>
        </div>
    </div>

    <style>
        .container {
            max-width: 800px;
            margin: auto;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .card-body {
            padding: 20px;
        }

        h2 {
            margin-top: 20px;
            font-size: 24px;
            font-weight: 600;
            color: #333;
        }

        .form-group label {
            font-weight: 600;
            color: #555;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ddd;
        }
    </style>
    <script>
        document.getElementById('getAccessTokenBtn').addEventListener('click', function() {
            fetch('{{ route('super.zalo.getAccessToken') }}')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('accessToken').value = data.access_token;
                    document.getElementById('refreshToken').value = data.refresh_token;
                })
                .catch(error => {
                    console.error('Error fetching access token:', error);
                });
        });
    </script>
@endsection
