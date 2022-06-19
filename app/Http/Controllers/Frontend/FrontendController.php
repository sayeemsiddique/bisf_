<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App;
use Session;
use DB;

/* included models */
use App\Models\Cart;
use App\Models\Citizen;
use App\Models\Stock;
use App\Models\Faq;
use App\Models\Division;
use App\Models\Content;
use App\Models\User;
use App\Models\Video;
use App\Models\ContentFile;
use App\Models\TemplateSetting;
use App\Models\Page;
use App\Models\Technology;
use App\Models\Varient;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Order;
use App\Models\Country;
use App\Models\Notify;
use App\Models\Bank;
use App\Models\OrderDetail;
use App\Models\Payment;

use Auth;

class FrontendController extends Controller
{
    public function index()
    {
        $main_categories = Category::withCount('SellProducts')->where([
            'parent_id' => 0,
            'status' => 1,
        ])->orderBy('sl', 'asc')->limit(4)->get();

        $featured_products = Product::where([
            'featured' => 1,
            'status' => 1,
            'type' => 1,
        ])->with('productVarient')->limit(10)->get()->split(3);
        
        
        return view('frontend.index', compact('main_categories','featured_products'));
    }

    // frontend about us page
    public function aboutus()
    {
        $page = Page::where('type', 1)->first();
        return view('frontend.aboutus', compact('page'));
    }
    // frontend contact us page
    public function contactus()
    {
        $page = Page::where('type', 2)->first();
        return view('frontend.contactus', compact('page'));
    }

    public function login()
    {
        return view('frontend.login');
    }

    public function registration(Request $request)
    {
        if ($request->type == 1) {

            $request->validate([
                'type'          => 'required',
                'first_name'    => 'required|max:255',
                'last_name'     => 'required|max:255',
                'mobile'        => 'required|min:11|unique:users',
                'email'         => 'unique:users',
                'password'      => 'required|confirmed|min:8',
            ]);

        } else {

            $request->validate([
                'type'              => 'required',
                'first_name'        => 'required|max:255',
                'last_name'         => 'required|max:255',
                'corporation_name'  => 'required|unique:users|max:255',
                'mobile'            => 'required|min:11|unique:users',
                'email'             => 'unique:users',
                'password'          => 'required|confirmed|min:8',
                'nid_no'            => 'required|unique:users',
                'bin_no'            => 'required|unique:users',
                'tin_no'            => 'required|unique:users',
                'image'             => 'required|mimes:jpeg,jpg,png',
                'nid'               => 'required|mimes:jpeg,jpg,png,pdf',
                'bin'               => 'required|mimes:jpeg,jpg,png,pdf',
                'tin'               => 'required|mimes:jpeg,jpg,png,pdf',
            ]);

        }

        $user = new User;

        $user->role_id              = 7;
        $user->type                 = $request->type;
        $user->first_name           = $request->first_name;
        $user->last_name            = $request->last_name;
        $user->corporation_name     = $request->corporation_name;
        $user->mobile               = $request->mobile;
        $user->email                = $request->email;
        $user->present_address      = $request->present_address;
        $user->password             = bcrypt($request->password);
        $user->nid_no               = $request->nid_no;
        $user->bin_no               = $request->bin_no;
        $user->tin_no               = $request->tin_no;
        if ($request->type == 1) {
            $user->status           = 1;
        } else {
            $user->status           = 3;
        }

        $user->save();

        $user->username             = Str::lower($request->first_name.$request->last_name.$user->id);
        $user->created_by           = $user->id;

        $user->save();

        // Send notification of new corporate consumer or dealer
        if ($request->type != 1) {
            $notification = new Notify;
            $notification->type = $request->type;
            if($request->type == 2){
                $notification->data = 'New Corporate Consumer account is pending';
            }else{
                $notification->data = 'New Dealer account is pending';
            }
            $notification->status = 1;
            $notification->save();
        }

        if($request->hasFile('image'))
        {
            $cp = $request->file('image');
            $extension = strtolower($cp->getClientOriginalExtension());
            $randomFileName = $user->id.'image'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            Storage::disk('public')->put('users/'.$randomFileName, File::get($cp));

            $user->image = $randomFileName;
            $user->save();
      	} 
        if($request->hasFile('nid'))
        {
            $cp = $request->file('nid');
            $extension = strtolower($cp->getClientOriginalExtension());
            $randomFileName = $user->id.'nid'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            Storage::disk('public')->put('nid/'.$randomFileName, File::get($cp));

            $user->nid = $randomFileName;
            $user->save();
      	} 
        if($request->hasFile('bin'))
        {
            $cp = $request->file('bin');
            $extension = strtolower($cp->getClientOriginalExtension());
            $randomFileName = $user->id.'bin'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            Storage::disk('public')->put('bin/'.$randomFileName, File::get($cp));

            $user->bin = $randomFileName;
            $user->save();
      	} 
        if($request->hasFile('tin'))
        {
            $cp = $request->file('tin');
            $extension = strtolower($cp->getClientOriginalExtension());
            $randomFileName = $user->id.'tin'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            Storage::disk('public')->put('tin/'.$randomFileName, File::get($cp));

            $user->tin = $randomFileName;
            $user->save();
      	}

        if ($request->type == 1) {
            return back()->with('success', 'Registration Successful! Login to your account.');
        } else {
            return back()->with('success', 'Registration Successful! Please wait for approval.');
        }
    }
    
    // Notification redirect
    public function notificationRedirect($id, $type)
    {
        $notification = Notify::where('id', $id)->first();
        $notification->status = 2;
        $notification->read_at = date('Y-m-d H:i:s');
        $notification->save();

        if($type == 2){
            return redirect()->route('admin.customer.pending_corporate');
        }elseif($type == 3){
            return redirect()->route('admin.customer.pending_dealer');
        }else{
            return back();
        }
    }

    public function store_grid(Request $request)
    {
        $query = Product::where([
            'status' => 1,
            'type' => 1
        ]);
        if ($request->c) {
            $query = $query->where(function ($q1) use ($request) {
                $q1->whereIn('category_id', $request->c)->orWhereIn('sub_category_id', $request->c);
            });
        }
        if ($request->b) {
            
            $query = $query->whereIn('brand_id', $request->b);
        }
        
        if (isset($request->v) and $request->v != '') {
            $query->whereHas('productVarientData', function ($q) use ($request) {
                $q->whereHas('productInfo', function ($r) use ($q, $request) {
                    $r->where('has_varient', 1);
                    $q->where('varient_value_id', $request->v);
                });
                
            });
        }
        
        if (isset($request->range) and $request->range != '') {
            $range_data = explode('%3B', $request->range);
            $product_min_price_from = explode(";",$range_data[0])[0];
            $product_max_price_to = explode(";",$range_data[0])[1];
            
            $query->whereHas('productVarient', function ($qq) use ($request) {
                $range_data = explode('%3B', $request->range);
                $product_min_price_from = explode(";",$range_data[0])[0];
                $product_max_price_to = explode(";",$range_data[0])[1];

                $qq->where('status', 1);
                $qq->whereBetween('discount_price', [$product_min_price_from, $product_max_price_to]);
            })->OrWhereBetween('discount_price', [$product_min_price_from, $product_max_price_to])->where('has_varient',0);


        }

        if (isset($request->searchProduct) and ($request->searchProduct != '')) {
            $query->where('slug', 'like', '%'.$request->searchProduct.'%');
        }

        
        

        $paginate = 20;

        if ($request->per_page) {
            $paginate = $request->per_page;
        }
        
        if ($request->sort_option) {
            if ($request->sort_option == 1) {
                $query->orderBy('discount_price', 'ASC');
            }
            else if ($request->sort_option == 2) {
                $query->orderBy('discount_price', 'DESC');
            } else {
                $query->latest();
            }
        } else {
            $query->latest();
        }
        
        $products = $query->with('productVarient','productVarientData')->paginate($paginate);
        // dd($products);
        return view('frontend.store_grid', compact('products'));
    }
    
    public function store_category(Request $request,$id)
    {
        $products = Product::where([
            'type' => 1,
            'status' => 1,
            'category_id' => $id,
        ])->latest()->paginate(20);

        $category = Category::where('id',$id)->latest()->first();
        
        return view('frontend.store_category', compact('products','category'));
    }
    
    public function cart(Request $request)
    {
        $carts = [];
        if (auth()->check()) {
            $carts = Cart::where('user_id', auth()->user()->id)->with('productInfo','varientInfo')->latest()->get();
        }
        $setting = Setting::oldest()->first();
        return view('frontend.cart', compact('carts','setting'));
    }
    
    public function update_cart(Request $request)
    {
        foreach ($request->cart_id as $key => $cart_id) {
            $data['quantity'] = $request->quantity[$key];
            $data['update_by'] = auth()->user()->id;
            Cart::where('id',$cart_id)->update($data);
        }

        return back()->with('success', 'Your cart has been updated');
    }
    
    public function order_track(Request $request)
    {
        return view('frontend.order_track');
    }
    
    public function product_detail($id)
    {
        $product = Product::where('id',$id)->with('productGallery')->latest()->first();

        if ($product->status == 0) {
            return back()->with('danger', "Product not found");
        }
        
        $related_products = Product::inRandomOrder()->where('category_id', $product->category_id)->where('id', '!=', $id)->limit(5)->get();

        return view('frontend.product_detail', compact('product','related_products'));
    }

    public function checkout()
    {
        $carts = Cart::where('user_id', auth()->user()->id)->with('productInfo','varientInfo')->latest()->get();
        if (count($carts) == 0) {
            return back()->with('error','Your cart is empty, please add item first for checkout');
        }        
        $banks = Bank::where('status',1)->get();
        $setting = Setting::oldest()->first();
        return view('frontend.checkout', compact('carts','banks','setting'));
    }

    public function account()
    {
        if (Auth::user()) {

            $user = User::where('id', Auth::id())->first();
            return view('frontend.account', compact('user'));

        } else {

            return redirect()->route('index');

        }
    }

    public function edit_info(Request $request, User $user)
    {
        
        if ($user->type == 1) {
            $request->validate([
                'first_name'    => 'required|max:255',
                'last_name'     => 'required|max:255',
                'mobile'        => 'required|min:11|unique:users,mobile,'.$user->id,
                'email'         => 'email|unique:users,email,'.$user->id,
            ]);
        } else {
            $request->validate([
                'first_name'        => 'required|max:255',
                'last_name'         => 'required|max:255',
                'corporation_name'  => 'required|max:255|unique:users,corporation_name,'.$user->id,
                'mobile'            => 'required|min:11|unique:users,mobile,'.$user->id,
                'email'             => 'email|unique:users,email,'.$user->id,
                'nid_no'            => 'required|unique:users,nid_no,'.$user->id,
                'bin_no'            => 'required|unique:users,bin_no,'.$user->id,
                'tin_no'            => 'required|unique:users,tin_no,'.$user->id,
            ]);
        }

        if ($user->type == 1) {
            $user->first_name           = $request->first_name;
            $user->last_name            = $request->last_name;
            $user->mobile               = $request->mobile;
            $user->email                = $request->email;

            $user->save();
        } else {
            $user->first_name           = $request->first_name;
            $user->last_name            = $request->last_name;
            $user->corporation_name     = $request->corporation_name;
            $user->mobile               = $request->mobile;
            $user->email                = $request->email;
            $user->nid_no               = $request->nid_no;
            $user->bin_no               = $request->bin_no;
            $user->tin_no               = $request->tin_no;

            $user->save();

            $user->username             = Str::lower($request->first_name.$request->last_name.$user->id);
            $user->updated_by           = $user->id;

            $user->save();

            if($request->hasFile('image'))
            {
                $cp = $request->file('image');
                $extension = strtolower($cp->getClientOriginalExtension());
                $randomFileName = $user->id.'image'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

                Storage::disk('public')->put('users/'.$randomFileName, File::get($cp));

                if($user->image)
                {
                    $f = 'users/'.$user->image;

                    if(Storage::disk('public')->exists($f))
                    {
                        Storage::disk('public')->delete($f);
                    }
                }

                $user->image = $randomFileName;
                $user->save();
            } 
            if($request->hasFile('nid_new'))
            {
                $cp = $request->file('nid_new');
                $extension = strtolower($cp->getClientOriginalExtension());
                $randomFileName = $user->id.'nid'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

                Storage::disk('public')->put('nid/'.$randomFileName, File::get($cp));

                if($user->nid)
                {
                    $f = 'nid/'.$user->nid;

                    if(Storage::disk('public')->exists($f))
                    {
                        Storage::disk('public')->delete($f);
                    }
                }

                $user->nid = $randomFileName;
                $user->save();
            } 
            if($request->hasFile('bin_new'))
            {
                $cp = $request->file('bin_new');
                $extension = strtolower($cp->getClientOriginalExtension());
                $randomFileName = $user->id.'bin'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

                Storage::disk('public')->put('bin/'.$randomFileName, File::get($cp));

                if($user->bin)
                {
                    $f = 'bin/'.$user->bin;

                    if(Storage::disk('public')->exists($f))
                    {
                        Storage::disk('public')->delete($f);
                    }
                }

                $user->bin = $randomFileName;
                $user->save();
            } 
            if($request->hasFile('tin_new'))
            {
                $cp = $request->file('tin_new');
                $extension = strtolower($cp->getClientOriginalExtension());
                $randomFileName = $user->id.'tin'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

                Storage::disk('public')->put('tin/'.$randomFileName, File::get($cp));

                if($user->tin)
                {
                    $f = 'tin/'.$user->tin;

                    if(Storage::disk('public')->exists($f))
                    {
                        Storage::disk('public')->delete($f);
                    }
                }

                $user->tin = $randomFileName;
                $user->save();
            } 
        }

        return back()->with('success', 'Information Updated Successfully.');
    }

    public function edit_address(Request $request, User $user)
    {
        if ($request->present_address) {

            $request->validate([
                'present_address' => 'required',
            ]);

            $user->present_address      = $request->present_address;
        }
        
        if ($request->permanent_address) {
            
            $request->validate([
                'permanent_address' => 'required',
            ]);

            $user->permanent_address    = $request->permanent_address;
        }

        $user->save();

        return redirect()->back();
    }

    public function edit_password(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        $old_password = User::where('id', $user->id)->first();

        if (!empty($old_password))
        {
            $password = Hash::check($request->current_password, $old_password->password);
            if ($password)
            {
                $current_user = User::find($user->id);
                $current_user->password = bcrypt($request->password);
                $current_user->updated_by = Auth::id();

                $current_user->save();

                return back()->with('success', 'Password Updated Successfully');

            } else {
                return back()->with('error', 'Password did not matched!');
            }
        } else {
            return back()->with('error', 'Password can not be empty');
        }
    }
    
    public function set_local_value(Request $request)
    {
        if(Session::get('lang') == 'en'){
            $request->session()->put('lang', 'bn');
        } else {
            $request->session()->put('lang', 'en');
        }
        return redirect()->back();
    }

    public function query()
    {
        $wings = Wing::where('status',1)->get();
        return view('frontend.query', compact('wings'));
    }
    
    public function page_details($id,$slag)
    {
        $page = Page::where('id',$id)->latest()->first();
        return view('frontend.pageDetails', compact('page'));
    }
    
    public function user_logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }


    
    public function add_to_cart(Request $request)
    {
        $check_cart = Cart::where([
            'product_id' => $request->product_id,
            'variation_id' => $request->varient,
            'user_id' => auth()->user()->id,
        ])->first();

        $check_stock = Stock::where([
            'product_id' => $request->product_id,
            'varient_id' => $request->varient,
        ])->latest()->first();

        $quantity = $check_stock->quantity ?? 0;
        

        if ($check_cart) {
            if ($quantity < ($check_cart->quantity + $request->quantity)) {
                if($request->ajax()){
                    return response()->json(['error'=>'Quantity is out of stock']);
                }
            }

            
            $check_cart->quantity = $check_cart->quantity + $request->quantity;
            $check_cart->save();

            if($request->ajax()){
                return response()->json(['message'=>'Update your cart successfully']);
            }


        } else {
            $data['product_id'] = $request->product_id;
            $data['variation_id'] = $request->varient;
            $data['quantity'] = $request->quantity;
            $data['created_by'] = auth()->user()->id;
            $data['user_id'] = auth()->user()->id;
            Cart::create($data);
        }

        

        if($request->ajax()){
            return response()->json(['message'=>'Added to your cart successfully']);
        }
    }
    
    public function remove_cart_item(Request $request)
    {
        $check_cart = Cart::find($request->id)->delete();

        return redirect()->back()->with('success','Item removed from your cart');
    }
    
    public function checkout_complete(Request $request)
    {
        $data = $request->all();
        // dd($data);
        // shipping_area  = 1 = inside dhaka
        // shipping_area  = 2 = outside dhaka
        $carts = Cart::where('user_id', auth()->user()->id)->with('productInfo','varientInfo')->latest()->get();

        if (count($carts) == 0) {
            return back()->with('error', "Your cart is empty");
        }
        

        $order_data['tracking_code'] = date("yhis");
        $order_data['user_id'] = auth()->user()->id;
        $order_data['status'] = 0;
        $order_data['payment_status'] = 0; // 1 approved
        $order_data['total_price'] = $request->total_price - $request->discount_amount;
        $order_data['grand_total_price'] = $request->total_price;
        $order_data['discount_amount'] = $request->discount_amount;
        $order_data['coupon_discount'] = 0;
        $order_data['shipping_cost'] = 0;
        $order_data['type'] = 2;
        $order_data['vat'] = $request->vat;
        $order_data['tax'] = $request->tax;
        $order_data['shipping_address'] = $request->shipping_address ?? "";
        $order_data['ship_different_address'] = $request->shippingdiffrentAddress ?? 0;
        $order_data['delivery_status'] = 0;
        $order_data['shipping_area'] = $request->shipping_area ?? '';
        $order_data['personal_vehicle'] = $request->personal_vehicle ?? 0;

        $order = Order::create($order_data);
        
        foreach ($carts as $key => $cart) {
            $order_detail['order_id'] = $order->id;
            $order_detail['product_id'] = $cart->product_id;
            $order_detail['quantity'] = $cart->quantity;
            $order_detail['varient_id'] = $cart->variation_id;

            if ($cart->variation_id == 0){
                $order_detail['price'] = $cart->productInfo->discount_price ?? 0;
            } else {
                $order_detail['price'] = $cart->varientInfo->discount_price ?? 0;
            }

            OrderDetail::create($order_detail);
        }

        $payment_data['user_id'] = auth()->user()->id;
        $payment_data['order_id'] = $order->id;
        $payment_data['amount'] = $request->total_price;
        $payment_data['payment_method'] = $request->stylishRadio;
        $payment_data['bank_id'] = $request->bank_id ?? "";

        if (isset($request->document) and $request->file('document')) {
            $path = $request->file('document')->store('/public/document');
            $path = Str::replace('public/document', '', $path);
            $payment_data['document'] = Str::replace('/', '', $path);
        }
        
        if (isset($request->mb_document) and $request->file('mb_document')) {
            $path = $request->file('mb_document')->store('/public/mb_document');
            $path = Str::replace('public/mb_document', '', $path);
            $payment_data['mb_document'] = Str::replace('/', '', $path);
        }

        $payment_data['status'] = 0;
        $payment_data['created_by'] = auth()->user()->id;

        Payment::create($payment_data);

        Cart::where('user_id', auth()->user()->id)->delete();

        return redirect()->route('account')->with('success','Your order is under review');

    }

    // User order list
    public function account_orders(Request $request)
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->latest()->paginate(5);

        return view('frontend.userDashboard.orderList', compact('user', 'orders', 'request'));
    }

    // User order details page
    public function orderDetails(Request $request, $orderId)
    {
        $user = Auth::user();
        $orderDetails = Order::with('orderDetails')->where('id', $orderId)->first();
        $setting = Setting::oldest()->first();

        return view('frontend.userDashboard.orderDetails', compact('user', 'orderDetails', 'setting', 'request'));
    }

    // User dashboard address
    public function account_address(Request $request)
    {
        $user = Auth::user();
        return view('frontend.userDashboard.accountAddress', compact('user', 'request'));
    }

    // User account details
    public function accountDetails(Request $request)
    {
        $user = Auth::user();
        return view('frontend.userDashboard.accountDetails', compact('user', 'request'));
    }

    // User account password
    public function accountPassword(Request $request)
    {
        $user = Auth::user();
        return view('frontend.userDashboard.accountPassword', compact('user', 'request'));
    }

}
