<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormFields extends Model
{

    public function renderField($type, $id, $title, $values, $currentItem){
        $html = '';

        switch ($type){

            case 'select':
                $html .= '<div class="form-group">
                    <label class="col-sm-4 control-label">'.$title.':</label>
                    <div class="col-sm-8">';
                $html .= '<select name="attr['.$id.']" class="form-control" id="id_'.$id.'">';
                foreach ($values as $item){
                    $selected = '';
                    if(!empty($currentItem)){
                        if($currentItem[0]['attribute_value'] == $item['attribute_value'])
                            $selected = 'selected="selected"';
                    }
                    $html .= '<option value="'.$item['attribute_value'].'" '.$selected.'>'.$item['attribute_value'].'</option>';
                }
                $html .= '</select>';
                $html .= '</div>
                </div>';
                break;

            case 'text':
                if(!empty($currentItem)){
                    $value = $currentItem[0]['attribute_value'];
                }
                else{
                    $value = '';
                }

                $html .= '<div class="form-group">
                    <label for="" class="col-sm-4 control-label">'.$title.':</label>
                    <div class="col-sm-8">';
                $html .= '<input class="form-control" name="attr['.$id.']" type="text" value="'.$value.'" id="id_'.$id.'">';
                $html .= '</div>
                </div>';
                break;

            case 'checkbox':
                if(!empty($currentItem[0]['attribute_value'])){
                    $checked = 'checked="checked"';
                    $value = $currentItem[0]['attribute_value'];
                }
                else{
                    $checked = '';
                    $value = '';
                }

                $html .= '<div class="form-group">
                    <label for="" class="col-sm-4 control-label">'.$title.':</label>
                    <div class="col-sm-8">';
                $html .= '<input id="id_'.$id.'" name="attr['.$id.']" type="checkbox" value="'.$value.'" '.$checked.'>';
                $html .= '</div>
                </div>';
                break;

            case 'radio':
                $html .= '<div class="form-group">
                    <label class="col-sm-4 control-label">'.$title.':</label>
                    <div class="col-sm-8">';
                foreach ($values as $item){
                    $selected = '';
                    if(!empty($currentItem)){
                        if(!empty($currentItem)){
                            if($currentItem[0]['attribute_value'] == $item['attribute_value'])
                                $selected = 'checked="checked"';
                        }
                    }

                    $html .= '<div class="radio radio-primary">
                                <input type="radio" '.$selected.' name="attr['.$id.']" id="'.$item['attribute_value'].'" value="'.$item['attribute_value'].'">
                                <label for="'.$item['attribute_value'].'">'.$item['attribute_value'].'</label>
                            </div>';
                }
                $html .= '</div>
                    </div>';
                break;

            case 'multiple':

                $arr = [];
                foreach ($currentItem as $item){
                    $arr[] = $item['attribute_value'];
                }

                $html .= '<div class="form-group">
                    <label class="col-sm-4 control-label">'.$title.':</label>
                    <div class="col-sm-8">
                        <select name="attr['.$id.'][]" class="select2 form-control" multiple="multiple" data-placeholder="Выберите ...">';
                foreach ($values as $item){

                    if(in_array($item['attribute_value'], $arr)){
                        $selected = 'selected="selected"';
                    }
                    else{
                        $selected = '';
                    }

                    $html .= '<option value="'.$item['attribute_value'].'" '.$selected.'>'.$item['attribute_value'].'</option>';
                }
                $html .= '</select></div>
                    </div>';

                break;

        }

        return $html;
    }

    public function renderFrontField($type, $id, $title, $values, $currentItem){
        $html = '';

        switch ($type){

            case 'select':
                $html .= '<div class="spec__row">
                    <div class="spec__name">'.$title.'</div>
                    <div class="spec__value">';
                foreach ($values as $item){
                    if(!empty($currentItem)){
                        if($currentItem[0]['attribute_value'] == $item['attribute_value']){
                            $html .= $item['attribute_value'];
                        }
                    }
                }
                $html .= '</div>
                </div>';
                break;

            case 'text':
                if(!empty($currentItem)){
                    $value = $currentItem[0]['attribute_value'];
                }
                else{
                    $value = '';
                }

                $html .= '<div class="spec__row">
                    <div class="spec__name">'.$title.'</div>
                    <div class="spec__value">';
                $html .= ($value != "") ? $value : '-';
                $html .= '</div>
                </div>';
                break;

            case 'checkbox':
                if(!empty($currentItem[0]['attribute_value'])){
                    $checked = 'checked="checked"';
                    $value = $currentItem[0]['attribute_value'];
                }
                else{
                    $checked = '';
                    $value = '';
                }

                $html .= '<div class="form-group">
                    <label for="" class="col-sm-4 control-label">'.$title.':</label>
                    <div class="col-sm-8">';
                $html .= '<input id="id_'.$id.'" name="attr['.$id.']" type="checkbox" value="'.$value.'" '.$checked.'>';
                $html .= '</div>
                </div>';
                break;

            case 'radio':
                $html .= '<div class="spec__row">
                    <div class="spec__name">'.$title.'</div>
                    <div class="spec__value">';
                foreach ($values as $item){
                    if(!empty($currentItem)){
                        if(!empty($currentItem)){
                            if($currentItem[0]['attribute_value'] == $item['attribute_value']){
                                $html .= $item['attribute_value'];
                            }
                        }
                    }
                }
                $html .= '</div>
                    </div>';
                break;

            case 'multiple':

                $arr = [];
                foreach ($currentItem as $item){
                    $arr[] = $item['attribute_value'];
                }

                $html .= '<div class="spec__row">
                    <div class="spec__name">'.$title.'</div>
                    <div class="spec__value">';
                        foreach ($values as $item){
                            if(in_array($item['attribute_value'], $arr)){
                                $html .= $item['attribute_value'] . ', ';
                            }
                        }
                $html .= '</div>
                </div>';

                break;

        }

        return $html;
    }

    public function renderViewFrontField($type, $id, $title, $values, $currentItem){
        $html = '';
        $array = [];

        switch ($type){

            case 'select':
                $html .= '<li><span>'.$title.': </span>';
                foreach ($values as $item){
                    if(!empty($currentItem)){
                        if($currentItem[0]['attribute_value'] == $item['attribute_value']){
                            $html .= $item['attribute_value'];
                        }
                    }
                }
                $html .= '</li>';
                break;

            case 'text':
                if(!empty($currentItem)){
                    $value = $currentItem[0]['attribute_value'];
                }
                else{
                    $value = '';
                }

                $html .= '<li><span>'.$title.': </span>';
                $html .= ($value != "") ? $value : '-';
                $html .= '</li>';
                break;

            case 'checkbox':
                if(!empty($currentItem[0]['attribute_value'])){
                    $checked = 'checked="checked"';
                    $value = $currentItem[0]['attribute_value'];
                }
                else{
                    $checked = '';
                    $value = '';
                }

                $html .= '<li><span>'.$title.': </span>';
                $html .= '<input id="id_'.$id.'" name="attr['.$id.']" type="checkbox" value="'.$value.'" '.$checked.'>';
                $html .= '</li>';
                break;

            case 'radio':
                $html .= '<li><span>'.$title.': </span>';
                foreach ($values as $item){
                    if(!empty($currentItem)){
                        if(!empty($currentItem)){
                            if($currentItem[0]['attribute_value'] == $item['attribute_value']){
                                $html .= $item['attribute_value'];
                            }
                        }
                    }
                }
                $html .= '</li>';
                break;

            case 'multiple':

                $arr = [];
                foreach ($currentItem as $item){
                    $arr[] = $item['attribute_value'];
                }

                $html .= '<li><span>'.$title.': </span>';
                foreach ($values as $item){
                    if(in_array($item['attribute_value'], $arr)){
                        $html .= $item['attribute_value'] . ', ';
                    }
                }
                $html .= '</li>';
                break;
        }

        $array[] = $html;

        return $array;
    }

}