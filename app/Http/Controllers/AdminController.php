<?php
namespace App\Http\Controllers;
use App\Models\Account;
use App\Models\cate;
use App\Models\Colors;
use App\Models\Photo;
use App\Models\product;
use App\Models\Product_variant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin/dashBoard');
    }

// ---------------------------Slider---------------------------
    public function addSlider() {
        return view('admin/managementAll/addSlider');
    }

    public function uploadImg(Request $request){
        $file = $request->file('file');
        $fileName = $request->post('name');
        $extension = Photo::create([
            'name' => $fileName
        ]);

        $photoUpdate = [
            'name' => $extension->name . '_' . $extension->id . '.png'
        ];
        Photo::where('id', $extension->id)->update($photoUpdate);
        
        $file->move(public_path('user/banner'), $fileName . '_' . $extension->id .'.png');
        return redirect('admin/allSlider');
    }

    public function deleteSlider($id)
    {
        try {
            // 1. Tìm ảnh trong DB
            $photo = Photo::findOrFail($id); // nếu không tìm thấy sẽ tự động throw 404

            // 2. Tạo đường dẫn tới file ảnh đã lưu
            $filePath = public_path('user/banner/' . $photo->name);

            // 3. Kiểm tra nếu file tồn tại → xóa file
            if (File::exists($filePath)) {
                File::delete($filePath);
                 // 4. Xóa record khỏi database
                $photo->delete(); 
                session()->flash('success', 'Delete Success');
                return redirect('admin/allSlider');
            } else {
                session()->flash('error', 'Delete Fails');
                return redirect('admin/allSlider');
            }
        }  catch (Exception $e) {
            session()->flash('error', 'Delete Fails');
            return redirect('admin/allSlider');
        }
    }

    public function allSlider() {
        $data =[
            'photos' => Photo::where('product_variant_id', null)->get()
        ];
        return view('admin/managementAll/allSlider')->with($data);
    }

// ---------------------------Products---------------------------
    public function addProducts() {
        $data = [
           'cates' => cate::get(),
           'colors' => Colors::get()
        ];
        return view('admin/managementAll/addProducts')->with($data);
    }

    public function saveProducts(Request $request){
       
    $product = Product::create([
        'name' => $request->name,
        'price' => $request->price,
        // 'size' => $request->size,
        'description' => $request->description,
        'cate_id' => $request->cate_id,
    ]);
    
    foreach ($request->color_id as $colorId) {
        for( $i = 0; $i<2; $i++){
        if($request->color_id[$i] == $colorId){

            $stock = 'stock' . $i;
            $productVariant = Product_variant::create([
                'product_id' => $product->id,
                'colors_id' => $colorId, // ID màu từ checkbox
                'stock' => $request->$stock, // Stock được gửi từ form
            ]);

            $photoName = 'photo_name' . $i;

            if (is_array($request->$photoName)) {
            foreach ($request->$photoName as $photo) {
                    Photo::create([
                        'name' => $photo,
                        'product_variant_id' => $productVariant->id
                    ]);
                }
            } 
        } elseif($request->color_id[$i] == $colorId){
            $stock = 'stock' . $i;
            $productVariant = Product_variant::create([
                'product_id' => $product->id,
                'colors_id' => $colorId, // ID màu từ checkbox
                'stock' => $request->$stock, // Stock được gửi từ form
            ]);

            $photoName = 'photo_name' . $i;
            if (is_array($request->$photoName)) {
                foreach ($request->$photoName as $photo) {
                Photo::create([
                    'name' => $photo,
                    'product_variant_id' => $productVariant->id
                ]);
                }
            }
        } else {
            echo 'loi loi !!!!!!!!!!!!1';// Mã sẽ được thực thi nếu tất cả các điều kiện trên đều là false
        }
        }
    }

    // 2. Tạo biến thể sản phẩm (product_variant)
    // $productVariant = Product_variant::create([
    //     'product_id' => $product->id,
    //     'colors_id' => $request->color_id,
    //     'stock' => $request->stock
    // ]);

    // $productVariant = Product_variant::create([
        //     'product_id' => $product->id,
        //     'colors_id' => $colorId, // ID màu từ checkbox
        //     'stock' => $request->stock, // Stock được gửi từ form
        // ]);

    // if (is_array($request->photo_name)) {
    // foreach ($request->photo_name as $photo) {
    //         Photo::create([
    //             'name' => $photo,
    //             'product_variant_id' => $productVariant->id
    //         ]);
    //     }
    // }

    // 3. Tạo ảnh và liên kết với biến thể
    // if ($request->has('photo_name')) {
    //     Photo::create([
    //         'name' => $request->photo_name,
    //         'product_variant_id' => $productVariant->id
    //     ]);
    // }


            return redirect('admin/allProducts');
        
    }

    public function deleteProduct($id)
    {
        // 1. Tìm sản phẩm
        $product = Product::find($id);

        // 2. Lấy tất cả variant của sản phẩm này
        $variants = $product->variant; // Giả sử quan hệ tên là `variants`

        foreach ($variants as $variant) {
            // 3. Xoá ảnh liên quan đến variant này
            Photo::where('product_variant_id', $variant->id)->delete();
        }

        // 4. Xoá các variant
        Product_variant::where('product_id', $id)->delete();

        // 5. Xoá sản phẩm chính
        $product->delete();

        return redirect('admin/allProducts');
    }

    // public function editProduct($i){
        
    // }


    public function allProducts() {
        $data =
            [
                'products' => Product::get(),
            ];
        return view('admin/managementAll/allProducts')->with($data);
    }

//---------------------------Categories---------------------------
    public function addCategories(){
        return view('admin/managementAll/addCategories');
    }

    public function saveCategories(Request $request){
        $category = $request->post();
        cate::create($category);
        return redirect('admin/allCategories');
    }

    public function deleteCategory($id)
    {
        cate::where('id', $id)->delete();
        return redirect('admin/allCategories');
    }

    public function editCategory($i){
        $data = [
            'cate' => cate::find($i)
        ];
        return view('admin/managementAll/editCategories')->with($data);
    }

    public function updateCategory(Request $request){
        $category = [
            'name' => $request->post('name')
        ];
        cate::where('id', $request->post('id'))->update($category);
        return redirect('admin/allCategories');
    }

    public function allCategories(){
        $data = [
            'cates' => cate::get()
        ];
        return view('admin/managementAll/allCategories')->with($data);
    }

//---------------------------Orders---------------------------
    public function managementOrder(){
        return view('admin/managementAll/managementOrder');
    }

//---------------------------Customers---------------------------
    public function accounts(){
         $data = [
            'accounts' => account::get()
        ];
        return view('admin/managementAll/accounts')->with($data);
    }


}
?>