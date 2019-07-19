@extends("tasks::layouts.base")

@section('title')
    @lang('tasks::tasks.tasks')
@endsection

@section('content')
    <div class="row my-5">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    @lang('tasks::tasks.tasks')
                </div>
                <div class="card-body">
                    @include("tasks::partials.nav")
                </div>
            </div>
        </div>
    </div>
@stop
