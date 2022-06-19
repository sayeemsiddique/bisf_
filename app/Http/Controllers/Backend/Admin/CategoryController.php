<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        
        if(Gate::allows('all_category',$user))
        {            
            menuSubmenuSubsubmeny('settings', 'product_setting', 'all_category');

            $query = Category::latest();

            if (isset($request->name) and $request->name != '') {
                $query->where('name', 'like', '%'.$request->name.'%');
            }

            $categories = $query->paginate(25);

            return view('backend.admin.category.index',[
                'categories' => $categories
            ]);
        
        } else {
            abort(403);
        }
        
    }

    public function create()
    {
        $user = Auth::user();

        if (Gate::allows('inventory_management', $user)) 
        {
            if(Gate::allows('add_category',$user))
            {
                menuSubmenuSubsubmeny('settings', 'product_setting', 'add_category');

                $categories = Category::latest()->select('id','name','parent_id')->get();

                return view('backend.admin.category.create', compact('categories'));
            
            } else {
                abort(403);
            }
        } else {
            abort(403);
        }
    }
    
    public function store(Request $request)
    {
        $user = Auth::user();

        if (Gate::allows('inventory_management', $user)) 
        {
            if(Gate::allows('add_category',$user))
            {
                $request->validate([
                    'name' => 'required|unique:categories',
                ]);

                $data = $request->all();
                unset($data['files']);
                if ($request->file('image')) {
                    
                    $path = $request->file('image')->store('/public/category');
                    
                    $path = Str::replace('public/category', '', $path);
                    $data['image'] = Str::replace('/', '', $path);
                }  
                
                if ($request->file('banner')) {
                    
                    $path = $request->file('banner')->store('/public/category');
                    
                    $path = Str::replace('public/category', '', $path);
                    $data['banner'] = Str::replace('/', '', $path);
                }

                $data['slug'] = Str::of($request->name)->slug('-');
                $data['created_by'] = auth()->user()->id;
                $data['meta_title'] = $request->name ?? '';
                $data['meta_description'] = $request->description ?? '';

                
                Category::create($data);
                return redirect()->route('admin.category.index')->with('success', 'Category Added');
            
            } else {
                abort(403);
            }
        } else {
            abort(403);
        }
    }

    public function edit($id)
    {
        $user = Auth::user();

        if (Gate::allows('inventory_management', $user)) 
        {
            if(Gate::allows('edit_category',$user))
            {
                menuSubmenuSubsubmeny('settings', 'product_setting', 'edit_category');
                $category = Category::findOrFail($id);
                $categories = Category::where('id','!=',$id)->latest()->select('id','name','parent_id')->get();
                return view('backend.admin.category.edit', compact('category','categories'));
            }
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $id,
        ]);

        $data = $request->all();

        unset($data['files']);

        if ($request->file('image')) {
                    
            $path = $request->file('image')->store('/public/category');
            
            $path = Str::replace('public/category', '', $path);
            $data['image'] = Str::replace('/', '', $path);
        }  
        
        if ($request->file('banner')) {
            
            $path = $request->file('banner')->store('/public/category');
            
            $path = Str::replace('public/category', '', $path);
            $data['banner'] = Str::replace('/', '', $path);
        }

        $data['slug'] = Str::of($request->name)->slug('-');
        $data['update_by'] = auth()->user()->id;
        $data['meta_title'] = $request->name ?? '';
        if (isset($request->description) and $request->description != '') {
            $data['meta_description'] = $request->description ?? '';
        }
        

        Category::findOrFail($id)->update($data);
        return redirect()->route('admin.category.index')->with('success', 'Category Updated');
    }
    
    public function show($id)
    {
        menuSubmenuSubsubmeny('settings', 'product_setting', 'view_category');
        $category = Category::findOrFail($id);
        return view('backend.admin.category.show', compact('category'));
    }
    
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Category Deleted');
    }
    
    public function get_child_category(Request $request)
    {
        $categories = Category::where([
            ['status', '=', 1],
            ['parent_id', '!=', 0],
            ['parent_id', '=', $request->id],
        ])->with('childTreeInfo')->get();
        

        return view('backend.admin.category.option_list', compact('categories'));
    }
}
