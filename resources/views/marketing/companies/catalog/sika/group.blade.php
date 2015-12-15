@extends('marketing.layout.master')

@section('page_title')
    {{ $group->page_title != '' ? $group->page_title  : $group->title }}
@stop

@section('top_content')
    @slider()
    @include('marketing.layout.breadcrumbs', [
                'title' => '',
                'items' => [
                        [ 'title' => 'Главная', 'action' => 'Marketing\HomeController@index', 'active' => FALSE ],
                        [ 'title' => $company->title, 'action' => 'Marketing\Companies\AboutController@getShow', 'action_params' => ['shortTitle' => 'sika'], 'active' => FALSE ],
                        [ 'title' => $group->title, 'action' => '', 'active' => FALSE ],
                ]
            ])
@stop

@section('content')
    <div class="row margin-bottom-20 margin-top-20">

        <div class="col-md-3">
            @foreach($group_categories as $group_category)
                <ul class="list-group sidebar-nav-v1" id="sidebar-nav-{{ $group_category->id }}">
                    <li class="list-group-item first {{ $group_category->id == $group->id ? 'active' : '' }}"><a href="{{ action('Marketing\Companies\Sika\CatalogController@getGroup', ['id' => $group_category->id]) }}">{{ $group_category->title }}</a></li>
                    @foreach($group_category->categories as $cat)
                        <li class="list-group-item {{ count($cat->child_categories) > 0 ? 'list-toggle' : '' }}">
                            <a data-toggle="{{ count($cat->child_categories) > 0 ? 'collapse' : '' }}" data-parent="#sidebar-nav-{{ $group_category->id }}" href="{{ count($cat->child_categories) > 0 ? '#category-'.$cat->id : url('/companies/sika/catalog/index/'.$cat->id) }}">{{ $cat->title }}</a>
                            @if (count($cat->child_categories) > 0)
                                <ul id="category-{{ $cat->id }}" class="collapse">
                                    @foreach($cat->child_categories as $child_category)
                                        <li>
                                            <a href="{{ url('/companies/sika/catalog/index/'.$child_category->id) }}"><i class="fa fa-chevron-circle-right"></i> {{ $child_category->title }}</a>
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
                    <h1>{{ $group->page_title != '' ? $group->page_title  : $group->title }}</h1>
                </div>
            </div>

            {!! $group->description !!}

            @if (count($group->categories) != 0)
                <div class="row">
                    <div class="col-md-12">
                        <h2>Категории</h2>
                    </div>
                </div>

                <ul>
                    @foreach($group->categories as $сategory)
                        <li><a class="text-primary" href="{{ action('Marketing\Companies\Sika\CatalogController@getIndex', ['id' => $сategory->id]) }}">{{ $сategory->title }}</a></li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@stop

@section('meta')
    <meta name="keywords" content="{{ $group->page_keywords }}">
    <meta name="description" content="{{ trim($group->page_description) != '' ? $group->page_description : str_limit(strip_tags($group->description), 200) }}">
@stop