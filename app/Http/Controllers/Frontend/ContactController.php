<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request as FacadeRequest;

class ContactController extends Controller
{
    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function postContact(Request $request)
    {
        // Lấy địa chỉ IP của client
        $ip = FacadeRequest::ip();

        // Kiểm tra xem IP này đã gửi trong vòng 15 phút chưa
        if (Cache::has("contact_ip:$ip")) {
            return response()->json([
                'errors' => [
                    'general' => ['Bạn chỉ được gửi liên hệ mỗi 15 phút một lần. Vui lòng thử lại sau.']
                ]
            ], 429);
        }

        // Validate
        $request->validate(
            [
                'your-name' => 'required|max:255',
                'your-phone' => 'required|regex:/^[0-9\-\+]{9,15}$/',
                'your-email' => 'required|email',
                'your-message' => 'required|max:2000',
            ],
            __('request.messages'),
            [
                'your-name' => 'Họ và Tên',
                'your-phone' => 'Số điện thoại',
                'your-email' => 'Email',
                'your-message' => 'Nội dung liên hệ',
            ]
        );

        // Lưu dữ liệu vào database
        Form::create([
            'name' => $request->input('your-name'),
            'phone' => $request->input('your-phone'),
            'email' => $request->input('your-email'),
            'message' => $request->input('your-message'),
            'ip' => $ip,
        ]);

        // Lưu IP vào cache để giới hạn gửi liên hệ
        Cache::put("contact_ip:$ip", true, now()->addMinutes(15));

        return response()->json(['message' => 'Liên hệ đã được gửi thành công.']);
    }
}
