<?php

namespace App\Http\Controllers;

use App\Mail\Exchange;
use App\Mail\SendMail;
use App\Models\Coupon;
use App\Models\CouponUser;
use App\Models\Rank;
use App\Models\User;
use App\Repositories\CouponRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Repositories\EventRepository;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    protected $eventRepository;
    protected $couponRepository;

    public function __construct(EventRepository $eventRepository, CouponRepository $couponRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->couponRepository = $couponRepository;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
  

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
            $ranks = $this->eventRepository->getRank();
            return view('demo.customer', compact('rank_point', 'rest_point', 'rank_name', 'ranks'));
        }

        $ranks = $this->eventRepository->getRank();
        $rank_name = "";
        foreach ($ranks as $rank) {
            if ($rank_point > $rank->point) {
                $rank_name = $rank->rank;

            }
        }
        foreach ($ranks as $rank) {
            $max_id = $rank->id;
        }

        // $rank = Rank::where('rank', $rank_name)->first();
        $id = $this->eventRepository->getIdbyRank($rank_name);

        if ($id < $max_id) {
            $id = $id + 1;

            // $rest_point = Rank::where('id', $id)->first()->point - $rank_point;
            $rest_point = $this->eventRepository->getRankPoint($id) - $rank_point;
        } else {
            $rest_point = 0;
        }


        return view('demo.customer', compact('rank_point', 'rest_point', 'rank_name', 'ranks'));
    }

    public function cart()
    {
        return view('demo.cart');
    }
    public function gift()
    {
        // $rank_point = Auth::user()->rank_point;
        // $ranks = Rank::where('point', '<=', $rank_point)->pluck('id')->toArray();
        // $coupons = Coupon::whereIN('rank', $ranks)->get();
        $coupons = $this->eventRepository->getCouponofUser();

        $point = Auth::user()->current_point;

        return view('demo.gift', compact('coupons', 'point'));
    }

    public function editPoint($id)
    {
        // dd($id);
        // $x = Coupon::where('id', $id)->first();
        $coupon = $this->couponRepository->getById($id);
        $code = $coupon->code;
        $point = $coupon->point;
        $user = Auth::user();
        // $coupon_id = CouponUser::where('user_id', $user->id)->where('coupon_id', $id)->first();
        $coupon_id = $this->couponRepository->getCouponbyUserCoupon($user,$id);
        
        // dd($user->id);
        // dd($coupon_id);

        if ($coupon_id == null) {
            $coupon_user = ['user_id' => $user->id, 'coupon_id' => $id];
            $this->couponRepository->create($coupon_user);
            // CouponUser::create(['user_id' => $user->id, 'coupon_id' => $id]);
        }
        $current_point = $user->current_point;
        $current_point = $current_point - $point;
        // User::where('id', $user->id)->update(['current_point' => $current_point]);
        $this->eventRepository->updatePoint($user, $current_point);
        // Mail::send('mail.test_mail', ['name' => 'test name'], function($email){
        //     $email->to('nguyentiendat080201@gmail.com','subject');
        // });
        Mail::to('nguyentiendat080201@gmail.com')->send(new Exchange($code));
        return redirect('gift');
    }
}
