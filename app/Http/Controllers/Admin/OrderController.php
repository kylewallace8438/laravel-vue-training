<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show(User $user)
    {
        $this->authorize('view',Order::class);
        return redirect()->back();
    }

    public function delete(User $user)
    {
        $this->authorize('delete',Order::class);
        return redirect()->back();
    }
}
