@extends('sample-product::layouts')

@section('content')
    <div class="panel-body">

        @if ($isNew)
            <h2>Add product</h2>
        @else
            <h2>Edit product</h2>
        @endif

        @include('sample-product::errors')

        @if ($isNew)
        <form action="{{ url('sample-product') }}" method="POST" class="form-horizontal">
        @else
        <form action="{{ url('sample-product/' . $sampleProduct->id) }}" method="POST" class="form-horizontal">
        @endif
            {{ csrf_field() }}

            <div class="form-group">
                <label for="product" class="col-sm-3 control-label">Name</label>

                <div class="col-sm-6">
                    <input value="{{ old('name') != '' ? old('name') : $sampleProduct->name }}" type="text" name="name" id="product-name" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <a href="/sample-products" class="btn btn-default"><i class="fa fa-hand-o-left"></i> Back to list</a>
                    <button type="submit" class="btn btn-success">                        
                        @if ($isNew)
                            <i class="fa fa-plus"></i> Submit
                        @else
                            <i class="fa fa-save"></i> Save
                        @endif
                    </button>

                </div>
            </div>
        </form>
    </div>
@endsection