<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            if (Auth::user()->roles == 'ADMIN') {
                $food_chart = DB::table('foods')->leftJoin('transactions', 'foods.id', '=', 'transactions.food_id')->groupBy('foods.food_name')->selectRaw('foods.food_name,  
        IFNULL(SUM(transactions.quantity),0) AS quantity')->get();
                $food_chart_label = $food_chart->map(function ($x) {
                    return $x->food_name;
                })->toArray();
                $food_chart_ds1 = $food_chart->map(function ($x) {
                    return $x->quantity;
                })->toArray();
                $status_chart_label = ['ORDER', 'BAYAR', 'BATAL'];
                $status_chart_ds1 = [10, 12, 1];
                $transactions = Transaction::paginate();
                return view('dashboard.adminindex', [
                    'transaction' => $transactions,
                    'food_chart_label' => $food_chart_label,
                    'food_chart_ds1' => $food_chart_ds1,
                    'status_chart_label' => $status_chart_label,
                    'status_chart_ds1' => $status_chart_ds1,
                ]);
            } else if (Auth::user()->roles == 'USER') {
                $onCart = Transaction::whereRaw(
                    "user_id=? AND status='CART'",
                    [Auth::user()->id]
                )->first();
                $onOrder = Transaction::whereRaw(
                    "user_id=? AND status='ORDER'",
                    [Auth::user()->id]
                )->first();
                $transactions = Transaction::whereRaw(
                    "user_id=?",
                    [Auth::user()->id]
                )->orderBy('created_at', 'desc')->get();
                return view('dashboard.userindex', [
                    'onOrder' => $onOrder,
                    'onCart' => $onCart, 'transactions' => $transactions
                ]);
            }
        }
    }
}
