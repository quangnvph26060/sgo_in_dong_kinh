<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BulkOperationController extends Controller
{
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'model' => 'required'
        ]);

        $ids = $request->input('ids', []);
        $modelName = $request->model;
        $modelClass = "App\\Models\\$modelName";

        if (!class_exists($modelClass)) {
            return response()->json(['message' => 'Model không tồn tại'], 400);
        }

        if (!is_array($ids) || empty($ids)) {
            return response()->json(['message' => 'Danh sách ID không hợp lệ'], 400);
        }

        $modelClass::whereIn('id', $ids)->withoutGlobalScope('published')->delete();
        return response()->json(['message' => 'Xóa thành công']);
    }
}
