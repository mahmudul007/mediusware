<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
class TransactionController extends Controller
{
   
    public function create()
    {
        return view( 'frontend.deposite.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    $request->validate([
       
        'amount' => 'required|numeric|min:0',
    ]);

    
    $transaction = Transaction::create([
        'user_id' => Auth::user()->id,
        'type' => 'deposit',
        'amount' => $request->amount,
        'status' => 'pending',
        'fee'=>0,
    ]);

    return redirect()->route('all.transaction');

    }

    public function updateStatus(Request $request, $transactionId)
    {
       
        $transaction = Transaction::findOrFail($transactionId);
    
     
        $request->validate([
            'status' => 'required',
        ]);
    
      
    
        if ($request->status === 'approve') {
           
            $transaction->status = 'approved';
            $transaction->save();
    
            $user = $transaction->user;
          
            $user->balance += $transaction->amount;
            $user->save();
            return redirect()->back()->with('success', 'Transaction approved successfully');
        } elseif ($request->status === 'decline') { 
            $transaction->status = 'declined';
            $transaction->save();
            return redirect()->back()->with('success', 'Transaction declined successfully');
        }
    }
    
    public function alltransactions(Transaction $transaction)
    {
        $transactions = Transaction::where('user_id', auth()->id())->get();
        $currentBalance = User::find(auth()->id())->balance;
       
        return view('frontend.deposite.index', [
            'transactions' => $transactions,
            'current_balance' => $currentBalance,
        ]);
        

    }
    public function viewAllPendingTransaction(){
        $transactions = Transaction::where('status','pending')->get();
        return view('frontend.transactionapprovelist.index', [
            'transactions' => $transactions]);

    }


    public function deposited_transaction(Transaction $transaction)
    {
        
         $deposits = Transaction::where('type', '0')->get();

        
         return response()->json([
             'deposits' => $deposits,
         ]);

    }
    

   

    public function withdrawal(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);
    
        $user = User::findOrFail(auth()->id());
    
        // Determine the withdrawal rate based on account type
        $withdrawalRate = $user->account_type === '0' ? 0.015 : 0.025;
    
        // Apply free withdrawal conditions for Individual accounts
        if ($user->account_type === '0') {
            $dayOfWeek = now()->dayOfWeek;
            $remainingFreeWithdrawalsThisMonth = max(0, 5 - Transaction::where('user_id', $user->id)
                ->where('transaction_type', 0)
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month)
                ->sum('amount') / 1000);
    
            // Each Friday withdrawal is free of charge
            // The first 1K withdrawal per transaction is free
            if ($dayOfWeek === 5 || $remainingFreeWithdrawalsThisMonth > 0) {
                $withdrawalRate = 0; // Free withdrawal conditions apply
            }
        }
    
        // Apply the appropriate withdrawal fee
        $withdrawalFee = $request->amount * $withdrawalRate;
    
        // Check if the user has sufficient balance
        if ($user->balance >= ($request->amount + $withdrawalFee)) {
            // Deduct the withdrawn amount and withdrawal fee from the user's balance
            $user->balance -= ($request->amount + $withdrawalFee);
            $user->save();
    
            // Create a withdrawal transaction record
            Transaction::create([
                'user_id' => $user->id,
                'transaction_type' => 'withdrawal',
                'amount' => $request->amount,
                'fee' => $withdrawalFee,
            ]);
    
            // Redirect to the withdrawals page
            return redirect()->route('showWithdrawals')->with('success', 'Withdrawal successful');
        } else {
            // Insufficient balance, redirect back with an error message
            return redirect()->back()->with('error', 'Insufficient balance');
        }
    }
    
    



    
    public function showWithdrawals()
    {
    
        $withdrawals = Transaction::where('type', 'withdrawal')->where('user_id',Auth::user()->id)->get();
       return view('frontend.witdraw.index', $withdrawals);
    }
}
