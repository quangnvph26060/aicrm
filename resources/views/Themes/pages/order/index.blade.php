@extends('Themes.layout_staff.app')
@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="container">
    <h1>Lịch sử đơn hàng </h1>
    <div id="order-data"></div>
    <div class="d-flex justify-content-center">
        <ul id="pagination" class="pagination"></ul>
    </div>
</div>

<script type="text/javascript">
    var j = jQuery.noConflict();

j.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': j('meta[name="csrf-token"]').attr('content')
    }
});

j(document).ready(function() {
    fetch_data(1);

    function fetch_data(page) {
        j.ajax({
            url:  "{{ route('staff.orderFetch') }}?page=" + page,
            success: function(data) {
                let html = `
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Người tạo</th>
                                <th>Người mua</th>
                                <th>Tổng tiền </th>
                                <th>Ngày tạo</th>
                            </tr>
                        </thead>
                        <tbody>
                `;
                j.each(data.data, function(key, order) {


                    html += `
                        <tr>
                            <td>${order.id}</td>
                            <td>${order.user_id}</td>
                            <td>${order.client_id}</td>
                            <td>${order.total_money}</td>
                            <td>${order.create_at}</td>
                        </tr>
                    `;
                });
                html += `
                        </tbody>
                    </table>
                `;
                j('#order-data').html(html);
                let pagination = createPagination(data.current_page, data.last_page);
                j('#pagination').html(pagination);
            }
        });
    }

    function createPagination(current, last) {
        let pagination = '';
        if (last <= 5) {
            for (let i = 1; i <= last; i++) {
                pagination += `<li class="page-item ${i === current ? 'active' : ''}">
                                <a class="page-link" href="#" data-page="${i}">${i}</a>
                            </li>`;
            }
        } else {
            pagination += `<li class="page-item ${1 === current ? 'active' : ''}">
                            <a class="page-link" href="#" data-page="1">1</a>
                        </li>`;
            if (current > 3) {
                pagination += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
            }
            for (let i = Math.max(2, current - 1); i <= Math.min(current + 1, last - 1); i++) {
                pagination += `<li class="page-item ${i === current ? 'active' : ''}">
                                <a class="page-link" href="#" data-page="${i}">${i}</a>
                            </li>`;
            }
            if (current < last - 2) {
                pagination += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
            }
            pagination += `<li class="page-item ${last === current ? 'active' : ''}">
                            <a class="page-link" href="#" data-page="${last}">${last}</a>
                        </li>`;
        }
        return pagination;
    }

    j(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        let page = j(this).data('page');
        fetch_data(page);
    });
});
</script>

@endsection
