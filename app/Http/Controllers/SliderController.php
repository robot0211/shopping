<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderAddRequest;
use App\Models\Slider;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SliderController extends Controller
{
    use DeleteModelTrait;
    use StorageImageTrait;
    private $slider;
    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    public function index(Request $request)
    {
        $query = $request->input('query');
        $perPage = $request->get('perPage', 5); // Default is 5

        $sliders = $this->slider->when($query, function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%')
              ->orWhere('description', 'like', '%' . $query . '%');
        })->latest()->paginate($perPage);

        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.add');
    }

    public function store(SliderAddRequest $request)
    {
        try {
            DB::beginTransaction();
            $dataSliderCreate = [
                'name' => $request->name,
                'description' => $request->description
            ];

            $dataUploadImageSlider = $this->storageTraitUpload($request, 'image_path', 'slider');
            if (!empty($dataUploadImageSlider)) {
                $dataSliderCreate += [
                    'image_name' => $dataUploadImageSlider['file_name'],
                    'image_path' => $dataUploadImageSlider['file_path']
                ];
            }

            $product = $this->slider->create($dataSliderCreate);
            DB::commit();
            return redirect()->route('slider.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . 'Line: ' . $exception->getLine());
        }
    }

    public function edit($id)
    {
        $slider = $this->slider->find($id);

        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataSliderUpdate = [
                'name' => $request->name,
                'description' => $request->description
            ];

            $dataUploadImageSlider = $this->storageTraitUpload($request, 'image_path', 'slider');
            if (!empty($dataUploadImageSlider)) {
                $dataSliderUpdate += [
                    'image_name' => $dataUploadImageSlider['file_name'],
                    'image_path' => $dataUploadImageSlider['file_path']
                ];
            }

            $product = $this->slider->find($id)->update($dataSliderUpdate);
            DB::commit();
            return redirect()->route('slider.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . 'Line: ' . $exception->getLine());
        }
    }

    public function delete($id)
    {
        return $this->deleteModelTrait($this->slider, $id);
    }
}
