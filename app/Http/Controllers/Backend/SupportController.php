<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $supports = Support::query();
            return datatables()->of($supports)
                ->addIndexColumn() // Thêm số thứ tự
                ->addColumn('action', function ($row) {
                    return '
                        <div class="btn-group">
                        <button class="btn btn-danger btn-sm delete-btn" data-url="' . route('admin.supports.destroy', $row->id) . '">    <i class="fas fa-trash-alt"></i></button>
                        </div>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.support.index');
    }

    public function create()
    {
        $title = 'Thêm mới hỗ trợ';
        return view('backend.support.save', compact('title'));
    }

    public function store(Request $request)
    {
        $payloads =  $request->validate([
            'image' => 'required|image',
            'title' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        if ($request->hasFile('image')) {
            $payloads['image'] = saveImage($request, 'image', 'supports');
        }

        Support::create($payloads);

        toastr()->success('Hỗ trợ đã được thêm thành công.');

        return redirect()->route('admin.supports.index');
    }

    public function edit($id)
    {
        $support = Support::findOrFail($id);
        $title = 'Chỉnh sửa hỗ trợ';
        return view('backend.support.save', compact('support', 'title'));
    }

    public function update(Request $request, $id)
    {
        $payloads =  $request->validate([
            'image' => 'nullable|image',
            'title' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        $support = Support::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($support->image) {
                deleteImage($support->image);
            }
            $payloads['image'] = saveImage($request, 'image', 'supports');
        }

        $support->update($payloads);

        toastr()->success('Hỗ trợ đã được cập nhật thành công.');

        return redirect()->route('admin.supports.index');
    }

    public function destroy($id)
    {
        $support = Support::findOrFail($id);
        if ($support->image) {
            deleteImage($support->image);
        }
        $support->delete();

        return response()->json([
            'status' => true,
            'message' => 'Hỗ trợ đã được xóa thành công'
        ]);
    }
}
