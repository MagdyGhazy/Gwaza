<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Skills;
use App\Models\User;
use App\Models\UserSkill;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SkillController extends Controller
{
    use UploadImage;

    public function index()
    {
        $skills = Skills::get();
        if ($skills) {
            return response()->json([
                'message' => 'successfully get',
                'skills' => $skills,
            ], 200);
        }
        return response()->json(['error' => error_get_last()], 401);


    }

    public function store(Request $request)
    {

        foreach ($request->skills as $skill) {
            $findSkills = DB::table('Skills')->where('name', $skill)->first();
            if ($findSkills == null) {
                $insertSkill = Skills::create(['name' => $skill]);
                $UserSkill = UserSkill::create([
                    'user_id' => auth()->guard('api')->user()->id,
                    'skills_id' => $insertSkill->id,
                ]);

            } else {
                $findUser = DB::table('user_skills')->where('user_id', auth()->guard('api')->user()->id)->first();

                if ($findUser == null) {
                    $UserSkill = UserSkill::create([
                        'user_id' => auth()->guard('api')->user()->id,
                        'skills_id' => $findSkills->id,
                    ]);
                }
            }
        }

        return response()->json(['message' => 'successfully add'], 201);
    }

    public function test(Request $request)
    {
        $imgPath = $this->uploadImage($request, 'Post/img');

        return response()->json(['message' => $imgPath], 200);

    }
}
