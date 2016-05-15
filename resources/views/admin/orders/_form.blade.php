<form role="form" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">

        <div class="form-group">
            <label>Статус заказа</label>
            <select class="form-control" name="status" id="status">
                <option value="1" {{ old('status', isset($order) ? $order->status : 1) == 1 ? 'selected' : '' }}>Новый</option>
                <option value="2" {{ old('status', isset($order) ? $order->status : 1) == 2 ? 'selected' : '' }}>В обработке</option>
                <option value="3" {{ old('status', isset($order) ? $order->status : 1) == 3 ? 'selected' : '' }}>Обработан</option>
            </select>
        </div>

        <div class="form-group has-success">
            <label for="title">Продукт</label>
            <input type="text" placeholder="Продукт" id="product_title" name="product_title" class="form-control" value="{{ old('product_title', isset($order) ? $order->product_title : '') }}">
        </div>

        <div class="form-group">
            <label for="title">ФИО заказчика</label>
            <input type="text" placeholder="ФИО заказчика" id="username" name="username" class="form-control" value="{{ old('username', isset($order) ? $order->username : '') }}">
        </div>

        <div class="form-group">
            <label for="title">Компания заказчика</label>
            <input type="text" placeholder="Компания заказчика" id="company" name="company" class="form-control" value="{{ old('company', isset($order) ? $order->company : '') }}">
        </div>

        <div class="form-group">
            <label for="title">Контактный телефон</label>
            <input type="text" placeholder="Контактный телефон" id="phone" name="phone" class="form-control" value="{{ old('phone', isset($order) ? $order->phone : '') }}">
        </div>

        <div class="form-group">
            <label for="title">E-Mail</label>
            <input type="text" placeholder="E-Mail" id="email" name="email" class="form-control" value="{{ old('email', isset($order) ? $order->email : '') }}">
        </div>

        <div class="form-group">
            <label for="comment">Комментарий</label>
            <textarea id="comment" name="comment" rows="10" cols="80" class="form-control ckeditor">{{ old('comment', isset($order) ? $order->comment : '') }}</textarea>
        </div>
    </div><!-- /.box-body -->

    <div class="box-footer">
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Сохранить</button>
    </div>
</form>