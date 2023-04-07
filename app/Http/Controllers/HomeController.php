<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rank;
use App\Models\Coupon;
use App\Models\CouponUser;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('demo.index');
    }

    public function shop()
    {
        return view('demo.shop');
    }

    public function about()
    {
        return view('demo.about');
    }
    public function service()
    {
        return view('demo.service');
    }
    public function blog()
    {
        return view('demo.blog');
    }
    public function contact()
    {
        return view('demo.contact');
    }

    public function customer()
    {
        $rank_point = Auth::user()->rank_point;
        if ($rank_point < 500) {
            $rank_name = "No rank";

            $rest_point = 500 - $rank_point;
            $ranks = Rank::all();
            return view('demo.customer', compact('rank_point', 'rest_point', 'rank_name', 'ranks'));
        }

        $ranks = Rank::all();
        $rank_name = "";
        foreach ($ranks as $rank) {
            if ($rank_point > $rank->point) {
                $rank_name = $rank->rank;
                // $rest_point = $rank->point - $rank_point;

            }
        }
        foreach ($ranks as $rank) {
            $max_id = $rank->id;
        }
        // dd($max_id);
        $rank = Rank::where('rank', $rank_name)->first();
        $id = $rank->id;
        // dd($id);
        if ($id < $max_id) {
            $id = $id + 1;
            // $point = Rank::where('id', $id)->first()->point;
            // dd($rank_point);
            $rest_point = Rank::where('id', $id)->first()->point - $rank_point;
        } else $rest_point = 0;
        return view('demo.customer', compact('rank_point', 'rest_point', 'rank_name', 'ranks'));
    }

    public function cart()
    {
        return view('demo.cart');
    }
    public function gift()
    {
        $rank_point = Auth::user()->rank_point;
        $ranks = Rank::where('point', '<=', $rank_point)->pluck('id')->toArray();
        $coupons = Coupon::whereIN('rank', $ranks)->get();
        // dd($coupons);
        // dd($ranks);
        // $coupons =[];
        // foreach($ranks as $rank){
        //     // dd($rank->rank);
        //     // $coupons = Coupon::where('rank', $rank)->get()->toArray();
        //     $coupon = $rank->rank_coupon()->get()->toArray();
        //     $coupons = array_merge($coupons, $coupon);


        // }
        // $x = json_encode($coupons);


        // dd($x);
        // $coupons = Coupon::where('rank', $rank_id)->get();
        $point = Auth::user()->current_point;
        return view('demo.gift', compact('coupons', 'point', 'ranks'));
    }

    public function edit_point($id)
    {
        // dd($id);
        $x = Coupon::where('id', $id)->first();

        $point = $x->point;
        $user = Auth::user();
        $coupon_id = CouponUser::where('user_id', $user->id)->where('coupon_id', $id)->first();
        // dd($user->id);
        // dd($coupon_id);
        if ($coupon_id == NULL) {
            CouponUser::create(['user_id' => $user->id, 'coupon_id' => $id]);
        }
        $current_point = $user->current_point;
        $current_point = $current_point - $point;
        User::where('id', $user->id)->update(['current_point' => $current_point]);
        return redirect('gift');
    }
}
