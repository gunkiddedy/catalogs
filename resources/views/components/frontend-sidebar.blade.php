<div class="col-lg-3 col-md-3 col-sm-6 frontend-sidebar">
    {{-- <h3><i class="fa fa-filter"></i> Filter </h3> --}}
    <input class="mt-3 mb-2" type="text" id="search" placeholder="search product or company..." style="width:100%;">
    {{-- <div class="filterprice card mb-2">
        <div class="card-body">
            <h5 class="card-title">Price</h5>
            <input type="range" min="{{ $minPrice }}" max="{{ $maxPrice }}" value="100000" class="slider selector" id="pricerange">
            <p class="p-0 m-0">Max: Rp <span id="currentrange">{{ $minPrice }}</span></p>
        </div>
    </div> --}}
    <div class="filtergender card mb-2">
        <div class="card-body">
            <h5 class="card-title">Provinsi</h5>
            {{-- <hr> --}}
            <div class="inline">
                {{-- <input type="checkbox" id="{{ $provinsi->name }}" class="custom-control-input" name="{{ $provinsi->name }}" value="{{ $provinsi->name }}" > --}}
                <select name="provinsi_id" id="" class="form-control">
                    <option value="" selected>Choose...</option>
                    @foreach ($provinsis as $provinsi)
                    <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                    @endforeach
                </select>
                {{-- <label class="custom-control-label" for="{{ $provinsi->name }}">{{ ucfirst($provinsi->name) }}</label> --}}
            </div>
        </div>
    </div>
    <div class="filtergender card mb-2">
        <div class="card-body">
            <h5 class="card-title">Kabupaten</h5>
            {{-- <hr> --}}
            <div class="inline">
                {{-- <input type="checkbox" id="{{ $provinsi->name }}" class="custom-control-input" name="{{ $provinsi->name }}" value="{{ $provinsi->name }}" > --}}
                <select name="kabupaten_id" id="" class="form-control">
                    <option value="" selected>Choose...</option>
                    @foreach ($kabupatens as $kabupaten)
                    <option value="{{ $kabupaten->id }}">{{ $kabupaten->name }}</option>
                    @endforeach
                </select>
                {{-- <label class="custom-control-label" for="{{ $provinsi->name }}">{{ ucfirst($provinsi->name) }}</label> --}}
            </div>
        </div>
    </div>
    {{-- <div class="filtergender card mb-2">
        <div class="card-body">
            <h5 class="card-title">Kabupaten</h5>
            <hr>
            @foreach ($kabupatens as $kabupaten)
            <div class="custom-control custom-checkbox">
                <input type="checkbox" id="{{ $kabupaten->name }}" class="custom-control-input" name="{{ $kabupaten->name }}" value="{{ $kabupaten->name }}" >
                <label class="custom-control-label" for="{{ $kabupaten->name }}">{{ ucfirst($kabupaten->name) }}</label>
            </div>
            @endforeach
        </div>
    </div> --}}
    <div class="filtergender card mb-2">
        <div class="card-body">
            <h5 class="card-title">Categories</h5>
            {{-- <hr> --}}
            @foreach ($category as $cat)
            <div class="custom-control custom-checkbox">
                <input type="checkbox" id="{{ $cat->name }}" class="custom-control-input" name="{{ $cat->name }}" value="{{ $cat->name }}" >
                <label class="custom-control-label" for="{{ $cat->name }}">{{ ucfirst($cat->name) }}</label>
            </div>
            @endforeach
        </div>
    </div>
    <div class="filtergender card mb-2">
        <div class="card-body">
            <h5 class="card-title">Sub Categories</h5>
            {{-- <hr> --}}
            @foreach ($subcategory as $subcat)
            <div class="custom-control custom-checkbox">
                <input type="checkbox" id="{{ $subcat->name }}" class="custom-control-input" name="{{ $subcat->name }}" value="{{ $subcat->name }}" >
                <label class="custom-control-label" for="{{ $subcat->name }}">{{ ucfirst($subcat->name) }}</label>
            </div>
            @endforeach
        </div>
    </div>

</div>
{{-- end of filter ============================= --}}