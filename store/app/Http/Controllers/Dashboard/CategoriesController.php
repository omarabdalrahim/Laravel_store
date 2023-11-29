<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\support\Str;
use Illuminate\Validation\Rules\Dimensions;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
     {
           $request = request();
    //     // $query = Category::query();
    //     // لو فيه ريكوست اسمه نيم ضعه داخل المتغير اللي اسمه نيم
    //     // if($name = $request->query('name'))
    //     // {
    //     //     $query->where('name','LIKE',"%{$name}%");
    //     // }
    //     // if($status = $request->query('status'))
    //     // {
    //     //     $query->where('status','=',$status);
    //     // }
    //     $categories = $query->paginate(1); //return collection object
    $categories = Category::with('parent')
    /*leftJoin('categories as parents', 'parents.id', '=', 'categories.parent_id')
    ->select([
        'categories.*',
        'parents.name as parent_name'
    ])*/
        ->withCount([
                'products as products_number' => function($query) {
                    $query->where('status', '=', 'active');
                }
            ])
            ->filter($request->query())
            ->orderBy('categories.name')
            ->paginate();




        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = Category::all(); //return collection object
        $category = new Category();

        return view('dashboard.categories.create', compact('category', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(Category::rules(),[
            'required'=>'this field :attribute is required',
        ]);

        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);
        $data = $request->except('image');
        $data['image'] = $this->uploadImgae($request);

        $category = Category::create($data);
        // //request طرق الحصول علي البينات من
        // $request->input('name');
        // $request->post('name');
        // $request->query('name');
        // $request->get('name');
        // $request->name;
        // $request['name'];

        // $request->all();
        // $request->only('name','parent_id');
        // $request->except('image','status');

        //request

        // $category = new Category($request->all());
        // $category->save();  // ====

        // PRG  post redirect get

        return Redirect::route('categories.index')->with('success', 'Category created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('dashboard.categories.show', [
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $category = Category::findorfail($id);
        } catch (Exception $e) {
            return redirect()->route('categories.index')
                ->with('info', 'record not found');
        }


        // //== $category = Category::find($id);
        // // في حالة تمرير اي دي ليس موجود نعمل نوقف الكود
        // if (!$category){
        //     // helper function return status and stop code
        //     abort(404);
        // }
        // ==         $category = Category::findorfail($id);


        $parents = Category::where('id', '<>', $id)->
            //   طلما هذا المتغير ليس  من اساسس الدالة use في حالة تمرير متغير ل داله اسمها كلوجر فنكشن لابد من استخدام كلمت
            where(function ($query) use ($id) {
                $query->wherenull('parent_id')
                    ->orwhere('parent_id', '<>', $id);
            })->get();
        return view('dashboard.categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        // $request->validate(Category::rules($id));


        $category = Category::findOrFail($id);

        $old_image = $category->image;

        $data = $request->except('image');


        $new_image= $this->uploadImgae($request);
        if($new_image){
            $data['image']=$new_image;
        }

        $category->update($data);
        //$category->fill($request->all())->save();

        if ($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }

        return Redirect::route('categories.index')->with('success', 'Category update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findorfail($id);
        $category->delete();

        // if($category->image)
        // {
        //     storage::disk('public')->delete($category->image);
        // }

        return Redirect::route('categories.index')->with('success', 'Category delete');
    }

    protected function uploadImgae(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }

        $file = $request->file('image'); // UploadedFile Object

        $path = $file->store('uploads', [
            'disk' => 'public'
        ]);
        return $path;
    }
      public function trash()
    {
        $categories = Category::onlyTrashed()->paginate();
        return view('dashboard.categories.trash', compact('categories'));
    }

    public function restore(Request $request, $id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('categories.trash')
            ->with('success', 'Category restored!');
    }

    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();

        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        return redirect()->route('categories.trash')
            ->with('success', 'Category deleted forever!');
    }
}
