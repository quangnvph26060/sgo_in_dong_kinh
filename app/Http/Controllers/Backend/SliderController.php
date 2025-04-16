<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{

    // public function index()
    // {
    //     $sliders = \App\Models\Slider::latest()->get();
    //     return view('backend.slider.index', compact('sliders'));
    // }

    public function create()
    {
        $sliders = Slider::query()->orderByDesc('position')->get();

        return view('backend.slider.save', compact('sliders'));
    }
    public function save(Request $request)
    {
        $data = $request->all();

        dd($data);

        $sliders = $data['sliders'] ?? [];

        $request->validate(
            [
                'sliders.*.title' => 'nullable|string|max:255',
                'sliders.*.url' => 'nullable|url',
                'sliders.*.content' => 'nullable|string|max:1000',
                'sliders.*.button_text' => 'nullable|string|max:100',
                'sliders.*.position' => 'nullable|integer',
                'sliders.*.image' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ],
            __('request.messages'),
        );

        // Lấy tất cả ID đang có trong DB
        $existingIds = Slider::pluck('id')->toArray();

        // Lưu danh sách ID mới từ request để so sánh
        $incomingIds = array_keys($sliders);

        // Cập nhật hoặc tạo mới
        foreach ($sliders as $id => $slider) {
            // Nếu id không phải số (slider mới), tạo mới
            if (!is_numeric($id) || !in_array($id, $existingIds)) {
                $image = null;
                if ($request->hasFile("sliders.$id.image")) {
                    $image = saveImage($request, "sliders.$id.image", 'slider');
                }

                Slider::create([
                    'title' => $slider['title'] ?? null,
                    'url' => $slider['url'] ?? null,
                    'content' => $slider['content'] ?? null,
                    'button_text' => $slider['button_text'] ?? null,
                    'position' => $slider['position'] ?? 0,
                    'image' => $image,
                ]);
            } else {
                // Đã tồn tại => cập nhật
                $sliderModel = Slider::find($id);
                if (!$sliderModel) continue;

                $sliderModel->title = $slider['title'] ?? null;
                $sliderModel->url = $slider['url'] ?? null;
                $sliderModel->content = $slider['content'] ?? null;
                $sliderModel->button_text = $slider['button_text'] ?? null;
                $sliderModel->position = $slider['position'] ?? 0;

                if ($request->hasFile("sliders.$id.image")) {
                    // Xóa ảnh cũ nếu có
                    if ($sliderModel->image) {
                        deleteImage($sliderModel->image);
                    }

                    $sliderModel->image = saveImage($request, "sliders.$id.image", 'slider');
                }

                $sliderModel->save();
            }
        }

        // Xóa các slider không còn tồn tại trong danh sách gửi lên
        $slidersToDelete = array_diff($existingIds, $incomingIds);
        if (!empty($slidersToDelete)) {
            $slidersToDeleteModels = Slider::whereIn('id', $slidersToDelete)->get();
            foreach ($slidersToDeleteModels as $slider) {
                if ($slider->image) {
                    deleteImage($slider->image);
                }
                $slider->delete();
            }
        }

        return response()->json([
            'status' => true,
        ]);
    }
}
