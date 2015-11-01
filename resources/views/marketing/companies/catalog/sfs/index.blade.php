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
                        [ 'title' => $category->title, 'action' => '', 'active' => TRUE ],
                ]
            ])
@stop

@section('content')
<div class="row margin-bottom-20 margin-top-20">

    <div class="col-md-3">
        @foreach($group_categories as $group_category)
            <ul class="list-group sidebar-nav-v1" id="sidebar-nav-{{ $group_category->id }}">
                <li class="list-group-item first"><a href="{{ Request::url() }}#">{{ $group_category->title }}</a></li>
                @foreach($group_category->categories as $cat)
                <li class="list-group-item {{ count($cat->child_categories) > 0 ? 'list-toggle' : '' }} {{ $cat->child_categories->contains($category->id) || $cat->id == $category->id ? 'active' : '' }}">
                    <a data-toggle="{{ count($cat->child_categories) > 0 ? 'collapse' : '' }}" data-parent="#sidebar-nav-{{ $group_category->id }}" href="{{ count($cat->child_categories) > 0 ? '#category-'.$cat->id : url('/companies/sfs/catalog/index/'.$cat->id) }}">{{ $cat->title }}</a>
                    @if (count($cat->child_categories) > 0)
                    <ul id="category-{{ $cat->id }}" class="collapse {{ $cat->child_categories->contains($category->id) ? 'in' : '' }}">
                        @foreach($cat->child_categories as $child_category)
                        <li class="{{ $child_category->id == $category->id ? 'active' : '' }}">
                            <a href="{{ url('/companies/sfs/catalog/index/'.$child_category->id) }}"><i class="fa fa-chevron-circle-right"></i> {{ $child_category->title }}</a>
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
        {!! isset($category->parent_category) ? $category->parent_category->description : $category->description !!}

        <div class="row">
            <div class="col-md-12">
                <h2>Товари</h2>
            </div>
        </div>

        <!-- Pager -->
        <div class="text-center">
            {!! str_replace('/?', '?', $products->render()) !!}
        </div>
        <!-- End Pager -->

        @if (count($products) > 0)
            <ul>
            @foreach($products as $item)
                <li><a class="text-primary" href="{{ asset('assets/img/products/sfs/'.$item->file_name) }}" target="_blank" title="Завантажити">{{ $item->title }}</a></li>
            @endforeach
            </ul>
        @else
            <div class="row">
                <div class="col-md-12">
                    <p>Товари відсутні</p>
                </div>
            </div>
        @endif

        <!-- Pager -->
        <div class="text-center">
            {!! str_replace('/?', '?', $products->render()) !!}
        </div>
        <!-- End Pager -->

    </div>
</div>
@stop