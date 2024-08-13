<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingAddRequest;
use App\Models\Setting;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request as FacadesRequest;

class SettingController extends Controller
{
    use DeleteModelTrait;
    private $setting;
    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }
    public function index(Request $request){
        $query = $request->input('query');
        $perPage = $request->get('perPage', 5);

        $settings = $this->setting->when($query, function ($q) use ($query) {
            $q->where('config_key', 'like', '%' . $query . '%')
              ->orWhere('config_value', 'like', '%' . $query . '%');
        })->latest()->paginate($perPage);

        return view('admin.setting.index', compact('settings', 'query', 'perPage'));
    }

    public function create(){
        return view('admin.setting.add');
    }

    public function store(SettingAddRequest $request){
        $this->setting->create([
            'config_key' => $request->config_key,
            'config_value' => $request->config_value,
            'type' => $request->type
        ]);

        return redirect()->route('setting.index');
    }

    public function edit($id){
        $setting = $this->setting->find($id);

        return view('admin.setting.edit', compact('setting'));
    }

    public function update(SettingAddRequest $request, $id){
        $this->setting->find($id)->update([
            'config_key' => $request->config_key,
            'config_value' => $request->config_value
        ]);

        return redirect()->route('setting.index');
    }

    public function delete($id){
        return $this->deleteModelTrait($this->setting, $id);
    }
}
