@extends('marketing.layout.master')

@section('page_title'){{ $category->page_title != '' ? $category->page_title  : $category->title }}{{ isset($products) && $products->currentPage() != 1 ? ' - Страница ' . $products->currentPage() : '' }}@stop

@section('top_content')
    @slider()
    @include('marketing.layout.breadcrumbs', [
                'title' => '',
                'items' => [
                        [ 'title' => 'Главная', 'action' => 'Marketing\HomeController@index', 'active' => FALSE ],
                        [ 'title' => $company->title, 'action' => 'Marketing\Companies\AboutController@getShow', 'action_params' => ['shortTitle' => 'sfs'], 'active' => FALSE ],
                        [ 'title' => 'Каталог', 'url' => 'companies/sfs/catalog', 'active' => FALSE ],
                        [ 'title' => $category->group_category->title, 'action' => 'Marketing\Companies\Sfs\CatalogController@getGroup', 'action_params' => ['id' => $category->group_category->id], 'active' => FALSE ],
                        $category->parent_category ? [ 'title' => $category->parent_category->title, 'action' => 'Marketing\Companies\Sfs\CatalogController@getCategory', 'action_params' => ['id' => $category->parent_category->id], 'active' => FALSE ] : null,
                        [ 'title' => $category->title, 'action' => '', 'active' => TRUE ],
                ]
            ])
@stop

@section('content')
<div class="row margin-bottom-20 margin-top-20">

    <div class="col-md-3">
        @foreach($group_categories as $group_category)
            <ul class="list-group sidebar-nav-v1" id="sidebar-nav-{{ $group_category->id }}">
                <li class="list-group-item first"><a href="{{ action('Marketing\Companies\Sfs\CatalogController@getGroup', ['id' => $group_category->id]) }}">{{ $group_category->title }}</a></li>
                @foreach($group_category->categories as $cat)
                <li class="list-group-item {{ count($cat->child_categories) > 0 ? 'list-toggle' : '' }} {{ $cat->child_categories->contains($category->id) || $cat->id == $category->id ? 'active' : '' }}">
                    <a data-parent="#sidebar-nav-{{ $group_category->id }}" href="{{ url('/companies/sfs/catalog/category/'.$cat->id) }}">{{ $cat->title }}</a>
                    @if (count($cat->child_categories) > 0)
                    <ul id="category-{{ $cat->id }}" class="collapse {{ $cat->child_categories->contains($category->id) || $cat->id == $category->id ? 'in' : '' }}">
                        @foreach($cat->child_categories as $child_category)
                        <li class="{{ $child_category->id == $category->id ? 'active' : '' }}">
                            <a href="{{ url('/companies/sfs/catalog/category/'.$child_category->id) }}"><i class="fa fa-chevron-circle-right"></i> {{ $child_category->title }}</a>
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
                <h1>{{ $category->page_h1 != '' ? $category->page_h1  : $category->title }}</h1>
            </div>
        </div>

        {!! $category->description != '' ? $category->description : (isset($category->parent_category) ? $category->parent_category->description : '') !!}

        @if (count($category->child_categories) == 0)


            @if (count($products) > 0)
                <div class="row">
                    <div class="col-md-12">
                        <h2>Товары</h2>
                    </div>
                </div>

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
                                                    <a href="{{ action('Marketing\Companies\Sfs\CatalogController@getShow', ['id'=>$products[$i+$j]->id]) }}">
                                                        <img class="img-responsive" src="{{ asset('assets/img/products/sfs/'.$products[$i+$j]->photo) }}" alt="{{ $products[$i+$j]->title }}" />
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="caption">
                                                <h3><a class="hover-effect" href="{{ action('Marketing\Companies\Sfs\CatalogController@getShow', ['id'=>$products[$i+$j]->id]) }}">{{ $products[$i+$j]->title }}</a></h3>
                                                <p>{{ $products[$i+$j]->description_small }}</p>

                                                <a target="_blank" href="{{ asset('assets/img/products/sfs/pdf/'.$products[$i+$j]->file_name) }}" class="btn-u btn-u-blue rounded" title="Загрузить"><i class="fa fa-file-pdf-o"></i> Детальная информация (pdf)</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endfor
                        </div><!--/row-->
                        <!-- End Thumbnails v1 -->
                    @endif
                @endfor

                <!-- Pager -->
                <div class="text-center">
                    {!! str_replace('/?', '?', $products->render()) !!}
                </div>
                <!-- End Pager -->
            @else
                <div class="row">
                    <div class="col-md-12">
                        <p>Товары отсутствуют</p>
                    </div>
                </div>
            @endif
        @else
            <h2>Подкатегории:</h2>
            <ul>
                @foreach($category->child_categories as $childCategory)
                    <li><a class="text-primary" href="{{ action('Marketing\Companies\Sfs\CatalogController@getCategory', ['id' => $childCategory->id]) }}">{{ $childCategory->title }}</a></li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@stop

@section('meta')
    <meta name="keywords" content="{{ $category->page_keywords }}">
    <meta name="description" content="{{ trim($category->page_description) != '' ? $category->page_description : str_limit(strip_tags($category->description), 200) }}">


    @if (isset($products))
        @if ($products->currentPage() == 1)
        <link rel="canonical" href="{{ url('companies/sfs/catalog/category/'.$category->id) }}"/>
        @endif

        @if ($products->currentPage() < $products->lastPage())
        <link rel="next" href="{{ url('companies/sfs/catalog/category/' . $category->id . '?page=' . ($products->currentPage() + 1)) }}" />
        @endif

        @if ($products->currentPage() > 1)
        <link rel="prev" href="{{ url('companies/sfs/catalog/category/' . $category->id . '?page=' . ($products->currentPage() - 1)) }}" />
        @endif
    @endif
@stop