<?php

namespace App\Http\Controllers;

use App\Models\Attribute_items;
use App\Models\Attributes;
use App\Models\Brand_items;
use App\Models\Categories;
use App\Models\Category_attribute;
use App\Models\Colors;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    private $per_page = 10;

    public function categories(){
        $categories = Categories::with('parent_category')->where('status', 1)->simplePaginate($this->per_page);
        $limit = $this->per_page;
        return view('admin.categories', compact('categories', 'limit'));
    }

    public function addNewCategory(){
        $attributes = Attributes::all();
        //$categories = Categories::where('status', 1)->get();
        $categories = Categories::with('childrenRecursive')->whereNull('parent_category_id')->where('status', 1)->get();
        return view('admin.add_new_category', compact('attributes', 'categories'));
    }

    public function addNewCategoryPost(Request $request){
        
        try{
            $validate = Validator::make($request->all(),[
                'name'    =>  'required|string|min:3|max:255',
                'type_id'    =>  'required',
                'orderNumber'    =>  'required|string|min:1|max:255',
                'banner'    =>  'image|mimes:jpeg,png,jpg|max:2048|dimensions:width=200,height=200',
                'icon'    =>  'image|mimes:jpeg,png,jpg|max:2048|dimensions:width=32,height=32',
                'cover'    =>  'image|mimes:jpeg,png,jpg|max:2048|dimensions:width=360,height=360',
                'meta'    =>  'required|string|min:3|max:255',
                'metaDescription'    =>  'required',
            ]);

            if($validate->fails()){

                $notification = array(
                    'message' => $validate->getMessageBag()->first(),
                    'alert-type' => 'error'
                );
               
                return redirect()->back()->with($notification);
            }

            $banner = time().'.'.$request->banner->extension();
            $request->banner->move(public_path('images/categories/banner'), $banner);

            $icon = time().'.'.$request->icon->extension();
            $request->icon->move(public_path('images/categories/icon'), $icon);

            $cover = time().'.'.$request->cover->extension();
            $request->cover->move(public_path('images/categories/cover'), $cover);

            $category_data = Categories::create([
                'name' => $request->name,
                'parent_category_id' => $request->parent_category_id,
                'type_id' => $request->type_id,
                'orderNumber' => $request->orderNumber,
                'banner' => 'images/categories/banner/'.$banner,
                'icon' => 'images/categories/icon/'.$icon,
                'cover' => 'images/categories/cover/'.$cover,
                'meta' => $request->meta,
                'metaDescription' => $request->metaDescription,
            ]);

            
            foreach($request['attributes'] as $attribute_id){
                
                Category_attribute::create([
                    'category_id' => $category_data->id,
                    'attribute_id' => $attribute_id,
                ]);

            }
            

            $notification = array(
                'message' => 'Successfully Added',
                'alert-type' => 'success'
            );
           
            return redirect()->route('categories')->with($notification);

            

        }catch(Exception $e){
            
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
           
            return redirect()->back()->with($notification);
        }
    }

    public function featuredStatusChangeAjax(Request $request){
        $category = Categories::find($request->id);
        //dd($request->all());

        if($request->current_status == 1){
            $status = 0;
        }

        if($request->current_status == 0){
            $status = 1;
        }

       $update = $category->update([
            'featured' => $status,
        ]);

        if(!$update){
            return response()->json(['error' => true, 'message' => 'Status not updated']);
        }

        return response()->json(['error' => false, 'message' => 'Status updated']);

    }

    public function categoryDelete($id){
        $category = Categories::find($id);
        unlink($category->banner);
        unlink($category->icon);
        unlink($category->cover);
        Categories::where('id', $id)->delete();
        Category_attribute::where('category_id', $id)->delete();

        $notification = array(
            'message' => 'Successfully Deleted',
            'alert-type' => 'success'
        );
       
        return redirect()->route('categories')->with($notification);
    }

    public function categoryEditPost(Request $request){
        
        $categories = Categories::find($request->category_id);
        
        try{
            $validate = Validator::make($request->all(),[
                'name'    =>  'required|string|min:3|max:255',
                'type_id'    =>  'required',
                'orderNumber'    =>  'required|string|min:1|max:255',
                'banner'    =>  'image|mimes:jpeg,png,jpg|max:2048|dimensions:width=200,height=200',
                'icon'    =>  'image|mimes:jpeg,png,jpg|max:2048|dimensions:width=32,height=32',
                'cover'    =>  'image|mimes:jpeg,png,jpg|max:2048|dimensions:width=360,height=360',
                'meta'    =>  'required|string|min:3|max:255',
                'metaDescription'    =>  'required',
            ]);

            if($validate->fails()){

                $notification = array(
                    'message' => $validate->getMessageBag()->first(),
                    'alert-type' => 'error'
                );
               
                return redirect()->back()->with($notification);
            }

            if($request->banner){

                $banner = time().'.'.$request->banner->extension();
                $request->banner->move(public_path('images/categories/banner'), $banner);

                unlink($categories->banner);

                $categories->update([
                    'banner' => 'images/categories/banner/'.$banner,
                ]);
            }

            if($request->icon){

                $icon = time().'.'.$request->icon->extension();
                $request->icon->move(public_path('images/categories/icon'), $icon);

                unlink($categories->icon);

                $categories->update([
                    'icon' => 'images/categories/icon/'.$icon,
                ]);
            }

            if($request->cover){

                $cover = time().'.'.$request->cover->extension();
                $request->cover->move(public_path('images/categories/cover'), $cover);

                unlink($categories->cover);

                $categories->update([
                    'cover' => 'images/categories/cover/'.$cover,
                ]);
            }


            $category_data = $categories->update([
                'name' => $request->name,
                'parent_category_id' => $request->parent_category_id,
                'type_id' => $request->type_id,
                'orderNumber' => $request->orderNumber,
                'meta' => $request->meta,
                'metaDescription' => $request->metaDescription,
                'featured' => (isset($request->featured)? 1 : 0 ),
            ]);

            Category_attribute::where('category_id', $request->category_id)->delete();

            foreach($request['attributes'] as $attribute_id){
                
                Category_attribute::create([
                    'category_id' => $request->category_id,
                    'attribute_id' => $attribute_id,
                ]);

            }
            

            $notification = array(
                'message' => 'Successfully Updated',
                'alert-type' => 'success'
            );
           
            return redirect()->route('categories')->with($notification);

            

        }catch(Exception $e){
            
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
           
            return redirect()->back()->with($notification);
        }
    }

    public function categoryEdit($id){
        $categoryEdit = Categories::find($id);
        $categories = Categories::with('childrenRecursive')->whereNull('parent_category_id')->where('status', 1)->get();
        
        // $categories = Categories::where('status', 1)->get();
        //dd($categories);
        $attributes = Attributes::all();
        $category_attributes = Category_attribute::with('attribute')->where("category_id",$id)->get();

        $attr_ids = array();
        foreach($category_attributes as $category_attribute){
            foreach($category_attribute->attribute as $cat_attr){
                array_push($attr_ids, $cat_attr->id);
            }
        }

        return view('admin.categoryEdit', compact('categoryEdit', 'categories', 'attributes', 'attr_ids'));
    }

    public function attributes(){
        $attributes = Attributes::with('attribute_items')->get();
        return view('admin.attributes', compact('attributes'));
    }
    
    public function addAttributeItem(Request $request){
        try{
            $validate = Validator::make($request->all(),[
                'attribue_value'            =>'required|string|max:20',
            ]);

            if($validate->fails()){
                $notification = array(
                    'message' => $validate->getMessageBag()->first(),
                    'alert-type' => 'error'
                );
               
                return redirect()->back()->with($notification);
            }

            Attribute_items::create([
                'attribute_id'            =>$request->attribute_id,
                'name'             =>$request->attribue_value,
            ]);

            $notification = array(
                'message' => "Successfully Added",
                'alert-type' => 'success'
            );
           
            return redirect()->back()->with($notification);

        }catch(Exception $e){
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
           
            return redirect()->back()->with($notification);
        }
    }

    public function add_attribute(Request $request){
        
        try{
            $validate = Validator::make($request->all(),[
                'name' => 'required|string|min:3|max:50',
            ]);

            if($validate->fails()){
                $notification = array(
                    'message' => $validate->getMessageBag()->first(),
                    'alert-type' => 'error'
                );
               
                return redirect()->back()->with($notification);
            }

            Attributes::create([
                'name' => $request->name,
            ]);

            $notification = array(
                'message' => 'Successfully Added',
                'alert-type' => 'success'
            );
           
            return redirect()->back()->with($notification);
            
        }catch(Exception $e){
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
           
            return redirect()->back()->with($notification);
        }
    }

    public function attributeEdit(Request $request){
        $attribute = Attributes::find($request->attribute_id);

        $attribute->update([
            'name' => $request->attribue_name,
        ]);

        $notification = array(
            'message' => 'Successfully Updated',
            'alert-type' => 'success'
        );
       
        return redirect()->route('attributes')->with($notification);
    }

    public function attributes_edit($id){
        $attribute = Attributes::find($id);
        return view('admin.atrribute_edit', compact('attribute'));
    }

    public function attributesDetails($id){
        $attribute = Attributes::with('attribute_items')->find($id);
        return view('admin.atrribute_details', compact('attribute'));
    }

    public function addCategory(){
        return view('admin.attributesDetails');
    }

    public function attributesDetailsEdit($id){
        $attribute_items = Attribute_items::with('attribute')->find($id);
        return view('admin.attributesDetailsItemEdit', compact('attribute_items'));
    }

    public function attributeItemEdit(Request $request){
        
        $attribute = Attribute_items::find($request->attribute_item_id);
        
        $attribute->update([
            'name' => $request->attribue_item_name,
        ]);

        $notification = array(
            'message' => 'Successfully Updated',
            'alert-type' => 'success'
        );
       
        return redirect()->back()->with($notification);
    }

    public function attributesDelete($id){
        Attributes::where('id', $id)->delete();
        Attribute_items::where('attribute_id', $id)->delete();
        return redirect()->back();
    }

    public function attributesDetailsDelete($id){
        Attribute_items::where('id', $id)->delete();
        return redirect()->back();
    }

    public function addNewBrand(Request $request){
        try{
            $validate = Validator::make($request->all(),[
                'name'            =>'required|string|min:3|max:100',
                'logo'             =>'image|mimes:jpeg,png,jpg|max:2048|dimensions:width=120,height=80',
                'meta_title'                 =>'required',
                'meta_description'          =>'required',
            ]);

            if($validate->fails()){
                $notification = array(
                    'message' => $validate->getMessageBag()->first(),
                    'alert-type' => 'error'
                );
               
                return redirect()->back()->with($notification);
            }

           $imageName = time().'.'.$request->logo->extension();
           $request->logo->move(public_path('images/brands'), $imageName);

           Brand_items::create([
            'name'              =>$request->name,
            'logo'              => "images/brands/".$imageName,
            'meta_title'        =>$request->meta_title,
            'meta_description'  =>$request->meta_description,
           ]);

            $notification = array(
                'message' => 'Successfully Added',
                'alert-type' => 'success'
            );
           
            return redirect()->route('brand')->with($notification);

        }catch(Exception $e){
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
           
            return redirect()->back()->with($notification);
        }
    }

    public function brand(){
        $brands = Brand_items::simplePaginate($this->per_page);
        $limit = $this->per_page;
        return view('admin.brand', compact('brands', 'limit'));
    }

    public function brandDelete($id){
        $data = Brand_items::find($id);
        
        if(file_exists($data->logo)){
            unlink($data->logo);
        }
        
        Brand_items::where('id', $id)->delete();

        $notification = array(
            'message' => 'Successfully Deleted',
            'alert-type' => 'success'
        );
       
        return redirect()->route('brand')->with($notification);
        
    }
    
    public function brandEdit($id){
        $brand = Brand_items::find($id);
        return view('admin.brandEdit', compact('brand'));
    }

    public function brandEditSubmit(Request $request){
        $brand = Brand_items::find($request->brand_id);

        if(isset($request->logo)){

            $validate = Validator::make($request->all(),[
                'name'            =>'required|string|min:3|max:100',
                'logo'             =>'image|mimes:jpeg,png,jpg|max:2048|dimensions:width=120,height=80',
                'meta_title'                 =>'required',
                'meta_description'          =>'required',
            ]);

            if($validate->fails()){
                $notification = array(
                    'message' => $validate->getMessageBag()->first(),
                    'alert-type' => 'error'
                );
               
                return redirect()->back()->with($notification);
            }

            if(file_exists($brand->logo)){
                unlink($brand->logo);
            }

            $imageName = time().'.'.$request->logo->extension();
            $request->logo->move(public_path('images/brands'), $imageName);

            $brand->update([
                'logo' => "images/brands/".$imageName,
            ]);
            
        }

        $brand->update([
            'name' => $request->name,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);

        $notification = array(
            'message' => 'Successfully Updated',
            'alert-type' => 'success'
        );
       
        return redirect()->back()->with($notification);
    }


    public function colors(){
        $colors = Colors::simplePaginate($this->per_page);
        return view('admin.colors', compact('colors'));
    }

    public function addColor(Request $request){
        try{
            $validate = Validator::make($request->all(),[
                'name'            =>'required|string|min:3|max:100',
                'code'             =>'required|string|min:3|max:200',
            ]);

            if($validate->fails()){
                $notification = array(
                    'message' => $validate->getMessageBag()->first(),
                    'alert-type' => 'error'
                );
               
                return redirect()->back()->with($notification);
            }
           

           Colors::create([
            'name'              => $request->name,
            'code'              => $request->code,
           ]);

            $notification = array(
                'message' => 'Successfully Added',
                'alert-type' => 'success'
            );
           
            return redirect()->route('colors')->with($notification);

        }catch(Exception $e){
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
           
            return redirect()->back()->with($notification);
        }
    }

    public function colorsEdit($id){
        $color = Colors::find($id);
        return view('admin.colorEdit', compact('color'));
    }

    public function colorEditSubmit(Request $request){
        $color = Colors::find($request->color_id);
           //dd($request->all());
        try{
            $validate = Validator::make($request->all(),[
                'name'            =>'required|string|min:3|max:100',
                'code'             =>'required|string|min:3|max:200',
            ]);

            if($validate->fails()){
                $notification = array(
                    'message' => $validate->getMessageBag()->first(),
                    'alert-type' => 'error'
                );
               
                return redirect()->back()->with($notification);
            }
           
           
           $color->update([
            'name' => $request->name,
            'code' => $request->code,
           ]);

            $notification = array(
                'message' => 'Successfully Added',
                'alert-type' => 'success'
            );
           
            return redirect()->route('colors')->with($notification);

        }catch(Exception $e){
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
           
            return redirect()->back()->with($notification);
        }
        return redirect()->route('colors')->with($notification);
    }


    public function colorsDelete($id){
        Colors::where('id', $id)->delete();
        $notification = array(
            'message' => 'Successfully Deleted',
            'alert-type' => 'success'
        );
        return redirect()->route('colors')->with($notification);
    }

    public function addProduct(){
        $brands = Brand_items::where('status', 1)->get();
        $colors = Colors::all();
        $attributes = Attributes::all();
        return view('admin.addProduct', compact('brands', 'colors', 'attributes'));
    }

    public function get_attributes_details(Request $request){
        
        $attr_details = array_values(json_decode($request->data, true));
        
        if (empty(array_filter($attr_details))){
            return false;
        }

        foreach($attr_details as $attr_detail){
            $data_items[] = Attributes::with('attribute_items')->where('id', (int)$attr_detail)->get();
        }

        
        return view('admin.get_attributes_details', compact('data_items'));
    }

    public function get_variant_details(Request $request){

        $colors = array();
        $attributes_attr = array();
        $attributes_item_arr = array();
        
        foreach(json_decode($request->data) as $y){
           
            if(isset($y->color_id)){
                foreach($y->color_id as $colors_item){
                    $colors[] = Colors::find($colors_item);
                }
            }

            if(isset($y->attributes_attr)){
                foreach($y->attributes_attr as $attributes_attr_item){
                    $attributes_attr[] = Attributes::find($attributes_attr_item);
                }
            }

            if(isset($y->attributes_items)){
                foreach($y->attributes_items as $attributes_item){
                    $attributes_item_arr[] = Attribute_items::find($attributes_item);
                }
            }
           
            
        }

        
        return view('admin.get_variant_details',compact('colors', 'attributes_attr', 'attributes_item_arr'));
    }


    public function product_add_post(Request $request){
        dd($request->all());
    }
    
}
