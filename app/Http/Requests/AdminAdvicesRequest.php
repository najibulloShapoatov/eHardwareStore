<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AdminAdvicesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::check()){
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required',
            'advice_type_id' => 'required',
            'date_add' => 'required',
            'title' => 'required',
            'slug' => 'required|unique:advices',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024|dimensions:width=730,height=490'
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Выберите категорию',
            'advice_type_id.required' => 'Выберите тип совета',
            'date_add.required' => 'Введите дату',
            'title.required' => 'Введите заголовок',
            'slug.required' => 'Введите алиас',
            'slug.unique' => 'Алиас должен быть уникальным',
            'description.required' => 'Введите описание',
            'image.required' => 'Загрузите картину',
            'image.dimensions' => 'Картина доллжна быть 730x490 px',
            'image.mimes' => 'Формат картины должен быть (jpeg,png,jpg,gif)',
            'image.max' => 'Размер картины должна быть менее 1 МБ',
            'image.image' => 'Эй, вы че? Загрузите картину!',
        ];
    }
}
