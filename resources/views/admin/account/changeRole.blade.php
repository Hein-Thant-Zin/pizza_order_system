@extends('admin.layouts.master')
@section('title', 'Change Role')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-1 offset-10">
                                <i class="fa-solid fa-arrow-left text-dark mb-3" onclick="history.back()"></i>
                            </div>
                        </div>
                        <div class="col-lg-10 offset-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Change Role</h3>
                                    </div>
                                    <hr>
                                    <form action="{{ route('admin#change', $account->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-4 offset-1">
                                                @if ($account->image != null)
                                                    <img src="{{ asset('storage/' . $account->image) }}"
                                                        class='img-thumbnail shadow-sm' />
                                                @elseif ($account->gender == 'female')
                                                    <img src="{{ asset('admin/images/default_female.png') }}" alt=""
                                                        srcset="">
                                                @else
                                                    <img src="{{ asset('admin/images/default_user.png') }}" alt=""
                                                        srcset="">
                                                @endif

                                                <div class="mt-3">
                                                    <button type="submit" class="col-12 btn bg-dark text-white"><i
                                                            class=" fa-solid fa-circle-chevron-right me-1"></i>
                                                        Change</button>
                                                </div>
                                            </div>
                                            <div class="row col-6">
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Name</label>
                                                    <input disabled id="cc-pament" name="name" type="text"
                                                        value="{{ $account->name }}"
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
                                                    <label class="control-label mb-1">Role</label>
                                                    {{-- <input id="cc-pament" name="role" type="text"
                                                        value="{{ $account->role }}" class="form-control "
                                                        aria-required="true" aria-invalid="false" placeholder=""> --}}
                                                    <select class="form-control" name="role" id="">
                                                        <option class="form-select" value="Admin"
                                                            @if ($account->role == 'admin') selected @endif>Admin</option>
                                                        <option value="User"
                                                            @if ($account->role == 'user') selected @endif>User</option>
                                                    </select>
                                                </div>


                                                <div class="form-group">
                                                    <label class="control-label mb-1">E-mail</label>
                                                    <input disabled id="cc-pament" name="email" type="email"
                                                        value="{{ $account->email }}"
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
                                                    <input disabled id="cc-pament" name="phone" type="number"
                                                        value="{{ $account->phone }}"
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
                                                    <select disabled name="gender"
                                                        class="form-control @error('gender') is-invalid @enderror"
                                                        value="{{ $account->gender }}" id="">
                                                        <option disabled>Choose your gender</option>
                                                        <option class=" form-control" value="male"
                                                            @if ($account->gender == 'male') selected @endif>
                                                            Male</option>
                                                        <option class=" form-control" value="female"
                                                            @if ($account->gender == 'female') selected @endif>
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
                                                    <textarea disabled placeholder="Enter Admin Address" name="address"
                                                        class="form-control  @error('address') is-invalid @enderror" cols="10" rows="10">{{ $account->address }}</textarea>
                                                    @error('address')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
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
