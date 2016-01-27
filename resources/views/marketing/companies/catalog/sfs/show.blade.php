@extends('marketing.layout.master')

@section('page_title'){{ $product->page_title != '' ? $product->page_title  : $product->title }}@stop

@section('top_content')
    @slider()
    @include('marketing.layout.breadcrumbs', [
                'title' => '',
                'items' => [
                        [ 'title' => 'Главная', 'action' => 'Marketing\HomeController@index', 'active' => FALSE ],
                        [ 'title' => $company->title, 'action' => 'Marketing\Companies\AboutController@getShow', 'action_params' => ['shortTitle' => 'sika'], 'active' => FALSE ],
                        [ 'title' => 'Каталог', 'url' => 'companies/sfs/catalog', 'active' => FALSE ],
                        [ 'title' => $product->category->group_category->title, 'action' => 'Marketing\Companies\Sfs\CatalogController@getGroup', 'action_params' => ['id' => $product->category->group_category->id], 'active' => FALSE ],
                        $product->category->parent_category ? [ 'title' => $product->category->parent_category->title, 'action' => 'Marketing\Companies\Sfs\CatalogController@getCategory', 'action_params' => ['id' => $product->category->parent_category->id], 'active' => FALSE ] : null,
                        [ 'title' => $product->category->title, 'action' => 'Marketing\Companies\Sfs\CatalogController@getCategory', 'action_params' => ['id' => $product->category->id], 'active' => FALSE ],
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
                    <a data-parent="#sidebar-nav-{{ $group_category->id }}" href="{{ url('/companies/sfs/catalog/category/'.$cat->id) }}">{{ $cat->title }}</a>
                    @if (count($cat->child_categories) > 0)
                    <ul id="category-{{ $cat->id }}" class="collapse {{ $cat->child_categories->contains($product->category->id) ? 'in' : '' }}">
                        @foreach($cat->child_categories as $child_category)
                        <li class="{{ $child_category->id == $product->category->id ? 'active' : '' }}">
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
                <h1>{{ $product->page_h1 != '' ? $product->page_h1  : $product->title }}</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <p><a href="{{ url('/companies/sfs/catalog/category/'.$product->category->id) }}"><i class="fa fa-arrow-circle-left"></i> Вернутся к товарам категории <strong>"{{ $product->category->title }}"</strong></a></p>

                <div class="panel panel-grey margin-bottom-40">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ $product->title }}</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img alt="{{ $product->title }}" src="assets/img/products/sfs/{{ $product->photo }}" class="img-responsive">
                            </div>
                            <div class="col-md-8">
                                <h5 class="text-uppercase"><span class="color-blue"><strong>Описание</strong></span></h5>

                                <?php $description = $product->description_full != '' ? $product->description_full : ($product->description_small != '' ? '<p>'.$product->description_small.'</p>' : '<p>Описание отсутствует.</p>'); ?>
                                {!! $description !!}

                                <a target="_blank" href="{{ asset('assets/img/products/sfs/pdf/'.$product->file_name) }}" class="btn-u btn-u-blue rounded" title="Загрузить"><i class="fa fa-file-pdf-o"></i> Детальная информация (pdf)</a>
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
    <meta name="description" content="{{ trim($product->page_description) != '' ? $product->page_description : str_limit(strip_tags($description), 200) }}">
@stop