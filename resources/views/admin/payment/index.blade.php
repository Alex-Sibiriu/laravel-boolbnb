@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center py-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">PAGAMENTO</div>
                <div class="card-body">
                    <p class="@if (session('success'))
                    d-none
                @endif"> Sponsor <strong class="text-capitalize">{{$sponsor?->name}}</strong> per <strong>{{$house?->title}}</strong></p>
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

                    <form method="post" action="{{ route('admin.payment.create') }}" class="@if (session('success'))
                        d-none
                    @endif">
                        @csrf

                        <div class="form-group">
                            <label for="amount" class="fw-bold mb-2">Pagherai:</label>
                            <input type="" class="border-0" id="amount" name="amount" value="{{$sponsor?->price}}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="nonce"></label>
                            <div id="dropin-container"></div>
                            <input type="hidden" id="nonce" name="payment_method_nonce">
                        </div>

                        <button type="submit" class="btn btn-primary">Paga</button>
                    </form>
                </div>
            </div>
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
