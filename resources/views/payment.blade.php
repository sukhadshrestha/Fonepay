@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Please fill this form to proceed to payment') }}</div>
                <div class="card-body">
                    <form method="GET" action="{{ route('payment') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="amount"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>

                            <div class="col-md-6">
                                <input id="amount" type="number" value="1"
                                       class="form-control @error('amount') is-invalid @enderror"
                                       name="amount" required autocomplete="amount" autofocus>

                                @error('amount')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="remarks1"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Remarks 1') }}</label>

                            <div class="col-md-6">
                                <input id="remarks1" type="text" value="test1"
                                       class="form-control @error('remarks1') is-invalid @enderror"
                                       name="remarks1" required autocomplete="remarks1" autofocus>

                                @error('remarks1')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="remarks2"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Remarks 2') }}</label>

                            <div class="col-md-6">
                                <input id="remarks2" type="text" value="test2"
                                       class="form-control @error('remarks2') is-invalid @enderror"
                                       name="remarks2" required autocomplete="remarks2" autofocus>

                                @error('remarks2')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="deviceId"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Device ID') }}</label>

                            <div class="col-md-6">
                                <input id="deviceId" type="text" value="deviceId"
                                       class="form-control @error('deviceId') is-invalid @enderror"
                                       name="deviceId" required autocomplete="deviceId" autofocus>

                                @error('deviceId')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="merchantCode"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Merchant Code') }}</label>

                            <div class="col-md-6">
                                <input id="merchantCode" type="text" value="YXSB"
                                       class="form-control @error('merchantCode') is-invalid @enderror"
                                       name="merchantCode" required autocomplete="merchantCode" autofocus>

                                @error('merchantCode')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>

                        {{--<div class="form-group row">--}}
                            {{--<label for="username"--}}
                                   {{--class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="username" type="text" value=""--}}
                                       {{--class="form-control @error('username') is-invalid @enderror"--}}
                                       {{--name="username" required autocomplete="username" autofocus>--}}

                                {{--@error('username')--}}
                                {{--<span class="invalid-feedback" role="alert">--}}
                                            {{--<strong>{{ $message }}</strong>--}}
                                        {{--</span>--}}
                                {{--@enderror--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="password"--}}
                                   {{--class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password" type="password" value=""--}}
                                       {{--class="form-control @error('password') is-invalid @enderror"--}}
                                       {{--name="password" required autocomplete="password" autofocus>--}}

                                {{--@error('password')--}}
                                {{--<span class="invalid-feedback" role="alert">--}}
                                            {{--<strong>{{ $message }}</strong>--}}
                                        {{--</span>--}}
                                {{--@enderror--}}
                            {{--</div>--}}
                        {{--</div>--}}


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection