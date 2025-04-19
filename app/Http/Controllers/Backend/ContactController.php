<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Backend\ContactService;

class ContactController extends Controller
{

    public function __construct(protected ContactService $contactService) {}

    public function show()
    {
        $data = $this->contactService->show();

        return view('backend.contact.show', compact('data'));
    }
    public function update(Request $request)
    {
        // , 'regex:/^0[0-9]{9}$/'
        $request->validate(
            [
                'hotline' => 'nullable',
                'title' => 'nullable',
                'email' => 'required|email',
                'phone' => 'required',
                'company' => 'required',
                'address' => 'required',
                'website' => 'nullable|url',
                'description' => 'nullable',
                'introduce' => 'nullable',
                'map' => 'nullable',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'seo_title' => 'nullable',
                'seo_description' => 'nullable',
                'copyright' => 'nullable',
                'working_time' => 'nullable',
                'commits' => 'nullable|array',
            ],
            __('request.messages'),
            [
                'hotline' => 'Số điện thoại',
                'title' => 'Tiêu đề',
                'email' => 'Email',
                'phone' => 'Số điện thoại',
                'company' => 'Tên công ty',
                'address' => 'Địa chỉ',
                'website' => 'Website',
                'description' => 'Mô tả ngắn',
                'map' => 'Bản đồ',
                'logo' => 'Logo',
                'icon' => 'Icon',
                'company_logo' => 'Logo công ty',
                'seo_title' => 'Tiêu đề seo',
                'seo_description' => 'Mô tả seo',
                'seo_keywords' => 'Từ khóa seo',
                'copyright' => 'Copyright',
                'working_time' => 'Thời gian làm việc',
            ]
        );

        $this->contactService->update();

        return back();
    }
}
