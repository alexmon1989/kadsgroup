<form role="form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">
        <div class="form-group">
            <label for="title">Название</label>
            <input type="title" placeholder="Название" id="title" name="title" class="form-control" value="{{ old('title', isset($certificate) ? $certificate->title : '') }}">
        </div>
        <div class="form-group">
            <label for="file_name">Изображение</label>
            @if (isset($certificate))
            <div class="row">
                <div class="col-md-12 margin-bottom-10">
                    <img width="400" src="{{ asset('assets/img/certificates/'.$certificate->file_name) }}" alt="{{ $certificate->title }}" class="img-responsive">
                </div>
            </div>
            @endif
            <input type="file" id="file_name" name="file_name">
            <p class="help-block">Форматы: <b>jpg, png, gif</b>. @if (isset($certificate)) Выбирайте изображение только если хотите сменить текущее. @endif</p>
        </div>
    </div><!-- /.box-body -->

    <div class="box-footer">
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Сохранить</button>
    </div>
</form>