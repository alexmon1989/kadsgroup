<!--=== Breadcrumbs ===-->
<div class="breadcrumbs">
    <div class="container">
        <h1 class="pull-left">{{ $title }}</h1>
        <ul class="pull-right breadcrumb">
            @foreach($items as $item)
                @if (!is_null($item))
                <li class="{{ $item['active'] == TRUE ? 'active' : '' }}">
                    @if (isset($item['action']) && $item['action'] != '')
                        <a href="{{ action($item['action'], isset($item['action_params']) ? $item['action_params'] : NULL) }}">{{ $item['title'] }}</a>
                    @elseif (isset($item['url']) && $item['url'] != '')
                        <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>
                    @else
                      {{ $item['title'] }}
                    @endif
                </li>
                @endif
            @endforeach
        </ul>
    </div>
</div><!--/breadcrumbs-->
<!--=== End Breadcrumbs ===-->