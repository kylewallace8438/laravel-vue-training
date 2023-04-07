<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('admin.dashboard');
        } else {
            return view('admin.login');
        }
    }

    public function product()
    {
        return view('admin.product');
    }

    public function customer()
    {
        $customers = User::where('role_user', 2)->get();
        // dd($customer);
        return view('admin.customer', compact('customers'));
    }

    public function adminList()
    {
        $admins = User::where('role_user', 1)->get();
        if (Auth::user()->role_user == 0) {
            return view('admin.admin', compact('admins'));
        } else {
            return redirect()->back();
        }
    }

    public function order()
    {
        $orders = Order::all();
        return view('admin.order', compact('orders'));
    }
    public function confirmOrder(Request $request, $id)
    {
        if ($request->user()->can('confirm', Order::class)) {
            Order::where('id', $id)->update(['status' => 1]);
            $event = Event::where('status', 1)->first();
            if ($event != NULL) {
                $order = Order::where('id', $id)->first();
                $user_id = $order->user_id;
                if ($event->type == 1) {
                    $unit = 10 / ($event->unit);
                } else {
                    $products = $order->order_detail;
                    $total = 0.00;
                    foreach ($products as $product) {
                        $total = $total + $product->discount_price * $product->amount;
                    }
                    $unit = 10 * ceil($total / $event->unit);
                }
                $x = User::where('id', $user_id)->first();
                $current_point = $unit + $x->current_point;
                $rank_point = $unit + $x->current_point;
                User::where('id', $user_id)->update(['rank_point' => $rank_point, 'current_point' => $current_point]);
            }
            return redirect('admin/orders');
        } else {
            return redirect()->back()->with('error', 'Access is not allowed');
        }
    }

    public function add_product()
    {
        dd(1);
        return view('admin.add_product');
    }

    public function edit_product()
    {
        return view('admin.edit_product');
    }

    public function edit_product_show()
    {
        return view('admin.edit_product');
    }

    public function dashboard()
    {
        if (Auth::check()) {
            $product = Product::all()->count();
            $user = User::where('role_user', 2)->get()->count();
            $order1 = Order::where('status', 1)->get()->count();
            $order0 = Order::where('status', 0)->get()->count();
            return view('admin.dashboard', compact('product', 'user', 'order0', 'order1'));
        } else {
            return view('admin.login');
        }
    }
}