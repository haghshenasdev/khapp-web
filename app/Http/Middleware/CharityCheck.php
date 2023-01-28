<?php

namespace App\Http\Middleware;

use App\Http\Resources\CharityCheckResource;
use App\Models\charity;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharityCheck
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return CharityCheckResource
     */
    public function handle(Request $request, Closure $next)
    {
        if (! $charity = charity::query()->find($request->route('charity')) or $charity->is_active == 0){
            return response([
                'message' => 'خیریه مورد نظر در دسترس نیست',
            ],403);
        }
        return $next($request);
    }
}
