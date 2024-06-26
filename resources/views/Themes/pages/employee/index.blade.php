@extends('Themes.layouts.app')
@section('content')
    <div class="container">

        <div class="table-responsive table-card mt-100 mb-100">
            <div class="row d-flex justify-content-end">
                <div class=" d-flex justify-content-end mb-2">
                    <div class="dropdown">

                        <button id="openModalProduct" class="dropbtn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 16">
                                <path fill="currentColor"
                                    d="M8.25 3a.5.5 0 0 1 .5.5v3.75h3.75a.5.5 0 0 1 .5.5v.5a.5.5 0 0 1-.5.5H8.75v3.75a.5.5 0 0 1-.5.5h-.5a.5.5 0 0 1-.5-.5V8.75H3.5a.5.5 0 0 1-.5-.5v-.5a.5.5 0 0 1 .5-.5h3.75V3.5a.5.5 0 0 1 .5-.5z" />
                            </svg>
                            Nhân viên
                        </button>


                        <div class="modal fade" id="myModalProduct" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <!-- Modal content -->
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="dropdown">
                        <button class="dropbtn">Xuất file</button>
                    </div>
                </div>
            </div>

            <table class="table table-nowrap table-striped-columns mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="cardtableCheck">
                                <label class="form-check-label" for="cardtableCheck"></label>
                            </div>
                        </th>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Total</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="cardtableCheck01">
                                <label class="form-check-label" for="cardtableCheck01"></label>
                            </div>
                        </td>
                        <td><a href="#" class="fw-semibold">#VL2110</a></td>
                        <td>William Elmore</td>
                        <td>07 Oct, 2021</td>
                        <td>$24.05</td>
                        <td><span class="badge bg-success">Paid</span></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-light">Details</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="cardtableCheck02">
                                <label class="form-check-label" for="cardtableCheck02"></label>
                            </div>
                        </td>
                        <td><a href="#" class="fw-semibold">#VL2109</a></td>
                        <td>Georgie Winters</td>
                        <td>07 Oct, 2021</td>
                        <td>$26.15</td>
                        <td><span class="badge bg-success">Paid</span></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-light">Details</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="cardtableCheck03">
                                <label class="form-check-label" for="cardtableCheck03"></label>
                            </div>
                        </td>
                        <td><a href="#" class="fw-semibold">#VL2108</a></td>
                        <td>Whitney Meier</td>
                        <td>06 Oct, 2021</td>
                        <td>$21.25</td>
                        <td><span class="badge bg-danger">Refund</span></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-light">Details</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="cardtableCheck04">
                                <label class="form-check-label" for="cardtableCheck04"></label>
                            </div>
                        </td>
                        <td><a href="#" class="fw-semibold">#VL2107</a></td>
                        <td>Justin Maier</td>
                        <td>05 Oct, 2021</td>
                        <td>$25.03</td>
                        <td><span class="badge bg-success">Paid</span></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-light">Details</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script>
         document.getElementById("openModalProduct").addEventListener("click", function() {
        var modal = new bootstrap.Modal(document.getElementById("myModalProduct"), {
            backdrop: "static",
            keyboard: false
        });
        modal.show();
    });
    </script>
@endsection
