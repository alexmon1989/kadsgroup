<form role="form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">
        <div class="form-group">
            <label for="file_main">Изображение фоновое</label>
            <input type="file" id="file_main" name="file_main">
            <p class="help-block">Форматы: <b>jpg, png, gif</b>. Размер: <b>2048px * 350px</b>. Программа приведёт изображение к этому разрешению автоматически без сохранения пропорций сторон.</p>
        </div>
        <div class="form-group">
            <label for="file_logo">Изображение лого</label>
            <input type="file" id="file_logo" name="file_logo">
            <p class="help-block">Форматы: <b>jpg, png, gif</b>. Рекомендуемый размер: <b>135px</b> по высоте. Программа приведёт изображение к этому разрешению автоматически с сохранением пропорций сторон.</p>
        </div>
        <div class="form-group">
            <label for="url">Ссылка (полная)</label>
            <input type="text" placeholder="Ссылка (полная)" id="url" name="url" class="form-control" value="{{ old('url', isset($slider) ? $slider->url : '') }}">
        </div>
        <div class="form-group">
            <label for="text_1">Текст 1</label>
            <input type="text" placeholder="Текст 1" id="text_1" name="text_1" class="form-control" value="{{ old('text_1', isset($slider) ? $slider->text_1 : '') }}">
        </div>
        <div class="form-group">
            <label for="text_2">Текст 2</label>
            <input type="text" placeholder="Текст 2" id="text_2" name="text_2" class="form-control" value="{{ old('text_2', isset($slider) ? $slider->text_2 : '') }}">
        </div>
        <div class="form-group">
            <label for="css_main">css_main</label>
            <textarea id="css_main" name="css_main" class="form-control">{{ old('css_main', isset($slider) ? $slider->css_main : config('slider.default.css_main')) }}</textarea>
            <p class="help-block">Меняйте значение этого поля только если знаете что делаете!</p>
        </div>
        <div class="form-group">
            <label for="css_1">css_1</label>
            <textarea id="css_1" name="css_1" class="form-control">{{ old('css_1', isset($slider) ? $slider->css_1 : config('slider.default.css_1')) }}</textarea>
            <p class="help-block">Меняйте значение этого поля только если знаете что делаете!</p>
        </div>
        <div class="form-group">
            <label for="css_2">css_2</label>
            <textarea id="css_2" name="css_2" class="form-control">{{ old('css_2', isset($slider) ? $slider->css_2 : config('slider.default.css_2')) }}</textarea>
            <p class="help-block">Меняйте значение этого поля только если знаете что делаете!</p>
        </div>
        <div class="form-group">
            <label for="css_3">css_3</label>
            <textarea id="css_3" name="css_3" class="form-control">{{ old('css_3', isset($slider) ? $slider->css_3 : config('slider.default.css_3')) }}</textarea>
            <p class="help-block">Меняйте значение этого поля только если знаете что делаете!</p>
        </div>
    </div><!-- /.box-body -->

    <div class="box-footer">
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Сохранить</button>
    </div>
</form>