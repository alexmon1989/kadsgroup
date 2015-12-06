<form role="form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">
        <div class="form-group">
            <label for="title">Название</label>
            <input type="text" placeholder="Название" id="title" name="title" class="form-control" value="{{ old('title', isset($product) ? $product->title : '') }}">
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

        <div class="checkbox">
            <label>
                <input type="checkbox" name="enabled" value="1" {{ old('enabled', isset($product) ? $product->enabled : 0) == 1 ? 'checked=""' : ''  }}> Включено
            </label>
        </div>

        <div class="form-group">
            <label for="thumbnail">Изображение</label>
            @if (isset($product))
            <div class="row">
                <div class="col-md-12 margin-bottom-10">
                    <img width="200" src="{{ asset('assets/img/products/sika/'.$product->photo) }}" alt="{{ $product->title }}" class="img-responsive">
                </div>
            </div>
            @endif
            <input type="file" id="photo" name="photo">
            <p class="help-block">Форматы: <b>jpg, png, gif</b>. Размер: <b>230 px</b> по горизонтали. Программа приведёт изображение к этому разрешению автоматически с сохранением пропорций сторон. Выбирайте файл только если хотите сменить текущее изображение.</p>
        </div>

        <div class="form-group">
            <label for="description">Описание</label>
            <textarea id="description" name="description" class="form-control ckeditor">{{ old('description', isset($product) ? $product->description : '') }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="package">Упаковка</label>
                    <textarea id="package" name="package" class="form-control ckeditor">{{ old('package', isset($product) ? $product->package : '') }}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="package_list">Упаковка (для страницы со списком товаров)</label>
                    <textarea id="package_list" name="package_list" class="form-control ckeditor">{{ old('package_list', isset($product) ? $product->package_list : '') }}</textarea>
                    <p class="help-block">Заполните по желанию короткую версию для страницы списка товаов.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="characteristics">Технические характеристики</label>
                    <textarea id="characteristics" name="characteristics" class="form-control ckeditor">{{ old('characteristics', isset($product) ? $product->characteristics : '') }}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="using_area">Область применения</label>
                    <textarea id="using_area" name="using_area" class="form-control ckeditor">{{ old('using_area', isset($product) ? $product->using_area : '') }}</textarea>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="tech_cart_file">Тех. карта</label>
            @if (isset($product) && $product->tech_cart_file)
            <div class="row">
                <div class="col-md-12 margin-bottom-10">
                   <p>Ссылка на текущий файл: <a href="{{ asset('assets/img/products/sika/tech-carts/'.$product->tech_cart_file) }}" target="_blank">Скачать</a></p>
                </div>
            </div>
            @endif
            <input type="file" id="tech_cart_file" name="tech_cart_file">
            <p class="help-block">Формат: <b>pdf</b>.</p>
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