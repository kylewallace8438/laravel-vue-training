<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

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
        Event::where('id', $id)->update(['status' => 0]);
        $events = Event::all();
        return redirect('admin/events');
    }
}
