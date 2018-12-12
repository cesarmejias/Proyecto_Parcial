<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use Auth;
use Session;
use App\Repositories\CategoryRepository;
use Carbon\Carbon;

class CategoryController extends Controller
{
    

     /**
     * CategoryRepository $CategoryRepository
     */
    protected $CategoryRepository;


        public function __construct(CategoryRepository $categoryRepository) {
        $this->middleware(['auth'])->except('index', 'show');

        $this->categoryRepository = $categoryRepository;

        Carbon::setlocale('es');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderby('id', 'asc')->paginate(5); //show only 5 items at a time in descending order

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            //Validating name and description field
        $this->validate($request, [
            'name' =>'required',
            'description' =>'required',
            ]);

        $name = $request['name'];
        $description = $request['description'];


        $category = Category::create($request->only('name', 'description'));

    //Display a successful message upon save
        return redirect()->route('categories.index')
            ->with('flash_message', 'Category,
             '. $category->name.' created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $category = $this->categoryRepository->getById($id);
       
        return view ('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->getById($id);

        return view('categories.edit', compact('category'));
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
        $this->validate($request, [
            'name'=>'required',
            'description'=>'required',
        ]);

        $category = Category::findOrFail($id);
        $category->title = $request->input('amount','description');
        $category->save();

        return redirect()->route('categories.show', 
            $category->id)->with('flash_message', 
            'Category, '. $category->name.' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->categoryRepository->getById($id);
        $category = $this->deleteAll();

        return redirect()->route('categories.index')
            ->with('flash_message',
             'Category successfully deleted');
    }
}