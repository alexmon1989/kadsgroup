<form role="form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">
        <div class="form-group">
            <label for="url">Название</label>
            <input type="text" placeholder="Название" id="title" name="title" class="form-control" value="{{ old('title', isset($company) ? $company->title : '') }}">
        </div>
        <div class="form-group">
            <label for="file_main">Изображение основное</label>
            <div class="row">
                <div class="col-md-12 margin-bottom-10">
                    <img src="{{ asset('assets/img/companies/'.$company->file_main) }}" alt="{{ $company->title }}" class="img-responsive">
                </div>
            </div>
            <input type="file" id="file_main" name="file_main">
            <p class="help-block">Форматы: <b>jpg, png, gif</b>. Размер: <b>370px * 247px</b>. Программа приведёт изображение к этому разрешению автоматически без сохранения пропорций сторон. Выбирайте только если хотите заменить текущее.</p>
        </div>
        <div class="form-group">
            <label for="file_logo">Изображение лого</label>
            <div class="row">
                <div class="col-md-12 margin-bottom-10">
                    <img src="{{ asset('assets/img/companies/top/'.$company->file_logo) }}" alt="{{ $company->title }}" class="img-responsive">
                </div>
            </div>
            <input type="file" id="file_logo" name="file_logo">
            <p class="help-block">Форматы: <b>jpg, png, gif</b>. Рекомендуемый размер: <b>89px</b> по высоте. Программа приведёт изображение к этому разрешению автоматически с сохранением пропорций сторон. Выбирайте только если хотите заменить текущее.</p>
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea id="description" name="description" class="form-control ckeditor">{{ old('description', isset($company) ? $company->description : '') }}</textarea>
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
            <input type="text" placeholder="Заголовок (title) страницы" id="page_title" name="page_title" class="form-control" value="{{ old('page_title', isset($company) ? $company->page_title : '') }}">
        </div>
        <div class="form-group">
            <label for="title">Ключевые слова (keywords)</label>
            <input type="text" placeholder="Ключевые слова (keywords)" id="page_keywords" name="page_keywords" class="form-control" value="{{ old('page_keywords', isset($company) ? $company->page_keywords : '') }}">
        </div>
        <div class="form-group">
            <label for="title">Описание (description)</label>
            <input type="text" placeholder="Описание (description)" id="page_description" name="page_description" class="form-control" value="{{ old('page_description', isset($company) ? $company->page_description : '') }}">
        </div>
        <div class="form-group">
            <label for="title">Тег h1</label>
            <input type="text" placeholder="Описание (description)" id="page_h1" name="page_h1" class="form-control" value="{{ old('page_h1', isset($company) ? $company->page_h1 : '') }}">
        </div>
    </div><!-- /.box-body -->

    <div class="box-footer">
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Сохранить</button>
    </div>
</form>