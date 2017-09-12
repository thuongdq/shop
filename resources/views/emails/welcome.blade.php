@component('mail::message')
@component('mail::panel')
    <p>Cám ơn bạn đã đặt hàng tại Website của chúng tôi</p>
@endcomponent
# Đơn hàng #{{ $order->id }} của bạn bao gồm các sản phẩm sau đây
@php
    $total = 0;
@endphp
@component('mail::table')
    | Tên sản phẩm | Số lượng | Giá tiền | Thành tiền |
    |--------------|:--------:|:--------:|-----------:|
    @foreach($products as $product)
        @php
            $subtotal = $product->pivot->quantity * $product->sale_price;
            $total += $subtotal;
        @endphp
        | {{ $product->name }} | {{ $product->pivot->quantity }} | {{ get_currency($product->sale_price) }} | {{ get_currency($subtotal) }} |
    @endforeach
@endcomponent
<div style="text-align: center">
    <strong>Tổng tiền: </strong>{{ get_currency($total) }}
</div>
@component('mail::button', ['url' => url('/'), 'color' => 'blue'])
    Xem đơn hàng
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
