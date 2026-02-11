<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
   

public function index()
{
    
    $restaurantsByCity = DB::table('restaurants')
        ->select('ville', DB::raw('count(*) as total'))
        ->groupBy('ville')
        ->orderBy('total', 'desc')
        ->get();

    
    $stats = [
        'total_restaurants' => DB::table('restaurants')->count(),
        'new_users' => DB::table('users')->where('created_at', '>=', now()->subDays(30))->count(),
    ];

   $Restaurants=Restaurant::all();

    return view('admin.dashboard', compact('restaurantsByCity', 'stats', 'Restaurants'));
}
}
