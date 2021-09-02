<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    protected $fillable = [
        'parent_id',
        'sort_order',
        'title',
        'slug',
        'image',
        'description',
        'is_active',
        'main'
    ];

    public function getByID($id)
    {
        return $this->where('id', $id)->get()->first();
    }

    public function getList()
    {
        $cats = DB::table('categories as t1')
            ->select(
                't1.id',
                        't1.sort_order',
                        't1.title',
                        't1.slug',
                        't1.image',
                        't1.is_active',
                        't2.id as sub',
                        't2.title as subname',
                        't2.slug as subslug',
                        't2.is_active as sub_active',
                        't3.id as subsub',
                        't3.title as subsubname',
                        't3.slug as subsubslug',
                        't3.is_active as subsub_active'
            )
            ->leftJoin('categories as t2', 't1.id', '=', 't2.parent_id')
            ->leftJoin('categories as t3', 't2.id', '=', 't3.parent_id')
            ->where(['t1.parent_id' => 0])
            ->orderBy('t1.sort_order', 'asc')
            ->orderBy('t2.sort_order', 'asc')
            ->orderBy('t3.sort_order', 'asc')
            ->get();

        $categories = array();
        foreach ($cats as $mitem) {
            $categories[$mitem->id]['id'] = $mitem->id;
            $categories[$mitem->id]['sort_order'] = $mitem->sort_order;
            $categories[$mitem->id]['title'] = $mitem->title;
            $categories[$mitem->id]['slug'] = $mitem->slug;
            $categories[$mitem->id]['image'] = $mitem->image;
            $categories[$mitem->id]['is_active'] = $mitem->is_active;

            if ($mitem->subname != null && $mitem->subname != '') {
                if(empty($categories[$mitem->id]['child'][$mitem->sub])){
                    $categories[$mitem->id]['child'][$mitem->sub] = [
                        'id' => $mitem->sub,
                        'title' => $mitem->subname,
                        'slug' => $mitem->subslug,
                        'is_active' => $mitem->sub_active
                    ];
                }
            }

            if ($mitem->subsubname != null && $mitem->subsubname != '') {
                $categories[$mitem->id]['child'][$mitem->sub]['child'][$mitem->subsub] = [
                    'id' => $mitem->subsub,
                    'title' => $mitem->subsubname,
                    'slug' => $mitem->subsubslug,
                    'is_active' => $mitem->subsub_active
                ];
            }
        }

        return $categories;
    }

    public function getCategory($id)
    {

        $parent = '';
        $section = '';
        $child = '';

        // parent category (1 lvl)
        $category = DB::select(DB::raw("select t3.id, t3.title from azimi_categories t3
                                            where t3.parent_id = 0 and t3.id = '".$id."'"));
        if(count($category) > 0){
            $parent =  [
                'id' => $id,
                'title' => $category[0]->title
            ];
        }

        // section (2 lvl)
        $category = DB::select(DB::raw("select t2.id as pID, t2.title as pTitle, t3.id as sID, t3.title as sTitle from azimi_categories t3
                                            inner join azimi_categories t2 on t3.parent_id = t2.id 
                                            and t2.parent_id = 0 
                                            where t3.parent_id > 0 and t3.id = '".$id."'"));
        if(count($category) > 0){
            $parent =  [
                'id' => $category[0]->pID,
                'title' => $category[0]->pTitle
            ];
            $section =  [
                'id' => $category[0]->sID,
                'title' => $category[0]->sTitle
            ];
        }

        $category = DB::select(DB::raw("select 
                                                t1.id as pID, t1.title as pTitle, 
                                                t2.id as sID, t2.title as sTitle, 
                                                t3.id as cID, t3.title as cTitle 
                                                from azimi_categories t3
                                            inner join azimi_categories t2 on t3.parent_id = t2.id  and t2.parent_id > 0
                                            inner join azimi_categories t1 on t2.parent_id = t1.id 
                                            and t1.parent_id = 0                                             
                                            where t3.parent_id > 0 and t3.id = '".$id."'"));

        if(count($category) > 0){
            $parent =  [
                'id' => $category[0]->pID,
                'title' => $category[0]->pTitle
            ];
            $section =  [
                'id' => $category[0]->sID,
                'title' => $category[0]->sTitle
            ];
            $child = [
                'id' => $category[0]->cID,
                'title' => $category[0]->cTitle
            ];
        }

        return [
            'info' => $this->where('id', $id)->get()->first()->toArray(),
            'cats' => $this->where('parent_id', $id)->orderBy('sort_order', 'asc')->get()->toArray(),
            //'products' => $products->toArray(),
            'parent' => $parent,
            'section' => $section,
            'child' => $child,
            //'category' => $category
        ];
    }

    public function store(Request $request)
    {
        $input = $request->all();

        // upload image
        if($file = $request->file('image')){
            $image_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move('public/uploads/category/', $image_name);
            $input['image'] = $image_name;
        }

        $input['image'] = ($input['image'] != 'undefined') ? $input['image'] : '';

        // insert
        $result = $this->create($input);

        if($result){
            return ['sts' => 1, 'parent_id' => $input['parent_id']];
        }

    }

    public function updateCategory(Request $request)
    {
        $input = $request->all();
        $category = $this->getByID($input['id']);

        // upload image
        if($file = $request->file('image')){
            $image_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move('public/uploads/category/', $image_name);
            $input['image'] = $image_name;
        }

        if($input['image'] == 'undefined' || $input['image'] == ''){
            $input['image'] = $category->image;
        }

        // update
        $result = $category->update($input);

        if($result){
            return ['sts' => 1, 'parent_id' => $input['parent_id'], 'input' => $input];
        }

    }

    public function getMain(){
        $cats = DB::table('categories as t1')
            ->select(
                't1.id',
                't1.sort_order',
                't1.title',
                't1.slug',
                't1.image',
                't1.is_active',
                't2.id as sub',
                't2.title as subname',
                't2.slug as subslug',
                't2.is_active as sub_active'
            )
            ->leftJoin('categories as t2', 't1.id', '=', 't2.parent_id')
            ->where(['t1.parent_id' => 0, 't1.main' => 1])
            ->orderBy('t1.sort_order', 'asc')
            ->orderBy('t2.sort_order', 'asc')
            ->get();

        $categories = array();
        foreach ($cats as $mitem) {
            $categories[$mitem->id]['id'] = $mitem->id;
            $categories[$mitem->id]['sort_order'] = $mitem->sort_order;
            $categories[$mitem->id]['title'] = $mitem->title;
            $categories[$mitem->id]['slug'] = $mitem->slug;
            $categories[$mitem->id]['image'] = $mitem->image;
            $categories[$mitem->id]['is_active'] = $mitem->is_active;

            if ($mitem->subname != null && $mitem->subname != '') {
                if(empty($categories[$mitem->id]['child'][$mitem->sub])){
                    $categories[$mitem->id]['child'][$mitem->sub] = [
                        'id' => $mitem->sub,
                        'title' => $mitem->subname,
                        'slug' => $mitem->subslug,
                        'is_active' => $mitem->sub_active
                    ];
                }
            }

        }

        return $categories;
    }

    public function prodBreadcrumb($catID)
    {
        $category = DB::select(DB::raw("SELECT 
                                                t1.title as parent_title,  t1.slug as parent_slug, 
                                                t2.title as section_title,  t2.slug as section_slug,
                                                t3.title as child_title,  t3.slug as child_slug 
                                                FROM azimi_categories t1
                                                INNER JOIN azimi_categories t2 ON t1.id = t2.parent_id
                                                INNER JOIN azimi_categories t3 ON t2.id = t3.parent_id
                                                AND t3.id = '" . $catID . "'"));
        return [
            'parent' => $category[0]->parent_slug,
            'section' => $category[0]->section_slug,
            'child' => $category[0]->child_slug
        ];
    }

}
