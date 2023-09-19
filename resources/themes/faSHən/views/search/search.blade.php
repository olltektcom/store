@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.search.page-title') }}
@endsection

@section('content-wrapper')
    <div class="block">
        <div class="container">
            <div class="h2-style">Your search for "{{ app('request')->input('term') }}" revealed the following:</div>
            <form role="search" action="{{ route('shop.search.index') }}" method="GET" class="search-form white">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="input-group input-group-lg">
                            <input type="text" name="term" class="form-control" value="{{ app('request')->input('term') }}" />
                            <div class="input-group-btn">
                                <button type="submit" class="btn">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @if (! $results)
        <div class="search-result-status">
            <h2>{{ __('shop::app.products.whoops') }}</h2>
            <span>{{ __('shop::app.search.no-results') }}</span>
        </div>
    @endif

    @if ($results)
        <div class="block bottom-space">
			<div class="container">
	
                    @if ($results->isEmpty())
                        <div class="search-result-status">
                            <h2>{{ __('shop::app.products.whoops') }}</h2>
                            <span>{{ __('shop::app.search.no-results') }}</span>
                        </div>
                    @else
                        @if ($results->total() == 1)
                            <div class="search-result-status mb-20">
                                <span><b>{{ $results->total() }} </b>{{ __('shop::app.search.found-result') }}</span>
                            </div>
                        @else
                            <div class="search-result-status mb-20">
                                <span><b>{{ $results->total() }} </b>{{ __('shop::app.search.found-results') }}</span>
                            </div>
                        @endif

                        <div class="products-grid four-in-row product-variant-5">
                            @foreach ($results as $productFlat)

                                @include('shop::products.list.card', ['product' => $productFlat->product])

                            @endforeach
                        </div>

                        @include('ui::datagrid.pagination')
                    @endif
            </div>
        </div> <!-- /block bottom-space -->
    @endif
@endsection