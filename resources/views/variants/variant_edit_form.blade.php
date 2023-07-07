@extends('layout') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Edit Variant
                    <a href="{{ route('variant-list') }}" class="btn btn-sm btn-secondary float-end">View All</a>
                </div>
                <div class="card-body">
                    <form id="variant-form" action="{{ route('variant-update') }}" method="POST">
                        <input type="hidden" value="{{$variant->id}}" name="id"> @csrf
                        <div class="form-group mt-3">
                            <label for="title">Title</label>
                            <input type="text" class="form-control mt-2" id="title" value="{{ $variant->title ?? '' }}" name="title" placeholder="Enter title"
                                required>
                        </div>

                        <button type="submit" id="submit" class="btn btn-primary float-end  mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection @section('page-js')
<script>
    $(document).ready(function() {
        $('#variant-form').on('submit', function(e) {
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
                    window.location.href = "/variants";
                }
            });
        });
    });
</script>
@endsection