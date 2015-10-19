<form role="form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">
        <div class="form-group">
            <label for="title">Название</label>
            <input type="title" placeholder="Название" id="title" name="title" class="form-control" value="{{ old('title', isset($photo) ? $photo->title : '') }}">
        </div>
        <div class="form-group">
            <label for="file_name">Изображение</label>
            @if (isset($photo))
            <div class="row">
                <div class="col-md-12 margin-bottom-10">
                    <img width="400" src="{{ asset('assets/img/galleries/'.$photo->file_name) }}" alt="{{ $photo->title }}" class="img-responsive">
                </div>
            </div>
            @endif
            <input type="file" id="file_name" name="file_name">
            <p class="help-block">Форматы: <b>jpg, png, gif</b>. @if (isset($photo)) Выбирайте изображение только если хотите сменить текущее. @endif</p>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="is_main" value="1" {{ old('is_main', isset($photo) ? $photo->is_main : 0) == 1 ? 'checked=""' : ''  }}> Главное фото галереи
            </label>
            <p class="help-block">Отметьте, если хотите использовать это фото как заглавное в списке галерей</p>
        </div>
    </div><!-- /.box-body -->

    <div class="box-footer">
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Сохранить</button>
    </div>
</form>