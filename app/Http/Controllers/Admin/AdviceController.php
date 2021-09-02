<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminAdvicesRequest;
use App\Models\Advice;
use App\Models\AdviceType;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class AdviceController extends Controller
{
    public function index()
    {
        $advices = Advice::orderBy('date_add', 'desc')->paginate(15);
        return view('admin.advices.index', compact('advices'));
    }

    public function show($id)
    {
        $advice = Advice::findOrFail($id);
        return view('admin.advices.show', compact('advice'));
    }

    public function create()
    {
        $category = new Category();
        $categories = $category->getList();

        $adviceType = new AdviceType();
        $adviceTypes = $adviceType->getList();

        return view('admin.advices.create', compact(['categories', 'adviceTypes']));
    }

    public function store(AdminAdvicesRequest $request)
    {
        $input = $request->all();
        //print_r($input);

        if($file = $request->file('image')){
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->move('public/uploads/advices', $name);
            $input['image'] = $name;
        }

        if($input['slug'] == ''){
            $input['slug'] = Str::slug($input['title']);
        }

        $advices = Advice::create($input);
        return redirect('/admin/advices')->with(['success_message' => 'Успешно!']);

    }

    public function edit($id)
    {
        $advice = Advice::findOrFail($id);

        $category = new Category();
        $categories = $category->getList();

        $adviceType = new AdviceType();
        $adviceTypes = $adviceType->getList();

        return view('admin.advices.edit', compact(['advice', 'categories', 'adviceTypes']));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $advice = Advice::findOrFail($id);

        if($file = $request->file('image')){

            $messages = [
                'category_id.required' => 'Выберите категорию',
                'advice_type_id.required' => 'Выберите тип совета',
                'date_add.required' => 'Введите дату',
                'title.required' => 'Введите заголовок',
                'slug.unique' => 'Алиас должен быть уникальным',
                'description.required' => 'Введите описание',
                'image.required' => 'Загрузите картину',
                'image.dimensions' => 'Картина доллжна быть 730x490 px',
                'image.mimes' => 'Формат картины должен быть (jpeg,png,jpg,gif)',
                'image.max' => 'Размер картины должна быть менее 1 МБ',
                'image.image' => 'Эй, вы че? Загрузите картину!',
            ];

            $this->validate($request, [
                'category_id' => 'required',
                'advice_type_id' => 'required',
                'date_add' => 'required',
                'title' => 'required',
                'slug' => 'unique:advices,slug,' . $advice->id,
                'description' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024|dimensions:width=730,height=490'
            ],$messages);

            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->move('public/uploads/advices', $name);
            $input['image'] = $name;

            //print_r($name);

        }
        else{
            $messages = [
                'date_add.required' => 'Введите дату',
                'title.required' => 'Введите заголовок',
                'alias.unique' => 'Алиас должен быть уникальным',
                'description.required' => 'Введите описание',
            ];

            $this->validate($request, [
                'date_add' => 'required',
                'title' => 'required',
                'slug' => 'unique:advices,slug,' . $advice->id,
                'description' => 'required',
            ],$messages);
        }

        if($input['slug'] == ''){
            $input['slug'] = Str::slug($input['title']);
        }

        if(empty($input['is_active'])){ $input['is_active'] = '0'; }

        $advice->update($input);
        return redirect('admin/advices')->with(['success_message' => 'Сохранено!']);
    }

    public function destroy($id)
    {
        $advice = Advice::findOrFail($id);
        if(!empty($advice->image)){
            if(file_exists('public/uploads/advices/' . $advice->image)) {
                unlink('public/uploads/advices/' . $advice->image);
            }
        }
        $advice->delete();
        return redirect('/admin/advices')->with(['success_message' => 'Удалено!']);
    }

    public function deleteimg(Request $request){
        if( $request->ajax() ) {
            $input = $request->all();
            $advice = Advice::findOrFail($input['id']);
            if(file_exists('public/uploads/advices/' . $advice->image)) {
                unlink('public/uploads/advices/' . $advice->image);
            }
            $input['image'] = '';
            $advice->update($input);
            $msg = "ok";
            return response()->json(array('msg'=> $msg), 200);
        }
    }
}
