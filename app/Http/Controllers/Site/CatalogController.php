<?php

namespace App\Http\Controllers\Site;

use App\Models\Attribute;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class CatalogController extends Controller
{
    // shop page
    public function index($slug)
    {
        $product = new Product();

        // catalog
        $category = new Category();
        $categories = $category->getList();

        // top week products
        $topWeek = $product->getRandom(5);

        // all products with nav
        $allProducts = $product->getAll();

        if($slug == 'all'){
            $data = $product->getAll();
        }
        else{
            $data = $product->getBySlug($slug);
        }

        //print_r($data);

        return view('site.catalog.index', compact([
            'data',
            'categories',
            'topWeek',
            'allProducts'
        ]));

    }

    // products section page
    public function category($categorySlug)
    {

    }

    // product detail
    public function product($articul)
    {
        // product
        $product = new Product();
        $data = $product->getByArticul($articul);

        // attributes
        $prop = new Attribute();
        $details = $prop->getFrontProps($data->category_id, $data->id);

        // breadcrumb
        $category = new Category();
        $breadcrumb = $category->prodBreadcrumb($data->category_id);

        // reviews
        $review = new Review();
        $reviews = $review->getByProductID($data->id);

        return view('site.catalog.product', compact([
            'data',
            'details',
            'breadcrumb',
            'reviews'
        ]));
    }

    // filter products
    public function filter(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();

            $product = new Product();
            $result = $product->filtered($input);

            if(count($result['data']) > 0){
                $html = View::make('site.catalog._filtered', compact('result'))->render();
                return response()->json([
                    'qntProd' => count($result['data']),
                    'qntProdAll' => count($result['dataAll']),
                    'cnt' => $result['cnt'],
                    'html' => $html,
                    'input' => $input
                ], 200);
            }
            else{
                return response()->json([
                    'qntProd' => 0,
                    'qntProdAll' => 0,
                    'cnt' => 0,
                    'html' => '',
                    'input' => $input
                ], 200);
            }

        }
    }

    // get popular products by category
    public function getPopularProductsByCategory(Request $request){
        if ($request->ajax()) {
            $input = $request->all();
            $catID = htmlspecialchars(trim($input['catID']));

            $product = new Product();
            $popularProducts = $product->getPopularProducts();

            $html = View::make('site.catalog._popular', compact(['popularProducts', 'catID']))->render();

            return response()->json([
                'input' => $input,
                'html' => $html
            ], 200);
        }
    }

    // get new products by category
    public function getNewProductsByCategory(Request $request){
        if ($request->ajax()) {
            $input = $request->all();
            $catID = htmlspecialchars(trim($input['catID']));

            $product = new Product();
            $newProducts = $product->getNewProducts();

            $html = View::make('site.catalog._new', compact(['newProducts', 'catID']))->render();

            return response()->json([
                'input' => $input,
                'html' => $html
            ], 200);
        }
    }

    // quickview product
    public function quickView(Request $request){
        if ($request->ajax()) {
            $input = $request->all();
            $id = htmlspecialchars(trim($input['id']));

            $product = new Product();
            $data = $product->getByID($id);

            $html = View::make('site.catalog._quickview', compact('data'))->render();

            return response()->json([
                //'input' => $input,
                'html' => $html
            ], 200);
        }
    }


}
