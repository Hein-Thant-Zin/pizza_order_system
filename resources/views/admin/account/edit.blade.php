@extends('admin.layouts.master')
@section('title', 'account-details')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-1 offset-10">
                                <a href="{{ route('admin#details') }}"><button
                                        class="btn bg-dark text-white my-3">Back</button></a>
                            </div>
                        </div>
                        <div class="col-lg-10 offset-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Account Profile</h3>
                                    </div>
                                    <hr>
                                    <form action="{{ route('admin#update', Auth::user()->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-4 offset-1">
                                                @if (Auth::user()->image != null)
                                                    <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                        class='img-thumbnail shadow-sm' />
                                                @elseif (Auth::user()->gender == 'female')
                                                    <img src="{{ asset('admin/images/default_female.png') }}" alt=""
                                                        srcset="">
                                                @else
                                                    <img src="{{ asset('admin/images/default_user.png') }}" alt=""
                                                        srcset="">
                                                @endif
                                                <div class="">
                                                    <input type="file"
                                                        class=" form-control mt-2  @error('image') is-invalid

                                                    @enderror"
                                                        name="image" id="">
                                                    @error('image')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror

                                                </div>
                                                <div class="mt-3">
                                                    <button type="submit" class="col-12 btn bg-dark text-white"><i
                                                            class=" fa-solid fa-circle-chevron-right me-1"></i>
                                                        Update</button>
                                                </div>
                                            </div>
                                            <div class="row col-6">
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Name</label>
                                                    <input id="cc-pament" name="name" type="text"
                                                        value="{{ Auth::user()->name }}"
                                                        class="form-control  @error('name') is-invalid @enderror"
                                                        aria-required="true" aria-invalid="false"
                                                        placeholder="Enter Admin Name">
                                                    @error('name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>


                                                <div class="form-group">
                                                    <label class="control-label mb-1">E-mail</label>
                                                    <input id="cc-pament" name="email" type="email"
                                                        value="{{ Auth::user()->email }}"
                                                        class="form-control  @error('email') is-invalid @enderror"
                                                        aria-required="true" aria-invalid="false"
                                                        placeholder="Enter Admin email">
                                                    @error('email')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>


                                                <div class="form-group">
                                                    <label class="control-label mb-1">Phone number</label>
                                                    <input id="cc-pament" name="phone" type="number"
                                                        value="{{ Auth::user()->phone }}"
                                                        class="form-control  @error('phone') is-invalid @enderror"
                                                        aria-required="true" aria-invalid="false"
                                                        placeholder="Enter Admin phone">
                                                    @error('phone')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>


                                                <div class="form-group">
                                                    <label class="control-label mb-1">Gender</label>
                                                    <select name="gender"
                                                        class="form-control @error('gender') is-invalid @enderror"
                                                        value="{{ Auth::user()->gender }}" id="">
                                                        <option disabled>Choose your gender</option>
                                                        <option class=" form-control" value="male"
                                                            @if (Auth::user()->gender == 'male') selected @endif>
                                                            Male</option>
                                                        <option class=" form-control" value="female"
                                                            @if (Auth::user()->gender == 'female') selected @endif>
                                                            Female</option>
                                                    </select>
                                                    @error('gender')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>


                                                <div class="form-group">
                                                    <label class="control-label mb-1">Address</label>
                                                    <textarea placeholder="Enter Admin Address" name="address" class="form-control  @error('address') is-invalid @enderror"
                                                        cols="10" rows="10">{{ Auth::user()->address }}</textarea>
                                                    @error('address')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Role</label>
                                                    <input id="cc-pament" name="role" type="text"
                                                        value="{{ Auth::user()->role }}" class="form-control "
                                                        aria-required="true" aria-invalid="false" disabled placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END MAIN CONTENT-->
@endsection
