@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Referrel Url</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <input onclick="myFunction()" id="myInput" class="btn btn-success" type="text" readonly="readonly" value="{{ url('/') . '/register/?ref=' . Auth::user()->id }}" style="width: 310px;padding: 5px;border-radius: 5px;border: 1px solid #ddd;">
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Poient List</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">Si</th>
                          <th scope="col">Product Name</th>
                          <th scope="col">Price</th>
                          <th  style="text-align: center;" scope="col">Buy</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($products as $key=>$item)
                            <tr>
                              <th scope="row">{{ $key + 1 }}</th>
                              <td>{{ $item->product_name }}</td>
                              <td>${{ $item->product_price}} </td>
                              <td style="text-align: center;"><a href="{{ URL::to('/process/'.$item->id) }}" class="btn btn-primary">Buy</a></td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  document.execCommand("copy");
}
</script>