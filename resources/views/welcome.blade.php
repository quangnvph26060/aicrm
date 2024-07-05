@extends('Admin.Layout.index')
@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Thống kê </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Khách hàng mới</p>
                                    <h4 class="card-title">{{ $clientnumber }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                    <i class="far fa-check-circle"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Đơn hàng năm nay</p>
                                    <h4 class="card-title">{{ $ordernumber }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="fas fa-luggage-cart"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Thu nhập năm nay</p>
                                    <h4 class="card-title">{{ number_format($amount) }} VND</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">User Statistics</div>
                            <div class="card-tools">
                                <a href="#" class="btn btn-label-success btn-round btn-sm me-2">
                                    <span class="btn-label">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                    Export
                                </a>
                                <a href="#" class="btn btn-label-info btn-round btn-sm">
                                    <span class="btn-label">
                                        <i class="fa fa-print"></i>
                                    </span>
                                    Print
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="min-height: 375px">
                            <div class="chartjs-size-monitor"
                                style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                <div class="chartjs-size-monitor-expand"
                                    style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                    <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink"
                                    style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                    <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                </div>
                            </div>
                            <canvas id="statisticsChart" width="609" height="375"
                                style="display: block; width: 609px; height: 375px;"
                                class="chartjs-render-monitor"></canvas>
                        </div>
                        <div id="myChartLegend">
                            <ul class="0-legend html-legend">
                                <li><span style="background-color:#f3545d"></span>Subscribers</li>
                                <li><span style="background-color:#fdaf4b"></span>New Visitors</li>
                                <li><span style="background-color:#177dff"></span>Active Users</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-primary card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Thu nhập ngày</div>
                            <div class="card-tools">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-label-light dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Export
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-category">{{ date('d/m/Y') }}</div>
                    </div>
                    <div class="card-body pb-0">
                        <div class="mb-4 mt-2">
                            <h1>{{ number_format($daily['income']) }} VND</h1>
                            <h3><u>{{ $daily['amount'] }} Đơn</u></h3>
                        </div>
                        <div class="pull-in">
                            <div class="chartjs-size-monitor"
                                style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                <div class="chartjs-size-monitor-expand"
                                    style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                    <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink"
                                    style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                    <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                </div>
                            </div>
                            <canvas id="dailySalesChart" width="307" height="150"
                                style="display: block; width: 307px; height: 150px;"
                                class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>
                {{-- <div class="card card-round">
                    <div class="card-body pb-0">
                        <div class="h1 fw-bold float-end text-primary">+5%</div>
                        <h2 class="mb-2">17</h2>
                        <p class="text-muted">Users online</p>
                        <div class="pull-in sparkline-fix">
                            <div id="lineChart"><canvas width="309" height="70"
                                    style="display: inline-block; width: 309.781px; height: 70px; vertical-align: top;"></canvas>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
        {{-- card-body pb-0 --}}
        <div class="row">
            <div class="col-md-6">
                <div class="card card-round">
                    <div class="card-body">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Khách hàng mới</div>
                            <div class="card-tools">
                                <div class="dropdown">
                                    <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-list py-4">
                            @foreach ($newClient as $item)
                                <div class="item-list">
                                    <div class="avatar">
                                        <span
                                            class="avatar-title rounded-circle border border-white text-uppercase {{ randomClass() }}">
                                            {{ substr($item->name, 0, 1) }}
                                        </span>
                                    </div>
                                    <div class="info-user ms-3">
                                        <div class="username">{{ $item->name }}</div>
                                        <div class="status">{{ $item->phone }}</div>
                                    </div>
                                    <button class="btn btn-icon btn-link op-8 me-1">
                                        <i class="far fa-envelope"></i>
                                    </button>
                                    <button class="btn btn-icon btn-link btn-danger op-8">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </div>
                            @endforeach

                            @php
                                function randomColor()
                                {
                                    // Define a range of colors or use an algorithm to generate them dynamically
                                    $colors = ['#FF5733', '#33FF57', '#5733FF', '#33B5E5', '#FFBB33'];
                                    return $colors[array_rand($colors)];
                                }

                                function randomClass()
                                {
                                    // Define a range of classes or use an algorithm to generate them dynamically
                                    $classes = ['bg-primary', 'bg-success', 'bg-info', 'bg-warning', 'bg-danger'];
                                    return $classes[array_rand($classes)];
                                }
                            @endphp

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-round">
                    <div class="card-body">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Nhân viên mới</div>
                            <div class="card-tools">
                                <div class="dropdown">
                                    <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-list py-4">
                            @foreach ($newStaff as $item)
                                <div class="item-list">
                                    <div class="avatar">
                                        <span
                                            class="avatar-title rounded-circle border border-white text-uppercase {{ randomClass() }}">
                                            {{ substr($item->name, 0, 1) }}
                                        </span>
                                    </div>
                                    <div class="info-user ms-1">
                                        <div class="username">{{ $item->name }}</div>
                                        <div class="status">{{ $item->phone }}</div>
                                    </div>
                                    <div class="info-user ms-2">{{ \Carbon\Carbon::parse($item->created_at)->format('m/Y') }}</div>
                                    <button class="btn btn-icon btn-link op-8 me-1">
                                        <i class="far fa-envelope"></i>
                                    </button>
                                    <button class="btn btn-icon btn-link btn-danger op-8">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Đơn hàng gần đây</div>
                            <div class="card-tools">
                                <div class="dropdown">
                                    <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" scope="col">Mã đơn hàng</th>
                                        <th class="text-center" scope="col">Ngày tạo</th>
                                        <th class="text-center" scope="col">Khách hàng</th>
                                        <th class="text-center" scope="col">Tổng tiền (VND)</th>
                                        <th class="text-center" scope="col">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($newOrder as $item)
                                        <tr>
                                            <td class="text-center"><a
                                                    href="{{ route('admin.order.detail', ['id' => $item->id]) }}">{{ $item->id }}</a>
                                            </td>
                                            <td class="text-center">{{ $item->created_at->format('H:i d/m/Y') }}</td>
                                            <td class="text-center">{{ $item->client->name }}</td>
                                            <td class="text-center">{{ number_format($item->total_money) }}</td>
                                            @if ($item->status == 1)
                                                <td class="text-center">
                                                    <span class="badge badge-danger">Đang chờ</span>
                                                </td>
                                            @else
                                                <td class="text-center">
                                                    <span class="badge badge-success">Hoàn thành</span>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
