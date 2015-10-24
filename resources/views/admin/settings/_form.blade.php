<form role="form" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">
        <div class="form-group">
            <label for="email_to">E-Mail, куда приходят сообщения с формы обратной связи</label>
            <input type="title" placeholder="E-Mail" id="email_to" name="email_to" class="form-control" value="{{ old('email_to', Memory::get('site.email_to', 'llckadsgroup@gmail.com')) }}">
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
    </div><!-- /.box-body -->

    <div class="box-footer">
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Сохранить</button>
    </div>
</form>