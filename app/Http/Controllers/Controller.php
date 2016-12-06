<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * The authenticated user.
     * 
     * @var \App\User|null
     */
    protected $user;

    /**
     * Make the Auth facade available to all controllers by the $user property.
     */
    public function __construct() {
    	
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }

    /**
     * Increase the the view by 1.
     * 
     * @param  string $table [table name]
     * @param  int $id [id of the specific column]
     * @return Illuminate\Support\Facades\Redis        
     */
    public function incr($table, $id) {
        return Redis::incr("{$table}.{$id}.views");
    }
}
