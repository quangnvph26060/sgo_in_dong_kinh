<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Label;
use Exception;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
