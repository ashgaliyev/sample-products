@extends('layouts.app')

@section('content')

  @if (count($products) > 0)
    <div class="panel panel-default">
      <div class="panel-heading">
        Product list
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
                  <div>{{ $product->name }}</div>
                </td>

                <td class="table-text">
                  <div>{{ $product->art }}</div>
                </td>

                <td>
                  <form action="/sample-product/{{ $product->id }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button>Delete</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
   @endif
@endsection