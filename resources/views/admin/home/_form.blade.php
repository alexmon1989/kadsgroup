<form role="form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">
        <div class="form-group">
            <label for="full_text">Текст статьи*</label>
            <textarea id="full_text" name="full_text" rows="10" cols="80" class="form-control ckeditor">{{ old('full_text', isset($article) ? $article->full_text : '') }}</textarea>
        </div>

        <hr/>

        <h4>Настройки для SEO</h4>
        <div class="alert alert-info alert-dismissible">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4><i class="icon fa fa-info"></i> Информация!</h4>
            Эти поля предназначены для оптимизации сайта для продвижения сайта в поисковых сетях. Если вы не знаете что сюда писать, оставьте их пустыми.
        </div>
        <div class="form-group">
            <label for="page_title">Заголовок (title) страницы</label>
            <input type="text" placeholder="Заголовок (title) страницы" id="page_title" name="page_title" class="form-control" value="{{ old('page_title', isset($article) ? $article->page_title : '') }}">
        </div>
        <div class="form-group">
            <label for="page_keywords">Ключевые слова (keywords)</label>
            <input type="text" placeholder="Ключевые слова (keywords)" id="page_keywords" name="page_keywords" class="form-control" value="{{ old('page_keywords', isset($article) ? $article->page_keywords : '') }}">
        </div>
        <div class="form-group">
            <label for="page_description">Описание (description)</label>
            <input type="text" placeholder="Описание (description)" id="page_description" name="page_description" class="form-control" value="{{ old('page_description', isset($article) ? $article->page_description : '') }}">
        </div>


    </div><!-- /.box-body -->

    <div class="box-footer">
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Сохранить</button>
    </div>
</form>