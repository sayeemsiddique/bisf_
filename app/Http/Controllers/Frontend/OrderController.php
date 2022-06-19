<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Order;
use App\Models\Setting;
use App\Models\Payment;
use App\Models\OrderDetail;
use App\Models\Stock;
use App\Models\Inventory;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if(Gate::allows('order_list', $user))
        {            
            menuSubmenu('manage_order', 'order_list');

            $orders = Order::where('type',2)->latest()->paginate(20);

            return view('backend.admin.order.index', compact('orders'));
            
        }
        else
        {
            abort(403);
        }
        
    }
    
    public function show($id)
    {
        $user = Auth::user();

        if(Gate::allows('view_order', $user))
        {            
            menuSubmenu('manage_order', 'order_list');

            $order = Order::where('id',$id)->latest()->first();
            $setting = Setting::oldest()->first();
            $payment = Payment::where('order_id', $id)->first();

            return view('backend.admin.order.show', compact('order', 'setting', 'payment'));
            
        }
        else
        {
            abort(403);
        }
        
    }

    // Order Payment status update
    public function paymentUpdate(Request $request)
    {
        $order = Order::where('id', $request->orderId)->first();
        $order->payment_status = $request->paymentStatus;
        $order->save();

        $payment = Payment::where('order_id', $request->orderId)->first();
        $payment->status = $request->paymentStatus;
        $payment->save();

        return redirect()->back()->with('success', 'Payment Status Updated Successfully...!!!');
    }

    // Order status update
    public function orderUpdate(Request $request)
    {
        $order = Order::where('id', $request->orderId)->first();
        $order->status = $request->orderStatus;
        $order->save();

        return redirect()->back()->with('success', 'Order Status Updated Successfully...!!!');
    }

    // Order delivery update
    public function deliveryUpdate(Request $request)
    {
        $order = Order::where('id', $request->orderId)->first();
        $order->delivery_status = $request->deliveryStatus;
        $order->save();

        // Get Order products & manage stock
        if($request->deliveryStatus == 2)
        {
            $products = OrderDetail::where('order_id', $request->orderId)->groupBy('product_id')->get();
            foreach($products as $product){
                // Manage stock
                $stock = Stock::where('product_id', $product->product_id)->where('varient_id', $product->varient_id)->first();
                $stock->quantity -= $product->quantity;
                $stock->save();

                // insert history into inventory table
                $inventory = new Inventory;
                $inventory->order_id = $request->orderId;
                $inventory->type = 2;
                $inventory->product_id = $product->product_id;
                $inventory->varient_id = $product->varient_id;
                $inventory->quantity = $product->quantity;
                $inventory->created_by = Auth::user()->id;
                $inventory->save();

            }
        }
        

        return redirect()->back()->with('success', 'Delivery Status Updated Successfully...!!!');
    }
}
