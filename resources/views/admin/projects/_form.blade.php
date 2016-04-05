<form role="form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">
        <div class="form-group">
            <label for="title">Название</label>
            <input type="text" placeholder="Название" id="title" name="title" class="form-control" value="{{ old('title', isset($project) ? $project->title : '') }}">
        </div>

        <div class="form-group">
            <label for="slug">Slug (текст в ссылке)</label>
            <input type="text" placeholder="Название" id="slug" name="slug" class="form-control" value="{{ old('slug', isset($project) ? $project->slug : '') }}">
            <p class="help-block">Можно оставить пустым и текст будет сгенерирован автоматически на основании поля "Название"</p>
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="enabled" value="1" {{ old('enabled', isset($project) ? $project->enabled : 0) == 1 ? 'checked=""' : ''  }}> Включено
            </label>
        </div>

        <div class="form-group">
            <label for="description_short">Описание короткое</label>
            <textarea id="description_short" name="description_short" rows="10" cols="80" class="form-control ckeditor">{{ old('description_short', isset($project) ? $project->description_short : '') }}</textarea>
        </div>

        <div class="form-group">
            <label for="description_full">Описание полное</label>
            <textarea id="description_full" name="description_full" rows="10" cols="80" class="form-control ckeditor">{{ old('description_full', isset($project) ? $project->description_full : '') }}</textarea>
            <p class="help-block">Можно оставить пустым и на странице объекта будет отображаться текст из поля "Описание коротко"</p>
        </div>

        <div class="form-group">
            <label for="file_name">Изображение</label>
            @if (isset($project))
            <div class="row">
                <div class="col-md-12 margin-bottom-10">
                    <img width="140" src="{{ asset('assets/img/projects/'.$project->image) }}" alt="{{ $project->title }}" class="img-responsive">
                </div>
            </div>
            @endif
            <input type="file" id="image" name="image">
            <p class="help-block">Форматы: <b>jpg, png, gif</b>. @if (isset($project)) Выбирайте изображение только если хотите сменить текущее. @endif</p>
        </div>
    </div><!-- /.box-body -->

    <div class="box-footer">
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Сохранить</button>
    </div>
</form>