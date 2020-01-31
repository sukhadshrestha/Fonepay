@extends('layouts.app')

@section('content')
    <div class="container" style="padding-top: 200px">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">{{ __('Payment Status') }}</div>
                    <div class="card-body">
                        @if($response->success == 'true')
                                <h4 align="center">Payment Successful! {{ $product_id }}</h4>
                        @else
                            <h4>Payment Failed!</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection