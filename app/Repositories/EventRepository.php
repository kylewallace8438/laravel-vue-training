<?php

namespace App\Repositories;

use App\Models\Event;
use App\Models\Coupon;
use App\Models\Rank;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EventRepository implements EventRepositoryInterface
{
    public function show()
    {
        return Event::all();
    }
    public function create(array $attributes)
    {
        return Event::create($attributes);
    }
    public function getById($id)
    {
        return Event::find($id);
    }
    public function update($id, array $attributes)
    {
        $event = Event::find($id);
        $event->update($attributes);
        return $event;
    }
    public function delete($id)
    {
        $event = Event::find($id);
        $event->delete();
    }

    public function getExchange()
    {
        return Coupon::where('point', '!=', 0)->get();
    }

    public function getCoupon()
    {
        return Coupon::where('point', 0)->get();
    }
    public function getRank()
    {
        return Rank::all();
    }
    public function getIdbyCoupon($coupon)
    {
        return Coupon::where('code', $coupon)->first()->id;
    }
    public function updatebyCoupon($coupon, $rank, $point)
    {
        Coupon::where('code', $coupon)->update(['rank' => $rank, 'point' => $point]);
    }
    public function getIdbyRank($rank)
    {
        $rank = Rank::where('rank', $rank)->first();
        return $rank->id;
    }

    public function getRankPoint($id)
    {
        return Rank::where('id', $id)->first()->point;
    }

    public function getCouponofUser()
    {
        $rank_point = Auth::user()->rank_point;
        $ranks = Rank::where('point', '<=', $rank_point)->pluck('id')->toArray();
        $coupons = Coupon::whereIN('rank', $ranks)->get();
        return $coupons;
    }

    public function updatePoint($user, $current_point)
    {
        User::where('id', $user->id)->update(['current_point' => $current_point]);
    }

    public function getStatus($id)
    {
        return Event::find($id)->status;
    }

    public function resetPoint()
    {
        User::where('id', '>', 0)->update(['current_point' => 0, 'rank_point' => 0]);
    }
    public function checkEventActived()
    {
        return Event::where('status', 1)->first();
    }
}
