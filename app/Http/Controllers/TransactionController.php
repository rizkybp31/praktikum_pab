<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function CreateOrder()
    {
        $foods = Food::get();
        return view('transaction.order', ['foods' => $foods]);
    }

    public function StoreOrder(Request $request)
    {
        $transaction = new Transaction();
        $food = Food::find($request->food_id);
        $transaction->food_id = $request->food_id;
        $transaction->payment_url = '';
        $transaction->quantity = 1;
        $transaction->status = 'CART';
        $transaction->total = $food->price;
        $transaction->user_id = Auth::user()->id;
        $transaction->save();
        return redirect('/transaction/cart/' . $transaction->id);
    }

    public function CreateCart($id)
    {
        $transaction = Transaction::find($id);
        return view('transaction.cart', ['transaction' => $transaction]);
    }

    public function StoreCart(Request $request, $id)
    {
        $transaction = Transaction::find($id);
        $transaction->quantity = $request->quantity;
        $food = Food::find($transaction->food_id);
        $transaction->status = 'ORDER';
        $transaction->total = $food->price * $transaction->quantity;
        $transaction->save();
        return redirect('/transaction/payment/' . $transaction->id);
    }

    public function bayar(Request $request, $id)
    {
        $transaction = Transaction::find($id);
        $transaction->status = 'TERBAYAR';
        $transaction->save();
        return redirect('/dashboard');
    }

    public function cancel(Request $request, $id)
    {
        $transaction = Transaction::find($id);
        $transaction->status = 'BATAL';
        $transaction->save();
        return redirect('/dashboard');
    }

    public function index(Request $request)
    {
        $q = $request->get('q');
        $periode = $request->get('periode');
        $status = $request->get('status');
        $transactions = Transaction::when(($periode == 'SEMUA' ? '' : $periode),
            function ($query, $periode) {
                $batas_waktu = Carbon::today();
                if ($periode == 'MINGGU') {
                    $batas_waktu = $batas_waktu->subDays(7);
                } else if ($periode == 'BULAN') {
                    $batas_waktu = Carbon::create($batas_waktu->year, $batas_waktu->month, 1);
                } else if ($periode == 'TAHUN') {
                    $batas_waktu = Carbon::create($batas_waktu->year, 1, 1);
                }
                return $query->where('created_at', '>=', $batas_waktu);
            }
        )->when(($status == 'SEMUA' ? '' : $status), function ($query, $status) {
            return $query->where('status', $status);
        })->when($q, function ($query, $q) {
            return $query->whereHas('user', function ($query) use ($q) {
                $query->where('name', 'like', '%' . $q . '%')->orWhere('address', 'like', '%' . $q . '%');
            })->orWhereHas('food', function ($query) use ($q) {
                $query->where('food_name', 'like', '%' . $q . '%');
            });
        })->paginate()->withQueryString();
        return view('transaction.index', [
            'transaction' => $transactions,
            'periode' => $periode, 'status' => $status, 'q' => $q
        ]);
    }
}
