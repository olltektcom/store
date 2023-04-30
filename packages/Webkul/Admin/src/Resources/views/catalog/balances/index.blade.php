@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.catalog.balances.title') }}
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.catalog.balances.title') }}</h1>
            </div>


        </div>

        {!! view_render_event('bagisto.admin.catalog.families.list.before') !!}

        <div class="page-content">
            <datagrid-plus src="{{ route('admin.catalog.balances.index') }}"></datagrid-plus>
        </div>

        {!! view_render_event('bagisto.admin.catalog.families.list.after') !!}

    </div>
@stop
