<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth; // Add this line


class TransactionController extends Controller
{
    public function index()
    {
        if(Auth::user()){
            $user = Auth::id();
            $transactions = Transaction::where([['is_delete',0],['is_active',1],['user',$user]])->get();
            return view('transaction/index', compact('transactions'));
        }
        else{
            return view('welcome');
        }
    }

    public function store(Request $request)
    {
        // dd('s');
        if(Auth::user()){
            $transaction = new Transaction();
            $transaction->name = strtoupper($request->name);
            $transaction->description = $request->description;
            
            $transaction->user = Auth::id();
            $transaction->save();
            return redirect()->route('transaction.view')->with('success', 'Transaction added successfully');
        }
        else{
            return view('welcome');
        }
       
    }

    public function edit($id)
    {
        if(Auth::user()){
            $id = decrypt($id);
            $transaction = Transaction::findOrFail($id);
            return view('transaction.edit', compact('transaction'));
        }
        else{
            return view('welcome');
        }
       
    }
        public function update(Request $request, $id)
        {
            if(Auth::user()){
                $validatedData = $request->validate([
                    'name' => 'required|string|max:255',
                    
                ]);
    
                if($validatedData){
                    $transaction = Transaction::find($id);
                    $transaction->name = $request->name;
                    $transaction->description = $request->description;
    
                    if($transaction->save()){
                        return redirect()->route('transaction.view')->with('success', 'Transaction updated successfully');
                    }
                    else{
                        return redirect()->route('transaction.view')->with('error', 'Transaction updated failed');
                    }
                }         
    
                return redirect()->route('transaction.view')->with('error', 'Transaction updated failed');
            }
            else{
                return view('welcome');
            }
            // dd($request->all(), $id);
           
        }

    public function delete($id)
    {
        if(Auth::user()){
            $transaction = Transaction::findOrFail($id);
            $transaction->is_delete = 1;
            if($transaction->save()){
                return redirect()->route('transaction.view')->with('success', 'Transaction deleted successfully');
            }
            else{
                return redirect()->route('transaction.view')->with('error', 'Transaction deleted failed');
            }
            return redirect()->route('transaction.view')->with('error', 'Transaction deleted failed');
        }
        else{
            return view('welcome');
        }
        
    }
}

?>