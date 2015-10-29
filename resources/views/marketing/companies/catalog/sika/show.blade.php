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
                        [ 'title' => $product->category->title, 'url' => url('/companies/catalog/sika/index/'.$product->category->id), 'active' => FALSE ],
                        [ 'title' => $product->title, 'action' => '', 'active' => TRUE ],
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
                <li class="list-group-item {{ count($cat->child_categories) > 0 ? 'list-toggle' : '' }} {{ $cat->child_categories->contains($product->category->id) || $cat->id == $product->category->id ? 'active' : '' }}">
                    <a data-toggle="{{ count($cat->child_categories) > 0 ? 'collapse' : '' }}" data-parent="#sidebar-nav-{{ $group_category->id }}" href="{{ count($cat->child_categories) > 0 ? '#category-'.$cat->id : url('/companies/catalog/sika/index/'.$cat->id) }}">{{ $cat->title }}</a>
                    @if (count($cat->child_categories) > 0)
                    <ul id="category-{{ $cat->id }}" class="collapse {{ $cat->child_categories->contains($product->category->id) ? 'in' : '' }}">
                        @foreach($cat->child_categories as $child_category)
                        <li class="{{ $child_category->id == $product->category->id ? 'active' : '' }}">
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
        <div class="row">
            <div class="col-md-12">
                <p><a href="{{ url('/companies/catalog/sika/index/'.$product->category->id) }}"><i class="fa fa-arrow-circle-left"></i> Повернутись до товарів категорії <strong>"{{ $product->category->title }}"</strong></a></p>

                <div class="panel panel-grey margin-bottom-40">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-tasks"></i> {{ $product->title }}</h3>
                    </div>
                    <div class="panel-body">
                        <strong>{!! $product->description !!}</strong>

                        @if ($product->tech_cart_file)
                        <a target="_blank" href="{{ asset('assets/img/products/sika/tech-carts/'.$product->tech_cart_file) }}" class="btn-u btn-u-blue rounded" title="Завантажити"><i class="fa fa-file-pdf-o"></i> Технічна карта</a>
                        @endif
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td><strong>Упаковка</strong></td>
                                <td><strong>Область застосування</strong></td>
                                <td><strong>Технічні характеристики</strong></td>
                                <td><strong>Приклад застосування</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{!! $product->package !!}</td>
                                <td>{!! $product->using_area !!}</td>
                                <td>{!! $product->characteristics !!}</td>
                                <td><img width="200" src="{{ asset('assets/img/products/sika/'.$product->photo) }}" alt="{{ $product->title }}"/></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@stop