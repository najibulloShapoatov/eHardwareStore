<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'date_add',
        'date_end',
        'brand_id',
        'country_id',
        'title',
        'slug',
        'articul',
        'price',
        'quantity',
        'image',
        'description',
        'viewed',
        'sold',
        'is_active'
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function brand(){
        return $this->belongsTo('App\Models\Brand');
    }

    public function country(){
        return $this->belongsTo('App\Models\Country');
    }

    public function gallery(){
        return $this->hasMany('App\Models\ProductGallery');
    }

    public function reviews(){
        return $this->hasMany('App\Models\Review');
    }

    public function attributes($categoryID, $id){
        $prop = new Attribute();
        $details = $prop->getViewFrontProps($categoryID, $id);
        $i=0;
        foreach($details as $item){
            echo $item[0];
            if($i == 5)
                break;
            $i++;
        }
    }

    public function getListByCategoryID($categoryID)
    {
        return $this->where('category_id', $categoryID)->orderBy('date_add', 'desc')->get();
    }

    public function getByID($id)
    {
        return $this->where('id', $id)->get()->first();
    }

    public function getByArticul($articul)
    {
        return $this->where('articul', $articul)->get()->first();
    }

    public function add($catID)
    {
        $product = new Product();
        $product->title = 'Название товара - ' . date('d.m.Y H:i');
        $product->category_id = $catID;
        $product->date_add = date('Y-m-d');
        $data = $product->save();
        if($data){
            return $product->id;
        }
    }

    public function updateProduct(Request $request, $id)
    {
        $input = $request->all();
        $product = $this->getByID($id);

        // is active or not
        if(empty($input['is_active'])){ $input['is_active'] = '0'; }

        // image upload
        $input['image'] = ProductImage::uploadProductImage($request, $id);

        // update product
        $result = $product->update($input);

        if($result){

            // update properties
            $props = new ProductProperty();
            $props->updateProdProps($id, $input['attr']);

            return $product->category_id;
        }

    }

    public function getRandom($qnt){
        return $this->all()->where('image', '<>', '')->where('articul', '<>', '')->random($qnt);
    }

    public function getAll(){
        /*return $this->where('image', '<>', '')
            ->where('articul', '<>', '')
            ->orderBy('date_add', 'desc')
            ->paginate(15);*/

        $productsList = DB::select(DB::raw("select pr.id, pr.title, pr.image, pr.price, pr.quantity, pr.articul, pr.category_id, pr.brand_id from azimi_products pr
                                    where pr.is_active = 1  
                                    order by pr.date_add desc limit 15"));

        // brands
        $listOfBrands = Product::select('brand_id')->where('is_active', 1)->distinct()->get()->toArray();
        $brands = Brand::select('title','slug')->whereIn('id', $listOfBrands)->orderBy('date_add','desc')->get();

        $props =  [
            'slug' => 'all',
            'parent' => '',
            'section' => '',
            'child' => '',
            'brand' => $brands,
        ];

        return [
            'productsList' => $productsList,
            'props' => $props
        ];
    }

    public function getBySlug($slug){

        $productsList = DB::select(DB::raw("select pr.id, pr.title, pr.image, pr.price, pr.quantity, pr.articul, pr.category_id, pr.brand_id from azimi_products pr
                                    where pr.category_id in  ( 
                                            select t3.id from azimi_categories t3
                                            where  t3.slug = '".$slug."'
                                            union all 
                                            select t3.id from azimi_categories t2
                                            left join azimi_categories t3 on t3.parent_id = t2.id
                                            where t2.slug = '".$slug."'
                                            union all 
                                            select t3.id from azimi_categories t1
                                            left join azimi_categories t2 on t2.parent_id = t1.id
                                            left join azimi_categories t3 on t3.parent_id = t2.id
                                            where t1.parent_id = 0 and t1.slug = '".$slug."'
                                    )
                                    and pr.is_active = 1  
                                    order by pr.date_add desc limit 15"));

        // selected cats
        $parent = '';
        $section = '';
        $child = '';
        $brands = '';

        $category = DB::select(DB::raw("select t3.slug as slug from azimi_categories t3 where t3.parent_id = 0 and t3.slug = '".$slug."'"));
        if(count($category) > 0){

            $queryBrands = DB::select(DB::raw("select m.title, m.slug from azimi_brands m
                                    inner join(select  DISTINCT pr.brand_id as brand_id from azimi_products pr
                                    where pr.category_id in  (
                                            select t1.id from azimi_categories t1 where t1.parent_id in (
                                            select t3.id from azimi_categories t2
                                            left join azimi_categories t3 on t3.parent_id = t2.id
                                            where t2.slug in  ('".$slug."')
                                            )
                                    )
									and pr.is_active = 1) ttt on ttt.brand_id = m.id"));
            $parent =  $slug;
            $brands = $queryBrands ;
        }

        $category = DB::select(DB::raw("select t2.slug from azimi_categories t3
                                            inner join azimi_categories t2 on t3.parent_id = t2.id 
                                            and t2.parent_id = 0 
                                            where t3.parent_id > 0 and t3.slug = '".$slug."'"));
        if(count($category) > 0){
            $queryBrands = DB::select(DB::raw("select m.title, m.slug from azimi_brands m 
                                    inner join (select DISTINCT pr.brand_id as brand_id from azimi_products pr
                                    where pr.category_id in  (
                                            select t1.id from azimi_categories t1 where t1.parent_id in (
                                            select t2.id from azimi_categories t2
												where t2.slug in  ('".$slug."')
                                            )
                                    )
									and pr.is_active = 1) ttt on ttt.brand_id = m.id"));
            $parent =  $category[0]->slug;
            $section =  $slug;
            $brands = $queryBrands;
        }

        $category = DB::select(DB::raw("select t2.slug, t1.slug as parentSlug from azimi_categories t3
                                            inner join azimi_categories t2 on t3.parent_id = t2.id  and t2.parent_id > 0
                                            inner join azimi_categories t1 on t2.parent_id = t1.id 
                                            and t1.parent_id = 0                                             
                                            where t3.parent_id > 0 and t3.slug = '".$slug."'"));
        if(count($category) > 0){
            $queryBrands = DB::select(DB::raw("select m.title, m.slug from azimi_brands m 
                                    inner join (select DISTINCT pr.brand_id as brand_id  from azimi_products pr
                                    where pr.category_id in  (
                                            select t1.id from azimi_categories t1 where t1.slug in  ('".$slug."')
                                    )                                    
									and pr.is_active = 1) ttt on ttt.brand_id = m.id"));
            $parent = $category[0]->parentSlug;
            $section = $category[0]->slug;
            $child = $slug;
            $brands = $queryBrands ;
        }

        $props =  [
            'slug' => '',
            'parent' => $parent,
            'section' => $section,
            'child' => $child,
            'brand' => $brands,
        ];

        return [
            'productsList' => $productsList,
            'props' => $props
        ];
    }

    public function filtered($input){
        // categories
        $parent  = trim( implode ("','", explode(',', $input['cat_parent'])) ) ;
        $parentrep = str_replace("''", "", str_replace("','", "", $parent));

        $section  = trim(  implode ("','", explode(',', $input['cat_section'])) );
        $sectionrep  = str_replace("','", "", $section);

        $child  = trim(  implode ("','", explode(',', $input['cat_child'])) );
        $childrep  = str_replace("','", "", $child);

        // page count (on load more)
        $page = 15 * (int)trim($input['page_count']);

        if(!empty($child)){
            $queryAll = "select pr.id, pr.title, pr.image, pr.price, pr.quantity, pr.articul, pr.category_id, pr.brand_id, (ifnull(pr.viewed ,0) + ifnull(pr.sold, 0)) as pp from azimi_products pr
                                    where pr.category_id in  (
                                            select t1.id from azimi_categories t1 where (t1.slug in ('".$child."') or '".$childrep."' = '')
                                    ) 
                                    and pr.is_active = 1 
                                    order by pr.date_add desc, pp desc";
            $query = $queryAll .  " limit " . $page . ", 15";
        }
        else if(!empty($section)){
            $queryAll = "select pr.id, pr.title, pr.image, pr.price, pr.quantity, pr.articul, pr.category_id, pr.brand_id, (ifnull(pr.viewed ,0) + ifnull(pr.sold, 0)) as pp from azimi_products pr
                                    where pr.category_id in  (
                                            select t1.id from azimi_categories t1 where t1.parent_id in (
                                            select t2.id from azimi_categories t2
												where t2.slug in  ('".$section."')
                                            )
                                    ) 
                                    and pr.is_active = 1 
                                    order by pr.date_add desc, pp desc";
            $query = $queryAll .  " limit " . $page . ", 15";
        }
        else if(!empty($parent)){
            $queryAll = "select pr.id, pr.title, pr.image, pr.price, pr.quantity, pr.articul, pr.category_id, pr.brand_id, (ifnull(pr.viewed ,0) + ifnull(pr.sold, 0)) as pp from azimi_products pr
                                    where pr.category_id in  (
                                            select t1.id from azimi_categories t1 where t1.parent_id in (
                                            select t3.id from azimi_categories t2
                                            left join azimi_categories t3 on t3.parent_id = t2.id
                                            where t2.slug in  ('".$parent."')
                                            )
                                    )
                                    and pr.is_active = 1 
                                    order by pr.date_add desc, pp desc";
            $query = $queryAll .  " limit " . $page . ", 15";
        }
        else{
            $queryAll = "select pr.id, pr.title, pr.image, pr.price, pr.quantity, pr.articul, pr.category_id, pr.brand_id, (ifnull(pr.viewed ,0) + ifnull(pr.sold, 0)) as pp from azimi_products pr 
                                    where pr.is_active = 1 
                                    order by pr.date_add desc, pp desc";
            $query = $queryAll .  " limit " . $page . ", 15";
        }

        $data = DB::select(DB::raw($query));
        $dataAll = DB::select(DB::raw($queryAll));
        $cnt = (int)$input['page_count'] + 1;

        return [
            'data' => $data,
            'dataAll' => $dataAll,
            'cnt' => $cnt
        ];
    }

    public function getPopularProducts(){
        $popularCategories = DB::select(DB::raw( "select ct.id, ct.title, ct.slug, max(pr.maxx) as pp from
                                (
                                select category_id, max(ifnull(viewed ,0) + ifnull(sold, 0)) as maxx from azimi_products where is_active = 1 
                                group by category_id
                                ) pr 
                                inner join (
                                select t1.id, t2.id as sub, t3.id  as subsub, t1.slug, t1.title from azimi_categories t1
                                left join azimi_categories t2 on t2.parent_id = t1.id and t2.is_active = 1
                                left join azimi_categories t3 on t3.parent_id = t2.id and t3.is_active = 1
                                where t1.parent_id = 0 and t1.is_active = 1
                                ) ct on pr.category_id = ct.subsub                                                                 
                                group by ct.id
                                order by pp desc
                                limit 4" ));

        $allPopularProducts = DB::select(DB::raw( " select id, category_id, title, image, price, articul, quantity, (ifnull(viewed ,0) + ifnull(sold, 0)) as pp from azimi_products where is_active = 1
                                order by pp desc
                                limit  10"));

        $popularProductCategories = [];
        foreach($popularCategories as $item){
            $popularProductCategories[$item->id] = DB::select(DB::raw("select pr.id, pr.category_id, pr.title, pr.image, pr.price, pr.articul, pr.quantity,  (ifnull(viewed ,0) + ifnull(sold, 0)) as pp from azimi_products pr
                                    
                                    where pr.category_id in  ( 
                                            select t3.id from azimi_categories t3
                                            where t3.id = ".$item->id."
                                            union all 
                                            select t3.id from azimi_categories t2
                                            left join azimi_categories t3 on t3.parent_id = t2.id
                                            where t2.id = ".$item->id."
                                            union all 
                                            select t3.id from azimi_categories t1
                                            left join azimi_categories t2 on t2.parent_id = t1.id
                                            left join azimi_categories t3 on t3.parent_id = t2.id
                                            where t1.parent_id = 0 and t1.id = ".$item->id."
                                    ) 
                                    and pr.image is not null and pr.is_active = 1 and pr.price > 0
                                    order by pp desc limit 10"));
        }

        return [
            'popularCategories' => $popularCategories,
            'allPopularProducts' => $allPopularProducts,
            'popularProductCategories' => $popularProductCategories
        ];

    }

    public function getNewProducts(){
        $newCategories = DB::select(DB::raw( "select ct.id, ct.title, ct.slug from
                                (
                                select category_id from azimi_products where is_active = 1 group by category_id
                                ) pr 
                                inner join (
                                select t1.id, t2.id as sub, t3.id  as subsub, t1.slug, t1.title from azimi_categories t1
                                left join azimi_categories t2 on t2.parent_id = t1.id and t2.is_active = 1
                                left join azimi_categories t3 on t3.parent_id = t2.id and t3.is_active = 1
                                where t1.parent_id = 0 and t1.is_active = 1
                                ) ct on pr.category_id = ct.subsub                                                                 
                                group by ct.id  
                                limit 4" ));

        $allNewProducts = DB::select(DB::raw( " select id, title, category_id, image, price, articul, quantity, date_add as newDate from azimi_products where is_active = 1
                                order by newDate desc
                                limit  10"));

        $newProductCategories = [];
        foreach($newCategories as $item){
            $newProductCategories[$item->id] = DB::select(DB::raw("select pr.id, pr.title, pr.category_id, pr.image, pr.price, pr.articul, pr.quantity, pr.date_add as newDate from azimi_products pr
                                    
                                    where pr.category_id in  ( 
                                            select t3.id from azimi_categories t3
                                            where t3.id = ".$item->id."
                                            union all 
                                            select t3.id from azimi_categories t2
                                            left join azimi_categories t3 on t3.parent_id = t2.id
                                            where t2.id = ".$item->id."
                                            union all 
                                            select t3.id from azimi_categories t1
                                            left join azimi_categories t2 on t2.parent_id = t1.id
                                            left join azimi_categories t3 on t3.parent_id = t2.id
                                            where t1.parent_id = 0 and t1.id = ".$item->id."
                                    ) 
                                    and pr.image is not null and pr.is_active = 1 and pr.price > 0
                                    order by newDate desc limit 10"));
        }

        return [
            'newCategories' => $newCategories,
            'allNewProducts' => $allNewProducts,
            'newProductCategories' => $newProductCategories
        ];

    }

    public function getBestSellers(){
        return DB::select(DB::raw( " select id, title, category_id, image, price, articul, quantity, ifnull(sold, 0) as pp from azimi_products where is_active = 1
                                order by pp desc
                                limit  7"));
    }

    public static function getReview($id){
        if(!empty($id)){
            $reviews = Review::where('product_id', $id)->get();
            if(count($reviews) > 0)
            {
                $cnt = count($reviews);
                $rating = 0;
                foreach ($reviews as $key => $item){
                    $rating = $rating + (int)$item->point;
                }
                $point = round($rating/$cnt);

                $star = [];
                for($i=1; $i <= 5; $i++){
                    if($point >= $i){
                        $star[$i] = 'gold';
                    }
                    else{
                        $star[$i] = 'grey';
                    }
                }
                $rewText = $cnt . ' ' . sklonenie($cnt);
            }
            else{
                $star = [];
                for($i=1; $i <= 5; $i++){
                    $star[$i] = 'grey';
                }
                $rewText = 'Нет отзыва';
            }
            return [
                'star' => $star,
                'text' => $rewText
            ];
        }
    }

    public function getListByIds($ids)
    {
        return $this->whereIn('id', $ids)->get();
    }

    public function searchProduct($searchText)
    {
        return $this->where('title', 'LIKE', "%$searchText%")
            ->orWhere('description', 'LIKE', "%$searchText%")
            ->where('is_active', 1)
            ->orderBy('date_add', 'desc')
            ->paginate(15);
    }


}
