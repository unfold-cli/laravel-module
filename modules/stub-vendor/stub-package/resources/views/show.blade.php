@extends("stub-package::layouts.base")

@section('title')
    @lang('stub-package::stub-package.stub_package')
@endsection

@section('content')
    <div class="row my-5">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    @lang('stub-package::stub-package.stub_package')
                </div>
                <div class="card-body">
                    @include("stub-package::partials.nav")
                </div>
            </div>
        </div>
    </div>
@stop
