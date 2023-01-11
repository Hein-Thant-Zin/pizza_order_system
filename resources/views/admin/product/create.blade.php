@extends('admin.layouts.master')
@section('title', 'Category list Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-3 offset-8">
                                <a href="{{ route('products#list') }}"><button
                                        class="btn bg-dark text-white my-3">List</button></a>
                            </div>
                        </div>
                        <div class="col-lg-6 offset-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Make your pizza</h3>
                                    </div>
                                    <hr>
                                    <form action="{{ route('product#create') }}" enctype="multipart/form-data"
                                        method="post" novalidate="novalidate">
                                        @csrf
                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="pizzaName" value="{{ old('pizzaName') }}"
                                                type="text" class="form-control @error('pizzaName') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Seafood...">
                                            @error('pizzaName')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <select name="pizzaCategory"
                                                class="form-control mt-3 @error('pizzaCategory') is-invalid @enderror"
                                                id="">
                                                <option value="{{ old('pizzaCategory') }}">Choose your category</option>
                                                @foreach ($categories as $c)
                                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('pizzaCategory')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            {{-- <label class="my-2 control-label mb-1">Describe your Pizza</label>
                                            <textarea name="pizzaDescription" id="" class="form-control  @error('pizzaDescription') is-invalid @enderror "
                                                cols="30" rows="10" placeholder="Enter your description..">{{ old('pizzaDescription') }}
                                            </textarea>
                                            @error('pizzaDescription')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror --}}
                                            <label class="my-2 control-label mb-1">Describe your pizza</label>
                                            <textarea name="pizzaDescription" id="" class="form-control @error('pizzaDescription') is-invalid  @enderror"
                                                cols="30" rows="10" placeholder="Enter your description..">{{ old('pizzaDescription') }}</textarea>
                                            @error('pizzaDescription')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror


                                            <label class="control-label mb-1">Upload your pizza picture</label>
                                            <input id="cc-pament" name="pizzaImage" value="{{ old('pizzaImage') }}"
                                                type="file"
                                                class="form-control @error('pizzaImage') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Seafood...">
                                            @error('pizzaImage')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <label class="control-label mb-1">Waiting Time</label>
                                            <input id="cc-pament" name="pizzaWaitingTime"
                                                value="{{ old('pizzaWaitingTime') }} mins " type="number"
                                                class="form-control @error('pizzaWaitingTime') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false"
                                                placeholder="How long it gonna take...">
                                            @error('waitingTime')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <label class="control-label mb-1">Price</label>
                                            <input id="cc-pament" name="pizzaPrice" value="{{ old('pizzaPrice') }}"
                                                type="number"
                                                class="form-control @error('pizzaPrice') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false"
                                                placeholder="What's the pizza price...">
                                            @error('pizzaPrice')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div>
                                            <button id="payment-button" type="submit"
                                                class="btn btn-lg btn-dark btn-block">
                                                <span id="payment-button-amount"> <i
                                                        class="fa-solid fa-circle-right me-1"></i>Create</span>
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
