@extends('admin.layouts.master')
@section('title', 'User List')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">User List</h2>
                            </div>
                        </div>
                        <div class="table-data__tool-right">

                        </div>
                    </div>
                    {{-- alert box for pizzaSuccess --}}
                    @if (session('createSuccess'))
                        <div class=" col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                <strong><i class="fa-solid fa-check"></i> {{ session('createSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    {{-- alert box for pizzaDelete --}}
                    @if (session('deleteSuccess'))
                        <div class=" col-4 offset-8">
                            <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                                <strong><i class="fa-sharp fa-solid fa-circle-xmark"></i>
                                    {{ session('deleteSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-3">
                            <h4 class=" text-secondary"> <span class="text-danger"> {{ request('key') }}</span>
                            </h4>
                        </div>
                        <div class=" col-3 offset-6">
                            <form action="{{ route('admin#orderList') }}" method="GET">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" placeholder="Search.." value="{{ request('key') }}"
                                        class="mr-1 form-control">
                                    <button class=" btn bg-dark text-white" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <h2>Total - {{ $user->total() }}</h2>
                    <div class="table-responsive table-responsive-data2 text-center">


                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <td>Phone</td>
                                    <th>Address</th>
                                    <th>Role</th>

                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($user as $usr)
                                    <tr class="tr-shadow">
                                        <input type="hidden" value="{{ $usr->id }}" name="" id="userId">
                                        <td class="col-1">
                                            @if ($usr->image != null)
                                                <img src="{{ asset('storage/' . $usr->image) }}"
                                                    class='img-thumbnail shadow-sm' />
                                            @elseif ($usr->gender == 'female')
                                                <img src="{{ asset('admin/images/default_female.png') }}" alt=""
                                                    srcset="">
                                            @else
                                                <img src="{{ asset('admin/images/default_user.png') }}" alt=""
                                                    srcset="">
                                            @endif
                                        </td>
                                        <td>{{ $usr->name }}</td>
                                        <td>{{ $usr->email }}</td>
                                        <td>{{ $usr->gender }}</td>
                                        <td>{{ $usr->phone }}</td>
                                        <td>{{ $usr->address }}</td>
                                        <td>
                                            <select name="changeRole" class="form-control" id="changeRole">
                                                {{-- <input value="{{ $usr->id }}" type="hidden"> --}}
                                                <option value="admin" @if ($usr->role == 'admin') selected @endif>
                                                    Admin
                                                </option>
                                                <option @if ($usr->role == 'user') selected @endif value="user">
                                                    User
                                                </option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="mt-3">
                        {{-- {{ for remaining the searching value after changing the paginate }} --}}
                        {{ $user->links() }}

                    </div>
                    {{-- @else --}}
                    {{-- <h2 class="mt-5 text-center align">There is no Product</h2> --}}
                    {{-- @endif --}}


                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
@section('scriptSection')
    <script>
        $(document).ready(function() {
            $('#changeRole').change(function() {
                $currentStatus = $(this).val();
                // console.log($currentStatus);
                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('#userId').val();
                $.ajax({
                    type: 'get',
                    url: '/user/ajax/change/role',
                    dataType: 'json',
                    data: {
                        'role': $currentStatus,
                        'userId': $userId,
                    },
                });
                location.reload();
            });

        })
    </script>
@endsection
