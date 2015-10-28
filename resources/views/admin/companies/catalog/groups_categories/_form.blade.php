<form role="form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">
        <div class="form-group">
            <label for="title">Название</label>
            <input type="text" placeholder="Название" id="title" name="title" class="form-control" value="{{ old('title', isset($group_category) ? $group_category->title : '') }}">
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="enabled" value="1" {{ old('enabled', isset($group_category) ? $group_category->enabled : 0) == 1 ? 'checked=""' : ''  }}> Включено
            </label>
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea id="description" name="description" rows="10" cols="80" class="form-control ckeditor">{{ old('description', isset($group_category) ? $group_category->description : '') }}</textarea>
        </div>
    </div><!-- /.box-body -->

    <div class="box-footer">
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Сохранить</button>
    </div>
</form>