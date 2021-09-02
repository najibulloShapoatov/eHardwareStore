<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminSlideshowRequest;
use App\Models\Slideshow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SlideshowController extends Controller
{
    public function index()
    {
        $slides = Slideshow::orderBy('date_add', 'desc')->paginate(15);
        return view('admin.slideshow.index', compact('slides'));
    }

    public function show($id)
    {

        $slide = Slideshow::findOrFail($id);
        return view('admin.slideshow.show', compact('slide'));
    }

    public function create()
    {
        return view('admin.slideshow.create');
    }

    public function store(AdminSlideshowRequest $request)
    {
        $input = $request->all();
        //print_r($input);

        if($file = $request->file('image')){
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->move('public/uploads/slideshow', $name);
            $input['image'] = $name;
        }

        if($file = $request->file('image_mobile')){
            $nameMob = 'mob_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move('public/uploads/slideshow', $nameMob);
            $input['image_mobile'] = $nameMob;
        }

        Slideshow::create($input);
        return redirect('/admin/slideshow')->with(['success_message' => 'Успешно!']);

    }

    public function edit($id)
    {
        $slide = Slideshow::findOrFail($id);
        return view('admin.slideshow.edit', compact('slide'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $slide = Slideshow::findOrFail($id);

        if($file = $request->file('image')){

            $messages = [
                'date_add.required' => 'Введите дату',
                'title.required' => 'Введите заголовок',
                'image.required' => 'Загрузите картину',
                'image.dimensions' => 'Картина должна быть 840x395 px',
                'image.mimes' => 'Формат картины должен быть (jpeg,png,jpg,gif)',
                'image.max' => 'Размер картины должна быть менее 1 МБ',
                'image.image' => 'Эй, вы че? Загрузите картину!',
            ];

            $this->validate($request, [
                'date_add' => 'required',
                'title' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024|dimensions:width=840,height=395',
            ],$messages);

            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->move('public/uploads/slideshow', $name);
            $input['image'] = $name;

        }

        if($file = $request->file('image_mobile')){

            $messages = [
                'date_add.required' => 'Введите дату',
                'title.required' => 'Введите заголовок',
                'image_mobile.required' => 'Загрузите картину для моб.',
                'image_mobile.dimensions' => 'Картина для моб. должна быть 400x400 px',
                'image_mobile.mimes' => 'Формат картины для моб. должен быть (jpeg,png,jpg,gif)',
                'image_mobile.max' => 'Размер картины для моб. должна быть менее 1 МБ',
                'image_mobile.image' => 'Эй, вы че? Загрузите картину для моб.!',
            ];

            $this->validate($request, [
                'date_add' => 'required',
                'title' => 'required',
                'image_mobile' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024|dimensions:width=400,height=400'
            ],$messages);

            $nameMob = 'mob_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move('public/uploads/slideshow', $nameMob);
            $input['image_mobile'] = $nameMob;
        }

        $messages = [
            'date_add.required' => 'Введите дату',
            'title.required' => 'Введите заголовок',
        ];

        $this->validate($request, [
            'date_add' => 'required',
            'title' => 'required'
        ],$messages);

        if(empty($input['is_active'])){ $input['is_active'] = '0'; }

        $slide->update($input);
        return redirect('admin/slideshow')->with(['success_message' => 'Сохранено!']);
    }

    public function destroy($id)
    {
        $slide = Slideshow::findOrFail($id);
        if(!empty($slide->image)){
            if(file_exists('public/uploads/slideshow/' . $slide->image)) {
                unlink('public/uploads/slideshow/' . $slide->image);
            }
        }
        if(!empty($slide->image_mobile)){
            if(file_exists('public/uploads/slideshow/' . $slide->image_mobile)) {
                unlink('public/uploads/slideshow/' . $slide->image_mobile);
            }
        }
        $slide->delete();
        return redirect('/admin/slideshow')->with(['success_message' => 'Удалено!']);
    }

    public function deleteimg(Request $request){
        if( $request->ajax() ) {
            $input = $request->all();

            $id = htmlspecialchars(trim($input['id']));
            $type = htmlspecialchars(trim($input['type']));

            $slide = Slideshow::findOrFail($id);

            if($type == 'web'){
                if(file_exists('public/uploads/slideshow/' . $slide->image)) {
                    unlink('public/uploads/slideshow/' . $slide->image);
                }
                $input['image'] = '';
                $msg = 'forWeb';
            }

            if($type == 'mob'){
                if(file_exists('public/uploads/slideshow/' . $slide->image_mobile)) {
                    unlink('public/uploads/slideshow/' . $slide->image_mobile);
                }
                $input['image_mobile'] = '';
                $msg = 'forMob';
            }

            $slide->update($input);

            return response()->json(array('cl'=> $msg), 200);
        }
    }
}
