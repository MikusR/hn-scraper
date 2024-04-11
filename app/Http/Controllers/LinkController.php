<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    public function index(): JsonResponse
    {
        $links = Link::where('points', '>', 10)->orderBy('points', 'desc')->get();
        return response()->json($links);
    }

    public function deleteLink(Link $link): JsonResponse
    {
        try {
            $link->delete();
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 418);
        }
        return response()->json(null);
    }

    public function checkUser(): JsonResponse
    {
        return response()->json(Auth::user());
    }
}


