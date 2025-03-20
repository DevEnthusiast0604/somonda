<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Productdetail;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Subscription;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use App\Mail\AdsMail;
use DB, Session, Redirect;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    private $bigbuy_api_url;
    private $bigbuy_api_key;

    public function __construct(){
        $this->middleware('auth');
        $this->bigbuy_api_url = env('BIGBUY_API_URL');
        $this->bigbuy_api_key = env('BIGBUY_API_KEY');
    }

    public function download(Request $request)
    {        
        $response = Http::withToken(env('BIGBUY_API_KEY'))->get($this->bigbuy_api_url.'rest/catalog/productsinformation.json?isoCode=en&pageSize=2000')->json();
        echo '<pre>';
        print_r($response);exit;
        $exist_prod = Product::find($response[0]['id']);
        if($exist_prod){
            return redirect()->back()->with('warning', 'Products is already exists');
        }else{
            set_time_limit(0);
            foreach($response as $row){
                $prod = Product::find($row['id']);
                if(!$prod){
                    $prod = new Product;
                }
                // $prod = new Product;
                $prod->id = $row['id'];
                $prod->sku = $row['sku'];
                $prod->url = $row['url'];
                $prod->name = $row['name'];
                $prod->description = $row['description'];
                $prod->dateUpdDescription = $row['dateUpdDescription'];
                $prod->isoCode = $row['isoCode'];
                $prod->save();
            }
            return redirect()->back()->with('success', 'Downloaed a new products!');
        }
    }

    public function synchronize($id){
        set_time_limit(0);
        $prod = Product::find($id);
        $prod_languages = Http::withToken($this->bigbuy_api_key)->get($this->bigbuy_api_url.'catalog/productinformationalllanguages/'.$id.'.json?isoCode=en')->json();
        $prod_lang = Productdetail::where('product_id', $id)->first();
        if($prod_lang){
            $prod_lang->fr_name = $prod_languages[2]["name"];
            $prod_lang->fr_description = $prod_languages[2]["description"];
            $prod_lang->pt_name = $prod_languages[4]["name"];
            $prod_lang->pt_description = $prod_languages[4]["description"];
            $prod_lang->it_name = $prod_languages[7]["name"];
            $prod_lang->it_description = $prod_languages[7]["description"];
            $prod_lang->da_name = $prod_languages[9]["name"];
            $prod_lang->da_description = $prod_languages[9]["description"];
            $prod_lang->sv_name = $prod_languages[22]["name"];
            $prod_lang->sv_description = $prod_languages[22]["description"];
            $prod_lang->ge_name = $prod_languages[3]["name"];
            $prod_lang->ge_description = $prod_languages[3]["description"];
            $prod_lang->nl_name = $prod_languages[19]["name"];
            $prod_lang->nl_description = $prod_languages[19]["description"];
            $prod_lang->no_name = $prod_languages[21]["name"];
            $prod_lang->no_description = $prod_languages[21]["description"];
            $prod_lang->fi_name = $prod_languages[10]["name"];
            $prod_lang->fi_description = $prod_languages[10]["description"];
            $prod_lang->save();
        }else{
            $prod_lang = new Productdetail;
            $prod_lang->fr_name = $prod_languages[2]["name"];
            $prod_lang->fr_description = $prod_languages[2]["description"];
            $prod_lang->pt_name = $prod_languages[4]["name"];
            $prod_lang->pt_description = $prod_languages[4]["description"];
            $prod_lang->it_name = $prod_languages[7]["name"];
            $prod_lang->it_description = $prod_languages[7]["description"];
            $prod_lang->da_name = $prod_languages[9]["name"];
            $prod_lang->da_description = $prod_languages[9]["description"];
            $prod_lang->sv_name = $prod_languages[22]["name"];
            $prod_lang->sv_description = $prod_languages[22]["description"];
            $prod_lang->ge_name = $prod_languages[3]["name"];
            $prod_lang->ge_description = $prod_languages[3]["description"];
            $prod_lang->nl_name = $prod_languages[19]["name"];
            $prod_lang->nl_description = $prod_languages[19]["description"];
            $prod_lang->no_name = $prod_languages[21]["name"];
            $prod_lang->no_description = $prod_languages[21]["description"];
            $prod_lang->fi_name = $prod_languages[10]["name"];
            $prod_lang->fi_description = $prod_languages[10]["description"];
            $prod_lang->product_id = $id;
            $prod_lang->save();
        }
     

        $prod_details = Http::withToken($this->bigbuy_api_key)->get($this->bigbuy_api_url.'catalog/product/'.$id.'.json?isoCode=en')->json();
        $prod_stocks = Http::withToken($this->bigbuy_api_key)->get($this->bigbuy_api_url.'catalog/productstock/'.$id.'.json?isoCode=en')->json();
        
        $prod->manufacturer = $prod_details['manufacturer'];
        $prod->weight = $prod_details['weight'];
        $prod->height = $prod_details['height'];
        $prod->width = $prod_details['width'];
        $prod->depth = $prod_details['depth'];
        $prod->category_id = $prod_details['category'];
        $prod->wholesalePrice = $prod_details['wholesalePrice'];
        $prod->retailPrice = $prod_details['retailPrice'];
        $prod->active = $prod_details['active'];
        $prod->taxRate = $prod_details['taxRate'];
        $prod->taxId = $prod_details['taxId'];
        $prod->inShopsPrice = $prod_details['inShopsPrice'];
        $prod->condition = $prod_details['condition'];
        $prod->logisticClass = $prod_details['logisticClass'];
        $prod->image = $prod_details['images']['images'][0]['url'];
        $images = [];
        foreach($prod_details['images']['images'] as $key=>$row){
            $images[$key] = $row['url'];
        }
        $prod->images = serialize($images);
        $prod->stock = $prod_stocks['stocks'][0]['quantity'];
        $prod->save();
        return redirect()->back()->with('success', 'Product information was initialized successfully!'); 
    }

    public function search(Request $request){
        // dd($request);
        $id = $request->id;
        $name = $request->name;
        $sku = $request->sku;
        $active_products = Product::where('status', 1)->count();
        if(!empty($id)){
            $data = Product::where('id', $id)->paginate('50');
            $count = Product::where('id', $id)->count();
            return view('admin.products.index', compact('data', 'count','active_products'));
        }

        if(!empty($name)){
            $data = Product::where('name','like',"%{$name}%")->orderby('status', 'DESC')->paginate('50');
            $count = Product::where('name','like',"%{$name}%")->count();
            return view('admin.products.index', compact('data', 'count','active_products'));
        }
        if(!empty($sku)){
            $data = Product::where('sku', $sku)->paginate('20');
            $count = Product::where('sku', $sku)->count();
            return view('admin.products.index', compact('data', 'count','active_products'));
        }
        return redirect()->route('admin.products')->with('warning', 'Search product with ID, Name or SKU');
    }

    public function add(Request $request){
        set_time_limit(0);
        $prod = Product::find($request->product);
        if($prod){
            return redirect()->back()->with('warning', 'Already exist product!');
        }else{
            $prod_details = Http::withToken($this->bigbuy_api_key)->get($this->bigbuy_api_url.'rest/catalog/product/'.$request->product)->json();
            $prod_stocks = Http::withToken($this->bigbuy_api_key)->get($this->bigbuy_api_url.'rest/catalog/productstock/'.$request->product.'.json?isoCode=en')->json();
            $prod_information = Http::withToken($this->bigbuy_api_key)->get($this->bigbuy_api_url.'rest/catalog/productinformation/'.$request->product.'.json?isoCode=en')->json();
            $prod_languages = Http::withToken($this->bigbuy_api_key)->get($this->bigbuy_api_url.'rest/catalog/productinformationalllanguages/'.$request->product.'.json?isoCode=en')->json();

            $prod = new Product;
            $prod->id = $prod_information[0]['id'];
            $prod->sku = $prod_information[0]['sku'];
            $prod->url = $prod_information[0]['url'];
            $prod->name = $prod_information[0]['name'];
            $prod->description = $prod_information[0]['description'];
            $prod->dateUpdDescription = $prod_information[0]['dateUpdDescription'];
            $prod->isoCode = $prod_information[0]['isoCode'];
            $prod->manufacturer = $prod_details['manufacturer'];
            $prod->weight = $prod_details['weight'];
            $prod->height = $prod_details['height'];
            $prod->width = $prod_details['width'];
            $prod->depth = $prod_details['depth'];
            $prod->category_id = $prod_details['taxonomy'];
            $prod->wholesalePrice = $prod_details['wholesalePrice'];
            $prod->retailPrice = $prod_details['retailPrice'];
            $prod->active = $prod_details['active'];
            $prod->taxRate = $prod_details['taxRate'];
            $prod->taxId = $prod_details['taxId'];
            $prod->inShopsPrice = $prod_details['inShopsPrice'];
            $prod->condition = $prod_details['condition'];
            $prod->logisticClass = $prod_details['logisticClass'];
            $prod->image = $prod_details['images']['images'][0]['url'];
            $images = [];
            foreach($prod_details['images']['images'] as $key=>$row){
                $images[$key] = $row['url'];
            }
            $prod->images = serialize($images);
            $prod->stock = $prod_stocks['stocks'][0]['quantity'];
            $prod->save();

            $prod_lang = new Productdetail;
            $prod_lang->fr_name = $prod_languages[2]["name"];
            $prod_lang->fr_description = $prod_languages[2]["description"];
            $prod_lang->pt_name = $prod_languages[4]["name"];
            $prod_lang->pt_description = $prod_languages[4]["description"];
            $prod_lang->it_name = $prod_languages[7]["name"];
            $prod_lang->it_description = $prod_languages[7]["description"];
            $prod_lang->da_name = $prod_languages[9]["name"];
            $prod_lang->da_description = $prod_languages[9]["description"];
            $prod_lang->sv_name = $prod_languages[22]["name"];
            $prod_lang->sv_description = $prod_languages[22]["description"];
            $prod_lang->ge_name = $prod_languages[3]["name"];
            $prod_lang->ge_description = $prod_languages[3]["description"];
            $prod_lang->nl_name = $prod_languages[19]["name"];
            $prod_lang->nl_description = $prod_languages[19]["description"];
            $prod_lang->no_name = $prod_languages[21]["name"];
            $prod_lang->no_description = $prod_languages[21]["description"];
            $prod_lang->fi_name = $prod_languages[10]["name"];
            $prod_lang->fi_description = $prod_languages[10]["description"];
            $prod_lang->product_id = $prod->id;
            $prod_lang->save();
            return redirect()->back()->with('success', 'A new product is added successfully'); 
        }
    }

    public function add_product(){
        $categories = Category::orderBy('name')->get();
        return view('admin.products.add', compact('categories'));
    }

    // ======================================== Admin Product Part =====================================
    public function list(){
        $count = Product::count();
        $data = Product::orderBy('status', 'DESC')->paginate('20');
        $active_products = Product::where('status', 1)->count();
        return view('admin.products.index', compact('data', 'count', 'active_products'));
    }

    public function edit($id){
        $data = Product::find($id);
        $categories = Category::orderBy('name')->get();
        return view('admin.products.edit', compact('data','categories'));
    }

    public function edit_details($id){
        $product = Product::find($id);
        $productdetail = Productdetail::where('product_id', $id)->first();
        return view('admin.products.edit_details', compact('product','productdetail'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required',
        ]);
        $prod = new Product;
        $image = $request->file('image');
        if($image){
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $image_name);
        }else{
            $image_name = '';
        }
        $prod->name = $request->name;
        $prod->sku = $request->sku;
        $prod->stock = $request->stock;
        $prod->category_id = $request->category_id;
        $prod->name = $request->name;
        $prod->weight = $request->weight;
        $prod->height = $request->height;
        $prod->width = $request->width;
        $prod->depth = $request->depth;
        $prod->wholesalePrice = $request->wholesalePrice;
        $prod->no_wholesalePrice = $request->no_wholesalePrice;
        $prod->se_wholesalePrice = $request->se_wholesalePrice;
        $prod->fi_wholesalePrice = $request->fi_wholesalePrice;
        $prod->retailPrice = $request->retailPrice;
        $prod->no_retailPrice = $request->no_retailPrice;
        $prod->se_retailPrice = $request->se_retailPrice;
        $prod->fi_retailPrice = $request->fi_retailPrice;
        $prod->taxRate = $request->taxRate;
        $prod->condition = $request->condition;
        $prod->status = $request->status;
        $prod->image = $image_name;
        $prod->custom = 1;
        $prod->description = $request->description;
        $prod->save();
        $prod->url = $prod->id.'-'.str_replace(' ', '-', $request->name);
        $prod->save();

        $productdetail = new Productdetail;
        $productdetail->product_id = $prod->id;
        $productdetail->save();

        return Redirect::route('admin.products')->with('success', 'Product was added successfully!');  
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'name' => 'required',
        ]);
        $prod = Product::find($id);
        $image = $request->file('image');
        if($image != '')
        {
            $prod_image = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $prod_image);
            if($prod->image){
                $OldImage = public_path('uploads/products/'.$prod->image);
                unlink($OldImage);
            }
            $prod->image = $prod_image;
        }
        if($prod->custom == 1){
            $prod->category_id = $request->category_id;
            $prod->sku = $request->sku;
            $prod->stock = $request->stock;
        }
        $prod->name = $request->name;
        $prod->weight = $request->weight;
        $prod->height = $request->height;
        $prod->width = $request->width;
        $prod->depth = $request->depth;
        $prod->wholesalePrice = $request->wholesalePrice;
        $prod->se_wholesalePrice = $request->se_wholesalePrice;
        $prod->no_wholesalePrice = $request->no_wholesalePrice;
        $prod->fi_wholesalePrice = $request->fi_wholesalePrice;
        $prod->retailPrice = $request->retailPrice;
        $prod->no_retailPrice = $request->no_retailPrice;
        $prod->se_retailPrice = $request->se_retailPrice;
        $prod->fi_retailPrice = $request->fi_retailPrice;
        $prod->taxRate = $request->taxRate;
        $prod->condition = $request->condition;
        $prod->status = $request->status;
        $prod->description = $request->description;
        $prod->save();
        return Redirect::route('admin.products')->with('success', 'Product was updated successfully!');  
    }

    public function update_details(Request $request, $id){
        $prod = Product::find($id);
        if($request->hasFile('images')){
            $allowedfileExtension=['jpeg','jpg','png','gif'];
            $files = $request->file('images');
            $images = [];
            foreach($files as $file){
                $filename = rand() . '.' . $file->getClientOriginalExtension();
                $extension = $file->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);
                //dd($check);
                if($check){
                    $images[] = $filename;
                    $file->move(public_path('uploads/products'), $filename);
                }else{
                    return Redirect::back()->with('warning', 'Please upload image files only!'); 
                }
            }
            $prod->images = serialize($images);
            $prod->save();
        }
       
        $productdetail = Productdetail::where('product_id', $id)->first();
        $productdetail->sv_name = $request->sv_name; 
        $productdetail->sv_description = $request->sv_description;
        $productdetail->fr_name = $request->fr_name; 
        $productdetail->fr_description = $request->fr_description; 
        $productdetail->da_name = $request->da_name; 
        $productdetail->da_description = $request->da_description; 
        $productdetail->it_name = $request->it_name; 
        $productdetail->it_description = $request->it_description; 
        $productdetail->pt_name = $request->pt_name; 
        $productdetail->pt_description = $request->pt_description; 
        $productdetail->nl_name = $request->nl_name; 
        $productdetail->nl_description = $request->nl_description; 
        $productdetail->ge_name = $request->ge_name; 
        $productdetail->ge_description = $request->ge_description; 
        $productdetail->fi_name = $request->fi_name; 
        $productdetail->fi_description = $request->fi_description; 
        $productdetail->no_name = $request->no_name; 
        $productdetail->no_description = $request->no_description; 
        $productdetail->save();
        return Redirect::route('admin.products')->with('success', 'Product was updated successfully!');  
    }


    public function destroy(Request $request)
    {
        $id = $request->id;
        $prod = Product::find($id);
        if ($prod) {
            $prod_description = Productdetail::where('product_id', $id);
            if($prod_description){
                $prod_description->delete();
            }
            // if($prod->image){
            //     $OldImage = public_path('uploads/products/'.$prod->image);
            //     unlink($OldImage);
            // }
            $prod->delete();
            return response()->json([
                'message' => 'Product was deleted successfully!'
            ]);
        } else {
            return response()->json([
                'message' => 'Something Went Wrong!'
            ]);
        }
    }

    public function importProductCategoryWise(Request $request,$categoryId) {
            set_time_limit(0);
            $prod_details = Http::withToken($this->bigbuy_api_key)->get($this->bigbuy_api_url.'rest/catalog/products.json?&pageSize=5000')->json(); 
            $prod_stocks = Http::withToken($this->bigbuy_api_key)->get($this->bigbuy_api_url.'rest/catalog/productsstockbyhandlingdays.json?&pageSize=5000')->json();
            $prod_information = Http::withToken($this->bigbuy_api_key)->get($this->bigbuy_api_url.'rest/catalog/productsinformation.json?&pageSize=5000')->json();
            $prod_images = Http::withToken($this->bigbuy_api_key)->get($this->bigbuy_api_url.'rest/catalog/productsimages.json?&pageSize=5000')->json();
            echo '<pre>';
            echo "====== Product Details ====== ";
            print_r($prod_details); 
            echo "====== Product  stocks ====== ";
            print_r($prod_stocks);
            echo "====== Product  information ====== ";
            print_r($prod_information);
            $count = count($prod_details);
            for($i= 0; $i<$count; $i++) 
            {
                $existingProd = Product::find($prod_information[$i]['id']);
                if(!$existingProd) {
                    $prod = new Product;
                    $prod->id = $prod_information[$i]['id'];
                    $prod->sku = $prod_information[$i]['sku'];
                    $prod->url = $prod_information[$i]['url'];
                    $prod->name = $prod_information[$i]['name'];
                    $prod->description = $prod_information[$i]['description'];
                    $prod->dateUpdDescription = $prod_information[$i]['dateUpdDescription'];
                    $prod->isoCode = $prod_information[$i]['isoCode'];
                    $prod->manufacturer = $prod_details[$i]['manufacturer'];
                    $prod->weight = $prod_details[$i]['weight'];
                    $prod->height = $prod_details[$i]['height'];
                    $prod->width = $prod_details[$i]['width'];
                    $prod->depth = $prod_details[$i]['depth'];
                    $prod->category_id = $prod_details[$i]['taxonomy'];
                    $prod->wholesalePrice = $prod_details[$i]['wholesalePrice'];
                    $prod->retailPrice = $prod_details[$i]['retailPrice'];
                    $prod->active = $prod_details[$i]['active'];
                    $prod->taxRate = $prod_details[$i]['taxRate'];
                    $prod->taxId = $prod_details[$i]['taxId'];
                    $prod->inShopsPrice = $prod_details[$i]['inShopsPrice'];
                    $prod->condition = $prod_details[$i]['condition'];
                    $prod->logisticClass = $prod_details[$i]['logisticClass'];
                    $prod->image = $prod_images[$i]['images'][0]['url'];
                    $images = [];
                    foreach($prod_images[$i]['images'] as $key=>$row){
                        $images[$key] = $row['url'];
                    }
                    $prod->images = serialize($images);
                    $prod->stock = $prod_stocks[$i]['stocks'][1]['quantity'];
                    $prod->save();
                }
        }
            return redirect()->back()->with('success', 'A new product is added successfully'); 
        
    }
}