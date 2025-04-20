<?php

use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Filesystem\FilesystemAdapter;
use Carbon\Carbon;



if (!function_exists('saveImages')) {
    function saveImages($request, string $inputName, string $directory = 'images', $width = 150, $height = 150, $isArray = false, $resize = false)
    {
        $paths = [];

        if ($request->hasFile($inputName)) {
            $images = $request->file($inputName);
            if (!is_array($images)) {
                $images = [$images];
            }

            $manager = new ImageManager(['driver' => 'gd']);

            foreach ($images as $key => $image) {
                $img = $manager->make($image->getRealPath());

                // Resize nếu $resize = true
                if ($resize) {
                    $img->resize($width, $height);
                }

                $filename = time() . uniqid() . '.' . 'webp';

                Storage::disk('public')->put($directory . '/' . $filename, $img->encode());

                $paths[$key] = $directory . '/' . $filename;
            }

            return $isArray ? $paths : $paths[0] ?? null;
        }

        return null;
    }
}


function saveImage($request, string $inputName, string $directory = 'images')
{
    if ($request->hasFile($inputName)) {
        $image = $request->file($inputName);
        $filename = time() . uniqid() . '.' . 'webp';
        Storage::disk('public')->put($directory . '/' . $filename, file_get_contents($image->getPathName()));
        return $directory . '/' . $filename;
    }
}

function saveImagesWithoutResize($request, string $inputName, string $directory = 'images', $isArray = false)
{
    $paths = [];

    // Kiểm tra xem có file không
    if ($request->hasFile($inputName)) {
        // Lấy tất cả các file hình ảnh
        $images = $request->file($inputName);

        if (!is_array($images)) {
            $images = [$images]; // Đưa vào mảng nếu chỉ có 1 ảnh
        }

        foreach ($images as $key => $image) {
            // Tạo tên file duy nhất
            $filename = time() . uniqid() . '.' . 'webp';

            // Lưu ảnh vào storage
            Storage::disk('public')->putFileAs($directory, $image, $filename);

            // Lưu đường dẫn vào mảng
            $paths[$key] = $directory . '/' . $filename;
        }

        // Trả về danh sách các đường dẫn
        return $isArray ? $paths : $paths[0];
    }

    return null;
}


function showImage($path, $default = 'image-default.png')
{
    /** @var FilesystemAdapter $storage */
    $storage = Storage::disk('public');

    if ($path && Storage::exists($path)) {
        return $storage->url($path);
    }

    return asset('backend/assets/img/' . $default);
}

function getSize($path)
{
    if ($path && Storage::disk('public')->exists($path)) {
        $sizeInBytes = Storage::disk('public')->size($path);

        // Convert bytes to MB or GB
        if ($sizeInBytes >= 1073741824) {
            // GB
            return number_format($sizeInBytes / 1073741824, 2) . ' GB';
        } elseif ($sizeInBytes >= 1048576) {
            // MB
            return number_format($sizeInBytes / 1048576, 2) . ' MB';
        } elseif ($sizeInBytes >= 1024) {
            // KB
            return number_format($sizeInBytes / 1024, 2) . ' KB';
        } else {
            // Bytes
            return $sizeInBytes . ' bytes';
        }
    }

    return '0 MB'; // Return 0MB if file doesn't exist
}

function getImageDimensions($path)
{
    if ($path && Storage::exists($path)) {
        return getimagesize(showImage($path));
    }

    return null;
}


function deleteImage($path)
{
    if ($path && Storage::disk('public')->exists($path)) {
        Storage::disk('public')->delete($path);
    }
}

// Ví dụ trong Controller hoặc Model

function getYouTubeVideoId($url)
{
    // Kiểm tra nếu là URL của YouTube Shorts
    if (preg_match('/(?:https?:\/\/)?(?:www\.)?youtube\.com\/shorts\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
        return $matches[1];  // Trả về video ID
    }

    // Kiểm tra nếu là URL của video YouTube thông thường
    if (preg_match('/(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $url, $matches)) {
        return $matches[1];  // Trả về video ID
    }

    return null;  // Nếu không tìm thấy ID
}

function formatString($json = null)
{
    if (empty($json))  return null;

    $keywordsArray = json_decode($json, true);

    $keywordsString = implode(', ', array_column($keywordsArray, 'value'));

    return $keywordsString;
}

function generateSchema($type, $data)
{
    $schemas = [
        'WebPage' => [
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            'name' => $data['name'] ?? 'Default Page',
            'url' => $data['url'] ?? url('/')
        ],
        'Product' => [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $data['name'],
            'image' => $data['image'],
            'description' => $data['description'],
            'offers' => [
                '@type' => 'Offer',
                'priceCurrency' => 'VND',
                'price' => $data['price'],
                'availability' => 'https://schema.org/InStock'
            ]
        ]
    ];

    return $schemas[$type] ?? [];
}

function generateListSchema($products, $listName)
{
    $itemListElements = [];

    foreach ($products as $index => $product) {
        $itemListElements[] = [
            '@type' => 'ListItem',
            'position' => $index + 1,
            'item' => [
                '@type' => 'Product',
                'name' => $product->name,
                'image' => $product->main_image,
                'url' => route('product.detail', $product->slug),
                'description' => strip_tags($product->description),
                'offers' => [
                    '@type' => 'Offer',
                    'price' => $product->price,
                    'availability' => 'https://schema.org/InStock',
                ],
            ],
        ];
    }

    return [
        '@context' => 'https://schema.org',
        '@type' => 'ItemList',
        'name' => $listName,
        'url' => url()->current(),
        'itemListElement' => $itemListElements,
    ];
}

function formatName($name)
{

    $formattedString = preg_replace_callback('/\b\w/u', function ($matches) {
        return mb_strtoupper($matches[0]);
    }, $name);

    return ucfirst($formattedString);
}


function isOnSale($record)
{
    // Kiểm tra xem có discount_price không
    if ($record->sale_price > 0) {
        // Nếu không có start_date và end_date, có nghĩa là giảm giá vô thời gian
        if (empty($record->start_date) && empty($record->end_date)) {
            return true; // Giảm giá vô thời gian
        }

        // Nếu có start_date và end_date, kiểm tra theo thời gian
        if ($record->start_date && $record->end_date) {
            // Chuyển đổi start_date và end_date thành định dạng Carbon (d-m-Y)
            $discountStart = $record->start_date;
            $discountEnd =  $record->end_date;
            $now = Carbon::now(); // Thời gian hiện tại

            // Kiểm tra điều kiện giảm giá hợp lệ
            if ($discountStart->lte($now) && $discountEnd->gte($now)) {
                return true;
            }
        }

        if ($record->start_date && empty($record->end_date)) {
            $discountStart = $record->start_date;
            $now = Carbon::now(); // Thời gian hiện tại
            if ($discountStart->gt($now)) {
                return true; // Giảm giá bắt đầu trong tương lai
            }
        }

        // Nếu chỉ có end_date và không có start_date, kiểm tra end_date < thời gian hiện tại
        if (empty($record->start_date) && $record->end_date) {
            $discountEnd = $record->end_date;
            $now = Carbon::now(); // Thời gian hiện tại
            if ($discountEnd->lt($now)) {
                return true; // Giảm giá đã kết thúc
            }
        }
    }

    // Trả về false nếu không thỏa mãn điều kiện giảm giá
    return false;
}

function getDiscountPercentage($price, $sale_price)
{
    if ($price > 0 && $sale_price >= 0 && $sale_price < $price) {
        $discount = (($price - $sale_price) / $price) * 100;
        return round($discount); // Trả về số nguyên % giảm
    }

    return 0; // Trường hợp không giảm giá hoặc dữ liệu không hợp lệ
}

function formatPrice($price)
{
    return  number_format($price, 0, ',', '.');
}


function generateSKU($min = 3, $max = 8): string
{
    $length = rand($min, $max);

    $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';           // Chỉ chữ
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; // Chữ và số

    $sku = $letters[rand(0, strlen($letters) - 1)]; // Ký tự đầu tiên luôn là chữ

    for ($i = 1; $i < $length; $i++) {
        $sku .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $sku;
}

function extractIframeSrc(string $html): ?string
{
    preg_match('/<iframe[^>]+src="([^"]+)"/', $html, $matches);
    return $matches[1] ?? null;
}


function generateUniqueSKU(): string
{
    do {
        $sku = generateSKU();
    } while (\App\Models\Product::where('sku', $sku)->exists());

    return $sku;
}
