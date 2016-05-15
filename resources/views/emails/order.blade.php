<h2>Данные заказа:</h2>

<p><strong>Товар:</strong> {{ $order->product_title }}</p>
<p><strong>Имя заказчика:</strong> {{ $order->username }}</p>
<p><strong>Компания заказчика:</strong> {{ $order->company }}</p>
<p><strong>Контактный телефон:</strong> {{ $order->phone }}</p>
<p><strong>E-Mail:</strong> <a href="mailto:{{ $order->email }}">{{ $order->email }}</a></p>
<p><strong>Комментарий:</strong> {{ $order->comment }}</p>

<br/>

<p><strong>После обработки заказа не забудьте присвоить ему соответсвующий статус в административной панели сайта по адресу:
        <a href="{{ route('orders.edit', ['order' => $order]) }}">перейти</a>.</strong></p>