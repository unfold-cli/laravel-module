@extends("stub-model::layouts.base")

@section('title')
    @lang('stub-model::stub-model.stub_models')
@endsection

@section('content')
    <div class="row my-5">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    @lang('stub-model::stub-model.stub_models')
                </div>

                <div class="card-body">
                    @include("stub-model::partials.nav")
                    <stub-model-table url="{{ route('stub-vendor.stub-models.api.index') }}">
                        {{-- By row --}}
                        {{-- <template slot-scope="{row}" slot="row">--}}
                        {{--     <tr>--}}
                        {{--         <td>@{{ row.id }}</td>--}}
                        {{--         <td>@{{ row.created_at | date }}</td>--}}
                        {{--         <td>@{{ row.updated_at | date }}</td>--}}
                        {{--     </tr>--}}
                        {{-- </template>--}}

                        {{-- By column --}}
                        <template slot-scope="{row}" slot="created_at">
                            @{{ row.created_at | date }}
                        </template>
                        <template slot-scope="{row}" slot="updated_at">
                            @{{ row.updated_at | date }}
                        </template>
                        <template slot-scope="{row}" slot="action">
                            <a :href="'{{ route('stub-vendor.stub-models.index') }}/' + row.id +'/edit'">Edit</a>
                        </template>
                    </stub-model-table>
                </div>
            </div>
        </div>
    </div>
@stop
