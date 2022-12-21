<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Request;

class ProductController extends Controller
{
    public function getAll()
    {
        if (Request::get('sort') == 'newest') {
            $url = 'newest';
            $products = DB::table('sanpham')
                ->join('chitietsanpham', 'sanpham.SanPhamID', '=', 'chitietsanpham.SanPhamID')
                ->join('menus', 'menus.id', '=', 'chitietsanpham.PhanLoaiID')->orderBy('created_at', 'desc')->get();
        } elseif (Request::get('sort') == 'price_desc') {
            $url = 'price_desc';
            $products = DB::table('sanpham')
                ->join('chitietsanpham', 'sanpham.SanPhamID', '=', 'chitietsanpham.SanPhamID')
                ->join('menus', 'menus.id', '=', 'chitietsanpham.PhanLoaiID')->orderBy('Gia', 'desc')->get();
        } elseif (Request::get('sort') == 'price_asc') {
            $url = 'price_asc';
            $products = DB::table('sanpham')
                ->join('chitietsanpham', 'sanpham.SanPhamID', '=', 'chitietsanpham.SanPhamID')
                ->join('menus', 'menus.id', '=', 'chitietsanpham.PhanLoaiID')->orderBy('Gia', 'asc')->get();
        } else {
            $url = 'none';
            $products = DB::table('sanpham')
                ->join('chitietsanpham', 'sanpham.SanPhamID', '=', 'chitietsanpham.SanPhamID')
                ->join('menus', 'menus.id', '=', 'chitietsanpham.PhanLoaiID')->get();
        }
        $count = DB::table('sanpham')->count();
        $categories = DB::table('menus')->get();
        return view('client.shop.shop', ['products' => $products, 'categories' => $categories, 'count' => $count, 'url' => $url]);
    }

    public function getOne($id)
    {
        //Nếu id sản phẩm tồn tại

        if (DB::table('sanpham')->where('SanPhamID', '=', $id)->exists()) {
            $product = DB::table('sanpham')->where('SanPhamID', '=', $id)->first();
            $product_images = DB::table('productimage')->where('product_id', $product->SanPhamID)->get();
            $flag = 0;
            $products = DB::table('sanpham')->inRandomOrder()->limit(10)->get();
            return view('client.shop.shop-detail', ['product' => $product, 'tensanpham' => $product->SanPhamTen, 'products' => $products, 'product_images' => $product_images, 'flag' => $flag]);
        } else {
            redirect()->route('client.all-product');
        }
    }

    public function viewCategory($id)
    {
        if (DB::table('menus')->where('id', $id)->exists()) {
            $category = DB::table('menus')->where('id', $id)->first();
            $categories = DB::table('menus')->get();
            $products = array();
            if ($category->parent_id == 0) {
                foreach ($categories as $cat) {
                    if ($cat->parent_id == $category->id) {
                        $product = DB::table('sanpham')
                            ->join('chitietsanpham', 'sanpham.SanPhamID', '=', 'chitietsanpham.SanPhamID')
                            ->join('menus', 'menus.id', '=', 'chitietsanpham.PhanLoaiID')->get()->where('PhanLoaiID', $cat->id);
                        array_push($products, $product);
                    }
                }
            }
            $product_main = DB::table('sanpham')
                ->join('chitietsanpham', 'sanpham.SanPhamID', '=', 'chitietsanpham.SanPhamID')
                ->join('menus', 'menus.id', '=', 'chitietsanpham.PhanLoaiID')->get()->where('PhanLoaiID', $id);
            array_push($products, $product_main);
            // dd($category);
            return view('client.shop.category')->with('products', $products)->with('categories', $categories)->with('categorypage', $category);
        } else {
            redirect()->route('client.all-product')->with('error', 'id not found');
        }
    }
}
