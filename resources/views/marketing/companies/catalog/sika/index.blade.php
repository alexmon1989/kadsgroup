@extends('marketing.layout.master')

@section('page_title')
    {{ $catalog_description->page_title != '' ? $catalog_description->page_title  : 'Каталог товаров ТМ Sika' }}
@stop

@section('top_content')
    @slider()
    @include('marketing.layout.breadcrumbs', [
                'title' => '',
                'items' => [
                        [ 'title' => 'Главная', 'action' => 'Marketing\HomeController@index', 'active' => FALSE ],
                        [ 'title' => $company->title, 'action' => 'Marketing\Companies\AboutController@getShow', 'action_params' => ['shortTitle' => 'sika'], 'active' => FALSE ],
                        [ 'title' => 'Каталог', 'action' => '', 'active' => TRUE ],
                ]
            ])
@stop

@section('content')
<div class="row margin-bottom-20 margin-top-20">

    <div class="col-md-3">
        @foreach($group_categories as $group_category)
            <ul class="list-group sidebar-nav-v1" id="sidebar-nav-{{ $group_category->id }}">
                <li class="list-group-item first"><a href="{{ action('Marketing\Companies\Sika\CatalogController@getGroup', ['id' => $group_category->id]) }}">{{ $group_category->title }}</a></li>
                @foreach($group_category->categories as $cat)
                <li class="list-group-item {{ count($cat->child_categories) > 0 ? 'list-toggle' : '' }}">
                    <a data-toggle="{{ count($cat->child_categories) > 0 ? 'collapse' : '' }}" data-parent="#sidebar-nav-{{ $group_category->id }}" href="{{ count($cat->child_categories) > 0 ? '#category-'.$cat->id : url('/companies/sika/catalog/category/'.$cat->id) }}">{{ $cat->title }}</a>
                    @if (count($cat->child_categories) > 0)
                    <ul id="category-{{ $cat->id }}" class="collapse">
                        @foreach($cat->child_categories as $child_category)
                        <li>
                            <a href="{{ url('/companies/sika/catalog/category/'.$child_category->id) }}"><i class="fa fa-chevron-circle-right"></i> {{ $child_category->title }}</a>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endforeach
            </ul>
        @endforeach
    </div>

    <div class="col-md-9">

        <div class="row">
            <div class="col-md-12">
                <h1>{{ $catalog_description->page_h1 != '' ? $catalog_description->page_h1  : 'Каталог товаров ТМ Sika' }}</h1>
            </div>
        </div>

        {!! $catalog_description->full_text !!}

        <h2>Группы товаров:</h2>
        <ul>
            @foreach($group_categories as $group_category)
            <li><a class="text-primary" href="{{ action('Marketing\Companies\Sika\CatalogController@getGroup', ['id' => $group_category->id]) }}">{{ $group_category->title }}</a></li>
            @endforeach
        </ul>
    </div>
</div>
@stop

@section('meta')
    <meta name="keywords" content="{{ $catalog_description->page_keywords }}">
    <meta name="description" content="{{ trim($catalog_description->page_description) != '' ? $catalog_description->page_description : str_limit(strip_tags($catalog_description->description), 200) }}">
@stop