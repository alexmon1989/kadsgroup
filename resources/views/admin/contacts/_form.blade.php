<form role="form" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">
        <div class="callout callout-info">
            <h4><i class="icon fa fa-info"></i> Информация!</h4>
            <p>Координаты можно определить с помощью <strong><a href="http://dimik.github.io/ymaps/examples/location-tool/" target="_blank">этого инструмента</a></strong>.</p>
        </div>
        <div class="form-group">
            <label for="title">Широта метки Google Maps</label>
            <input type="title" placeholder="Широта" id="latitude" name="latitude" class="form-control" value="{{ old('latitude', Memory::get('contacts.latitude')) }}">
        </div>
        <div class="form-group">
            <label for="title">Долгота метки Google Maps</label>
            <input type="title" placeholder="Долгота" id="longitude" name="longitude" class="form-control" value="{{ old('longitude', Memory::get('contacts.longitude')) }}">
        </div>

        <div class="callout callout-info">
            <h4><i class="icon fa fa-info"></i> Информация!</h4>
            <p>Если информация в каком-то из полей ниже будет отсутствувать, то соответствующий виджет <strong>отображён не будет</strong>.</p>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="contacts_form_text">Текст сверху формы связи</label>
                    <textarea id="contacts_form_text" name="contacts_form_text" rows="10" cols="80" class="form-control ckeditor">{{ old('contacts_form_text', isset($contacts_form_text) ? $contacts_form_text->full_text : '') }}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="contacts_working_time">Текст для виджета "Контакти"</label>
                    <textarea id="contacts_contacts" name="contacts_contacts" rows="10" cols="80" class="form-control ckeditor">{{ old('contacts_contacts', isset($contacts_contacts) ? $contacts_contacts->full_text : '') }}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="contacts_working_time">Текст для виджета "Рабочий час"</label>
                    <textarea id="contacts_working_time" name="contacts_working_time" rows="10" cols="80" class="form-control ckeditor">{{ old('contacts_working_time', isset($contacts_working_time) ? $contacts_working_time->full_text : '') }}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="contacts_why_us">Текст для виджета "Чому саме ми?"</label>
                    <textarea id="contacts_why_us" name="contacts_why_us" rows="10" cols="80" class="form-control ckeditor">{{ old('contacts_why_us', isset($contacts_why_us) ? $contacts_why_us->full_text : '') }}</textarea>
                </div>
            </div>
        </div>

        <hr/>
        <h4>Настройки для SEO</h4>
        <div class="alert alert-info alert-dismissible">
            <h4><i class="icon fa fa-info"></i> Информация!</h4>
            Эти поля предназначены для оптимизации сайта для продвижения сайта в поисковых сетях. Если вы не знаете что сюда писать, оставьте их пустыми.
        </div>
        <div class="form-group">
            <label for="title">Заголовок (title) страницы</label>
            <input type="text" placeholder="Заголовок (title) страницы" id="page_title" name="page_title" class="form-control" value="{{ old('page_title', isset($contacts_form_text) ? $contacts_form_text->page_title : '') }}">
        </div>
        <div class="form-group">
            <label for="title">Ключевые слова (keywords)</label>
            <input type="text" placeholder="Ключевые слова (keywords)" id="page_keywords" name="page_keywords" class="form-control" value="{{ old('page_keywords', isset($contacts_form_text) ? $contacts_form_text->page_keywords : '') }}">
        </div>
        <div class="form-group">
            <label for="title">Описание (description)</label>
            <input type="text" placeholder="Описание (description)" id="page_description" name="page_description" class="form-control" value="{{ old('page_description', isset($contacts_form_text) ? $contacts_form_text->page_description : '') }}">
        </div>
        <div class="form-group">
            <label for="title">Тег h1</label>
            <input type="text" placeholder="Описание (description)" id="page_h1" name="page_h1" class="form-control" value="{{ old('page_h1', isset($contacts_form_text) ? $contacts_form_text->page_h1 : '') }}">
        </div>
    </div><!-- /.box-body -->

    <div class="box-footer">
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Сохранить</button>
    </div>
</form>