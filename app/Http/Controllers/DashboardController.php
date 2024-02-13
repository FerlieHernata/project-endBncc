<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $itemCount = Item::count();
        $categoryCount = Category::count();
        $userCount = User::count();
        return view('dashboard',['item_count' => $itemCount, 'category_count' => $categoryCount, 'user_count' => $userCount]);
    }
}
