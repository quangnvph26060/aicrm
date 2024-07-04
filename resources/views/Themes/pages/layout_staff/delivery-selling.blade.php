<div class="col-lg-4" id="delivery-selling-content" style="display: none;">
    <div class="card">
        <div class="card-header">Customer Information</div>
        <div class="card-body" style="max-height: 400px; overflow-y: auto;">
            <!-- Customer information form -->
            <form action="">
                <div class="input-group">
                    <i class="fas fa-search"></i>
                    <input type="text" class="form-control" placeholder="Tìm kiếm khách hàng" name="" id="">
                    <i class="fas fa-plus" data-toggle="modal" data-target="#customerModal"></i>
                </div>
            </form>
            <form>
                <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <input type="text" class="form-control" id="fullName" placeholder="Enter full name">
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="phoneNumber">Phone Number</label>
                    <input type="tel" class="form-control" id="phoneNumber" placeholder="Enter phone number">
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
                    <input type="text" class="form-control" id="driverNote" placeholder="Enter note for driver">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit Order</button>
            </form>
        </div>
    </div>
</div>
