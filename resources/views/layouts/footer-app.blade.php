<div class="container-fluid bg-light text-dark pt-2 {{ request()->is(['/', 'products']) ? '' : 'fixed-bottom'}} " style="margin-top:100px;border-top:1px solid #e6dede;">
    {{-- <div class="container bg-light text-dark">
        <div class="p-3 mb-2 bg-light text-dark">.bg-light</div>
        <div class='container'>
            <div class='row'>
                <div class='col-md-4 col-sm-12 pt-3'>
                    <h3>Categories</h3>
                    <ul class="list-group list-group-flush">
                        <li style="list-style-type: none;">Cras justo odio</li>
                        <li style="list-style-type: none;">Dapibus ac facilisis in</li>
                        <li style="list-style-type: none;">Morbi leo risus</li>
                        <li style="list-style-type: none;">Porta ac consectetur ac</li>
                        <li style="list-style-type: none;">Vestibulum at eros</li>
                    </ul>
                </div>
                <div class='col-md-4 col-sm-12 pt-3'>
                    <h3>Brands</h3>
                    <ul class="list-group list-group-flush">
                        <li style="list-style-type: none;">Cras justo odio</li>
                        <li style="list-style-type: none;">Dapibus ac facilisis in</li>
                        <li style="list-style-type: none;">Morbi leo risus</li>
                        <li style="list-style-type: none;">Porta ac consectetur ac</li>
                        <li style="list-style-type: none;">Vestibulum at eros</li>
                    </ul>
                </div>
                <div class='col-md-4 col-sm-12 pt-3'>
                    <h3>Members</h3>
                    <ul class="list-group list-group-flush">
                        <li style="list-style-type: none;">Cras justo odio</li>
                        <li style="list-style-type: none;">Dapibus ac facilisis in</li>
                        <li style="list-style-type: none;">Morbi leo risus</li>
                        <li style="list-style-type: none;">Porta ac consectetur ac</li>
                        <li style="list-style-type: none;">Vestibulum at eros</li>
                    </ul>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <hr> --}}
    <div class="container">
        <div class="row">
            <div class='col-md-4 col-sm-12 pt-3'>
                <p>copyright {{ date('Y') }} {{ config('app.name') }}</p>
            </div>
        </div>
    </div>
</div>
