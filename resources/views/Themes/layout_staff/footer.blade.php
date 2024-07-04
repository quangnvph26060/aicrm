<div class="row mt-4  custom-border-shadow custom-list-item">
    <div class="col-lg-6">
        <ul class="d-flex justify-content-between">
            <li class="d-flex justify-content-between align-items-center " id="fast-selling">
                {{-- <i class="fas fa-bolt"></i> Bán nhanh --}}
            </li>
            <li class="d-flex justify-content-between align-items-center" id="regular-selling">
                {{-- <i class="fas fa-shopping-bag"></i> Bán thường --}}
            </li>
            <li class="d-flex justify-content-between align-items-center" id="delivery-selling">
                {{-- <i class="fas fa-truck"></i> Bán giao hàng --}}
            </li>

        </ul>
    </div>
    <div class="col-lg-6">
        <li class="d-flex justify-content-end align-items-center" id="phone-number">
            {{-- <i class="fas fa-phone"></i> Số điện thoại: 1234567890 --}}
        </li>
    </div>
</div>
</div>
<!-- Right side: Footer -->
<!-- Modal -->
<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="customerModalLabel">Customer Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-6">
                    <form>
                        <div class="form-group">
                            <label for="fullName">Full Name</label>
                            <input type="text" class="form-control" id="fullName"
                                placeholder="Enter full name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email"
                                placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="phoneNumber">Phone Number</label>
                            <input type="tel" class="form-control" id="phoneNumber"
                                placeholder="Enter phone number">
                        </div>
                        <div class="form-group">
                            <label for="paymentMethod">Payment Method</label>
                            <select class="form-control" id="paymentMethod">
                                <option>Credit Card</option>
                                <option>PayPal</option>
                                <option>Bank Transfer</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="driverNote">Driver's Note</label>
                            <input type="text" class="form-control" id="driverNote"
                                placeholder="Enter note for driver">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Submit Order</button>
                    </form>
                </div>
                <div class="col-lg-6 user-image">
                    <img src="https://via.placeholder.com/150" alt="User Image">
                    <!-- Replace the src value with the actual image URL -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- JavaScript code -->
<script src="{{asset('js/staff.js')}}"></script>
</body>

</html>
