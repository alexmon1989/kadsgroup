<form role="form" method="post" action="{{ action('Admin\VideosController@postSettings') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" placeholder="Заголовок" id="title" name="title" class="form-control" value="{{ old('title', isset($videos_description) ? $videos_description->title : '') }}">
        </div>

        <div class="form-group">
            <label for="full_text">Текст</label>
            <textarea id="full_text" name="full_text" rows="10" cols="80" class="form-control ckeditor">{{ old('full_text', isset($videos_description) ? $videos_description->full_text : '') }}</textarea>
        </div>
    </div><!-- /.box-body -->

    <div class="box-footer">
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Сохранить</button>
    </div>
</form>