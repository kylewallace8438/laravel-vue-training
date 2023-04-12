@php
    $sub_total = 0;
    $total = 0;
    $orderNumber = 0;
    
    foreach ($carts as $cart) {
        if ($cart->discount_price == -1) {
            $sub_total += $cart->amount * $cart->price;
        } else {
            $sub_total += $cart->amount * $cart->discount_price;
        }
    
        $total += $cart->amount * $cart->price;
        $orderNumber += $cart->amount;
    }
@endphp


<p>Dear {{ $user->name }},
    Cảm ơn bạn đã đặt hàng tại cửa hàng của chúng tôi. Đơn hàng của bạn đã được nhận và đang được xử lý.</p>
<p>Số kiện hàng của bạn là: {{ $orderNumber }}</p>
<p>Tổng giá trị đơn hàng của bạn là: ${{ $total }}</p>
<p>Tổng giá trị đơn hàng của bạn sau khi áp mã giảm giá là: ${{ $sub_total }}</p>

<p>Chúng tôi sẽ cập nhật trạng thái đơn hàng của bạn và thông báo cho bạn khi đơn hàng của bạn được
    gửi đi.

    Cảm ơn bạn đã tin tưởng và sử dụng dịch vụ của chúng tôi.
    Chi tiết đơn hàng: </p>
<table>
    <thead>
        <th style="width: 50%">Product</th>
        <th style="width: 50%">Total</th>
    </thead>

    <tbody>
        @foreach ($carts as $cart)
            <tr>
                <br>
                <td style="text-align: center;"> {{ $cart->product->name }} <strong class="mx-2">x</strong>
                    {{ $cart->amount }}</td>
                @if ($cart->discount_price == -1)
                    <td style="text-align: center;">
                        ${{ $cart->amount * $cart->price }}
                    </td>
                @else
                    <td style="text-align: center;">
                        <p style="text-decoration: line-through">
                            ${{ $cart->amount * $cart->price }}</p>
                        ${{ $cart->amount * $cart->discount_price }}
                        <br>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
