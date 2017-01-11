@if(Session::has('message'))
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>{{ session::get('message') }}</strong>
                </div>
            </div>
        </div>
    </div>
@endif