<div id="layerslider" style="width: 100%; height: 350px; margin: 0px auto;">
    @foreach($slider as $item)
    <div class="ls-slide" style="{{ $item->css_main }} ">
        <img src="assets/img/slider/{{ $item->file_main }}" class="ls-bg" alt="Slide background">

            <span class="ls-s-1" style=" {{ $item->css_1 }} ">
                {{ $item->text_1 }}
            </span>

        <a class="btn-u btn-u-blue ls-s-1" href="{{ $item->url }}" style=" {{ $item->css_2 }} ">
            {{ $item->text_2 }}
        </a>

        <img src="assets/img/slider/logo/{{ $item->file_logo }}" alt="Slider Image" class="ls-s-1" style=" {{ $item->css_3 }} ">
    </div>
    @endforeach
</div><!--/layer_slider-->