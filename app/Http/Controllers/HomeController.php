<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
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
        $products = DB::table('products')
        ->select('id', 'name', 'price')
        ->get();

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
        return view('demo.cart');
    }
    public function checkout()
    {
        return view('demo.checkout');
    }
    public function thankyou()
    {
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
        $name = $request->get('name');
        $price = $request->get('price');

        $orders = session()->get('carts');
        $cart = [];
        if (isset($orders) && !empty($orders)) {
            foreach ($orders as $product) {
                array_push($cart, $product);
            }
        }
        if ($add != -2 && $add != -1) {
            if (isset($orders) && !empty($orders)) {
                for ($i = 0; $i < count($cart); $i++) {
                    if ($cart[$i]['id'] == $id) {
                        if ($add >= 0) {
                            $cart[$i]['quantity'] = $add;
                        }
                        Session()->put('carts', $cart);
                        return response()->json($cart);
                    }
                }
            }
        }
        if ($add == -2) {
            $add = 1;
        }

        $check = 0;

        if (isset($orders) && !empty($orders)) {
            for ($i = 0; $i < count($cart); $i++) {
                if ($cart[$i]['id'] == $id) {
                    if (($cart[$i]['quantity'] += $add) < 0) {
                        $cart[$i]['quantity'] -= $add;
                    }
                    $check = 1;
                }
            }
        }
        if ($check == 0) {
            array_push($cart, [
                'id' => $id,
                'quantity' => $add,
                'name' => $name,
                'price' => $price,
            ]);
        }

        Session()->put('carts', $cart);
        $show = ' them thanh cong';
        return response()->json($cart);

    }
}
