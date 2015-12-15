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
            <p class="help-block">Форматы: <b>jpg, png, gif</b>. Размер: <b>260 px</b> по горизонтали. Программа приведёт изображение к этому разрешению автоматически с сохранением пропорций сторон. Выбирайте файл только если хотите сменить текущее изображение.</p>
        </div>

        <div class="form-group">
            <label for="description_small">Описание короткое</label>
            <textarea id="description_small" name="description_small" class="form-control">{{ old('description_small', isset($product) ? $product->description_small : '') }}</textarea>
        </div>

        <div class="form-group">
            <label for="description_full">Описание длинное</label>
            <textarea id="description_full" name="description_full" class="form-control ckeditor">{{ old('description_full', isset($product) ? $product->description_full : '') }}</textarea>
        </div>

        <div class="form-group">
            <label for="package">Упаковка</label>
            <input type="text" placeholder="Упаковка" id="package" name="package" class="form-control" value="{{ old('package', isset($product) ? $product->package : '') }}">
        </div>

        <div class="alert alert-info alert-dismissible">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4><i class="icon fa fa-info"></i> Внимание!</h4>
            Следующие поля не есть обязательными для заполнения. Для раскрытия любого из них нажмите плюс ("+").
        </div>
        @foreach(['using' => 'Использование',
                'exec_works'                => 'Выполнение работ',
                'tech_characteristics'      => 'Технические характеристики',
                'general_characteristics'   => 'Общие характеристики',
                'application'               => 'Использование',
                'properties_using'          => 'Свойства и предназначение материала',
                'application'               => 'Нанесение',
                'phys_chem_properties'      => 'Физические и химичиские свойства',
                'restrictions'              => 'Ограничения',
                'safety'                    => 'Меры безопасности',
                ] as $key => $item)
        <div class="box box-default box-solid collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">{{ $item }}</h3>

              <div class="box-tools pull-right">
                <button data-widget="collapse" class="btn btn-box-tool" type="button"><i class="fa {{ isset($product) && $product->$key != '' ? 'fa-minus' : 'fa-plus' }}"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: {{ isset($product) && $product->$key ? 'block' : 'none' }};">
              <textarea id="{{ $key }}" name="{{ $key }}" class="form-control ckeditor">{{ old($key , isset($product) ? $product->$key : '') }}</textarea>
            </div>
            <!-- /.box-body -->
        </div>
        @endforeach

        @for ($i = 1; $i <= 4; $i++)
        <?php
            $price_name = 'price_'.$i.'_name';
            $price_val = 'price_'.$i.'_val';
        ?>
        <div class="box box-default box-solid collapsed-box">
            <div class="box-header with-border">
                <h3 class="box-title">Цена {{ $i }}</h3>

                <div class="box-tools pull-right">
                    <button data-widget="collapse" class="btn btn-box-tool" type="button"><i class="fa {{ isset($product) && $product->$price_name != '' ? 'fa-minus' : 'fa-plus' }}"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: {{ isset($product) && $product->$price_name ? 'block' : 'none' }};">
                <div class="form-group">
                    <label for="{{ $price_name }}">Название поля</label>
                    <input type="text" placeholder="Название поля" id="{{ $price_name }}" name="{{ $price_name }}" class="form-control" value="{{ old($price_name, isset($product) ? $product->$price_name : '') }}">
                </div>
                <div class="form-group">
                    <label for="{{ $price_val }}">Значение</label>
                    <input type="text" placeholder="Значение" id="{{ $price_val }}" name="{{ $price_val }}" class="form-control" value="{{ old($price_val, isset($product) ? $product->$price_val : '') }}">
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        @endfor


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