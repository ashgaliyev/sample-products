@extends('layouts.app')

@section('content')
    <div class="panel-body">

        @include('common.errors')

        <form action="{{ url('sample-product') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <h2>Product Formt</h2>

            <div class="form-group">
                <label for="product" class="col-sm-3 control-label">Name</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="product-name" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="product" class="col-sm-3 control-label">Art</label>

                <div class="col-sm-6">
                    <input type="text" name="art" id="product-art" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> 
                        @if ($isNew)
                            Add product
                        @else
                            Save product
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection