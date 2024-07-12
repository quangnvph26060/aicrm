@extends('Themes.layout_staff.app')
@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


<style>
    body {
        background-color: #f8f9fa;
        padding-top: 20px;
    }

    .container {
        background-color: #fff;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        border-radius: 8px;
        margin-top: 20px;
        max-width: 1220px !important;
    }

    .order-table {
        width: 100%;
        margin-top: 20px;
    }

    .order-table th,
    .order-table td {
        padding: 10px;
        text-align: center;
        vertical-align: middle;
    }

    .order-table thead {
        background-color: #007bff;
        color: #fff;
    }

    .order-table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .order-table tbody tr:hover {
        background-color: #e9ecef;
    }

    .pagination {
        justify-content: center;
    }

    #tieude {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #tieude div {
        text-align: left;
    }

    #tieude h2 {
        display: block;
        margin: 0px auto;
    }

    .form-group {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 15px;
        width: 100%;
        box-sizing: border-box;
    }

    .form-group input {
        width: 150px;
        border: 0;
    }


    .form-group {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        margin-bottom: 15px;
    }

    .right-content {
        font-size: 13px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .codeAuto::placeholder {
        font-size: 12px;
    }

    .stock-history {
        border: 1px solid #b2b4b6;
    }

    .stock-history div {
        border-top: 1px solid #b2b4b6;
        min-height: 150px;
        overflow-y: auto;
    }

    #tieude {
        display: flex;
        justify-content: space-between;
        align-items: baseline;

    }

    #search {
        width: 400px;
    }

    .results {
        list-style-type: none;
        padding: 0;
        width: 400px;
        margin-top: 10px;
        border: 1px solid #ccc;
        max-height: 400px;
        overflow-y: auto;
        display: none;
        position: absolute;
        background-color: white;
        z-index: 1000;
        font-family: sans-serif;
        font-size: 14px;
    }

    .results li {
        padding: 10px;
        border-bottom: 1px solid #ccc;

    }

    .results li:last-child {
        border-bottom: none;
    }

    .results li:hover {
        background-color: #f0f0f0;
    }

    .no-results {
        text-align: center;
        color: #888;
    }

    .ovh p {
        padding: 0;
        margin: 0;
    }

    .txtB {
        font-weight: bold;
        font-size: 15px;
    }


    .fa-list {
        position: absolute;
        right: 10px;
        top: 10px;
        color: #007bff;
        cursor: pointer;
    }

    .numberInput {
        width: 100px;
    }
</style>
<div class="container">
    <div class="row mt-4">
        <div class="col-md-9">
            <div class="left-content">
                <div id="tieude">
                    <div><a href="{{ route('staff.Inventory.get') }}"><i class="fas fa-chevron-left"></i> Kiểm kho</a>
                    </div>
                    <div class="">
                        <form action="">
                            <div class="input-group" style="margin-bottom: 20px;">
                                <i class="fas fa-search"></i>
                                <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm" name="search"
                                    id="search" />
                                <i class="fas fa-list" data-toggle="modal" data-target="#listcategory"></i>
                            </div>
                            <ul class="results" id="results">
                                @if ($product)
                                @foreach ($product as $item )
                                <li data-id="{{ $item->id }}" class="product_inventory">
                                    <div style="display: flex; ">
                                        <div class="mr-4">
                                            <img style="width: 80px ; height: 70px;"
                                                src="{{ asset($item->images[0]->image_path) }}" alt="">
                                        </div>
                                        <div class="ovh">
                                            <p class="txtB ng-binding">{{ $item->name }} <span
                                                    class="sugg-attr ng-binding"></span>
                                                <span class="sugg-unit ng-binding"></span>
                                            </p>
                                            <p class="ng-binding">
                                                <span class="ng-binding">Giá: {{ $item->priceBuy }}</span>
                                            </p> <span class="ng-binding">Tồn: {{ $item->quantity }}</span>
                                            <span class="split txtC"></span>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                                @endif
                            </ul>
                        </form>
                    </div>
                </div>
                <table class="table table-bordered order-table">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">#</th>
                            <th scope="col">Mã hàng</th>
                            <th scope="col">Tên hàng</th>
                            <th scope="col">Tồn kho </th>
                            <th scope="col"> Thực tế </th>
                            <th scope="col">SL lệch </th>
                            <th scope="col">Giá trị lệch </th>
                        </tr>
                    </thead>
                    <tbody id="inventory-data-product">
                        <!-- Dữ liệu đơn hàng sẽ được thêm vào đây từ JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-3">
            <div class="right-content">
                <section class="kv2Right stockTake">
                    <article class="kv2Right-content">
                        <div class="kv2Box">
                            <div class="form-wrapper form-labels-220">
                                <div class="form-group">
                                    <div class="pull-left user-created control-label ng-binding">
                                        <span><i class="fa fa-user-circle-o" title="Người tạo"></i></span> {{
                                        $user->name }}
                                    </div>
                                    <div class="pull-right">
                                        <!-- Đoạn input thời gian -->
                                        <input type="datetime-local" id="datetime" name="datetime"
                                            class="datetime-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label control-label ng-binding">Mã kiểm kho</label>
                                    <div class="form-wrap">
                                        <input tabindex="100001" placeholder="Mã phiếu tự động" type="text"
                                            class="form-control codeAuto " />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label control-label ng-binding">Trạng thái</label>
                                    <div class="form-wrap form-control-static ng-binding">Phiếu tạm</div>
                                </div>
                                <!-- Các form-group khác ở đây -->
                                <div class="form-group wrap-note">
                                    <textarea tabindex="100002" placeholder="Ghi chú" class="form-control"
                                        maxlength="2000"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="stock-history uln">
                            <p style="padding: 7px 10px; font-weight: bold ; background: rgb(149, 236, 232)"
                                class="ng-binding m-0">Kiểm gần đây</p>
                            <div>
                                <ul>
                                    <!-- Dữ liệu lịch sử -->
                                </ul>
                            </div>
                        </div>
                    </article>
                    <article class="wrap-button mt-3" style="display: flex; box-sizing:border-box;">
                        <a style="flex: 1" tabindex="100004" class="btn btn-primary ng-binding p-2 mr-1">
                            <i class="fas fa-save"></i> Lưu tạm
                        </a>
                        <a style="flex: 1" tabindex="100005" class="btn btn-success ng-binding p-2 ml-1">
                            <i class="fas fa-check"></i> Hoàn thành
                        </a>
                    </article>
                </section>

            </div>
        </div>
    </div>

    <!-- Phân trang -->
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center" id="pagination">

        </ul>
    </nav>
    {{-- modal --}}
    <div class="modal fade" id="listcategory" tabindex="-1" aria-labelledby="listcategoryLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="width: 650px">
                <div class="modal-header">
                    <h5 class="modal-title" id="listcategoryLabel">Chọn nhóm hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var $j = jQuery.noConflict();
    $j(document).ready(function(){

        $j("#search").on("keyup", function() {
            var query = $j(this).val().toLowerCase();
            var hasResults = false;
            if (query.length > 0) {
                $j("#results").show();
                $j("#results li").each(function() {
                    var name = $j(this).text().toLowerCase();
                    if (name.includes(query)) {
                        $j(this).show();
                        hasResults = true;
                    } else if (!$j(this).hasClass("no-results")) {
                        $j(this).hide();
                    }
                });
                if (hasResults) {
                    $j(".no-results").hide();
                } else {
                    $j(".no-results").show();
                }
            } else {
                $j("#results").hide();
            }
        });

        $j.ajax({
            url: '{{ route('staff.warehome.get') }}',
            type: 'GET',
            success: function(data) {
                var warehouse = $j('#inventory-data-product');
                warehouse.empty();
                data.forEach(function(item,index) {
                var productHtml = `
                        <tr>
                            <td><i data-id='${item.id}' class="fas fa-trash-alt"></i></td>
                            <td>${ index }</td>
                            <td>${item.product.id}</td>
                            <td>${item.product.name}</td>
                            <td>${item.product.quantity}</td>
                            <td><input type="number" class="numberInput" name="quantity" value='' oninput="this.value = this.value.replace(/[^0-9]/g, '');" ></td>
                            <td class='chenhlech'></td>
                            <td class='gtlech'></td>

                        </tr>
                    `;
                    warehouse.append(productHtml);
                });
            },
            error: function(xhr, status, error) {
                console.log('AJAX Error: ' + status + error);
            }
        });

        $j('.product_inventory').click(function(e){
            e.preventDefault();
            var product = $(this).data('id');

            $j.ajax({
                url: '{{ route('staff.warehome.add') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product: product,
                },
                success: function(response) {
                    $('#search').val('');
                    $j('#results').hide();
                    updateWarehouse(response);
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.error);
                }
            });
        });


        $j(document).on('input', '.numberInput', function(e){
            e.preventDefault();
            var value = $j(this).val();
            var tr = $j(this).closest('tr');
            var chenhlech = tr.find('.chenhlech');
            chenhlech.text(value);
        });


        function updateWarehouse(warehouse) {
            var warehousehtml = $j('#inventory-data-product');
            warehousehtml.empty();
            if(warehouse.length === 0) {
                warehousehtml.append('<p>Your cart is empty.</p>');
            } else {
                $.each(warehouse, function(index, item) {
                    var productHtml = `
                        <tr>
                            <td><i class="fas fa-trash-alt"></i></td>
                            <td>${ index }</td>
                            <td>${item.product.id}</td>
                            <td>${item.product.name}</td>
                            <td>${item.product.quantity}</td>
                            <td><input type="number" class="numberInput" name="quantity" value='' oninput="this.value = this.value.replace(/[^0-9]/g, '');" ></td>
                            <td class='chenhlech'></td>
                            <td class='gtlech'></td>
                        </tr>
                    `;
                    warehousehtml.append(productHtml);
                });
            }
        }


    });

</script>



@endsection
