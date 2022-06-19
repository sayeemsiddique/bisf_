<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Division;

use App\Models\Content;
use App\Models\ContentFile;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use App\Http\Resources\DivisionCollection;
use App\Http\Resources\DivisionResource;
use App\Http\Resources\ContentCollection;
use App\Http\Resources\ContentFileCollection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        menuSubmenuSubsubmenu('organization_setting', 'divisions', 'alldivisions');
        
        $user = Auth::user();      
        

        // if (Gate::allows('organization_setting', $user)) 
        // {
        //     if(Gate::allows('manage_division', $user))
        //     {
        //         if(Gate::allows('all_division', $user))
        //         {
                    $divisions = Division::latest()->paginate(25);
                    return view('backend.admin.division.index', compact('divisions'));
                    
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        menuSubmenuSubsubmenu('organization_setting', 'divisions', 'addDivision');
        
        $user = Auth::user();        
        

        // if (Gate::allows('organization_setting', $user)) 
        // {
        //     if(Gate::allows('manage_division', $user))
        //     {
        //         if(Gate::allows('add_division', $user))
        //         {
                    $divisions = Division::latest()->paginate(25);
                    return view('backend.admin.division.create', compact('divisions'));
                    
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        unset($data['files']);
        
        $data['created_by'] = Auth::user()->id;
        $data['status'] = $request->status == "on" ? 1 : 0;

        if ($request->hasFile('image')) {

            $path = $request->file('image')->store('/public/division');
            $path = Str::replace('public/division', '', $path);
            $data['image'] = Str::replace('/', '', $path);
        }
        if ($request->file('file_name')) {
            $data['mime_type'] = $request->file('file_name')->extension();
            $path = $request->file('file_name')->store('/public/file');
            
            $path = Str::replace('public/file', '', $path);
            $data['file_name'] = Str::replace('/', '', $path);
        }
        $data['slug'] = Str::slug($request->name, '-');
        
        Division::create($data);

        return back()->with('success', 'Division Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userr = Auth::user();

        // if (Gate::allows('organization_setting', $userr)) 
        // {
        //     if(Gate::allows('manage_division', $userr))
        //     {
        //         if(Gate::allows('edit_division',$userr))
        //         {
                    
                    $division = Division::find($id);
                    return view('backend.admin.division.edit', compact('division'));
                    
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
   
        $data = $request->all();
        
        unset($data['_token']);
        unset($data['_method']);
        unset($data['files']);

        if(!$request->has('status')){
            $data['status'] = 0;
        }

        $data['updated_by'] = Auth::user()->id;

        $division = Division::where('id', $id)->first();

        if ($request->hasFile('image')) {

            $image_path = storage_path().'/app/public/division/'.$division->image;
            if(Storage::exists($image_path)){
                dd($image_path);
                unlink($image_path);
            }

            $path = $request->file('image')->store('/public/division');
            $path = Str::replace('public/division', '', $path);
            $data['image'] = Str::replace('/', '', $path);
        } else {
            unset($data['image']);
        }

        if ($request->file('file_name')) {
            $data['mime_type'] = $request->file('file_name')->extension();
            $path = $request->file('file_name')->store('/public/file');
            
            $path = Str::replace('public/file', '', $path);
            $data['file_name'] = Str::replace('/', '', $path);
        } else {
            unset($data['file_name']);
        }

        if($request->name){
            $data['slug'] = Str::slug($request->name, '-');
        }
        
        $division->update($data);

        return back()->with('success', 'Division Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        

    }
    
    public function delete($id)
    {
        Division::where('id', $id)->delete();
        return back()->with('success','Division Delete successfully.');
    }

    public function deleteDivision(Division $division)
    {
        $userr = Auth::user();

        // if (Gate::allows('organization_setting', $userr)) 
        // {
        //     if(Gate::allows('manage_division', $userr))
        //     {
        //         if(Gate::allows('delete_division',$userr))
        //         {
                    // dd($division->status);
                    if($division->status == true)
                    {
                        $division->status = false;
                    }
                    else
                    {
                        $division->status = true;
                    }
                    $division->save();
                    
                    return back()->with('success','Division Delete successfully.');
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
    
    public function devision_list_by_wing(Request $request)
    {
        $divisions =  Division::where('wing_id',$request->id)->where('status',1)->latest()->get();
        return view('backend.admin.division.option_list', compact('divisions'));
    }
    
    public function admin_devision_list_by_wing(Request $request)
    {
        $divisions =  Division::where('wing_id',$request->id)->where('status',1)->latest()->get();
        return view('backend.admin.division.admin_option_list', compact('divisions'));
    }
}
