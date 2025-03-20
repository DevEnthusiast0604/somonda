<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use Carbon\Carbon;
use Redirect;
use Illuminate\Support\Facades\Http;
 
class CategoryController extends Controller
{
    private $bigbuy_api_url;
    private $bigbuy_api_key;

    public function __construct(){
        $this->middleware('auth');
        $this->bigbuy_api_url = env('BIGBUY_API_URL');
        $this->bigbuy_api_key = env('BIGBUY_API_KEY');
    }

    public function synchronize(){
        $response = Http::withToken($this->bigbuy_api_key)->get($this->bigbuy_api_url.'rest/catalog/taxonomies.json?isoCode=en')->json();
        //dd($response);
        Category::truncate();
        set_time_limit(0);
        foreach($response as $row){
            $category = new Category;
            $category->id = $row['id'];
            $category->name = $row['name'];
            $category->url = $row['url'];
            $category->parentCategory = $row['parentTaxonomy'];
            $category->urlImage = $row['urlImages'];
            $category->isoCode = $row['isoCode'];
            $category->save();
        }
        return redirect()->back()->with('success', 'Synchronized Successfully Done!');
    }

    public function index(){

        $data = Category::orderBy('name','asc')->paginate(15);
        $count = Category::count();
        return view('admin.categories', compact('data','count'));
    }

    public function search(Request $request){
        // dd($request);
        $id = $request->id;
        $name = $request->name;
        if(empty($id) && empty($name)){
            return redirect()->back()->with('warning', 'Keyword is missing');
        }
        if(!empty($id)){
            $data = Category::where('id', $id)->paginate('50');
            $count = Category::where('id', $id)->count();
            return view('admin.categories', compact('data', 'count'));
        }

        if(!empty($name)){
            $data = Category::where('name','like',"%{$name}%")->orderby('name', 'asc')->paginate('50');
            $count = Category::where('name','like',"%{$name}%")->count();
            return view('admin.categories', compact('data', 'count'));
        }
        
        return redirect()->route('admin.categories')->with('warning', 'Search product with ID or Name');
    }

    public function store(Request $request){
       
        $this->validate($request,[
            'name' => 'required|unique:categories',
        ]);
        $Category = new Category;        
        $Category->name = $request->name;

        $image = $request->file('image');
        if($image){
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/categories'), $image_name);
        }else{
            $image_name = '';
        }
        $Category->image = $image_name;
        $Category->save();
        return Redirect::back()->with('success', 'New Category Was Added Successfully!');  
    }

    public function update(Request $request, $id){
        $Category = Category::find($id);
        if($Category){
            $this->validate($request, [
                'name' => 'required|unique:categories,name,'.$id,
            ]);
            $Category->name = $request->name;
            $image = $request->file('image');
            if($image != '')
            {
                $category_image = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/categories'), $category_image);
                if($Category->image){
                    $OldImage = public_path('uploads/categories/'.$Category->image);
                    unlink($OldImage);
                }
                $Category->image = $category_image;
            }
            $Category->save();
            return redirect()->back()->with('success', 'Category was successfully updated!');
        } else {
            return redirect()->back->with('error','Something Went Wrong!');
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $Category = Category::find($id);
        if ($Category) {
            $products = Product::where('category_id',$id)->count();
            if($products){
                return response()->json([
                    'title' => 'Warning!',
                    'status' => 'warning',
                    'message' => 'Some products are related to this category. You can not remove this category!'
                ]);
            }
            $subcategories = Subcategory::where('category_id',$id)->count();
            if($subcategories){
                return response()->json([
                    'title' => 'Warning!',
                    'status' => 'warning',
                    'message' => 'Category has subcategories. You can not remove this category!'
                ]);
            }
            $Category->delete();
            return response()->json([
                'title' => 'Success!',
                'status' => 'success',
                'message' => 'Category deleted successfully!'
            ]);
        } else {
            return response()->json([
                'title' => 'Error',
                'status' => 'error',
                'message' => 'Something Went Wrong!'
            ]);
        }
    }
}