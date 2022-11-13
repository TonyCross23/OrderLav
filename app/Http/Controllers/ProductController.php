<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // direct product list
    public function list (){
        $pizzas = Product::select('products.*','categories.name as category_name')
                            ->when(request('key'),function($query){
                                 $query->where('products.name','like','%'.request('key').'%');
                            })
                            ->leftJoin('categories','products.category_id','categories.id')
                            ->orderBy('products.created_at','desc')
                            ->paginate(3);
        return view('admin.product.list',compact('pizzas'));
    }

    // direct createPage
    public function createPage (){
        $categories = Category::select('id','name')->get();

        return view('admin.product.create',compact('categories'));
    }

    // create pizza
    public function create (Request $request){
        $this->pizzaValidationCheck($request,"create");
        $data = $this->createPizzaData($request);


        $fileName = uniqid(). $request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image'] = $fileName;


        Product::create($data);
        return redirect()->route('product#list');
    }

    // product delete section
    public function delete ($id){
        Product::where('id',$id)->delete();
        return redirect()->route('product#list')->with(['deleteSuccess' => 'Delete Success']);
    }

    // product edit section
    public function edit ($id){
        $pizza = Product::select('products.*','categories.name as category_name')
                           ->leftJoin('categories','products.category_id','categories.id')
                           ->where('products.id',$id)->first();
        return view('admin.product.detail_pizza',compact('pizza'));
    }

    // direct updatePage
    public function updatePage ($id){
        $pizza = Product::where('id',$id)->first();
        $category = Category::get();
        return view ('admin.product.update',compact('pizza','category'));
    }

    // update pizza
    public function update (Request $request){
        $this->pizzaValidationCheck($request,"update");
        $data = $this->createPizzaData ($request);

        if($request->hasFile('pizzaImage')){
            $oldImageName = Product::where('id',$request->pizzaId)->first();
            $oldImageName = $oldImageName->image;

            if($oldImageName != null){
                Storage::delete('public/'. $oldImageName);
            }

            $fileName = uniqid(). $request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$fileName);
            $data['image'] = $fileName;


        }

        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('product#list');

    }

    //pizza validation check
    private function pizzaValidationCheck($request,$action){
        $validationRule = [
                        'pizzaName' => 'required|unique:products,name,'.$request->pizzaId ,
                        'pizzaCategory' => 'required' ,
                        'pizzaDescription' => 'required' ,
                        'pizzaWaitingTime' => 'required' ,
                        'pizzaPrice' => 'required' ,
                  ];
        $validationRule['pizzaImage'] = $action == 'create' ? 'required|mimes:png,jpg,jpeg,jfif,webp|file' : "mimes:png,jpg,jpeg,jfif,webp|file" ;
        Validator::make($request->all(),$validationRule)->validate();
    }

    // pizza create data
    private function createPizzaData ($request){
        return[
            'name' => $request->pizzaName,
            'category_id' => $request->pizzaCategory,
            'description' => $request->pizzaDescription,
            'price' => $request->pizzaPrice,
            'waiting_time' => $request->pizzaWaitingTime,
        ];
    }

}
