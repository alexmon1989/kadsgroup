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
                    <a data-toggle="{{ count($cat->child_categories) > 0 ? 'collapse' : '' }}" data-parent="#sidebar-nav-{{ $group_category->id }}" href="{{ count($cat->child_categories) > 0 ? '#category-'.$cat->id : url('/companies/catalog/sika/index/'.$cat->id) }}">{{ $cat->title }}</a>
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
                                        <a target="_blank" href="{{ asset('assets/img/products/sika/tech-carts/'.$products[$i+$j]->tech_cart_file) }}" class="btn-u btn-u-blue rounded" title="Завантажити"><i class="fa fa-file-pdf-o"></i> Техничіна карта</a>
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