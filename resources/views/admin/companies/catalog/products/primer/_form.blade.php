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
            <label for="description_small">Описание короткое</label>
            <textarea id="description_small" name="description_small" class="form-control ckeditor">{{ old('description_small', isset($product) ? $product->description_small : '') }}</textarea>
        </div>

        <div class="form-group">
            <label for="description_full">Описание длинное</label>
            <textarea id="description_full" name="description_full" class="form-control ckeditor">{{ old('description_full', isset($product) ? $product->description_full : '') }}</textarea>
        </div>

        <div class="form-group">
            <label for="package">Упаковка</label>
            <input type="text" placeholder="Упаковка" id="package" name="package" class="form-control" value="{{ old('title', isset($product) ? $product->package : '') }}">
        </div>

        @foreach(['using' => 'Використання',
        'tech_characteristics' => '',
        'application' => '',
        'properties_using' => '',
        'application' => '',
        'phys_chem_properties' => '',
        'restrictions' => '',
        'safety' => '',
        'general_characteristics' => '',
        ] as $key => $item)
        <div class="box box-default box-solid collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">{{ $item }}</h3>

              <div class="box-tools pull-right">
                <button data-widget="collapse" class="btn btn-box-tool" type="button"><i class="fa {{ isset($product) && $product->$item && $product->$item != '' ? 'fa-minus' : 'fa-plus' }}"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: {{ isset($product) && $product->$item && $product->$item != '' ? 'block' : 'none' }};">
              <textarea id="using" name="using" class="form-control ckeditor">{{ old('using', isset($product) ? $product->$item : '') }}</textarea>
            </div>
            <!-- /.box-body -->
        </div>
        @endforeach

    </div><!-- /.box-body -->

    <div class="box-footer">
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Сохранить</button>
    </div>
</form>