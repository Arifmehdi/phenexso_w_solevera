<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\BisesoggoCategory;
use App\Models\BlogPost;
use App\Models\BookAppointment;
use App\Models\ContactUs;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Member;
use App\Models\Order;
use App\Models\Page;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        menuSubmenu('dashboardM','dashboardSM');
        
        $users = User::count();
        $cat = ProductCategory::where('parent_id', null)->count();
        $productcount = Product::count();
        $orders = Order::count();
        
        // Revenue Statistics (Delivered Orders)
        $total_revenue = Order::where('order_status', 'delivered')->sum('grand_total');
        $today_revenue = Order::where('order_status', 'delivered')
            ->whereDate('delivered_at', now()->today())
            ->sum('grand_total');
        $this_month_revenue = Order::where('order_status', 'delivered')
            ->whereMonth('delivered_at', now()->month)
            ->whereYear('delivered_at', now()->year)
            ->sum('grand_total');
            
        // Order Status Statistics
        $pending_orders_count = Order::where('order_status', 'pending')->count();
        $confirmed_orders_count = Order::where('order_status', 'confirmed')->count();
        $delivered_orders_count = Order::where('order_status', 'delivered')->count();
        $cancelled_orders_count = Order::where('order_status', 'cancelled')->count();

        $products = Product::latest()->take(10)->get();
        $recent_orders = Order::with('user')->latest()->take(10)->get();

        // Sales data for the last 7 days
        $sales_last_7_days = [];
        $labels_last_7_days = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $labels_last_7_days[] = $date->format('M d');
            $sales_last_7_days[] = Order::where('order_status', 'delivered')
                ->whereDate('delivered_at', $date)
                ->sum('grand_total');
        }

        return view('admin.index', compact(
            'users', 'cat', 'products', 'orders', 'productcount',
            'total_revenue', 'today_revenue', 'this_month_revenue',
            'pending_orders_count', 'confirmed_orders_count', 'delivered_orders_count', 'cancelled_orders_count',
            'recent_orders', 'sales_last_7_days', 'labels_last_7_days'
        ));
    }



    public function selectTagsOrAddNew(Request $request)
    {

        $tags = Tag::where('name', 'like', '%'.$request->q.'%')
        ->select(['name'])->take(30)->get();

        if($tags->count())
        {
            if ($request->ajax())
            {
                return $tags;
            }
        }
        else
        {
            if ($request->ajax())
            {
                return $tags;
            }
        }
    }


    public function selectAuthorsOrAddNew(Request $request)
    {

        $tags =Author::where('name', 'like', '%'.$request->q.'%')
        ->select(['name'])->take(30)->get();
        if($tags->count())
        {
            if ($request->ajax())
            {
                return $tags;
            }
        }
        else
        {
            if ($request->ajax())
            {
                return $tags;
            }
        }
    }


    public function allAppointments(){
        menuSubmenu('appointments','allAppointments');
        $data['appointments'] = BookAppointment::paginate(50);
        return view('admin.appointments.index',$data);
    }


    public function deleteAppointment($id){
        $appointment = BookAppointment::find($id);
        $appointment->delete();
        return back()->with("success","Appointment Delated Successfuly");
    }


}
