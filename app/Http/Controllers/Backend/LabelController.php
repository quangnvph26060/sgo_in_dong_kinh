<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Label;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(Label::query())
                ->addIndexColumn()
                ->editColumn('image', fn($row) => '<img src="' . showImage($row->image) . '" class="img-fluid" width="50px" height="50px" />')
                ->addColumn('status', function ($row) {
                    return '
                    <div class="radio-container">
                        <label class="toggle">
                            <input type="checkbox" class="status-change update-status" data-id="' . $row->id . '" ' . ($row->status == 1 ? 'checked' : '') . '>
                            <span class="slider"></span>
                        </label>
                    </div>
                ';
                })
                ->editColumn('created_at', fn($row) => $row->created_at->format('d-m-Y H:i'))
                ->addColumn('action', fn($row) =>
                '
                        <div class="btn-group">
                            <button class="btn btn-danger btn-sm delete-btn" data-url="' . route('admin.labels.destroy', $row->id) . '">    <i class="fas fa-trash-alt"></i></button>
                        </div>
                ')
                ->rawColumns(['status', 'action', 'image'])
                ->make(true);
        }


        return view('backend.label.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.label.save');
    }

    protected function validated($request, $id = null)
    {
        return $request->validate(
            [
                'title' => 'required|max:255|unique:labels,title,' . $id,
                'position' => 'nullable|numeric',
                'description' => 'nullable|string|max:160',
                'product_id' => 'nullable|array',
                'product_id.*' => 'exists:sgo_products,id',
                'status' => 'required|in:1,2',
                'image' => 'nullable|image|mimes:jpg,png,webp|max:2048'
            ],
            __('request.messages'),
            [
                'title' => 'Tên nhãn',
                'position' => 'Vị trí',
                'description' => 'Mô tả',
                'product_id' => 'Sản phẩm',
                'status' => 'Trạng thái',
                'image' => 'Hình ảnh'
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $payloads  = $this->validated($request);

        $image = null;

        try {
            if ($request->hasFile('image')) {
                $image = saveImage($request, 'image', 'labels');
                $payloads['image'] = $image;
            }

            $payloads['position'] ??= 0;

            if ($label =  Label::create($payloads)) {
                $this->products($request, $label);
            }

            toastr()->success('Thao tác thành công.');

            return redirect()->route('admin.labels.index');
        } catch (Exception $e) {
            deleteImage($image);
            Log::error("message:" . $e->getMessage());
            toastr()->error('Thao tác thất bại!');
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $label = Label::query()->with('products')->findOrFail($id);

        $products = $label->products;

        return view('backend.label.save', compact('label', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $payloads  = $this->validated($request, $id);

        $label = Label::query()->findOrFail($id);

        $image = null;
        $oldImage = $label->image;

        try {
            if ($request->hasFile('image')) {
                $image = saveImage($request, 'image', 'labels');
                $payloads['image'] = $image;
            }

            $payloads['position'] ??= 0;

            if ($label->update($payloads)) {
                if (!empty($image)) deleteImage($oldImage);

                $this->products($request, $label);
            };

            toastr()->success('Thao tác thành công.');

            return redirect()->route('admin.labels.index');
        } catch (Exception $e) {

            deleteImage($image);

            Log::error("message:" . $e->getMessage());
            toastr()->error('Thao tác thất bại!');
            return back();
        }
    }

    protected function products($request, $label)
    {
        if ($request->has('product_id')) {
            $label->products()->sync($request->product_id);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $label = Label::query()->findOrFail($id);

            if ($label->delete()) {
                deleteImage($label->image);
            }

            return response()->json([
                'success' => true,
                'message' => 'Thao tác thành công.'
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Đã có lỗi xảy ra. Vui lòng thử lại sau!'
            ]);
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            $label = Label::query()->findOrFail($request->id);

            $label->status = $label->status == 1 ? 0 : 1;

            $label->save();

            return response()->json(['success' => true, 'message' => 'Cập nhật nhãn thành công']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Cập nhật nhãn thất bại']);
        }
    }
}
