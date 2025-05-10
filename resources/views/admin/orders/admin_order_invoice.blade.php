<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Invoice</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #0D1624; color: #FFFFFF;">

  <!-- Header -->
  <table width="100%" style="background-color: #1E2B3F; padding: 20px;">
    <tr>
      <td>
        <h1 style="margin: 0; color: #25BA84;">VB CARD</h1>
      </td>
      <td align="right">
        <p style="margin: 0; font-size: 14px;">
          VB CARD Headquarters<br>
          Email: ahmed17nasser17@gmail.com<br>
          Phone: 01063265173<br>
          Egypt, Office #4
        </p>
      </td>
    </tr>
  </table>

  <!-- Customer & Invoice Info -->
  <table width="100%" style="padding: 20px;">
    <tr>
      <td valign="top" width="50%">
        <h3 style="color: #25BA84;">Customer Details</h3>
        <p style="font-size: 14px; line-height: 1.6;">
          <strong>Name:</strong> {{ $order->name ?? '' }}<br>
          <strong>Email:</strong> {{ $order->email ?? '' }}<br>
          <strong>Phone:</strong> {{ $order->phone ?? '' }}<br>
          @php
            $div = $order->division->division_name ?? '';
            $dis = $order->district->district_name ?? '';
            $state = $order->state->state_name ?? '';
          @endphp
          <strong>Address:</strong> {{ $order->adress }} / {{ $div }} / {{ $dis }} / {{ $state }}<br>
          <strong>Postal Code:</strong> {{ $order->post_code }}
        </p>
      </td>
      <td valign="top" width="50%" align="right">
        <h3 style="color: #25BA84;">Invoice Info</h3>
        <p style="font-size: 14px; line-height: 1.6;">
          <strong>Invoice No:</strong> #{{ $order->invoice_no ?? '' }}<br>
          <strong>Order Date:</strong> {{ $order->order_date ?? '' }}<br>
          <strong>Delivery Date:</strong> {{ $order->delivered_date ?? '' }}<br>
          <strong>Payment Method:</strong> {{ $order->payment_method ?? '' }}
        </p>
      </td>
    </tr>
  </table>

  <!-- Products Table -->
  <h3 style="background-color: #25BA84; color: #FFFFFF; padding: 10px 20px; margin: 0;">Products</h3>
  <table width="100%" cellpadding="10" cellspacing="0" style="background-color: #1E2B3F; border-collapse: collapse;">
    <thead>
      <tr style="text-align: center; border-bottom: 2px solid #25BA84;">
        <th style="color: #FFFFFF;">Image</th>
        <th style="color: #FFFFFF;">Product Name</th>
        <th style="color: #FFFFFF;">Code</th>
        <th style="color: #FFFFFF;">Quantity</th>
        <th style="color: #FFFFFF;">Seller</th>
        <th style="color: #FFFFFF;">Price</th>
      </tr>
    </thead>
    <tbody>
      @foreach($orderItem as $item)
      <tr style="text-align: center; border-bottom: 1px solid #25BA84;">
        <td><img src="{{ public_path($item->product->product_thambnail) }}" style="max-width: 60px;" alt=""></td>
        <td>{{ $item->product->product_name }}</td>
        <td>{{ $item->product->product_code ?? '...' }}</td>
        <td>{{ $item->qty }}</td>
        <td>
          @if($item->vendor_id == NULL)
            Admin
          @else
            Vendor
          @endif
        </td>
        <td>${{ number_format($item->price, 2) }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <!-- Totals -->
  <table width="100%" style="padding: 20px;">
    <tr>
      <td align="right">
        <h2 style="margin: 0; color: #FFFFFF;">
          <span style="color: #25BA84;">Subtotal:</span> SAR {{ number_format($order->amount, 2) }}
        </h2>
        <h2 style="margin: 5px 0 0 0; color: #FFFFFF;">
          <span style="color: #25BA84;">Total:</span> SAR {{ number_format($order->amount, 2) }}
        </h2>
      </td>
    </tr>
  </table>

  <!-- Thank You -->
  <div style="padding: 20px; background-color: #0D1624;">
    <p style="text-align: center; font-size: 16px; color: #FFFFFF;">
      Thank you for your purchase! We appreciate your business.
    </p>
  </div>

</body>
</html>
<style>
    td,tr,th{
        color: white
    }
</style>
