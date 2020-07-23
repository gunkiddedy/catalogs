<div class="col-lg-3 col-md-3 col-sm-6 frontend-sidebar">

    <input class="mt-3 mb-2" type="text" name="query" 
        id="search" 
        placeholder="search product or company..." 
        style="width:100%;"
        value="{{ request()->get('query') }}"
    >

    <div class="filtergender card mb-2">
        <div class="card-body">
            <h5 class="card-title">Provinsi</h5>
            <div class="inline">
                <select name="provinsi_id" id="" class="category form-control">
                    <option value="" selected>Choose...</option>
                    @foreach ($provinsis as $provinsi)
                    <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="filtergender card mb-2">
        <div class="card-body">
            <h5 class="card-title">Kabupaten</h5>
            <div class="inline">
                <select name="kabupaten_id" id="" class="subcategory form-control">
                    <option value="" selected>Choose...</option>
                    @foreach ($kabupatens as $kabupaten)
                    <option value="{{ $kabupaten->id }}">{{ $kabupaten->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="category card mb-2">
        <div class="card-body">
            <h5 class="card-title">Categories</h5>
            {{-- <hr> --}}
            @foreach ($category as $cat)
            <div class="custom-control custom-checkbox">
                <input type="checkbox" id="{{ $cat->id }}" class="custom-control-input category selector" name="{{ $cat->id }}" value="{{ $cat->id }}" >
                <label class="custom-control-label" for="{{ $cat->id }}">{{ ucfirst($cat->name) }}</label>
            </div>
            @endforeach
        </div>
    </div>
    <div class="subcategory card mb-2">
        <div class="card-body">
            <h5 class="card-title">Sub Categories</h5>
            {{-- <hr> --}}
            @foreach ($subcategory as $subcat)
            <div class="custom-control custom-checkbox">
                <input type="checkbox" id="s{{ $subcat->id }}" class="custom-control-input subcategory selector" name="{{ $subcat->id }}" value="{{ $subcat->id }}" >
                <label class="custom-control-label" for="s{{ $subcat->id }}">{{ ucfirst($subcat->name) }}</label>
            </div>
            @endforeach
        </div>
    </div>

</div>
{{-- end of filter ============================= --}}