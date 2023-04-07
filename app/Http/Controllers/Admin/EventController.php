<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Event;
use App\Models\Rank;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\EventRepository;

class EventController extends Controller
{
    //

    protected $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function show()
    {
        return view('admin.add_event');
    }
    public function addEvent(Request $request)
    {
        // dd($request->get('type'));
        $name = $request->get('name');
        // dd($name);
        $price = $request->get('price');
        // dd($price);
        Event::create([
            'type' => $request->get('type'),
            'name' => $request->get('name'),
            'des' => $request->get('des'),
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
            if ($event == null) {
                Event::where('id', $id)->update(['status' => 1]);
            }
        }
        return redirect('admin/events');
    }

    public function delete($id)
    {
        Event::where('id', $id)->delete();
        return redirect('admin/events');
    }

    public function addExchangeShow()
    {
        // $coupons = Coupon::where('point', 0)->get();
        $coupons = $this->eventRepository->getCoupon();
        // dd($coupons->code);

        // $ranks = Rank::all();
        $ranks = $this->eventRepository->getRank();
        return view('admin.add_exchange', compact('coupons', 'ranks'));
    }
    public function exchange()
    {
        // $coupons = Coupon::where('point', '!=', 0)->get();
        $coupons = $this->eventRepository->getExchange();
        return view('admin.exchange', compact('coupons'));
    }

    public function addExchange(Request $request)
    {
        $this->eventRepository->updatebyCoupon($request->get('coupon'), $request->get('rank'),  $request->get('point'));
        return redirect('admin/exchange/add');
    }
}
