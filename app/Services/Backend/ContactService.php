<?php

namespace App\Services\Backend;

use Exception;
use App\Models\Contact;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ContactService
{
    public function __construct(protected Contact $contact) {}

    public function show()
    {
        return $this->contact->firstOrFail();
    }

    public function update()
    {
        $payload = $this->payload();

        $dataOld = $this->contact->firstOrFail();

        DB::transaction(function () use ($payload, $dataOld) {
            try {
                if (isset($payload['logo'])) {
                    deleteImage($dataOld->logo);
                    $payload['logo'] = saveImage(request(), 'logo', 'logo');
                }

                if (isset($payload['icon'])) {
                    deleteImage($dataOld->icon);
                    $payload['icon'] = saveImage(request(), 'icon', 'icon');
                }
                if (isset($payload['banner'])) {
                    deleteImage($dataOld->banner);
                    $payload['banner'] = saveImage(request(), 'banner', 'banner');
                }

                $commits = [];
                $oldCommits = $dataOld->commits ?? [];

                if (isset($payload['commits'])) {
                    foreach ($payload['commits'] as $key => $commit) {
                        $image = null;

                        // Nếu có file ảnh được gửi lên, thì save ảnh mới
                        if (request()->hasFile("commits.$key.image")) {
                            // Xoá ảnh cũ nếu có
                            if (!empty($oldCommits[$key]['image'])) {
                                deleteImage($oldCommits[$key]['image']);
                            }

                            $image = saveImage(request(), "commits.$key.image", 'commits');
                        } elseif (!empty($oldCommits[$key]['image'])) {
                            // Nếu không gửi ảnh mới mà trong DB có ảnh, giữ lại ảnh cũ
                            $image = $oldCommits[$key]['image'];
                        }

                        $commits[] = [
                            'text' => $commit['text'],
                            'image' => $image,
                        ];
                    }

                    $payload['commits'] = $commits; // Gán lại vào payload để update xuống DB
                }

                if ($dataOld->update($payload)) {
                    return  toastr()->success('Cập nhật thông tin thành công');
                } else {
                    return toastr()->error('Cập nhật thông tin thất bại');
                }
            } catch (Exception $e) {
                Log::error('Failed to update this contact: ' . $e->getMessage() . ' - ' . $e->getLine());
                throw new Exception($e->getMessage());
            }
        });
    }

    private function payload()
    {
        return request()->except('_token', '_method');
    }
}
