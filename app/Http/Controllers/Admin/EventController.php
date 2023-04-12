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
        $event = [
            'type' => $request->get('type'),
            'name' => $request->get('name'),
            'des' => $request->get('des'),
            'unit' => $request->get('unit'),
            'status' => 0,

        ];
        $this->eventRepository->create($event);

        //  return redirect('formLogin');
        return view('admin.add_event');
    }

    public function event()
    {
        $events = $this->eventRepository->show();
        // dd($products);
        return view('admin.event', compact('events'));
    }

    public function edit($id)
    {
        // $status = Event::find($id)->status;
        $status = $this->eventRepository->getStatus($id);
        // dd($status);
        if ($status == 1) {
            // Event::where('id', $id)->update(['status' => 0]);
            $this->eventRepository->update($id, ['status' => 0]);
            $this->eventRepository->resetPoint();
        } else {
            $event = $this->eventRepository->checkEventActived();
            if ($event == null) {
                $this->eventRepository->update($id, ['status' => 1]);
            }
        }
        return redirect('admin/events');
    }

    public function delete($id)
    {
        $this->eventRepository->delete($id);
        return redirect('admin/events');
    }

    public function addExchangeShow()
    {
        $coupons = $this->eventRepository->getCoupon();
        $ranks = $this->eventRepository->getRank();
        return view('admin.add_exchange', compact('coupons', 'ranks'));
    }
    public function exchange()
    {
        $coupons = $this->eventRepository->getExchange();
        return view('admin.exchange', compact('coupons'));
    }

    public function addExchange(Request $request)
    {
        $this->eventRepository->updatebyCoupon($request->get('coupon'), $request->get('rank'),  $request->get('point'));
        return redirect('admin/exchange/add');
    }
}
