<form role="form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">
        <div class="form-group">
            <label for="youtube_id">ID Youtube</label>
            <input type="text" placeholder="ID Youtube" id="youtube_id" name="youtube_id" class="form-control" value="{{ old('youtube_id', isset($video) ? $video->youtube_id : '') }}">
            <p class="help-block">ID видео берётся из ссылки. Например, для видео со ссылкой <strong>https://www.youtube.com/watch?v=jsOpLSrEyYM</strong>, его ID будет <strong>jsOpLSrEyYM</strong>. В это поле нужно вставить именно его!</p>
        </div>
    </div><!-- /.box-body -->

    <div class="box-footer">
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Сохранить</button>
    </div>
</form>