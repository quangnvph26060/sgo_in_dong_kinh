<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Partner::select(['id', 'image', 'name', 'status', 'location', 'created_at'])->orderBy('location', 'asc');

            return datatables()->of($query)
                ->addColumn('image', function ($row) {
                    return '<img src="' . showImage($row->image) . '" class="img-fluid" style="width: 50px; height: 50px;" />';
                })
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
                ->addColumn('location', function ($row) {
                    return $row->location ?? 'Không có';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <div class="btn-group">
                            <button class="btn btn-primary btn-sm edit-btn" data-id="' . $row->id . '">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-sm delete-btn" data-url="' . route('admin.partners.delete', $row->id) . '">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    ';
                })
                ->rawColumns(['status', 'action', 'image'])
                ->addIndexColumn()
                ->make(true);
        }


        return view('backend.partner.index');
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
    public function save(Request $request, $id = null)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:partners,name,' . $id,
            'location' => 'required|string|max:255',
            'status' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'location' => $request->location,
            'status' => $request->status == 'on' ? 1 : 0,
        ];

        if ($request->hasFile('image')) {
            $oldImage = $id ? Partner::findOrFail($id)->image : null;
            $data['image'] = saveImage($request, 'image', 'partners');

            if ($oldImage) {
                deleteImage($oldImage);
            }
        }

        $partner = Partner::updateOrCreate(['id' => $id], $data);

        return response()->json([
            'success' => true,
            'message' => $id ? 'Đã cập nhật đối tác thành công.' : 'Đã tạo đối tác thành công.'
        ]);
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
    public function edit($id)
    {
        $partner = Partner::findOrFail($id);

        $partner->image = showImage($partner->image);
        return response()->json([
            'success' => true,
            'data' => $partner
        ]);
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

    public function updateLocations(Request $request)
    {
        try {
            $locations = $request->locations;

            foreach ($locations as $location) {
                Partner::where('id', $location['id'])->update(['location' => $location['location']]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        $partner = Partner::findOrFail($id);
        $partner->delete();
        return response()->json([
            'success' => true,
            'message' => 'Đối tác đã được xóa thành công!'
        ]);
    }

    public function updateStatus(Request $request)
    {
        $partner = Partner::findOrFail($request->id);
        $partner->status = $request->status;
        $partner->save();
        return response()->json([
            'success' => true,
            'message' => 'Trạng thái đã được cập nhật!'
        ]);
    }
}
