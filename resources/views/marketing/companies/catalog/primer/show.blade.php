@extends('marketing.layout.master')

@section('page_title'){{ $product->page_title != '' ? $product->page_title  : $product->title }}@stop

@section('top_content')
    @slider()
    @include('marketing.layout.breadcrumbs', [
                'title' => '',
                'items' => [
                        [ 'title' => 'Главная', 'action' => 'Marketing\HomeController@index', 'active' => FALSE ],
                        [ 'title' => $company->title, 'action' => 'Marketing\Companies\AboutController@getShow', 'action_params' => ['shortTitle' => 'primer'], 'active' => FALSE ],
                        [ 'title' => 'Каталог', 'url' => 'companies/primer/catalog', 'active' => FALSE ],
                        [ 'title' => $product->category->group_category->title, 'action' => 'Marketing\Companies\Primer\CatalogController@getGroup', 'action_params' => ['id' => $product->category->group_category->id], 'active' => FALSE ],
                        $product->category->parent_category ? [ 'title' => $product->category->parent_category->title, 'action' => 'Marketing\Companies\Primer\CatalogController@getCategory', 'action_params' => ['id' => $product->category->parent_category->id], 'active' => FALSE ] : null,
                        [ 'title' => $product->category->title, 'action' => 'Marketing\Companies\Primer\CatalogController@getCategory', 'action_params' => ['id' => $product->category->id], 'active' => FALSE ],
                        [ 'title' => $product->title, 'action' => '', 'active' => TRUE ],
                ]
            ])
@stop

@section('content')
<div class="row margin-bottom-20 margin-top-20">

    <div class="col-md-3">
        @foreach($group_categories as $group_category)
            <ul class="list-group sidebar-nav-v1" id="sidebar-nav-{{ $group_category->id }}">
                <li class="list-group-item first"><a href="{{ action('Marketing\Companies\Primer\CatalogController@getGroup', ['id' => $group_category->id]) }}">{{ $group_category->title }}</a></li>
                @foreach($group_category->categories as $cat)
                <li class="list-group-item {{ count($cat->child_categories) > 0 ? 'list-toggle' : '' }} {{ $cat->child_categories->contains($product->category->id) || $cat->id == $product->category->id ? 'active' : '' }}">
                    <a data-parent="#sidebar-nav-{{ $group_category->id }}" href="{{ url('/companies/primer/catalog/category/'.$cat->id) }}">{{ $cat->title }}</a>
                    @if (count($cat->child_categories) > 0)
                    <ul id="category-{{ $cat->id }}" class="collapse {{ $cat->child_categories->contains($product->category->id) ? 'in' : '' }}">
                        @foreach($cat->child_categories as $child_category)
                        <li class="{{ $child_category->id == $product->category->id ? 'active' : '' }}">
                            <a href="{{ url('/companies/primer/catalog/category/'.$child_category->id) }}"><i class="fa fa-chevron-circle-right"></i> {{ $child_category->title }}</a>
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
                <p><a href="{{ url('/companies/primer/catalog/category/'.$product->category->id) }}"><i class="fa fa-arrow-circle-left"></i> Вернутся к товарам категории <strong>"{{ $product->category->title }}"</strong></a></p>
                <div class="panel panel-grey">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ $product->title }}</h3>
                    </div>
                    <div class="panel-body">
                        <h5 class="text-uppercase"><span class="color-blue"><strong>{{ $product->description_small }}</strong></span></h5>

                        <div class="row">
                            <div class="col-md-3">
                                <img alt="{{ $product->title }}" src="assets/img/products/primer/{{ $product->photo }}" class="img-responsive">

                                @if(date('d.m.Y') >= '25.05.2017' and ($product->category->id == 71 or $product->category->id == 72))
                                    <div class="text-center margin-bottom-10 promo">
                                        <a href="https://kadsgroup.com.ua/news/show/8" target="_blank"><strong>Летняя Акция: -10%</strong></a>
                                    </div>
                                @endif

                                <div class="text-center margin-bottom-20">
                                    @if ($product->price_1_name && $product->price_1_val)
                                        <h5 class="text-uppercase"><span class="color-blue"><strong>Стоимость</strong></span></h5>

                                        {!! $product->price_1_name . ' - <strong>' . $product->price_1_val . '</strong>' !!}

                                        @if ($product->price_2_name && $product->price_2_val)
                                            <br /> {!! $product->price_2_name . ' - <strong>' . $product->price_2_val . '</strong>' !!}
                                        @endif
                                        @if ($product->price_3_name && $product->price_3_val)
                                            <br /> {!! $product->price_3_name . ' - <strong>' . $product->price_3_val . '</strong>' !!}
                                        @endif
                                        @if ($product->price_4_name && $product->price_4_val)
                                            <br /> {!! $product->price_4_name . ' - <strong>' . $product->price_4_val . '</strong>' !!}
                                        @endif
                                    @endif
                                </div>

                                <p class="text-center"><button class="btn-u btn-u-red btn-u-lg rounded" data-toggle="modal" data-target="#responsive"><i class="fa fa-cart-plus"></i> Купить</button></p>
                            </div>
                            <div class="col-md-9">
                                <div class="alert alert-info fade in">
                                    {!! $product->description_full !!}
                                </div>
                                @foreach(['using'           => 'Использование',
                                'exec_works'                => 'Выполнение работ',
                                'tech_characteristics'      => 'Технические характеристики',
                                'general_characteristics'   => 'Общие характеристики',
                                'application'               => 'Использование',
                                'properties_using'          => 'Свойства и предназначение материала',
                                'application'               => 'Нанесение',
                                'phys_chem_properties'      => 'Физические и химичиские свойства',
                                'restrictions'              => 'Ограничения',
                                'safety'                    => 'Меры безопасности',
                                ] as $key => $item)
                                    @if ($product->$key)
                                    <h5 class="text-uppercase"><span class="color-blue"><strong>{{ $item }}</strong></span></h5>
                                    {!! $product->$key !!}
                                    @endif
                                @endforeach

                                <h5 class="text-uppercase"><span class="color-blue"><strong>Упаковка</strong></span></h5>
                                {{ $product->package }}

                                @include('marketing.companies.catalog._partials.modal_form_buy')
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@stop

@section('meta')
    <meta name="keywords" content="{{ $product->page_keywords }}">
    <meta name="description" content="{{ trim($product->page_description) != '' ? $product->page_description : str_limit(strip_tags($product->description_full), 200) }}">
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