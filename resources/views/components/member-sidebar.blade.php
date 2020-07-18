<main class="py-4">
    <div class="container">
        <div class="row mx-auto">
            <div class="col-12 col-md-12 col-lg-2 col-md-2 col-sm-12 pb-2">
                <div class="card">
                    <div class="card-header">
                        NAVIGATION
                    </div>
                    <ul class="list-group">
                        <a href="/product/add" class="list-group-item member-navigation">Add Product</a>
                        {{-- <a href="/category/add" class="list-group-item member-navigation">Category</a> --}}
                        <a href="/profile/{{ Auth::id() }}" class="list-group-item member-navigation">Profile</a>
                        {{-- <a href="/products" class="list-group-item member-navigation">Catalogs</a> --}}
                    </ul>
                </div>
            </div>
            @yield('content')
        </div>
    </div>
</main>