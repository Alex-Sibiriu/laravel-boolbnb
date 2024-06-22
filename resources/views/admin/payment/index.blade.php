@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- <div class="card"> --}}
                {{-- <div class="card-header">Make a Payment</div> --}}

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('admin.payment.create') }}">
                        @csrf

                        <div class="form-group">
                            <label for="amount"></label>
                            <input type="hidden" class="form-control" id="amount" name="amount" value="10.00" readonly>
                        </div>

                        <div class="form-group">
                            <label for="nonce"></label>
                            <div id="dropin-container"></div>
                            <input type="hidden" id="nonce" name="payment_method_nonce">
                        </div>

                        <button type="submit" class="btn btn-primary">Paga</button>
                    </form>
                </div>
            {{-- </div> --}}
        </div>
    </div>
</div>

<script src="https://js.braintreegateway.com/web/dropin/1.35.0/js/dropin.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.querySelector('form');

        fetch('{{ route('admin.payment.token') }}')
            .then(response => response.json())
            .then(data => {
                var clientToken = data.clientToken;

                braintree.dropin.create({
                    authorization: clientToken,
                    container: '#dropin-container'
                }, function (createErr, instance) {
                    if (createErr) {
                        console.error('Error creating Braintree Drop-in:', createErr);
                        return;
                    }

                    form.addEventListener('submit', function (event) {
                        event.preventDefault();

                        instance.requestPaymentMethod(function (err, payload) {
                            if (err) {
                                console.error('Error requesting payment method:', err);
                                return;
                            }

                            document.querySelector('#nonce').value = payload.nonce;
                            form.submit();
                        });
                    });
                });
            })
            .catch(error => console.error('Error fetching client token:', error));
    });
</script>
@endsection
