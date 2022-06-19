<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        // menuSubmenuSubsubmenu('app_setting', 'manage_slider', 'all_slider');

        $user = Auth::user();

        // if (Gate::allows('manage_slider', $user)) 
        // {
        //     if (Gate::allows('all_slider', $user)) 
        //     {
                $query = Slider::latest();
                if($request->name and $request->name!=''){
                    $query = $query->where('title',$request->name);
                }
                $sliders = $query->paginate(25)->withQueryString();
                return view('backend.admin.slider.index', compact('sliders'));
        //     }
        //     else
        //     {
        //         abort(403);
        //     }
        // }
        // else
        // {
        //     abort(403);
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // menuSubmenuSubsubmenu('app_setting', 'manage_slider', 'add_slider');

        // $user = Auth::user();

        // if (Gate::allows('manage_slider', $user)) 
        // {
        //     if (Gate::allows('add_slider', $user)) 
        //     {
                return view('backend.admin.slider.create');
        //     }
        //     else
        //     {
        //         abort(403);
        //     }
        // }
        // else
        // {
        //     abort(403);
        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required|max:255',
        ]);


        $data = $request->all();
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('/public/slider');
            $path = Str::of($path)->replace('public/slider', '');
            $data['image'] = Str::of($path)->replace('/', '');
        }
        
        $data['created_by'] = Auth::id();

        Slider::create($data);

        return redirect()->route('admin.slider.index')->with('success','Slider Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // menuSubmenuSubsubmenu('app_setting', 'manage_slider', 'all_slider');
        // $user = Auth::user();

        // if (Gate::allows('manage_slider', $user))
        // {
        //     if (Gate::allows('view_slider', $user))
        //     {
                $slider = Slider::with('createdBy','updatedBy')->where('id', $id)->first();

                return view('backend.admin.slider.view', compact('slider'));
        //     }
        //     else
        //     {
        //         abort(403);
        //     }
        // }
        // else
        // {
        //     abort(403);
        // }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // menuSubmenuSubsubmenu('app_setting', 'manage_slider', 'all_slider');

        $userr = Auth::user();

        // if (Gate::allows('organization_setting', $userr)) 
        // {
        //     if(Gate::allows('manage_slider', $userr))
        //     {
        //         if(Gate::allows('edit_slider',$userr))
        //         {
                    $slider = Slider::where('id', $id)->first();

                    return view('backend.admin.slider.edit', compact('slider'));
        //         }
        //         else
        //         {
        //             abort(403);
        //         }
        //     }
        //     else
        //     {
        //         abort(403);
        //     }
        // }
        // else
        // {
        //     abort(403);
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        
        unset($data['_token']);
        unset($data['_method']);

        if(!$request->has('status')){
            $data['status'] = 0;
        }


        if ($request->hasFile('image')) {
            $slides = Slider::find($id);

            if($slides->image !=''){
                $image_path = storage_path().'/app/public/'.$slides->image;
                if(file_exists($image_path)){
                    unlink($image_path);
                }
                
            }

            $path = $request->file('image')->store('/public/slider');
            $path = Str::of($path)->replace('public/slider', '');
            $data['image'] = Str::of($path)->replace('/', '');
        }

        $data['updated_by'] = Auth::user()->id;
        
        Slider::where('id', $id)->update($data);
        return back()->with('success', 'Slider Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        //
    }

    public function delete($id)
    {
        $slider = Slider::findOrFail($id);
        if($slider->image !=''){
            $image_path = storage_path().'/app/public/'.$slider->image;
            if(file_exists($image_path)){
                unlink($image_path);
            }
        }
        $slider->delete();
        return back()->with('success', 'Slider Deleted Successfully');
    }
}
