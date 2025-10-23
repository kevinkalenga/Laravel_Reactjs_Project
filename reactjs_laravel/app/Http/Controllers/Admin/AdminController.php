<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;

class AdminController extends Controller
{
    // Fetch and display today, yesterday this month and this year Orders

    public function index()
    {
        // get today's orders 
        $todayOrders = Order::whereDay('created_at', Carbon::today())->get();
        $yesterdayOrders = Order::whereDay('created_at', Carbon::yesterday())->get();
        $monthOrders = Order::whereMonth('created_at', Carbon::now()->month)->get();
        $yearOrders = Order::whereYear('created_at', Carbon::now()->year)->get();

        return view('admin.index')->with([
            'todayOrders' => $todayOrders,
            'yesterdayOrders' => $yesterdayOrders,
            'monthOrders' => $monthOrders,
            'yearOrders' => $yearOrders
        ]);
    }

    // display the login form 
    public function login()
    {
        if(!auth()-> guard('admin')->check())
        {
            return view('admin.login');
        }
        return redirect()->route('admin.index');
    }
    // auth the admin
    public function auth(AuthAdminRequest $request)
    {
        if($request->validate())
        {
            if(auth()->guard('admin')->attemp([
                'email' => $request->email,
                'password' => $request->password
            ])){
                $request->session()->regenerate();
                return redirect()->route('admin.index');
            } else {
                return redirect()->route('admin.login')->with([
                    'error' => 'These credentials do not match our records'
                ]);
            }
        }
      
    }
    // logout the admin
    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.index');
      
    }
}
