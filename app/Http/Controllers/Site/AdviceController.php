<?php

namespace App\Http\Controllers\Site;

use App\Models\Advice;
use App\Models\AdviceType;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdviceController extends Controller
{
    // list of advices
    public function index()
    {
        $advice = new Advice();
        $data = $advice->getList();

        $advice_type = new AdviceType();
        $tags = $advice_type->getList();

        $category = new Category();
        $catList = $category->getList();


        return view('site.advices.index', compact(['data', 'catList', 'tags']));
    }

    // advice type
    public function adviceByType($slug)
    {
        $adviceType = new AdviceType();
        $data = $adviceType->getByType($slug);
        $list = $data->advices()->paginate(10);
        $tags = $adviceType->getList();
        return view('site.advices.type', compact(['data', 'tags', 'list']));
    }

    // advice detail
    public function detail($slug)
    {
        $advice = new Advice();
        $data = $advice->getDetail($slug);

        $category = new Category();
        $catList = $category->getList();

        $adviceType = new AdviceType();
        $tags = $adviceType->getList();

        $otherAdvices = $advice->getOtherAdvices($slug);

        return view('site.advices.detail', compact(['data', 'catList', 'otherAdvices', 'tags']));
    }
}
