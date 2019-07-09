@extends("stub-package::layouts.base")

@section('title')
    @lang('stub-package::stub-package.stub_packages')
@endsection

@section('content')
    <div class="row my-5">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    @lang('stub-package::stub-package.stub_packages')
                </div>

                <div class="card-body">
                    @include("stub-package::partials.nav")
                    <stub-package-table url="{{ route('stub-vendor.stub-packages.api.index') }}">
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
                            <a :href="'{{ route('stub-vendor.stub-packages.index') }}/' + row.id +'/edit'">Edit</a>
                        </template>
                    </stub-package-table>
                </div>
            </div>
        </div>
    </div>
@stop
