<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AdminSlideshowRequest extends FormRequest
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
    public function rules()
    {
        return [
            'date_add' => 'required',
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024|dimensions:width=840,height=395',
            'image_mobile' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024|dimensions:width=400,height=400'
        ];
    }

    public function messages()
    {
        return [
            'date_add.required' => 'Введите дату',
            'title.required' => 'Введите заголовок',
            'image.required' => 'Загрузите картину',
            'image.dimensions' => 'Картина должна быть 840x395 px',
            'image.mimes' => 'Формат картины должен быть (jpeg,png,jpg,gif)',
            'image.max' => 'Размер картины должна быть менее 1 МБ',
            'image.image' => 'Эй, вы че? Загрузите картину!',
            'image_mobile.required' => 'Загрузите картину для моб.',
            'image_mobile.dimensions' => 'Картина для моб. должна быть 400x400 px',
            'image_mobile.mimes' => 'Формат картины для моб. должен быть (jpeg,png,jpg,gif)',
            'image_mobile.max' => 'Размер картины для моб. должна быть менее 1 МБ',
            'image_mobile.image' => 'Эй, вы че? Загрузите картину для моб.!',
        ];
    }
}
