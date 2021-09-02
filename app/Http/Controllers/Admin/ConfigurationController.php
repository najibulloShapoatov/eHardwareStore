<?php

namespace App\Http\Controllers\Admin;

use App\Models\Configuration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigurationController extends Controller
{
    public function index()
    {
        $config = Configuration::findOrFail(1);
        return view('admin.config.index', compact('config'));
    }

    public function save(Request $request)
    {
        $input = $request->all();
        $setting = Configuration::findOrFail(1);
        $setting->update($input);
        return redirect('admin/config')->with(['success_message' => 'Сохранен!']);
    }
}
