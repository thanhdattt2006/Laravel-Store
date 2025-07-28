@extends('layout.admin')
@section('content')
<!-- <link rel="stylesheet" href="billStyle.css"> -->
<link rel="stylesheet" href="{{asset('admin')}}/assets/css/elementCss/billStyle.css">
<div class="invoice-box">
    <h2>HÓA ĐƠN THANH TOÁN</h2>

    <div class="info">
      <p><strong>Mã hóa đơn:</strong> INV-00022</p>
      <p><strong>Khách hàng:</strong> Trần Thị B</p>
      <p><strong>Email:</strong> tranb@gmail.com</p>
      <p><strong>SĐT:</strong> 0909 123 456</p>
      <p><strong>Địa chỉ:</strong> 123 Nguyễn Trãi, P. Bến Thành, Q.1, TP.HCM</p>
      <p><strong>Ngày đặt:</strong> 27/07/2025</p>
      <p><strong>Phương thức:</strong> Chuyển khoản ngân hàng</p>
      <p><strong>Trạng thái:</strong> Đang giao hàng - Đã thanh toán</p>
    </div>

    <table>
      <thead>
        <tr>
          <th>STT</th>
          <th>Sản phẩm</th>
          <th>Màu</th>
          <th>Kích cỡ</th>
          <th>SL</th>
          <th>Đơn giá</th>
          <th>Thuế (10%)</th>
          <th>Thành tiền</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Áo Thun Trắng</td>
          <td>Trắng</td>
          <td>M</td>
          <td>2</td>
          <td>200.000₫</td>
          <td>40.000₫</td>
          <td>440.000₫</td>
        </tr>
        <tr>
          <td>2</td>
          <td>Quần Short</td>
          <td>Xanh</td>
          <td>L</td>
          <td>1</td>
          <td>250.000₫</td>
          <td>25.000₫</td>
          <td>275.000₫</td>
        </tr>
        <tr>
          <td>3</td>
          <td>Giày Sneaker</td>
          <td>Đỏ</td>
          <td>42</td>
          <td>1</td>
          <td>1.000.000₫</td>
          <td>100.000₫</td>
          <td>1.100.000₫</td>
        </tr>
      </tbody>
    </table>

    <div class="totals">
      <p>Tổng tiền hàng: <span>1.450.000₫</span></p>
      <p>Thuế: <span>165.000₫</span></p>
      <p>Phí vận chuyển: <span>30.000₫</span></p>
      <p><strong>Tổng thanh toán: <span>1.645.000₫</span></strong></p>
    </div>

    <div class="note">
      Cảm ơn quý khách đã mua hàng tại cửa hàng của chúng tôi!
    </div>
  </div>
@endsection