<form role="form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">
        <div class="form-group">
            <label for="title">Название</label>
            <input type="title" placeholder="Название" id="title" name="title" class="form-control" value="{{ old('title', isset($news) ? $news->title : '') }}">
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="is_on_main" value="1" {{ old('is_on_main', isset($news) ? $news->is_on_main : 0) == 1 ? 'checked=""' : ''  }}> Показывать на главной странице
            </label>
        </div>
        <div class="form-group">
            <label for="thumbnail">Изображение</label>
            @if (isset($news))
            <div class="row">
                <div class="col-md-12 margin-bottom-10">
                    <img width="400" src="{{ asset('assets/img/news/'.$news->thumbnail) }}" alt="{{ $news->thumbnail }}" class="img-responsive">
                </div>
            </div>
            @endif
            <input type="file" id="thumbnail" name="thumbnail">
            <p class="help-block">Форматы: <b>jpg, png, gif</b>. Размер: <b>555px * 370px</b>. Программа приведёт изображение к этому разрешению автоматически без сохранения пропорций сторон. Выбирайте файл только если хотите сменить текущее изображение.</p>
        </div>
        <div class="form-group">
            <label for="preview_text_small">Текст для виджета на главной</label>
            <textarea id="preview_text_small" name="preview_text_small" class="form-control">{{ old('preview_text_small', isset($news) ? $news->preview_text_small : '') }}</textarea>
        </div>
        <div class="form-group">
            <label for="preview_text_mid">Текст для списка новостей</label>
            <textarea id="preview_text_mid" name="preview_text_mid" class="form-control ckeditor">{{ old('preview_text_mid', isset($news) ? $news->preview_text_mid : '') }}</textarea>
        </div>
        <div class="form-group">
            <label for="full_text">Текст полный</label>
            <textarea id="full_text" name="full_text" rows="10" cols="80" class="form-control ckeditor">{{ old('full_text', isset($news) ? $news->full_text : '') }}</textarea>
        </div>
    </div><!-- /.box-body -->

    <div class="box-footer">
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Сохранить</button>
    </div>
</form>