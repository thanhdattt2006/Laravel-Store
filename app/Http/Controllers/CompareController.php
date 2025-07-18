<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CompareController extends Controller {

     public function index()
    {
        // Lấy danh sách ID sản phẩm đã chọn để so sánh từ session
        $compareIds = session('compare', []);  // Mặc định là mảng rỗng nếu chưa có

        // Query chỉ lấy các trường cần thiết
        $data =
        [ 
            'products' => Product::whereIn('id', $compareIds)
                    ->select('id', 'photo', 'name', 'price', 'description')
                    ->get()
        ];
        // Truyền dữ liệu ra view
        return view('shop/compareProduct')->with($data);
    }

    //  Thêm sản phẩm vào danh sách so sánh
    public function add($id)
{
    $compareIds = session('compare', []);

    if (!in_array($id, $compareIds) && count($compareIds) < 3) {
        $compareIds[] = $id;
        session(['compare' => $compareIds]);
    }

    return redirect()->route('compare.index');
}


    // Xoá sản phẩm khỏi danh sách so sánh
    public function remove(Request $request)
    {
        $productId = $request->input('product_id'); // Lấy id muốn xoá
        $compareIds = session('compare', []);

        // Xoá id đó ra khỏi mảng
        $compareIds = array_filter($compareIds, function($id) use ($productId) {
            return $id != $productId;
        });

        session(['compare' => $compareIds]); // Lưu lại mảng mới

        return redirect()->route('compare.index');
    }

}

?>