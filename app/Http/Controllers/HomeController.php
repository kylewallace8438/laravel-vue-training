<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        return view('demo.index');
    }
    public function shop()
    {
        $products = Product::all();
    
    return view('demo.shop', ['products' => $products]);
    }
    public function about()
    {
        return view('demo.about');
    }
    public function services()
    {
        return view('demo.services');
    }
    public function blog()
    {
        return view('demo.blog');
    }
    public function contact()
    {
        return view('demo.contact');
    }
    public function cart()
    {
        $order_id = Order::where('user_id', 1)->where('status', 0)->first();
        if($order_id == null){
            $order_details = OrderDetail::where('order_id', 0)->get();
        }else{
            $order_details = OrderDetail::where('order_id', $order_id->id)->get();
        }
       
        return view('demo.cart', ['order_details' => $order_details]);
    }
    public function checkout()
    {
        $order_id = Order::where('user_id', 1)->where('status', 0)->first();
        $order_details = OrderDetail::where('order_id', $order_id->id)->get();
        return view('demo.checkout', ['order_details' => $order_details]);
    }
    public function thankyou()
    {
        $order_id = Order::where('user_id', 1)->where('status', 0)->first();
        
        Order::where('id',$order_id->id)->update(['status' => 1]);
        return view('demo.thankyou');
    }

//////
    public function forget_session()
    {
        session()->forget('carts');
        session()->forget('total');
        return view('demo.thankyou');
    }

    public function add_product(Request $request)
    {
        $id = $request->get('id');
        $add = $request->get('add');

        $orders = Order::where('user_id', 1)->where('status', 0)->first();
        if ($orders == null) {
            $order = ['user_id' => 1];
            Order::create($order);
        }

        $order_id = Order::where('user_id', 1)->where('status', 0)->first();
        $check_order_detail = OrderDetail::where('order_id', $order_id -> id)->where('product_id', $id)->first();
        
        if ($check_order_detail == null) {
            $product = Product::find($id);
            $order_detail = ['order_id' => $order_id -> id, 'product_id' => $id, 'price' => $product->price,'discount_price'=> $product->price, 'count' => 1];
            OrderDetail::create($order_detail);
        }else{
            if ($add != -2 && $add != -1) {
                if($add < 0){
                    $amout = 0;
                }else{
                    $amout = $add;
                }
            }else if($add == -2){
                $amout = $check_order_detail->count +1;
            }else{
                $amout = $check_order_detail->count -1;
            }
            OrderDetail::where('id', $check_order_detail->id)->update(['count'=> $amout]);
        }
        $show = ' them thanh cong';
        $order_details = OrderDetail::where('order_id',$order_id->id)->get();
        return response()->json($order_details);

    }
}
