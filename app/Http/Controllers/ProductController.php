<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use App\Product;

use Illuminate\Support\Facades\File;

class ProductController extends Controller
{       
    public function index(Request $request)
    {
        $input = $request->all();
        if($request->get('search')){
            $products = Product::where("name", "LIKE", "%{$request->get('search')}%")
                ->paginate(5);      
        }else{
          $products = Product::paginate(5);
        }
        return response($products);
    }
 
    public function store(Request $request)
    {            
        $input = $request->all();
        // check if file exists
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $request->file('file')->getClientOriginalExtension();

            $data = Image::make($file)->resize(200, 200)->save();
            $s3 = Storage::disk('s3');
        if ($s3->put($fileName, file_get_contents($request->file('file')), 'public')) {

            $create = Product::create($input);
        }
            return response($create);
    }
}
    public function edit($id){
        $product = Product::find($id);
        return response($product);
    }
     public function update(Request $request,$id)
    {
        $input = $request->all();
        Product::where("id",$id)->update($input);
        $product = Product::find($id);
        return response($product);
    }
        public function destroy($id)
    {
        return Product::where('id',$id)->delete();
    }
}