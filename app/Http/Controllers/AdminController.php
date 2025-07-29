<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Account;
use App\Models\Blog;
use App\Models\cate;
use App\Models\Colors;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Photo;
use App\Models\product;
use App\Models\Product_variant;
use Carbon\Carbon;
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
    public function addSlider()
    {
        return view('admin/slide/addSlider');
    }

    public function uploadImg(Request $request)
    {
        try {
            $file = $request->file('file');
            $fileName = $request->post('name');
            $extension = Photo::create([
                'name' => $fileName
            ]);

            $photoUpdate = [
                'name' => $extension->name . '_' . $extension->id . '.png'
            ];
            Photo::where('id', $extension->id)->update($photoUpdate);

            $file->move(public_path('user/banner'), $fileName . '_' . $extension->id . '.png');
            session()->flash('success', 'AddSlider Success');
            return redirect('admin/allSlider');
        } catch (Exception $e) {
            session()->flash('error', 'AddSlider Fails');
            return redirect('admin/allSlider');
        }
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
        } catch (Exception $e) {
            session()->flash('error', 'Delete Fails');
            return redirect('admin/allSlider');
        }
    }

    public function allSlider()
    {
        $data = [
            'photos' => Photo::where('product_variant_id', null)->orderBy('id', 'desc')->get()
        ];
        return view('admin/slide/allSlider')->with($data);
    }

    // ---------------------------Products---------------------------
    public function addProducts()
    {
        $data = [
            'cates' => cate::get(),
            'colors' => Colors::get()
        ];
        return view('admin/product/addProducts')->with($data);
    }

    public function saveProducts(Request $request)
    {
        try {
            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'cate_id' => $request->cate_id,
            ]);

            foreach ($request->color_id as $colorId) {
                for ($i = 0; $i < 2; $i++) {
                    if ($request->color_id[$i] == $colorId) {
                        $stock = 'stock' . $i;
                        $productVariant = Product_variant::create([
                            'product_id' => $product->id,
                            'colors_id' => $colorId, // ID màu từ checkbox
                            'stock' => $request->$stock, // Stock được gửi từ form
                        ]);

                        $photoName = 'photo_name' . $i;
                        if ($request->hasFile($photoName)) {
                            foreach ($request->file($photoName) as $file) {
                                // Tạo tên file mới (để tránh trùng)
                                $fileName = generateFileName($file->getClientOriginalName());
                                // Lưu file vào thư mục public/user/nike-img
                                $file->move(public_path('user/nike-img'), $fileName);
                                Photo::create([
                                    'name' => $fileName,
                                    'product_variant_id' => $productVariant->id
                                ]);
                            }
                        }
                    }
                }
            }
            session()->flash('success', 'AddProduct Success');
            return redirect('admin/allProducts');
        } catch (Exception $e) {
            session()->flash('error', 'AddProduct Fails');
            return redirect('admin/addProducts');
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

    }

    public function deleteProduct($id)
    {
        try {
            // 1. Tìm sản phẩm
            $product = Product::find($id);

            // 2. Lấy tất cả variant của sản phẩm này
            $variants = $product->variant; // Giả sử quan hệ tên là `variants`

            // foreach ($variants as $variant) {
            //     3. Xoá ảnh liên quan đến variant này
            //     Photo::where('product_variant_id', $variant->id)->delete();
            // }

            foreach ($variants as $variant) {
                $photos = Photo::where('product_variant_id', $variant->id)->get();

                foreach ($photos as $photo) {
                    $filePath = public_path('user/nike-img/' . $photo->name);

                    // Kiểm tra file tồn tại rồi mới xóa
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }

                    // Xóa bản ghi trong database
                    $photo->delete();
                }
            }

            // 4. Xoá các variant
            Product_variant::where('product_id', $id)->delete();

            // 5. Xoá sản phẩm chính
            $product->delete();
            session()->flash('success', 'DeleteProduct Success');
            return redirect('admin/allProducts');
        } catch (Exception $e) {
            session()->flash('error', 'DeleteProduct Fails');
            return redirect('admin/allProducts');
        }
    }

    public function editProduct($id)
    {
        $data = [
            'products' => Product::find($id),
            'cates' => cate::get(),
            'colors' => Colors::get(),
            'photos' =>  Product::with('variant.photos')->find($id)
        ];
        return view('admin/product/editProducts')->with($data);
    }




    public function upDateProducts(Request $request)
    {
        $product = [
            'name' => $request->post('name'),
            'price' => $request->post('price'),
            'description' => $request->post('description'),
            'cate_id' => $request->post('cate_id')
        ];
        product::where('id', $request->post('id'))->update($product);

        // $variant = [
        //     'stock' => $request=>post('stock')
        // ];
        // $productId = $request->post('id');

        for ($i = 0; $i < count($request->color_id); $i++) {
            $colorId = $request->color_id[$i];
            $stockKey = 'stock' . $i;
            $productVariant = [
                'colors_id' => $colorId,
                'stock' => $request->post($stockKey)
            ];
            Product_variant::where('product_id', $request->post('id'))->where('id', $request->post('variant_id' . $i))->update($productVariant);
            $productVariantId = Product_variant::where('product_id', $request->post('id'))->where('colors_id', $colorId)->value('id');

            $photoName = 'photo_name' . $i;

            if ($request->hasFile($photoName)) {
                foreach ($request->file($photoName) as $file) {
                    $fileName = generateFileName($file->getClientOriginalName());
                    $file->move(public_path('user/nike-img'), $fileName);

                    Photo::create([
                        'name' => $fileName,
                        'product_variant_id' => $productVariantId
                    ]);
                }
            }
        }

        return redirect('admin/allProducts');
    }


    //Them variant sản phẩm
    //     public function upDateProducts(Request $request){
    //         $product = [
    //             'name' => $request->post('name'),
    //             'price' => $request->post('price'),
    //             'description' => $request->post('description'),
    //             'cate_id' => $request->post('cate_id')
    //         ];
    //         product::where('id', $request->post('id'))->update($product);

    //         $variant = [
    //             'stock' => $request=>post('stock')
    //         ];
    //         $productId = $request->post('id');
    //         for ($i = 0; $i < count($request->color_id); $i++) {
    //     $colorId = $request->color_id[$i];
    //     $stockKey = 'stock' . $i;

    //     $productVariant = Product_variant::updateOrCreate(
    //         [
    //             'product_id' => $productId,
    //             'colors_id' => $colorId
    //         ],
    //         [
    //             'stock' => $request->$stockKey
    //         ]
    //     );

    //     $photoName = 'photo_name' . $i;

    //     if ($request->hasFile($photoName)) {
    //         foreach ($request->file($photoName) as $file) {
    //             $fileName = generateFileName($file->getClientOriginalName());
    //             $file->move(public_path('user/nike-img'), $fileName);

    //             Photo::create([
    //                 'name' => $fileName,
    //                 'product_variant_id' => $productVariant->id
    //             ]);
    //         }
    //     }
    // }

    //         return redirect('admin/allProducts');
    //     }


    public function allProducts()
    {
        $data =
            [
                'products' => Product::orderBy('id', 'desc')->get(),
            ];
        return view('admin/product/allProducts')->with($data);
    }

    //---------------------------Categories---------------------------
    public function addCategories()
    {
        return view('admin/category/addCategories');
    }

    public function saveCategories(Request $request)
    {
        $category = $request->post();
        cate::create($category);
        return redirect('admin/allCategories');
    }

    public function deleteCategory($id)
    {
        cate::where('id', $id)->delete();
        return redirect('admin/allCategories');
    }

    public function editCategory($i)
    {
        $data = [
            'cate' => cate::find($i)
        ];
        return view('admin/category/editCategories')->with($data);
    }

    public function updateCategory(Request $request)
    {
        $category = [
            'name' => $request->post('name')
        ];
        cate::where('id', $request->post('id'))->update($category);
        return redirect('admin/allCategories');
    }

    public function allCategories()
    {
        $data = [
            'cates' => cate::orderBy('id', 'desc')->get()
        ];
        return view('admin/category/allCategories')->with($data);
    }

    //---------------------------Orders---------------------------
    public function order()
    {
        $data = [
            'orders' => Order::get()
        ];

        return view('admin/order/order')->with($data);
    }

    public function bill($id)
    {
        $data = [
            'bills' => Order::find($id)
        ];
        return view('admin/order/bill')->with($data);
    }

    public function orderDetails($id){
        $data = [
          'orderDetails' => Order::find($id)
        ];
       return view('admin/order/orderDetails')->with($data);
    }

    public function editOrderDetails(Request $request){
    // Bước 1: Kiểm tra xem form có gửi lên mảng dữ liệu 'id' hay không.
    // Đây là bước quan trọng để đảm bảo code không bị lỗi khi request trống.
    try{
        if ($request->has('id') && is_array($request->id)) {

            // Bước 2: Lặp qua từng ID trong mảng 'id' mà view gửi lên.
            // $key sẽ là chỉ số của dòng (0, 1, 2, ...).
            // $orderDetailId sẽ là giá trị ID của chi tiết đơn hàng ở dòng đó.
            foreach ($request->id as $key => $orderDetailId) {

                // Bước 3: Lấy tất cả dữ liệu tương ứng của cùng một dòng bằng chỉ số $key.
                $quantity = $request->quantity[$key];
                $size = $request->size[$key];
                $color_id = $request->color_id[$key];
                $totalPriceFromView = $request->total_price[$key];

                // Bước 4: Làm sạch dữ liệu total_price.
                // Rất quan trọng: Loại bỏ các ký tự định dạng (như dấu '.') để lưu vào DB.
                // Ví dụ: '7.773.597' -> '7773597'
                $cleanedTotalPrice = str_replace('.', '', $totalPriceFromView);

                // Bước 5: Tìm và cập nhật bản ghi trong cơ sở dữ liệu.
                OrderDetail::where('id', $orderDetailId)->update([
                    'quantity'      => $quantity,
                    'size'          => $size,
                    'color_id'      => $color_id,
                    'total_price'   => $cleanedTotalPrice, // Sử dụng giá đã làm sạch
                ]);
            }
        }

        // Bước 6: Sau khi vòng lặp kết thúc, chuyển hướng người dùng trở lại.
            session()->flash('success', 'Edit Success');
            return redirect('admin/order');
        } catch (Exception $e) {
            session()->flash('error', 'Edit Fails');
            return redirect('admin/addBlog');
        }
    }

    //---------------------------Accounts---------------------------
    public function accounts()
    {
        $data = [
            'accounts' => account::orderBy('id', 'desc')->get()
        ];
        return view('admin/managementAll/accounts')->with($data);
    }
    public function deleteAccounts($id)
    {
        account::where('id', $id)->delete();
        return redirect('admin/accounts');
    }
      public function reset($id)
    {
        $password ='$2y$10$lePB5.14ydy2Vhf9LcQFiORchbwU6Ka/tMtqzkywFMe6nrnb24WJe';

        account::where('id', $id)->update(['password' => $password]);
       
        return redirect('admin/accounts');
    }

    //---------------------------Blog---------------------------
    public function blog()
    {
        $data = [
            'blogs' => Blog::orderBy('id', 'desc')->get()
        ];
        return view('admin/blog/blog')->with($data);
    }

    public function addBlog()
    {
        $data = [
            'accounts' => account::get()
        ];
        return view('admin/blog/addBlog')->with($data);
    }

    public function saveBlog(Request $request)
    {
        try {
            $blog = [
                'title' =>  $request->title,
                'photo' =>  $request->photo,
                'description' =>  $request->description,
                'content' =>  $request->content,
                'created_at' => Carbon::now()->format('Y-m-d'),
                'account_id' =>  $request->account_id

            ];
            Blog::create($blog);
            session()->flash('success', 'Add Blog Success');
            return redirect('admin/blog');
        } catch (Exception $e) {
            session()->flash('error', 'Add Blog Fails');
            return redirect('admin/addBlog');
        }
    }

    public function deleteBlog($id)
    {
        try {
            Blog::where('id', $id)->delete();
            session()->flash('success', 'Delete Blog Success');
        } catch (Exception $e) {
            session()->flash('error', 'Delete Blog Fails');
        }

        return redirect('admin/blog');
    }

    public function editBlog($id)
    {
        $data = [
            'blogs' => Blog::find($id)
        ];
        return view('admin/blog/editBlog')->With($data);
    }

    public function updateBlog(Request $request)
    {
        try {
            $data = [
                'title' =>  $request->title,
                'photo' =>  $request->photo,
                'description' =>  $request->description,
                'content' =>  $request->content,
                'updated_at' => Carbon::now()->format('Y-m-d'),
            ];
            Blog::where('id', $request->id)->update($data);
            session()->flash('success', 'Update Blog Success');
            return redirect('admin/blog');
        } catch (Exception $e) {
            session()->flash('error', 'Update Blog Fails');
            return redirect('admin/editBlog/' . $request->id);
        }
    }



    //---------------------------About-us---------------------------
    public function aboutUs()
    {
        $data = [
            'aboutus' => AboutUs::orderBy('id', 'desc')->get()
        ];
        return view('admin/aboutUs/aboutUs')->with($data);
    }

    public function addAboutUs()
    {
        $data = [
            'accounts' => account::get()
        ];
        return view('admin/aboutUs/addAboutUs')->with($data);
    }

    public function saveAboutUs(Request $request)
    {
        try {
            $data = [
                'title' =>  $request->title,
                'photo' =>  $request->photo,
                'description' =>  $request->description,
                'content' =>  $request->content,
                'created_at' => Carbon::now()->format('Y-m-d'),
                'account_id' =>  $request->account_id

            ];
            AboutUs::create($data);
            session()->flash('success', 'Add About Us Success');
            return redirect('admin/aboutUs');
        } catch (Exception $e) {
            session()->flash('error', 'Add About Us Fails');
            return redirect('admin/addAboutUs');
        }
    }

    public function deleteAboutUs($id)
    {
        try {
            AboutUs::where('id', $id)->delete();
            session()->flash('success', 'delete AboutUs Success');
        } catch (Exception $e) {
            session()->flash('error', 'delete AboutUs Fails');
        }

        return redirect('admin/aboutUs');
    }

    public function editAboutUs($id)
    {
        $data = [
            'aboutus' => AboutUs::find($id)
        ];
        return view('admin/aboutUs/editAboutUs')->with($data);
    }

    public function updateAboutUs(Request $request)
    {
        try {
            $data = [
                'title' =>  $request->title,
                'photo' =>  $request->photo,
                'description' =>  $request->description,
                'content' =>  $request->content,
                'updated_at' => Carbon::now()->format('Y-m-d'),
            ];
            AboutUs::where('id', $request->id)->update($data);
            session()->flash('success', 'Update About Us Success');
            return redirect('admin/aboutUs');
        } catch (Exception $e) {
            session()->flash('error', 'Update About Us Fails');
            return redirect('admin/editAboutUs/' . $request->id);
        }
    }
}
