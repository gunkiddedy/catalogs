@extends('layouts.app')

@section ('content')

<div class="container">
    <div id="accordion">

        <div class="card border-light">
          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-sm btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Product Images
              </button>
            </h5>
          </div>
      
          <div id="collapseOne" class="collapse show multi-collapse" aria-labelledby="headingOne" >
            <div class="card-body">
                @foreach ($images as $image)
                <img class="mr-5 mb-5 img-thumbnail" src="{{ asset('/storage/'.$image->image_path) }}" alt="image">
                @endforeach
                <table class="table table-sm">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Price</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->brand }}</td>
                        <td>{{ $product->price }}</td>
                      </tr>
                    </tbody>
                  </table>
            </div>
          </div>
        </div>

        <div class="card border-light">
          <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
              <button class="btn btn-sm btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Product Description
              </button>
            </h5>
          </div>
          <div id="collapseTwo" class="collapse multi-collapse" aria-labelledby="headingTwo" >
            <div class="card-body">
                {{ $product->description }}
            </div>
          </div>
        </div>
        
        {{-- <div class="card border-light">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-sm btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Company Profile
              </button>
            </h5>
          </div>
          <div id="collapseThree" class="collapse multi-collapse" aria-labelledby="headingThree" >
            <div class="card-body">
              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
            </div>
          </div>
        </div>
      </div> --}}
</div>

@endsection