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
                        [ 'title' => $product->category->title, 'url' => url('/companies/primer/catalog/index/'.$product->category->id), 'active' => FALSE ],
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
                    <a data-toggle="{{ count($cat->child_categories) > 0 ? 'collapse' : '' }}" data-parent="#sidebar-nav-{{ $group_category->id }}" href="{{ count($cat->child_categories) > 0 ? '#category-'.$cat->id : url('/companies/primer/catalog/index/'.$cat->id) }}">{{ $cat->title }}</a>
                    @if (count($cat->child_categories) > 0)
                    <ul id="category-{{ $cat->id }}" class="collapse {{ $cat->child_categories->contains($product->category->id) ? 'in' : '' }}">
                        @foreach($cat->child_categories as $child_category)
                        <li class="{{ $child_category->id == $product->category->id ? 'active' : '' }}">
                            <a href="{{ url('/companies/primer/catalog/index/'.$child_category->id) }}"><i class="fa fa-chevron-circle-right"></i> {{ $child_category->title }}</a>
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
                <p><a href="{{ url('/companies/primer/catalog/index/'.$product->category->id) }}"><i class="fa fa-arrow-circle-left"></i> Повернутись до товарів категорії <strong>"{{ $product->category->title }}"</strong></a></p>
                <div class="panel panel-grey">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ $product->title }}</h3>
                    </div>
                    <div class="panel-body">
                        <h5 class="text-uppercase"><span class="color-blue"><strong>{{ $product->description_small }}</strong></span></h5>

                        <div class="row">
                            <div class="col-md-3">
                                    <img alt="{{ $product->title }}" src="assets/img/products/primer/{{ $product->photo }}" class="img-responsive">
                            </div>
                            <div class="col-md-9">
                                <div class="alert alert-info fade in">
                                    {!! $product->description_full !!}
                                </div>
                                @foreach(['using'           => 'Використання',
                                'exec_works'                => 'Виконання робіт',
                                'tech_characteristics'      => 'Технічні характеристики',
                                'general_characteristics'   => 'Загальні характеристики',
                                'application'               => 'Використання',
                                'properties_using'          => 'Властивості та призначення матеріалу',
                                'application'               => 'Нанесення',
                                'phys_chem_properties'      => 'Фізичні та хімічні властивості',
                                'restrictions'              => 'Обмеження',
                                'safety'                    => 'Заходи безпеки',
                                ] as $key => $item)
                                    @if ($product->$key)
                                    <h5 class="text-uppercase"><span class="color-blue"><strong>{{ $item }}</strong></span></h5>
                                    {!! $product->$key !!}
                                    @endif
                                @endforeach

                                <h5 class="text-uppercase"><span class="color-blue"><strong>Фасовка</strong></span></h5>
                                {{ $product->package }}

                                @if ($product->price_1_name && $product->price_1_val)
                                    <h5 class="text-uppercase"><span class="color-blue"><strong>Ціна</strong></span></h5>

                                    {{ $product->price_1_name . ' - ' . $product->price_1_val }}

                                    @if ($product->price_2_name && $product->price_2_val)
                                        <br /> {{ $product->price_2_name . ' - ' . $product->price_2_val }}
                                    @endif
                                    @if ($product->price_3_name && $product->price_3_val)
                                        <br /> {{ $product->price_3_name . ' - ' . $product->price_3_val }}
                                    @endif
                                    @if ($product->price_4_name && $product->price_4_val)
                                        <br /> {{ $product->price_4_name . ' - ' . $product->price_4_val }}
                                    @endif
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@stop