<form role="form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">
        <div class="form-group">
            <label for="title">Название</label>
            <input type="text" placeholder="Название" id="title" name="title" class="form-control" value="{{ old('title', isset($partner) ? $partner->title : '') }}">
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="enabled" value="1" {{ old('enabled', isset($partner) ? $partner->enabled : 0) == 1 ? 'checked=""' : ''  }}> Включено
            </label>
        </div>

        <div class="form-group">
            <label for="description">Описание</label>
            <textarea id="description" name="description" rows="10" cols="80" class="form-control ckeditor">{{ old('description', isset($partner) ? $partner->description : '') }}</textarea>
        </div>

        <div class="form-group">
            <label for="web_site">Web-сайт</label>
            <input type="text" placeholder="Web-сайт" id="web_site" name="web_site" class="form-control" value="{{ old('web_site', isset($partner) ? $partner->web_site : '') }}">
        </div>

        <div class="form-group">
            <label for="category">Категория</label>
            <input type="text" placeholder="Категория" id="category" name="category" class="form-control" value="{{ old('category', isset($partner) ? $partner->category : '') }}">
        </div>

        <div class="form-group">
            <label for="file_name">Изображение</label>
            @if (isset($partner))
            <div class="row">
                <div class="col-md-12 margin-bottom-10">
                    <img width="140" src="{{ asset('assets/img/partners/'.$partner->image) }}" alt="{{ $partner->title }}" class="img-responsive">
                </div>
            </div>
            @endif
            <input type="file" id="image" name="image">
            <p class="help-block">Форматы: <b>jpg, png, gif</b>. @if (isset($partner)) Выбирайте изображение только если хотите сменить текущее. @endif</p>
        </div>
    </div><!-- /.box-body -->

    <div class="box-footer">
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Сохранить</button>
    </div>
</form>