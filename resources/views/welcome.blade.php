@extends('admin.layout.index')

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


<style>
    .slider-container {
        position: relative;
        overflow: hidden;
        width: 100%;
        margin: auto;
        max-height: 180px;
    }

    .slider {
        display: flex;
        transition: transform 0.5s ease;
    }

    .slide {
        flex: 0 0 100%;
        /* Đảm bảo mỗi slide chiếm full width */
    }

    .prev-btn,
    .next-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        cursor: pointer;
        padding: 10px;
        font-size: 20px;
        z-index: 1;
    }

    .prev-btn {
        left: 0;
    }

    .next-btn {
        right: 0;
    }

    .chart-container {
        position: relative;
        width: 100%;
        min-height: 375px;
    }

    #statisticsChart {
        display: block;
        width: 100%;
        height: auto;
    }

    #myChartLegend {
        margin-top: 10px;
    }

    .chart-legend {
        list-style: none;
        padding: 0;
        display: flex;
        justify-content: center;
    }

    .chart-legend li {
        display: flex;
        align-items: center;
        margin-right: 20px;
    }

    .legend-color {
        display: inline-block;
        width: 20px;
        height: 10px;
        margin-right: 5px;
        border-radius: 2px;
    }

    #myChartLegend .legend-color {
        vertical-align: middle;
    }

</style>

<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-0 pb-0"
        style="justify-content: flex-end">
        <div>
            <a class="btn btn-primary" target="_blank" href="{{ route('staff.index') }}" class="fw-bold mb-3 p-0">  <i style="padding-right: 10px" class="fas fa-cart-plus"></i>Bán hàng </a>

        </div>
    </div>
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
                    <div class="chart-container">
                        <canvas id="columnChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-primary card-round" style="margin-bottom: 10px">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title" id="daily">Thu nhập ngày</div>
                        <div class="card-tools">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-label-light dropdown-toggle" type="button"
                                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Theo ngày
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" id="day">Theo ngày</a>
                                    <a class="dropdown-item" id="month">Theo tháng </a>
                                    <a class="dropdown-item" id="year">Theo năm</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-category" id="day_month_year">{{ date('d/m/Y') }}</div>
                </div>
                <div class="card-body pb-0">
                    <div class="m2-4 mt-1" style="padding-top: 0 !improtant;">
                        <p id="income">{{ $daily['income'] }} </p>
                        <p><u id="amount">{{ $daily['amount'] }} Đơn</u></p>
                    </div>

                    <div class="mb-2">
                        <p id="interest">Lợi nhuận : {{ $daily['interest'] }}</p>
                        <p id="moneyinterest">{{ $daily['moneyinterest'] }} </p>
                    </div>
                </div>
            </div>

            <div class="your-slider" style="margin: 0px">

                <!-- Thêm nhiều slide theo nhu cầu -->
            </div>
            <div class="slider-container">
                <div class="slider">
                    <div class="slide"><img style="width: 100%; hight:auto;"
                            src="https://intphcm.com/data/upload/poster-quang-cao-dep-mat.jpg" alt=""></div>
                    <div class="slide"><img style="width: 100%; hight:auto;"
                            src="https://images2.thanhnien.vn/528068263637045248/2024/1/25/e093e9cfc9027d6a142358d24d2ee350-65a11ac2af785880-17061562929701875684912.jpg"
                            alt=""></div>
                    <div class="slide"><img style="width: 100%; hight:auto;"
                            src="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2023/07/anh-dep-thien-nhien-2-1.jpg"
                            alt=""></div>
                </div>
                <button class="prev-btn">&#10094;</button>
                <button class="next-btn">&#10095;</button>
            </div>

        </div>

    </div>

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
                                    class="avatar-title rounded-circle border border-white text-uppercase {{ 'bg-' . substr(md5($item->name), 0, 6) }}">
                                    {{ substr($item->name, 0, 1) }}
                                </span>
                            </div>
                            <div class="info-user ms-1">
                                <div class="username">{{ $item->name }}</div>
                                <div class="status">{{ $item->phone }}</div>
                            </div>
                            <div class="info-user ms-2">
                                {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                            </div>
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
                                    class="avatar-title rounded-circle border border-white text-uppercase {{ 'bg-' . substr(md5($item->name), 0, 6) }}">
                                    {{ substr($item->name, 0, 1) }}
                                </span>
                            </div>
                            <div class="info-user ms-1">
                                <div class="username">{{ $item->name }}</div>
                                <div class="status">{{ $item->phone }}</div>
                            </div>
                            <div class="info-user ms-2">
                                {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                            </div>
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
                                            href="{{ route('admin.order.detail', ['id' => $item->id]) }}">{{ $item->id
                                            }}</a>
                                    </td>
                                    <td class="text-center">{{ $item->created_at->format('H:i d/m/Y') }}</td>
                                    <td class="text-center">{{ $item->client->name }}</td>
                                    <td class="text-center">{{ number_format($item->total_money) }}</td>
                                    @if ($item->status == 1)
                                    <td class="text-center">
                                        <span class="badge badge-success">Hoàn thành</span>
                                    </td>
                                    @else
                                    <td class="text-center">
                                        <span class="badge badge-success">Công nợ</span>
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

<script>
    $(document).ready(function(){
        $('#day').click(function(e){

            $.ajax({
                url: '{{ route('admin.dashboard.day') }}',
                method: 'GET',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    let today = new Date();
                    let formattedDate = today.toLocaleDateString('en-GB', {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric'
                    });
                    $('#day_month_year').text(formattedDate);
                    $('#daily').text('Thu nhập ngày');
                    $('#dropdownMenuButton').text('Theo ngày');
                    $('#income').text(response.daily['income'] );
                    $('#amount').text(response.daily['amount'] + ' Đơn');
                    $('#interest').text('Lợi nhuận : '+response.daily['interest']);
                    $('#moneyinterest').text( response.daily['moneyinterest']);
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.error);
                }
            });
        });

        $('#month').click(function(e){
            $.ajax({
                url: '{{ route('admin.dashboard.month') }}',
                method: 'GET',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    let today = new Date();
                    let month = today.getMonth() + 1;
                    let year = today.getFullYear();
                    let formattedMonthYear = `${month}/${year}`;
                    $('#day_month_year').text(formattedMonthYear);
                    $('#daily').text('Thu nhập tháng');
                    $('#dropdownMenuButton').text('Theo tháng');
                    $('#income').text(response.daily['income'] );
                    $('#amount').text(response.daily['amount'] + ' Đơn');
                    $('#interest').text('Lãi xuất : '+response.daily['interest']);
                    $('#moneyinterest').text( response.daily['moneyinterest']);
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.error);
                }
            });
        })

        $('#year').click(function(e){
            $.ajax({
                url: '{{ route('admin.dashboard.year') }}',
                method: 'GET',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    let today = new Date();
                    let year = today.getFullYear();
                    let formattedYear = `${year}`;
                    $('#day_month_year').text(formattedYear);
                    $('#daily').text('Thu nhập năm');
                    $('#dropdownMenuButton').text('Theo năm');
                    $('#income').text(response.daily['income'] );
                    $('#amount').text(response.daily['amount'] + ' Đơn');
                    $('#interest').text('Lợi nhuận : '+response.daily['interest']);
                    $('#moneyinterest').text( response.daily['moneyinterest']);
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.error);
                }
            });
        })
    });
    function formatCurrency(number) {
        // return Number(number).toLocaleString('vi-VN') + ' VND';
        return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(number).replace('₫', 'VND');
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const slider = document.querySelector(".slider");
    const slides = document.querySelectorAll(".slide");
    const prevBtn = document.querySelector(".prev-btn");
    const nextBtn = document.querySelector(".next-btn");

    let slideIndex = 0;
    const totalSlides = slides.length;
    const autoSlideInterval = 3000;

    showSlide(slideIndex);

    prevBtn.addEventListener("click", function() {
        slideIndex = (slideIndex - 1 + totalSlides) % totalSlides;
        showSlide(slideIndex);
        resetAutoSlide();
    });


    nextBtn.addEventListener("click", function() {
        slideIndex = (slideIndex + 1) % totalSlides;
        showSlide(slideIndex);
        resetAutoSlide();
    });

    let autoSlideTimer = setInterval(function() {
        slideIndex = (slideIndex + 1) % totalSlides;
        showSlide(slideIndex);
    }, autoSlideInterval);

    function resetAutoSlide() {
        clearInterval(autoSlideTimer);
        autoSlideTimer = setInterval(function() {
            slideIndex = (slideIndex + 1) % totalSlides;
            showSlide(slideIndex);
        }, autoSlideInterval);
    }

    function showSlide(index) {
        slider.style.transform = `translateX(${-index * 100}%)`;
    }
});


</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('columnChart').getContext('2d');
            var months = {!! json_encode(range(1, 12)) !!};
            var monthlyRevenue = {!! json_encode($getMonthlyRevenue) !!};

            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months.map(function(month) {
                        return 'Tháng ' + month
                    }),
                    datasets: [{
                        label: 'Doanh thu hàng tháng',
                        data: monthlyRevenue,
                        backgroundColor: [
                            '#f3545d',
                            '#fdaf4b',
                            '#177dff',
                            '#6f42c1',
                            '#20c997',
                            '#ffc107',
                            '#dc3545',
                            '#17a2b8',
                            '#6610f2',
                            '#6c757d',
                        ],
                        borderColor: [
                            '#f3545d',
                            '#fdaf4b',
                            '#177dff',
                            '#6f42c1',
                            '#20c997',
                            '#ffc107',
                            '#dc3545',
                            '#17a2b8',
                            '#6610f2',
                            '#6c757d',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
    });
</script>


@endsection
