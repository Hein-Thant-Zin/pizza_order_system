@extends('admin.layouts.master')
@section('title', 'Product list Page')

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
                                <h2 class="title-1">Products List</h2>
                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('product#createPage') }}">
                                <button type="submit"
                                    class="btn  btn-active bg-dark au-btn au-btn-icon au-btn--green au-btn--small" <i
                                    class="zmdi zmdi-plus"></i> <i class="fa-solid fa-plus"></i>add product
                                </button>
                            </a>
                        </div>
                    </div>
                    {{-- alert box for pizzaSuccess --}}
                    @if (session('updateSuccess'))
                        <div class=" col-3 offset-9">
                            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                <strong><i class="fa-solid fa-check"></i> {{ session('updateSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    {{-- alert box for pizzaDelete --}}
                    @if (session('deleteSuccess'))
                        <div class=" col-3 offset-9">
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
                            <form action="{{ route('products#list') }}" method="GET">
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
                    <div class="  mt-2 ">
                        <div class="float-right ml-3 text-center col-1 offset-10 bg-white shadow-sm p-2">
                            <h3><i class="fa-solid fa-database me-1 "></i>{{ $pizzas->total() }} </h3>
                        </div>
                    </div>
                    {{-- @if (count($categories) != 0)/ --}}
                    @if (count($pizzas) != 0)
                        <div class="table-responsive table-responsive-data2 text-center">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        {{-- <th>Description</th> --}}
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>View count</th>
                                        <th>Created date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pizzas as $pizza)
                                        <tr class="tr-shadow">
                                            <td class="col-3"><img class="w-50 img-thumbnail shadow-sm"
                                                    src="{{ asset('storage/' . $pizza->image) }}"
                                                    alt="Cutest girl on the entire planet"></td>
                                            <td>{{ $pizza->name }}</td>
                                            {{-- <td>{{ $pizza->description }}</td> --}}
                                            <td>{{ $pizza->price }}</td>
                                            <td>{{ $pizza->category_name }}</td>
                                            <td><i class="fa-solid fa-eye me-1"></i>{{ $pizza->view_count }}</td>
                                            <td>{{ $pizza->created_at->format('j-F-Y') }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="{{ route('product#details', $pizza->id) }}">
                                                        <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                            title="View">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </button>
                                                    </a>

                                                    <a href="{{ route('product#edit', $pizza->id) }}">
                                                        <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit "></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('product#delete', $pizza->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                    {{-- <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="More">
                                                    <i class="zmdi zmdi-more"></i>
                                                </button> --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="mt-3">
                            {{-- {{ for remaining the searching value after changing the paginate }} --}}
                            {{ $pizzas->links() }}

                        </div>
                    @else
                        <h2 class="mt-5 text-center align">There is no Product</h2>
                    @endif


                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
