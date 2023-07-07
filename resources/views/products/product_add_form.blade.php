@extends('layout') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Add Product
                    <a href="{{ route('product-list') }}" class="btn btn-sm btn-secondary float-end">View All</a>
                </div>
                <div class="card-body">
                    <form id="product-form" action="{{ route('product-store') }}" method="POST">
                        @csrf
                        <div class="form-group mt-3">
                            <label for="title">Title</label>
                            <input type="text" class="form-control mt-2" id="title" name="title" placeholder="Enter title" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="title">Description</label>
                            <textarea type="text" class="form-control mt-2" name="description" id="desccription" required></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label for="variants">Variants (multiple)</label>
                            <select multiple class="form-control mt-2" name="variants[]" id="variants" required>
                                @foreach($variants as $variant)
                                <option value="{{ $variant->id }}">{{ $variant->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control-file mt-2" required>
                        </div>
                        <button type="submit" id="submit" class="btn btn-primary float-end">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection @section('page-js')
<script>
    $(document).ready(function() {
        $('#product-form').on('submit', function(e) {
            e.preventDefault();
            let form_data = new FormData(this);
            let url = $(this).attr('action');
            $.ajax({
                url: url,
                data: form_data,
                type: 'post',
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(res) {
                    alert(res.message);
                    window.location.href = "/";
                }
            });
        });
    });
</script>
@endsection