<?php

namespace App\Http\Controllers;

use Exception;
use App\Core\Invoice;
use App\Models\Product;
use App\Models\Category;
use App\Core\OrderManager;
use App\Models\Order;
use App\Models\OrderItem;

class Home
{
    public function index($category = null)
    {
        $products   = Product::select('id, title, image, price, quantity')->order('id DESC');
        $categories = Category::order('id DESC')->get();

        if ($category !== null) {
            $category = substr($category, strrpos($category, '-') + 1);
            $products->where(['category' => $category]);
        }

        return view('store', [
            'categories'    => $categories->all(),
            'products'      => $products->paginate(16),
            'category'      => $category
        ]);
    }

    public function product($id)
    {
        $product = Product::select('p.*, t1.title as categoryTitle, t1.image as categoryImage')
            ->leftJoin(Category::class, 't1.id = p.category')
            ->where(['p.id' => substr($id, strrpos($id, '-') + 1)])
            ->first();

        if (!$product) {
            abort(404);
        }

        $product->category = (new Category)->load([
            'id' => $product->category,
            'title' => $product->categoryTitle,
            'image' => $product->categoryImage,
        ]);

        unset($product->categoryTitle, $product->categoryImage);

        $related = Product::where(['category' => $product->category->id])
            ->andWhere("id != {$product->id}")
            ->order('id DESC')
            ->limit(12)
            ->get()
            ->all();

        return view('product', ['product' => $product, 'related' => $related]);
    }

    public function search()
    {
        $keyword = trim(input('keyword', ''));

        if (strlen($keyword) <= 2) {
            return '';
        }

        $products = Product::select('id, title, image, price')
            ->where("title LIKE '%{$keyword}%'")
            ->order('id DESC')
            ->limit(10)
            ->get();

        return view('ajax.search', ['products' => $products, 'keyword' => $keyword]);
    }

    public function order()
    {
        try {
            OrderManager::create(input('products'))->place();
        } catch (Exception $e) {
            redirect(
                url('error') . '?info=' . base64_encode(
                    encode_string(
                        ['message' => $e->getMessage(), 'code' => $e->getCode()]
                    )
                )
            );
        }
    }

    public function invoice($id)
    {
        return Invoice::webHtml(base64_decode($id));
    }

    public function myOrders()
    {
        $keyword = trim(input('keyword', ''));

        if (strlen($keyword) == 0) {
            return '';
        }

        $orders = Product::select(
            'p.id, p.title, p.price, p.image, t1.id as order_id, t1.status, t1.ordered_at, t2.quantity'
        )
            ->join(Order::class, "t1.email = '{$keyword}' OR t1.phone = '$keyword'")
            ->join(
                OrderItem::class,
                't2.product_id = p.id AND t2.order_id = t1.id'
            )
            ->order('t1.id DESC')
            ->limit(20)
            ->get();

        return view('ajax.delivery', ['orders' => $orders]);
    }
}
