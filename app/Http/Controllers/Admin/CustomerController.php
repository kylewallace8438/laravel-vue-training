<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index()
    {
        $customers = $this->userRepository->getByRole(2);
        return view('admin.customer', compact('customers'));
    }

    public function show(Request $request)
    {
        if ($request->user()->can('view', User::class)) {
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Access is not allowed');
        }
    }
}
