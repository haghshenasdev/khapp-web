<?php

namespace App\Http\Middleware;

use App\Models\charity;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharityCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!charity::query()->find($request->route('charity'))){
            return response()->json([
                'data' => 'خیریه مورد نظر در دسترس نیست',
                'status' => 'error'
            ]);
        }
        return $next($request);
    }
}
