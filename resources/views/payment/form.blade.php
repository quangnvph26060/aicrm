<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
</head>
<body>
    <form action="{{ route('payment.process') }}" method="post">
        @csrf
        <div>
            <label for="amount">Amount:</label>
            <input type="text" id="amount" name="amount">
        </div>
        <div>
            <button type="submit">Pay with MoMo</button>
        </div>
    </form>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>
