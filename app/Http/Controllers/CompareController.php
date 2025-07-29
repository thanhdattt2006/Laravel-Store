<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CompareController extends Controller
{

    public function index()
    {
        // Lấy danh sách ID sản phẩm đã chọn để so sánh từ session
        $compareIds = session('compare', []);  // Mặc định là mảng rỗng nếu chưa có

        // Query chỉ lấy các trường cần thiết
        $data = [
            'products' => Product::whereIn('id', $compareIds)
                ->with(['variant.photos']) // Load variant và photos
                ->select('id', 'name', 'price', 'description') // Không còn 'photo'
                ->get()
        ];
        // Truyền dữ liệu ra view
        return view('shop/compareProduct')->with($data);
    }

    //  Thêm sản phẩm vào danh sách so sánh
    // CompareController.php
    public function add($id)
    {
        $compareIds = session('compare', []);

        if (in_array($id, $compareIds)) {
            return response()->json([
                'success' => false,
                'message' => 'The product is already in the comparison list.'
            ]);
        }

        if (count($compareIds) >= 3) {
            return response()->json([
                'success' => false,
                'message' => 'You can only compare up to 3 products. Please remove some products first!'
            ]);
        }

        $compareIds[] = $id;
        session(['compare' => $compareIds]);

        return response()->json([
            'success' => true,
            'message' => 'The product has been added to the comparison list.'
        ]);
    }


    // Xoá sản phẩm khỏi danh sách so sánh
    public function remove(Request $request)
    {
        $productId = $request->input('product_id'); // Lấy id muốn xoá
        $compareIds = session('compare', []);

        // Xoá id đó ra khỏi mảng
        $compareIds = array_filter($compareIds, function ($id) use ($productId) {
            return $id != $productId;
        });

        session(['compare' => $compareIds]); // Lưu lại mảng mới

        return redirect()->route('compare.index');
    }
}
