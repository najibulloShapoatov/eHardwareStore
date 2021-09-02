<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Admin\SlideshowController;
use App\Models\Advice;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\Product;
use App\Models\Slideshow;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    // home page
    public function homepage()
    {
        $product = new Product();

        // slideshow
        $slide = new Slideshow();
        $slideshow = $slide->getActiveSlides();

        // Популярные товары
        $popularProducts = $product->getPopularProducts();

        // banners

        // bestsellers
        $bestsellers = $product->getBestSellers();

        // popular categories
        $category = new Category();
        $mainCategories = $category->getMain();

        // new products
        $newProducts = $product->getNewProducts();

        // advices
        $advice = new Advice();
        $advices = $advice->getMainAdvices();

        // brands
        $brand = new Brand();
        $brandList = $brand->getList();

        // top rated products

        //print_r($mainCategories);

        return view('site.index', compact([
            'slideshow',
            'popularProducts',
            'newProducts',
            'bestsellers',
            'advices',
            'mainCategories',
            'brandList'
        ]));
    }

    // pages
    public function page($slug)
    {
        $page = Page::where(['slug' => $slug, 'is_active' => 1])->first();

        if($page != ''){
            return view('site.pages.index', compact('page'));
        }
        else{
            return view('errors.404');
        }
    }

    // subscribtion
    public function subscribe(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();
            $email = trim(htmlspecialchars($input['email']));

            $subs = new Subscription();
            $result = $subs->subscribe($email);

            return response()->json(array('msg' => $result), 200);
        }
    }

    // feedback
    public function feedback(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();

            $feedback = new Feedback();
            $result = $feedback->sandFeedback($input);

            return response()->json($result, 200);
        }
    }

    // detail slide
    public function detailSlide($id)
    {
        $slide = new Slideshow();
        $data = $slide->getOne($id);
        return view('site.slide', compact('data'));
    }

    // search result
    public function searchResult($searchText)
    {
        $searchText = htmlspecialchars(trim($searchText));
        $product = new Product();
        $data = $product->searchProduct($searchText);
        return view('site.search.index', compact(['searchText','data']));
    }



}
