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
    <div class="col-md-4">
        @foreach($group_categories as $group_category)
            <ul class="list-group sidebar-nav-v1" id="sidebar-nav">
                <li class="list-group-item first"><a href="{{ Request::url() }}#">{{ $group_category->title }}</a></li>
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

    <div class="col-md-8">
        {{ $category->parent_category->description }}

        <div class="row">
            <div class="col-md-12">
                <h2>Товары</h2>
            </div>
        </div>

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
                                            <a href="{{ action('Marketing\Companies\Sika\CatalogController@getShow', ['id'=>$products[$i+$j]->id]) }}">
                                                <img class="img-responsive" src="{{ asset('assets/img/products/sika/'.$products[$i+$j]->photo) }}" alt="{{ $products[$i+$j]->title }}" />
                                            </a>
                                        </div>
                                    </div>
                                    <div class="caption">
                                        <h3><a class="hover-effect" href="{{ action('Marketing\Companies\Sika\CatalogController@getShow', ['id'=>$products[$i+$j]->id]) }}">{{ $products[$i+$j]->title }}</a></h3>
                                        {!! $products[$i+$j]->description !!}

                                        {!! $products[$i+$j]->package_list !!}

                                        @if ($products[$i+$j]->tech_cart_file)
                                        <a target="_blank" href="{{ asset('assets/img/products/sika/tech-carts/'.$products[$i+$j]->tech_cart_file) }}" class="btn-u btn-u-blue rounded"><i class="fa fa-file-pdf-o"></i> Техническая карта</a>
                                        @endif
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