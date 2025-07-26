<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function showCheckOut(Request $request)
    {
        $user = auth()->user();
        $cart = Cart::where('account_id', $user->id)->first();
        $cartItems = $cart
            ? $cart->cartItems()->with(['product', 'product.variant.colors'])->orderByDesc('id')->get()
            : collect();

        $subtotal = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        // Xử lý voucher
        $discount = 0;
        $voucher = null;
        $voucherMessage = null;
        $grand_price = $subtotal; // Mặc định grand_price bằng subtotal
        if ($request->has('code_name')) {
            $request->validate([
                'code_name' => 'nullable|string|max:255',
            ]);
            $voucher = Voucher::where('code_name', $request->input('code_name'))
                ->where('stock', '>', 0)
                ->first();

            if ($voucher) {
                $discount = $voucher->discount_value;
                $grand_price = $subtotal - $discount;
                $voucherMessage = 'Áp dụng voucher thành công!';
                session(['voucher_id' => $voucher->id]); // Lưu voucher_id vào session
            } else {
                $voucherMessage = 'Mã voucher không hợp lệ hoặc đã hết lượt sử dụng';
                session()->forget('voucher_id');
            }
        }

        $payments = Payment::get();
        $vouchers = Voucher::where('stock', '>', 0)->get(); // Chỉ lấy voucher còn stock

        if ($request->expectsJson()) {
            return response()->json([
                'loggedIn' => true,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'grand_price' => $grand_price,
                'cartItems' => $cartItems,
                'payments' => $payments,
                'voucher' => $voucher ? $voucher->only(['id', 'code_name', 'discount_value']) : null,
                'voucher_message' => $voucherMessage,
                'vouchers' => $vouchers,
            ]);
        }

        return view('shop.productCheckout', [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'grand_price' => $grand_price,
            'payments' => $payments,
            'voucher' => $voucher,
            'voucherMessage' => $voucherMessage,
            'vouchers' => $vouchers,
        ]);
    }

public function store(Request $request)
{
    // Kiểm tra đăng nhập
    if (!auth()->check()) {
        return redirect()->route('account.login')->with('error', 'Vui lòng đăng nhập trước.');
    }
    Log::info('⚡️ OrderController@store: Bắt đầu xử lý đơn hàng');
    Log::debug('📥 Request data:', $request->all());
    Log::debug('👤 Auth user:', [auth()->user()]);

    try {
        DB::beginTransaction();

        // Lấy ID của phương thức thanh toán từ tên
        $paymentMethod = Payment::where('name', $request->input('payment'))->first();
        if (!$paymentMethod) {
            return back()->with('error', 'Phương thức thanh toán không hợp lệ.');
        }

        // Tạo đơn hàng
        $order = Order::create([
            'account_id' => auth()->user()->id,
            'payments_id' => $paymentMethod->id,
            'voucher_discount_id' => $request->input('voucher') ?? null,
            'grand_price' => $request->input('grand_price'),
            'created_day' => now(),
            'updated_day' => now(),
            'fullname' => $request->input('fullname'),
            'address' => $request->input('address'),
            'phone' => $request->input('number'), // ⚠ Nếu form dùng "number" thay vì "phone"
            'note' => $request->input('note'),
            'status' => true
        ]);

        // Lưu chi tiết sản phẩm
        $productIds = $request->input('product_id', []);
        $quantities = $request->input('product_quantity', []);
        $totals = $request->input('total', []);

        foreach ($productIds as $index => $productId) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $quantities[$index],
                'price' => $totals[$index] / $quantities[$index],
                'total_price' => $totals[$index],
            ]);
        }

        //Xoá giỏ hàng (nếu dùng DB giỏ hàng)
        CartItem::where('cart_id', auth()->user()->id)->delete();

        DB::commit();
        return redirect()->route('shop.confirmation', ['order_id' => $order->id])
                         ->with('success', 'Đặt hàng thành công!');
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('❌ Order creation failed: ' . $e->getMessage());
        return back()->with('error', 'Có lỗi khi đặt hàng: ' . $e->getMessage());
    }
}


    public function confirmation()
{
    $data = [

    ];
}
}
