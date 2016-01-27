@extends('marketing.layout.master')

@section('page_title'){{ $catalog_description->page_title != '' ? $catalog_description->page_title  : 'Каталог товаров ТМ Праймер' }}{{ $products->currentPage() != 1 ? ' - Страница ' . $products->currentPage() : '' }}@stop

@section('top_content')
    @slider()
    @include('marketing.layout.breadcrumbs', [
                'title' => '',
                'items' => [
                        [ 'title' => 'Главная', 'action' => 'Marketing\HomeController@index', 'active' => FALSE ],
                        [ 'title' => $company->title, 'action' => 'Marketing\Companies\AboutController@getShow', 'action_params' => ['shortTitle' => 'primer'], 'active' => FALSE ],
                        [ 'title' => 'Каталог', 'action' => '', 'active' => TRUE ],
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
                <li class="list-group-item {{ count($cat->child_categories) > 0 ? 'list-toggle' : '' }}">
                    <a data-parent="#sidebar-nav-{{ $group_category->id }}" href="{{ url('/companies/primer/catalog/category/'.$cat->id) }}">{{ $cat->title }}</a>
                    @if (count($cat->child_categories) > 0)
                    <ul id="category-{{ $cat->id }}" class="collapse">
                        @foreach($cat->child_categories as $child_category)
                        <li>
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
                <h1>{{ $catalog_description->page_h1 != '' ? $catalog_description->page_h1  : 'Каталог товаров ТМ Праймер' }}</h1>
            </div>
        </div>

        {!! $catalog_description->full_text !!}

        <div class="row">
            <div class="col-md-12">
                <h2>Товары (всего: {{ $products->total() }})</h2>
            </div>
        </div>
        <!-- Pager -->
        <div class="text-center">
            {!! str_replace('/?', '?', $products->render()) !!}
        </div>
        <!-- End Pager -->
        @if (count($products) > 0)
        @for($i = 0; $i < count($products); $i = $i + 3)
            @if (isset($products[$i]))
                <!-- Thumbnails v1 -->
                <div class="row">
                    @for($j = 0; $j < 3; $j++)
                        @if (isset($products[$i+$j]))
                            <div class="col-md-4">
                                <div class="thumbnails thumbnail-style thumbnail-kenburn">
                                    <div class="thumbnail-img">
                                        <div class="overflow-hidden">
                                            <a href="{{ action('Marketing\Companies\Primer\CatalogController@getShow', ['id'=>$products[$i+$j]->id]) }}">
                                                <img class="img-responsive" src="{{ asset('assets/img/products/primer/'.$products[$i+$j]->photo) }}" alt="{{ $products[$i+$j]->title }}" />
                                            </a>
                                        </div>
                                    </div>
                                    <div class="caption">
                                        <h3><a class="hover-effect" href="{{ action('Marketing\Companies\Primer\CatalogController@getShow', ['id'=>$products[$i+$j]->id]) }}">{{ $products[$i+$j]->title }}</a></h3>
                                        {!! $products[$i+$j]->description_small !!}
                                        <p></p>

                                        <div class="row">
                                            <div class="col-md-4"><strong>Упаковка:</strong></div>
                                            <div class="col-md-8">{{ $products[$i+$j]->package }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                @if ($products[$i+$j]->price_1_name && $products[$i+$j]->price_1_val)
                                                    <strong>Стоимость:</strong>
                                                @endif
                                            </div>
                                            <div class="col-md-8">
                                                @if ($products[$i+$j]->price_1_name && $products[$i+$j]->price_1_val)
                                                    {{ $products[$i+$j]->price_1_name . ' - ' . $products[$i+$j]->price_1_val }}

                                                    @if ($products[$i+$j]->price_2_name && $products[$i+$j]->price_2_val)
                                                        <br /> {{ $products[$i+$j]->price_2_name . ' - ' . $products[$i+$j]->price_2_val }}
                                                    @endif
                                                    @if ($products[$i+$j]->price_3_name && $products[$i+$j]->price_3_val)
                                                        <br /> {{ $products[$i+$j]->price_3_name . ' - ' . $products[$i+$j]->price_3_val }}
                                                    @endif
                                                    @if ($products[$i+$j]->price_4_name && $products[$i+$j]->price_4_val)
                                                        <br /> {{ $products[$i+$j]->price_4_name . ' - ' . $products[$i+$j]->price_4_val }}
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endfor
                </div><!--/row-->
                <!-- End Thumbnails v1 -->
            @endif
        @endfor
        @else
            <div class="row">
                <div class="col-md-12">
                    <p>Товары отсутствуют</p>
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

@section('meta')
    <meta name="keywords" content="{{ $catalog_description->page_keywords }}">
    <meta name="description" content="{{ trim($catalog_description->page_description) != '' ? $catalog_description->page_description : str_limit(strip_tags($catalog_description->description), 200) }}">

    @if ($products->currentPage() == 1)
    <link rel="canonical" href="{{ url('companies/primer/catalog') }}"/>
    @endif

    @if ($products->currentPage() < $products->lastPage())
    <link rel="next" href="{{ url('companies/primer/catalog?page=' . ($products->currentPage() + 1)) }}" />
    @endif

    @if ($products->currentPage() > 1)
    <link rel="prev" href="{{ url('companies/primer/catalog?page=' . ($products->currentPage() - 1)) }}" />
    @endif
@stop