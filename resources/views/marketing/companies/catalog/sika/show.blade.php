@extends('marketing.layout.master')

@section('page_title'){{ $product->page_title != '' ? $product->page_title  : $product->title }}@stop

@section('top_content')
    @slider()
    @include('marketing.layout.breadcrumbs', [
                'title' => '',
                'items' => [
                        [ 'title' => 'Главная', 'action' => 'Marketing\HomeController@index', 'active' => FALSE ],
                        [ 'title' => $company->title, 'action' => 'Marketing\Companies\AboutController@getShow', 'action_params' => ['shortTitle' => 'sika'], 'active' => FALSE ],
                        [ 'title' => 'Каталог', 'url' => 'companies/sika/catalog', 'active' => FALSE ],
                        [ 'title' => $product->category->group_category->title, 'action' => 'Marketing\Companies\Sika\CatalogController@getGroup', 'action_params' => ['id' => $product->category->group_category->id], 'active' => FALSE ],
                        $product->category->parent_category ? [ 'title' => $product->category->parent_category->title, 'action' => 'Marketing\Companies\Sika\CatalogController@getIndex', 'action_params' => ['id' => $product->category->parent_category->id], 'active' => FALSE ] : null,
                        [ 'title' => $product->category->title, 'action' => 'Marketing\Companies\Sika\CatalogController@getIndex', 'action_params' => ['id' => $product->category->id], 'active' => FALSE ],
                        [ 'title' => $product->title, 'action' => '', 'active' => TRUE ],
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
                <li class="list-group-item {{ count($cat->child_categories) > 0 ? 'list-toggle' : '' }} {{ $cat->child_categories->contains($product->category->id) || $cat->id == $product->category->id ? 'active' : '' }}">
                    <a data-toggle="{{ count($cat->child_categories) > 0 ? 'collapse' : '' }}" data-parent="#sidebar-nav-{{ $group_category->id }}" href="{{ url('/companies/sika/catalog/category/'.$cat->id) }}">{{ $cat->title }}</a>
                    @if (count($cat->child_categories) > 0)
                    <ul id="category-{{ $cat->id }}" class="collapse {{ $cat->child_categories->contains($product->category->id) ? 'in' : '' }}">
                        @foreach($cat->child_categories as $child_category)
                        <li class="{{ $child_category->id == $product->category->id ? 'active' : '' }}">
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
                <h1>{{ $product->page_h1 != '' ? $product->page_h1  : $product->title }}</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <p><a href="{{ url('/companies/sika/catalog/category/'.$product->category->id) }}"><i class="fa fa-arrow-circle-left"></i> Вернутся к товарам категории <strong>"{{ $product->category->title }}"</strong></a></p>

                <div class="panel panel-grey margin-bottom-40">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ $product->title }}</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-9 col-sm-9">
                                <strong>{!! $product->description !!}</strong>

                                @if ($product->tech_cart_file)
                                    <a target="_blank" href="{{ asset('assets/img/products/sika/tech-carts/'.$product->tech_cart_file) }}" class="btn-u btn-u-blue rounded" title="Загрузить"><i class="fa fa-file-pdf-o"></i> Техническая карта</a>
                                @endif
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <p class="text-center"><button class="btn-u btn-u-red btn-u-lg rounded" data-toggle="modal" data-target="#responsive"><i class="fa fa-cart-plus"></i> Купить</button></p>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td><strong>Упаковка</strong></td>
                                <td><strong>Область применения</strong></td>
                                <td><strong>Техические характеристики</strong></td>
                                <td><strong>Пример применения</strong></td>
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

                @include('marketing.companies.catalog._partials.modal_form_buy')
            </div>
        </div>
    </div>
</div>
@stop

@section('styles')
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
    <!--[if lt IE 9]><link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms-ie8.css"><![endif]-->
@stop

@section('scripts')
    <script src="{{ asset('assets/js/forms/order.js') }}"></script>
    <script>
        $(function() {
            OrderForm.initOrderForm();
        });
    </script>
@stop

@section('meta')
    <meta name="keywords" content="{{ $product->page_keywords }}">
    <meta name="description" content="{{ trim($product->page_description) != '' ? $product->page_description : str_limit(strip_tags($product->description), 200) }}">
@stop