<form role="form" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">
        <div class="form-group">
            <label for="email_to">E-Mail, куда приходят сообщения с формы обратной связи</label>
            <input type="title" placeholder="E-Mail" id="email_to" name="email_to" class="form-control" value="{{ old('email_to', Memory::get('site.email_to', 'llckadsgroup@gmail.com')) }}">
        </div>

        <div class="form-group">
            <label for="main_article">Текст статьи на главной странице</label>
            <textarea id="main_article" name="main_article" rows="10" cols="80" class="form-control ckeditor">{{ old('main_article', isset($main_article) ? $main_article->full_text : '') }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="footer_about">Текст о компании в "подвале"</label>
                    <textarea id="footer_about" name="footer_about" rows="10" cols="80" class="form-control ckeditor">{{ old('footer_about', isset($footer_about) ? $footer_about->full_text : '') }}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="footer_contacts">Текст виджета "Зв'яжіться з нами"</label>
                    <textarea id="footer_contacts" name="footer_contacts" rows="10" cols="80" class="form-control ckeditor">{{ old('footer_contacts', isset($footer_contacts) ? $footer_contacts->full_text : '') }}</textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="jivosite_enabled" value="1" {{ old('jivosite_enabled', Memory::get('site.jivosite_enabled', 0)) == 1 ? 'checked=""' : ''  }}> JivoSite включён
                    </label>
                </div>
            </div>
        </div>
    </div><!-- /.box-body -->

    <div class="box-footer">
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Сохранить</button>
    </div>
</form>