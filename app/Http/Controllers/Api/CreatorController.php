<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\CreatorResource;
use Illuminate\Http\Request;

class CreatorController extends Controller
{
    public function show(int $id)
    {
        $author = User::findOrFail($id);
        return new CreatorResource($author);
    }
}
