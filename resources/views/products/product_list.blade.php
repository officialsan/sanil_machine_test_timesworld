@extends('layout') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('success'))
            <div class="alert  alert-dismissible fade show alert-success" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @elseif(session('error'))
            <div class="alert  alert-dismissible fade show alert-danger" role="alert">
                <strong>{{ session('error') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    Product List
                    <a href="{{ route('product-add') }}" class="btn btn-sm btn-secondary float-end"> Add New</a>
                </div>
                <div class="card-body">
                    @if($products)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Variants</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <?php // dd($product->variants[0]->variant); ?>
                            <tr>
                                <th scope="row">{{ $product->id }}</th>
                                <td>
                                    <img src="images/{{$product->image}}" width="50" class="img-thumbnail">
                                </td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->description }}</td>
                                <td>@foreach($product->variants as $variant){{$variant->variant->title}},@endforeach </td>
                                <td>
                                    <a href="{{ route('product-edit', $product->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit "></i>
                                    </a>

                                    <a href="{{ route('product-delete',$product->id) }}" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <h2 class="text-secondary text-center">No products found</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection