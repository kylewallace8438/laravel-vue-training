<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Models\Coupon;
use App\Models\Rank;
use Illuminate\Console\View\Components\Alert;

class EventController extends Controller
{
    //
    public function show()
    {
        return view('admin.add_event');
    }
    public function add_event(Request $request)
    {
        // dd($request->get('type'));
        $name = $request->get('name');
        // dd($name);
        $price = $request->get('price');
        // dd($price);
        Event::create([
            'type' => $request->get('type'),
            'name' => $request->get('name'),
            'des'  => $request->get('des'),
            'unit' => $request->get('unit'),
            'status' => 0,

        ]);

        //  return redirect('formLogin');
        return view('admin.add_event');
    }

    public function event()
    {
        $events = Event::all();
        // dd($products);
        return view('admin.event', compact('events'));
    }

    public function edit($id)
    {
        $status = Event::find($id)->status;
        // dd($status);
        if ($status == 1) {
            Event::where('id', $id)->update(['status' => 0]);
            User::where('id', '>', 0)->update(['current_point' => 0, 'rank_point' => 0]);
        } else {
            $event = Event::where('status', 1)->first();
            if ($event == NULL)
                Event::where('id', $id)->update(['status' => 1]);
        }
        return redirect('admin/events');
    }

    public function delete($id)
    {
        Event::where('id', $id)->delete();
        return redirect('admin/events');
    }

    public function add_exchange_show()
    {
        $coupons = Coupon::where('point', 0)->get();
        // dd($coupons->code);

        $ranks = Rank::all();
        return view('admin.add_exchange', compact('coupons', 'ranks'));
    }
    public function exchange()
    {
        $coupons = Coupon::where('point', '!=', 0)->get();
        return view('admin.exchange', compact('coupons'));
    }

    public function add_exchange(Request $request)
    {
        // dd($request->get('coupon'));
        Coupon::where('code', $request->get('coupon'))->update(['rank' => $request->get('rank'), 'point' => $request->get('point')]);
        return redirect('admin/exchange/add');
    }
}
