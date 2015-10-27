@extends('marketing.layout.master')

@section('page_title')
{{ $company->title }}
@stop

@section('top_content')
    @slider()
    @include('marketing.layout.breadcrumbs', [
                'title' => $company->title,
                'items' => [
                        [ 'title' => 'Головна', 'action' => 'Marketing\HomeController@index', 'active' => FALSE ],
                        [ 'title' => 'Група компаній', 'action' => '', 'active' => FALSE ],
                        [ 'title' => $company->title, 'action' => '', 'active' => FALSE ],
                        [ 'title' => 'Каталог', 'action' => '', 'active' => FALSE ],
                        [ 'title' => $category->parent_category->title, 'action' => '', 'active' => FALSE ],
                        [ 'title' => $category->title, 'action' => '', 'active' => TRUE ],
                ]
            ])
@stop

@section('content')
<div class="row margin-bottom-20 margin-top-20">
    <div class="col-md-3">
        @foreach($group_categories as $group_category)
            <ul class="list-group sidebar-nav-v1" id="sidebar-nav">
                <li class="list-group-item first"><a href="#">{{ $group_category->title }}</a></li>
                @foreach($group_category->categories as $cat)
                <li class="list-group-item list-toggle {{ $cat->child_categories->contains($category->id) ? 'active' : '' }}">
                    <a data-toggle="collapse" data-parent="#sidebar-nav" href="#category-{{ $cat->id }}">{{ $cat->title }}</a>
                    @if (count($cat->child_categories) > 0)
                    <ul id="category-{{ $cat->id }}" class="collapse {{ $cat->child_categories->contains($category->id) ? 'in' : '' }}">
                        @foreach($cat->child_categories as $child_category)
                        <li class="{{ $child_category->id == $category->id ? 'active' : '' }}">
                            <a href="{{ url('/companies/catalog/sika/index/'.$child_category->id) }}"><i class="fa fa-chevron-circle-right"></i> {{ $child_category->title }}</a>
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
        {{ $category->parent_category->description }}
    </div>
</div>
@stop