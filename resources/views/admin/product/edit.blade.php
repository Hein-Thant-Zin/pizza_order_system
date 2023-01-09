@extends('admin.layouts.master')
@section('title', 'Product list Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-11 offset-1">
                    <div class="container-fluid col-12">
                        {{-- <div class="row"> --}}
                        {{-- <div class="col-3 offset-8"> --}}
                        <i class="fa-solid fa-arrow-left text-dark mb-3" onclick="history.back()"></i>
                        {{-- </div> --}}
                        {{-- </div> --}}
                        <div class="">
                            <div class="card ">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Edit your pizza</h3>
                                    </div>
                                    <hr>
                                    <form action="{{ route('product#update', $pizza->product_id) }}" method="post"
                                        novalidate="novalidate" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="control-label b mb-1">Image</label>
                                                    <img class="img-thumbnail mb-1"
                                                        src="{{ asset('storage/' . $pizza->image) }}" alt="">
                                                    <input id="cc-pament" name="pizzaImage"
                                                        value="{{ old('pizzaImage', $pizza->image) }}" type="file"
                                                        class="form-control @error('pizzaImage') is-invalid @enderror"
                                                        aria-required="true" aria-invalid="false" placeholder="Kway..">
                                                    @error('pizzaImage')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="control-label b mb-1">Name</label>
                                                    <input type="hidden" id='upload' name="pizzaPrice"
                                                        value="{{ $pizza->price }}">
                                                    <input id="cc-pament" name="pizzaPrice"
                                                        value="{{ old('pizzaPrice', $pizza->name) }}" type="text"
                                                        class="form-control @error('pizzaPrice') is-invalid @enderror"
                                                        aria-required="true" aria-invalid="false" placeholder="Kway..">
                                                    @error('pizzaPrice')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label b mb-1">Waiting Time</label>
                                                    <input type="hidden" id='upload' name="pizzaWaitingTime"
                                                        value="{{ $pizza->waiting_time }}">
                                                    <input id="cc-pament" name="pizzaWaitingTime"
                                                        value="{{ old('pizzaWaitingTime', $pizza->waiting_time) }}"
                                                        type="text"
                                                        class="form-control @error('pizzaWaitingTime') is-invalid @enderror"
                                                        aria-required="true" aria-invalid="false" placeholder="Kway..">
                                                    @error('pizzaWaitingTime')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label b mb-1">Price</label>
                                                    <input type="hidden" id='upload' name="pizzaPrice"
                                                        value="{{ $pizza->price }}">
                                                    <input id="cc-pament" name="pizzaPrice"
                                                        value="{{ old('pizzaPrice', $pizza->price) }}" type="text"
                                                        class="form-control @error('pizzaPrice') is-invalid @enderror"
                                                        aria-required="true" aria-invalid="false" placeholder="Kway..">
                                                    @error('pizzaPrice')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label b mb-1">Description</label>
                                                    <input type="hidden" id='upload' name="pizzaDescription"
                                                        value="{{ $pizza->description }}">
                                                    <textarea name="pizzaDescription" id="" class="form-control @error('pizzaDescription') is-invalid  @enderror"
                                                        cols="30" rows="10" placeholder="Enter your description..">{{ $pizza->description }}</textarea>
                                                    @error('pizzaDescription')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <button id="payment-button" type="submit"
                                                class="btn btn-lg btn-info btn-block">
                                                <span id="payment-button-amount">Update <i
                                                        class="fa-solid fa-circle-right"></i></span>
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
