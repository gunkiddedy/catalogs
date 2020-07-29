{{-- <main class="py-4">
    <div class="container">
        <div class="row mx-auto">
            <div class="col-lg-2 col-md-4 col-sm-12 pb-2">
                <div class="card">
                    <div class="card-header">
                        NAVIGATION
                    </div>
                    <ul class="list-group">
                        <a href="{{ route('member.list') }}" class="list-group-item member-navigation">Users</a>
                        <a href="{{ route('category.index') }}" class="list-group-item member-navigation">Category</a>
                        <a href="{{ route('provinsi.index') }}" class="list-group-item member-navigation">Provinsi</a>
                        <a href="{{ route('kabupaten.index') }}" class="list-group-item member-navigation">Kabupaten</a>
                        <a href="{{ route('kecamatan.index') }}" class="list-group-item member-navigation">Kecamatan</a>
                        <a href="/profile/{{ Auth::id() }}" class="list-group-item member-navigation">Profile</a>
                        <a href="{{ route('about.index') }}" class="list-group-item member-navigation">About</a>
                        <a href="{{ route('contact.index') }}" class="list-group-item member-navigation">Contact</a>
                        <a href="/products" class="list-group-item member-navigation">Preview</a>
                    </ul>
                </div>
            </div>
            @yield('content')
        </div>
    </div>
</main> --}}

<div class="col-md-2 col-sm-12 pb-2 sidebar_admin_mobile">
    <div class="card">
        <div class="card-header">
            NAVIGATION
        </div>
        <ul class="list-group">
            <a href="{{ route('member.list') }}" class="list-group-item member-navigation">Users</a>
            <a href="{{ route('category.index') }}" class="list-group-item member-navigation">Category</a>
            <a href="{{ route('provinsi.index') }}" class="list-group-item member-navigation">Provinsi</a>
            <a href="{{ route('kabupaten.index') }}" class="list-group-item member-navigation">Kabupaten</a>
            <a href="{{ route('kecamatan.index') }}" class="list-group-item member-navigation">Kecamatan</a>
            {{-- <a href="/profile/{{ Auth::id() }}" class="list-group-item member-navigation">Profile</a> --}}
            <a href="{{ route('about.index') }}" class="list-group-item member-navigation">About</a>
            <a href="{{ route('contact.index') }}" class="list-group-item member-navigation">Contact</a>
            {{-- <a href="/products" class="list-group-item member-navigation">Preview</a> --}}
        </ul>
    </div>
</div>