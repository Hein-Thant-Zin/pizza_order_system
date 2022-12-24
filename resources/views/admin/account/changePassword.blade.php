@extends('admin.layouts.master')
@section('title', 'changing-password')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-3 offset-8">
                                <a href="{{ route('category#list') }}"><button
                                        class="btn bg-dark text-white my-3">List</button></a>
                            </div>
                        </div>
                        <div class="col-lg-6 offset-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Change your password</h3>
                                    </div>
                                    @if (session('changeSuccess'))
                                        <div class=" col-12">
                                            <div class="alert alert-success alert-dismissible fade show text-center"
                                                role="alert">
                                                <strong><i class="fa-solid fa-check me-2"></i>
                                                    {{ session('changeSuccess') }}</strong>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        </div>
                                    @endif
                                    <hr>
                                    <form action="{{ route('admin#changePassword') }}" method="post"
                                        novalidate="novalidate">
                                        @csrf
                                        <div class="form-group">
                                            <label class="control-label mb-1">Enter your old password</label>
                                            <input id="cc-pament" name="oldPassword" value="{{ old('oldPassword') }}"
                                                type="password"
                                                class="form-control @if (session('notMatch')) is-invalid @endif   @error('oldPassword') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="">
                                            @error('oldPassword')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            @if (session('notMatch'))
                                                <div class="invalid-feedback">
                                                    {{ session('notMatch') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">New password</label>
                                            <input id="cc-pament" name="newPassword" type="password"
                                                value="{{ old('newPassword') }}"
                                                class="form-control @if (session('samePsw')) is-invalid @endif @error('newPassword') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="">
                                            @error('newPassword')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            @if (session('samePsw'))
                                                <div class="invalid-feedback">
                                                    {{ session('samePsw') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Confirm password</label>
                                            <input id="cc-pament" name="confirmPassword" type="password"
                                                class="form-control @error('confirmPassword') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="">
                                            @error('confirmPassword')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div>
                                            <button id="payment-button" type="submit"
                                                class="btn btn-lg btn-info btn-block">
                                                <i class="fa-solid fa-key"></i> <span id="payment-button-amount">Change
                                                    Password</span>
                                                {{-- <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                <i class="fa-solid fa-circle-right"></i> --}}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
