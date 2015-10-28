<form role="form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">
        <div class="form-group">
            <label for="title">Название</label>
            <input type="text" placeholder="Название" id="title" name="title" class="form-control" value="{{ old('title', isset($category) ? $category->title : '') }}">
        </div>

        <div class="form-group">
            <label for="group_category_id">Группа категорий</label>
            @if (!isset($category) || (is_null($category->parent_id) && count($category->child_categories) == 0))
            <select class="form-control" name="group_category_id" id="group_category_id">
                <option></option>
                @foreach($groups_categories as $item)
                <option value="{{ $item->id }}" {{ old('group_category_id', isset($category) ? $category->group_category_id : NULL) == $item->id ? 'selected=""' : '' }}>{{ $item->title }}</option>
                @endforeach
            </select>
            @else
            <div class="alert alert-warning alert-dismissible">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <h4><i class="icon fa fa-warning"></i> Предупреждение!</h4>
                Невозможно задать группу категорий. Возможные причины: <br />
                1. Существует родительская категория для этой категории. <br />
                2. Существуют дочерние подкатегории этой категории. <br /><br />
                Текущая группа категорий: <strong>{{ $category->group_category->title }}</strong>
            </div>
            @endif
        </div>

        <div class="form-group">
            <label for="parent_id">Родительская категория</label>
            @if (!isset($category) || count($category->child_categories) == 0)
            <select class="form-control" name="parent_id" id="parent_id"></select>
            @else
            <div class="alert alert-warning alert-dismissible">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <h4><i class="icon fa fa-warning"></i> Предупреждение!</h4>
                Невозможно задать родительскую категорию, т.к. текущая категория содержит дочерние подкатегории.<br /><br />
                Текущая родительская категория: <strong>отсутствует</strong>
            </div>
            @endif
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="enabled" value="1" {{ old('enabled', isset($category) ? $category->enabled : 0) == 1 ? 'checked=""' : ''  }}> Включено
            </label>
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea id="description" name="description" rows="10" cols="80" class="form-control ckeditor">{{ old('description', isset($category) ? $category->description : '') }}</textarea>
        </div>
    </div><!-- /.box-body -->

    <div class="box-footer">
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Сохранить</button>
    </div>
</form>

@section('script')

@parent

<script>
    $(function() {
        // Заполнение поля "Родительская категория"
        var getParentCategories = function( groupCategoryId, ignoreId ) {
            $( "#parent_id" ).html('');
            if (groupCategoryId != '') {
                if (ignoreId === undefined) {
                    ignoreId = ''
                } else {
                    ignoreId = '/' + ignoreId;
                }
                $.getJSON( 'admin/companies/catalog/categories/parent-categories/' + groupCategoryId + ignoreId + '?company={{ $company->short_title  }}', function (data) {
                    $( "#parent_id" ).append($("<option />"));
                    $.each(data, function() {
                        $( "#parent_id" ).append($("<option />").val(this.id).text(this.title));
                    });

                    @if (old('parent_id'))
                        $("#parent_id [value='{{ old('parent_id') }}']").attr("selected", "selected");
                    @elseif (isset($category) && count($category->child_categories) == 0)
                        $("#parent_id [value='{{ $category->parent_id }}']").attr("selected", "selected");
                    @endif
                });
            }
        };

        $( "#group_category_id" ).change(function() {
          getParentCategories( $( "#group_category_id" ).val() );
        });

        @if (isset($category) && count($category->child_categories) == 0)
            getParentCategories( {{ $category->group_category_id }}, {{ $category->id }} );
        @elseif (old('group_category_id'))
            getParentCategories( {{ old('group_category_id') }} );
        @endif
    });
</script>

@stop