<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CouponRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    protected $productRepository;
    protected $couponRepository;
    protected $userRepository;

    public function __construct(ProductRepository $productRepository, CouponRepository $couponRepository, UserRepository $userRepository)
    {
        $this->productRepository = $productRepository;
        $this->couponRepository = $couponRepository;
        $this->userRepository = $userRepository;
    }

    public function showCreateCoupon()
    {
        $products = $this->productRepository->show();
        $users = $this->userRepository->getByRole(2);
        return view('admin.createCoupon', compact('products', 'users'));
    }

    public function createCoupon(Request $request)
    {
        $users_coupon = $request->get('user');
        $products_coupon = $request->get('product');

        $Coupon = $this->couponRepository->create([
            'code' => $request->get('code'),
            'des' => $request->get('des'),
            'price_type' => $request->get('price_type'),
            'price' => $request->get('price'),
            'condition' => $request->get('condition'),
            'start' => $request->get('date_start'),
            'end' => $request->get('date_end'),
            'point' => 0,
        ]);

        //store user_coupon
        $Coupon_id = $Coupon->id;
        if (strcmp($users_coupon[0], 'All') == 0) {
            $users = $this->userRepository->show();
            foreach ($users as $user) {
                $this->couponRepository->createCouponUser([
                    'user_id' => $user->id,
                    'coupon_id' => $Coupon_id,
                ]);
            }
        } else {
            foreach ($users_coupon as $user) {
                $user_id = $this->userRepository->getByName($user);
                $this->couponRepository->createCouponUser([
                    'user_id' => $user_id->id,
                    'coupon_id' => $Coupon_id,
                ]);
            }
        }

        //store product_coupon
        if (strcmp($products_coupon[0], 'All') == 0) {
            $products = $this->productRepository->show();
            foreach ($products as $product) {
                $this->couponRepository->createCouponProduct([
                    'product_id' => $product->id,
                    'coupon_id' => $Coupon_id,
                ]);
            }
        } else {
            foreach ($products_coupon as $product) {
                $product_id = $this->productRepository->getByName($product);
                $this->couponRepository->createCouponProduct([
                    'product_id' => $product_id->id,
                    'coupon_id' => $Coupon_id,
                ]);
            }
        }
        $products = $this->productRepository->show();
        $users = $this->userRepository->getByRole(2);
        return view('admin.createCoupon', compact('products', 'users'));
    }

    public function showListCoupon()
    {
        $coupons = $this->couponRepository->show();

        return view('admin.listCoupon', compact('coupons'));
    }

    public function deleteCoupon($id)
    {

        $this->couponRepository->delete($id);
        $coupons = $this->couponRepository->show();
        return view('admin.listCoupon', compact('coupons'));
    }
}
