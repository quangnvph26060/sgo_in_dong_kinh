<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\introStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IntroStepController extends Controller
{
    public function save()
    {
        $introSteps = introStep::first();
        return view('backend.intro-steps.save', compact('introSteps'));
    }

    public function update(Request $request)
    {
        $introStep = IntroStep::first();

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'contents' => 'required|array|size:3',
            'contents.*.title' => 'required|string|max:255',
            'contents.*.desc' => 'required|string',
            'contents.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'video_url' => 'nullable|file|mimes:mp4,webm,ogg|max:20000',
        ]);

        $contents = $request->input('contents');
        foreach ($contents as $i => &$step) {
            if ($request->hasFile("contents.$i.image")) {
                $file = $request->file("contents.$i.image");
                $filename = uniqid('intro_step_') . '.' . $file->getClientOriginalExtension();
                $path = "intro_steps/$filename";
                Storage::disk('public')->put($path, file_get_contents($file));
                $step['image'] = $path;
            } else {
                if (isset($introStep->content[$i]['image'])) {
                    $step['image'] = $introStep->content[$i]['image'];
                }
            }
        }

        $videoPath = $introStep->video_url ?? null;
        if ($request->hasFile('video_url')) {
            $video = $request->file('video_url');
            $filename = uniqid('intro_video_') . '.' . $video->getClientOriginalExtension();
            $videoPath = "intro_steps/videos/$filename";
            Storage::disk('public')->put($videoPath, file_get_contents($video));
        }

        if (!$introStep) {
            $introStep = new IntroStep();
        }
        $introStep->title = $data['title'];
        $introStep->content = json_encode($contents, JSON_UNESCAPED_UNICODE);
        $introStep->video_url = $videoPath;
        $introStep->save();

        return redirect()->back()->with('success', 'Lưu cấu hình thành công!');
    }
}
