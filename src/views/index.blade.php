@extends('sample-product::layouts')

@section('content')

        @if (Session::has('sp_flash'))

          <div class="alert alert-success">
          {{ Session::get('sp_flash') }}
          </div>

        @endif

      <div class="panel-heading">
        <h2>Product list</h2>
      </div>

      <div class="panel-body">
        <table class="table table-striped task-table">

          <thead>
            <th>Name</th>
            <th>Article</th>
            <th></th>
          </thead>

          <tbody>
            @foreach ($products as $product)
              <tr>
                <td class="table-text">
                  <div><a href="/sample-product/{{ $product->id }}">{{ $product->name }}</a></div>
                </td>

                <td class="table-text">
                  <div>{{ $product->art }}</div>
                </td>

                <td>
                  <form action="/sample-product/{{ $product->id }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button onclick="return confirm('Are you sure?')" class="btn btn-danger"><i class="fa fa-remove"></i> Delete</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        @if (app('current_user_type') == 'admin')

        <a class="btn btn-success" href="/sample-product"><i class="fa fa-plus"></i> Add product</a>

        @endif
      </div>
    
@endsection