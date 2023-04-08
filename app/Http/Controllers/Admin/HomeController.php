<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Repositories\EventRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{

    protected $eventRepository;
    protected $orderRepository;
    protected $productRepository;
    protected $userRepository;

    public function __construct(OrderRepository $orderRepository, EventRepository $eventRepository, UserRepository $userRepository, ProductRepository $productRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->eventRepository = $eventRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
    }

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
            // Order::where('id', $id)->update(['status' => 1]);
            $this->orderRepository->update($id, ['status' => 1]);
            // $event = Event::where('status', 1)->first();
            $event = $this->eventRepository->checkEventActived();
            if ($event != NULL) {
                // $order = Order::where('id', $id)->first();
                $order = $this->orderRepository->getById($id);
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
                // dd($unit);
                $user = $this->userRepository->getById($user_id);
                $current_point = $unit + $user->current_point;
                // dd($current_point);
                $rank_point = $unit + $user->rank_point;
                // dd($rank_point);
                // User::where('id', $user_id)->update();
                // $this->userRepository->update($user_id, ['rank_point' => $rank_point]);
                $this->userRepository->update($user_id, ['current_point' => $current_point, 'rank_point' => $rank_point]);
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
            $product = $this->productRepository->show()->count();
            $user = $this->userRepository->getByRole(2)->count();
            $order1 = $this->orderRepository->getByStatus(1)->count();
            $order0 = $this->orderRepository->getByStatus(0)->count();
            return view('admin.dashboard', compact('product', 'user', 'order0', 'order1'));
        } else {
            return view('admin.login');
        }
    }
}