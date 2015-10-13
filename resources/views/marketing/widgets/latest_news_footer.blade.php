<!-- Latest -->
<div class="col-md-3 md-margin-bottom-40">
    <div class="posts">
        <div class="headline"><h2>Последние новости</h2></div>
        <ul class="list-unstyled latest-list">
            @foreach($news as $item)
            <li>
                <a href="{{ action('Marketing\NewsController@getShow', array('id' => $item->id)) }}">{{ $item->title }}</a>
                <small>{{ date('d.m.Y', strtotime($item->created_at)) }}</small>
            </li>
            @endforeach
        </ul>
    </div>
</div><!--/col-md-3-->
<!-- End Latest -->