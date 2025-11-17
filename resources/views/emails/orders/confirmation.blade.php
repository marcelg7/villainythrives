<x-mail::message>
# Order Confirmed!

Thank you for your order, **{{ $order->customer_first_name }}**!

We've received your order and will process it shortly. Here are your order details:

<x-mail::panel>
**Order Number:** {{ $order->order_number }}<br>
**Order Date:** {{ $order->created_at->format('F j, Y') }}<br>
**Total:** ${{ number_format($order->total, 2) }} CAD
</x-mail::panel>

## Order Items

@foreach($order->items as $item)
- {{ $item->product_name }} (Qty: {{ $item->quantity }}) - ${{ number_format($item->price * $item->quantity, 2) }}
@endforeach

---

## Payment Instructions

@if($order->payment_method === 'etransfer')
**E-Transfer Payment**

Please send your e-Transfer to: **payments@villainythrives.com**

- Amount: **${{ number_format($order->total, 2) }} CAD**
- Message: {{ $order->order_number }}

Your order will be processed once payment is received.

@elseif($order->payment_method === 'cash')
**Cash on Delivery**

Please have **${{ number_format($order->total, 2) }} CAD** ready for the driver.

We will contact you to arrange delivery.
@endif

---

## Shipping Address

{{ $order->shipping_address['address_line1'] ?? '' }}
@if(isset($order->shipping_address['address_line2']) && $order->shipping_address['address_line2'])
{{ $order->shipping_address['address_line2'] }}
@endif
{{ $order->shipping_address['city'] ?? '' }}, {{ $order->shipping_address['province'] ?? '' }} {{ $order->shipping_address['postal_code'] ?? '' }}
{{ $order->shipping_address['country'] ?? '' }}

---

If you have any questions about your order, please contact us at **support@villainythrives.com**

**Choose Loyalty** 🔨

Thanks,<br>
**Villainy Thrives**<br>
*Est. 2021 - Huron County, Ontario*
</x-mail::message>
