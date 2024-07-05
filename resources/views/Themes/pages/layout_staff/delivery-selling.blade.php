
<div class="col-lg-4" id="delivery-selling-content" style="display: none;">
    <div class="card">
        <div class="card-header">Customer Information</div>
        <div class="card-body" style="max-height: 550px; overflow-y: auto;">
            <!-- Customer information form -->
            <form action="">
                <div class="input-group" style="margin-bottom: 20px;">
                    <i class="fas fa-search"></i>
                    <input type="text" class="form-control" placeholder="Tìm kiếm khách hàng" name="search" id="search" />
                    <i class="fas fa-plus" data-toggle="modal" data-target="#customerModal"></i>
                </div>
                <ul class="results" id="results">
                    <!-- Giả sử mỗi khách hàng có các thông tin fullName, email, phoneNumber -->
                    @if ($clients)
                        @foreach ($clients as $item )
                        <li data-fullname="{{ $item->name }}" data-email="{{ $item->email }}" data-phone="{{ $item->phone }}" data-address="{{ $item->address }}">{{ $item->name .'(' .$item->phone . ')'}}</li>
                        @endforeach
                    @endif
                    <li class="no-results">Không có kết quả</li>
                    <!-- Thêm phần tử này -->
                </ul>
            </form>
            <form id="client">
                <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter full name">
                </div>
                <div class="form-group">
                    <label for="email">Email </label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="phoneNumber">Phone Number</label>
                    <input type="tel" class="form-control" id="phoneNumber" placeholder="Enter phone number">
                </div>

                <div class="form-group">
                    <label for="phoneNumber">Address</label>
                    <input  type="address" class="form-control" id="address" placeholder="Enter address">
                </div>
                <div class="form-group">
                    <label for="paymentMethod">Payment Method</label>
                    <select class="form-control" id="paymentMethod">
                        <option>----- Payment Methods ----- </option>
                        <option>Credit Card</option>
                        <option>PayPal</option>
                        <option>Bank Transfer</option>
                    </select>
                </div>
                {{-- <div class="form-group">
                    <label for="driverNote">Driver's Note</label>
                    <input type="text" class="form-control" id="driverNote" placeholder="Enter note for driver">
                </div> --}}
                <button type="submit" class="btn btn-primary btn-block">Submit Order</button>
            </form>
        </div>
    </div>
</div>
