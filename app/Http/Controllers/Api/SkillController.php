<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Skills;
use App\Models\User;
use App\Models\UserSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SkillController extends Controller
{
    public function index()
    {
        $user = User::find(2);
        return $user->skills;

    }
}
