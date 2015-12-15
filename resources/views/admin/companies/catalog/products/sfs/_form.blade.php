<form role="form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">
        <div class="form-group">
            <label for="title">Название</label>
            <input type="text" placeholder="Название" id="title" name="title" class="form-control" value="{{ old('title', isset($product) ? $product->title : '') }}">
            <p class="help-block">Введите текст для ссылки, например, "Каталог гвоздей".</p>
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="enabled" value="1" {{ old('enabled', isset($product) ? $product->enabled : 0) == 1 ? 'checked=""' : ''  }}> Включено
            </label>
        </div>

        <div class="form-group">
            <label for="category_id">Категория</label>
            <select class="form-control" name="category_id" id="category_id">
                <option></option>
                @foreach($group_categories as $group_category)
                    <optgroup label="{{ $group_category->title }}">
                    @foreach($group_category->categories as $category)
                        @if (count($category->child_categories) == 0)
                            <option value="{{ $category->id }}" {{ old('category_id', isset($product) ? $product->category_id : NULL) == $category->id ? 'selected=""' : '' }}>{{ $category->title }}</option>
                        @endif
                    @endforeach
                    </optgroup>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="thumbnail">Изображение</label>
            @if (isset($product))
                <div class="row">
                    <div class="col-md-12 margin-bottom-10">
                        <img width="200" src="{{ asset('assets/img/products/sfs/'.$product->photo) }}" alt="{{ $product->title }}" class="img-responsive">
                    </div>
                </div>
            @endif
            <input type="file" id="photo" name="photo">
            <p class="help-block">Форматы: <b>jpg, png, gif</b>. Размер: <b>260 px</b> по горизонтали.
                Программа приведёт изображение к этому разрешению автоматически с сохранением пропорций сторон.
                Выбирайте файл только если хотите сменить текущее изображение.
                При создании товара изображение может быть присвоено автоматически, если не выбрано своё.
            </p>
        </div>

        <div class="form-group">
            <label for="description_small">Описание короткое</label>
            <textarea id="description_small" name="description_small" class="form-control">{{ old('description_small', isset($product) ? $product->description_small : '') }}</textarea>
        </div>

        <div class="form-group">
            <label for="description_full">Описание длинное</label>
            <textarea id="description_full" name="description_full" class="form-control ckeditor">{{ old('description_full', isset($product) ? $product->description_full : '') }}</textarea>
            <p class="help-block">Если оставите пустым, то при отображении будет использован текст из поля "Описание короткое".</p>
        </div>

        <div class="form-group">
            <label for="file_name">Файл PDF</label>
            @if (isset($product) && $product->file_name)
                <div class="row">
                    <div class="col-md-12 margin-bottom-10">
                        <p>Ссылка на текущий файл: <a href="{{ asset('assets/img/products/sfs/pdf/'.$product->file_name) }}" target="_blank">Скачать</a></p>
                    </div>
                </div>
            @endif
            <input type="file" id="file_name" name="file_name">
            <p class="help-block">Формат: <b>pdf</b>. Выбирайте файл только если хотите сменить текущий.</p>
        </div>

        <hr/>

        <h4>Настройки для SEO</h4>
        <div class="alert alert-info alert-dismissible">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4><i class="icon fa fa-info"></i> Информация!</h4>
            Эти поля предназначены для оптимизации сайта для продвижения сайта в поисковых сетях. Если вы не знаете что сюда писать, оставьте их пустыми.
        </div>
        <div class="form-group">
            <label for="title">Заголовок (title) страницы</label>
            <input type="text" placeholder="Заголовок (title) страницы" id="page_title" name="page_title" class="form-control" value="{{ old('page_title', isset($product) ? $product->page_title : '') }}">
        </div>
        <div class="form-group">
            <label for="title">Ключевые слова (keywords)</label>
            <input type="text" placeholder="Ключевые слова (keywords)" id="page_keywords" name="page_keywords" class="form-control" value="{{ old('page_keywords', isset($product) ? $product->page_keywords : '') }}">
        </div>
        <div class="form-group">
            <label for="title">Описание (description)</label>
            <input type="text" placeholder="Описание (description)" id="page_description" name="page_description" class="form-control" value="{{ old('page_description', isset($product) ? $product->page_description : '') }}">
        </div>
        <div class="form-group">
            <label for="title">Тег h1</label>
            <input type="text" placeholder="Описание (description)" id="page_h1" name="page_h1" class="form-control" value="{{ old('page_h1', isset($product) ? $product->page_h1 : '') }}">
        </div>
    </div><!-- /.box-body -->

    <div class="box-footer">
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Сохранить</button>
    </div>
</form>