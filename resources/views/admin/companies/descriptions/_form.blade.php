<form role="form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">
        <div class="form-group">
            <label for="url">Название</label>
            <input type="text" placeholder="Название" id="title" name="title" class="form-control" value="{{ old('title', isset($company) ? $slider->title : '') }}">
        </div>
        <div class="form-group">
            <label for="thumbnail">Изображение основное</label>
            <input type="file" id="file_main" name="file_main">
            <p class="help-block">Форматы: <b>jpg, png, gif</b>. Размер: <b>370px * 247px</b>. Программа приведёт изображение к этому разрешению автоматически без сохранения пропорций сторон.</p>
        </div>
        <div class="form-group">
            <label for="thumbnail">Изображение лого</label>
            <input type="file" id="file_logo" name="file_logo">
            <p class="help-block">Форматы: <b>jpg, png, gif</b>. Рекомендуемый размер: <b>89px</b> по высоте. Программа приведёт изображение к этому разрешению автоматически с сохранением пропорций сторон.</p>
        </div>
        <div class="form-group">
            <label for="preview_text_mid">css_3</label>
            <textarea id="css_main" name="css_3" class="form-control">{{ old('css_3', isset($slider) ? $slider->css_3 : config('slider.default.css_3')) }}</textarea>
            <p class="help-block">Меняйте значение этого поля только если знаете что делаете!</p>
        </div>
    </div><!-- /.box-body -->

    <div class="box-footer">
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Сохранить</button>
    </div>
</form>