@extends('admin.layouts.master')
@section('title', 'Admin list Page')

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
                                <h2 class="title-1">Category List</h2>
                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('auth#registerPage') }}">
                                <button type="submit"
                                    class="btn  btn-active au-btn bg-dark au-btn-icon au-btn--green au-btn--small" <i
                                    class="zmdi zmdi-plus"></i> <i class="fa-solid fa-plus"></i>add admin
                                </button>
                            </a>

                        </div>
                    </div>
                    {{-- alert box for categorySuccess --}}
                    @if (session('createSuccess'))
                        <div class=" col-3 offset-9">
                            <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                                <strong><i class="fa-solid fa-check"></i> {{ session('createSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    {{-- alert box for categoryDelete --}}
                    @if (session('deleteSuccess'))
                        <div class=" col-3 offset-5">
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
                            <h4 class=" text-secondary">Search Key : <span class="text-danger"> {{ request('key') }}</span>
                            </h4>
                        </div>

                        <div class=" col-3 offset-6">
                            <form action="{{ route('admin#list') }}" method="GET">
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
                    <div class="mt-2 ">
                        <div class="float-right ml-3 text-center col-1 offset-10 bg-white shadow-sm p-2">
                            <h3> {{ $admin->total() }} <i class="fa-solid fa-database"></i> </h3>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2 text-center">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>IMAGE</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>phone</th>
                                    <th>address</th>
                                    <th>gender</th>
                                    <th>Change Role</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as $a)
                                    <tr class="tr-shadow">
                                        <td class="col-1">
                                            @if ($a->image != null)
                                                <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                    class='img-thumbnail shadow-sm' />
                                            @elseif ($a->gender == 'female')
                                                <img src="{{ asset('admin/images/default_female.png') }}" alt=""
                                                    srcset="">
                                            @else
                                                <img src="{{ asset('admin/images/default_user.png') }}" alt=""
                                                    srcset="">
                                            @endif
                                        </td>
                                        <td>{{ $a->name }}</td>
                                        <td>{{ $a->email }}</td>
                                        <td>{{ $a->phone }}</td>
                                        <td>{{ $a->address }}</td>
                                        <td>{{ $a->gender }}</td>
                                        <input type="hidden" id="userId" value="{{ $a->id }}">
                                        <td>
                                            @if (Auth::user()->id == $a->id)
                                            @else
                                                <select name="status" class="form-control changeRole   text-center"
                                                    id="">
                                                    <option value="user"
                                                        @if ($a->role == 'user') selected @endif>
                                                        User
                                                    </option>

                                                    <option value="admin"
                                                        @if ($a->role == 'admin') selected @endif>
                                                        Admin
                                                    </option>
                                                </select>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="table-data-feature">
                                                @if (Auth::user()->id == $a->id)
                                                @else
                                                    <a href="{{ route('admin#changeRole', $a->id) }}">
                                                        <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                            title="Change role">
                                                            <i class="fas fa-edit "></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('admin#delete', $a->id) }}">
                                                        <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="mt-3">
                        {{-- {{ for remaining the searching value after changing the paginate }} --}}
                        {{ $admin->links() }}
                        {{-- {{ $categories->appends(request()->query())->links() }}
                        </div>
                    @else
                        <h2 class="mt-5 text-center align">There is no Category</h2>
                    @endif --}}
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
                // console.log('dd');
                $('.changeRole').change(function() {
                    $currentStatus = $(this).val();
                    $parentNode = $(this).parents('tr');
                    $userId = $parentNode.find('#userId').val();
                    $.ajax({

                        type: 'get',
                        url: '/admin/ajax/change/role',
                        dataType: 'Json',
                        data: {
                            'role': $currentStatus,
                            'userId': $userId,
                        },
                    });
                    location.reload();
                })
            })
        </script>
    @endsection
