@extends("stub-model::layouts.base")

@section('title')
    @lang('stub-model::stub-model.update_stub_model')
@endsection

@section('content')
    <div class="row my-5">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    @lang('stub-model::stub-model.update_stub_model')
                </div>
                <div class="card-body">
                    @include("stub-model::partials.nav")
                    <stub-model-form :stub-model="\{{ json_encode($stub_model) }}" :fields="\{{ json_encode($stub_model->getFormFields()) }}"></stub-model-form>
                </div>
            </div>
        </div>
    </div>
@stop
