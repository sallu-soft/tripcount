<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Expenditure;
use App\Models\ExpenditureMain;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\MoneyTransfer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use \Carbon\Carbon;
use Illuminate\Support\Facades\View as ViewFacade;


use DateTime;


class MoneyTransferController extends Controller
{
    public function index(){
        if(Auth::user()){
            $transactions = Transaction::where([
                ['is_delete', 0],
                ['is_active', 1],
                ['user', Auth::id()]
            ])->get();

            $transfers = MoneyTransfer::where([
                ['user', Auth::id()]
            ])->get();

            $company_name = Auth::user()->name;
            // dd($company_name);

            foreach ($transfers as $transfer) {
                // Fetch the name of the transaction associated with the 'from' ID
                $fromTransaction = Transaction::find($transfer->from);
                $transfer->from = $fromTransaction ? $fromTransaction->name : 'Unknown';
            
                // Fetch the name of the transaction associated with the 'to' ID
                $toTransaction = Transaction::find($transfer->to);
                $transfer->to = $toTransaction ? $toTransaction->name : 'Unknown';
            }
            
            // dd($transfers);
            return view('moneytransfer.index', compact('transactions', 'transfers', 'company_name'));
            
        }
        else{
            return view('welcome');
        }
        
    }


    public function expanditure_index(){
        if(Auth::user()){
            $transactions = Transaction::where([
                ['is_delete', 0],
                ['is_active', 1],
                ['user', Auth::id()]
            ])->get();

            $employees = Employee::where([
                ['is_delete',0],
                ['user', Auth::id()],
            ])->get();

            $expenditures = Expenditure::where([
                ['user', Auth::id()],
            ])->get();

            $expendituresmain = ExpenditureMain::where([
                ['user', Auth::id()],
            ])->get();


            $transfers = MoneyTransfer::where([
                ['user', Auth::id()]
            ])->get();

            $company_name = Auth::user()->name;
            // dd($company_name);

            foreach ($transfers as $transfer) {
                // Fetch the name of the transaction associated with the 'from' ID
                $fromTransaction = Transaction::find($transfer->from);
                $transfer->from = $fromTransaction ? $fromTransaction->name : 'Unknown';
            
                // Fetch the name of the transaction associated with the 'to' ID
                $toTransaction = Transaction::find($transfer->to);
                $transfer->to = $toTransaction ? $toTransaction->name : 'Unknown';
            }
            
            // dd($transfers);
            return view('expanditure.index', compact('transactions', 'transfers', 'company_name', 'expenditures','expendituresmain', 'employees'));
            
        }
        else{
            return view('welcome');
        }
        
    }

    public function store(Request $request)
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('welcome')->with('error', 'User not authenticated.');
        }

        $from = $request->from_account;
        $to = $request->to_account;

        // Check if "from" and "to" accounts are different
        if ($from == $to) {
            return redirect()->route('moneytransfer.view')->with('error', 'Both "from" and "to" cannot be the same.');
        }

        // Begin a database transaction
        DB::beginTransaction();

        try {
            // Retrieve sender and receiver transactions
            $senderTransaction = Transaction::find($from);
            $receiverTransaction = Transaction::find($to);

            // Check if sender has sufficient balance
            if ($senderTransaction->amount < $request->amount) {
                return redirect()->route('moneytransfer.view')->with('error', 'Insufficent Balance.');
            }

            // Deduct amount from sender and add to receiver
            $senderTransaction->amount -= $request->amount;
            $receiverTransaction->amount += $request->amount;

            // Save sender and receiver transactions
            $senderTransaction->save();
            $receiverTransaction->save();

            // Create a new money transfer record
            $moneyTransfer = new MoneyTransfer();
            $moneyTransfer->user = Auth::id();
            $moneyTransfer->from = $from;
            $moneyTransfer->to = $to;
            $moneyTransfer->date = $request->transaction_date;
            $moneyTransfer->amount = $request->amount;
            $moneyTransfer->remark = $request->remarks;
            $moneyTransfer->save();

            // Commit the transaction
            DB::commit();

            // Redirect with success message
            return redirect()->route('moneytransfer.view')->with('success', 'Money transferred successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction in case of exception
            DB::rollBack();
            return redirect()->route('moneytransfer.view')->with('error', $e->getMessage());
        }
    }
    public function destroy($id)
    {
        if (Auth::check()) {
            try {
                DB::transaction(function () use ($id) {
                    // Find the money transfer record by ID
                    $moneyTransfer = MoneyTransfer::find($id);

                    // Check if the money transfer record exists
                    if (!$moneyTransfer) {
                        throw new \Exception('Money transfer record not found.');
                    }

                    $amount = $moneyTransfer->amount;

                    // Update the balances of the sender and receiver transactions
                    $senderTransaction = Transaction::find($moneyTransfer->from);
                    $receiverTransaction = Transaction::find($moneyTransfer->to);

                    if ($senderTransaction && $receiverTransaction) {
                        $senderTransaction->amount += $amount;
                        $receiverTransaction->amount -= $amount;

                        $senderTransaction->save();
                        $receiverTransaction->save();
                    } else {
                        throw new \Exception('One or both of the transactions do not exist.');
                    }

                    // Delete the money transfer record
                    $moneyTransfer->delete();
                });

                return redirect()->route('moneytransfer.view')->with('success', 'Money transfer record deleted successfully.');
            } catch (\Exception $e) {
                return redirect()->route('moneytransfer.view')->with('error', $e->getMessage());
            }
        } else {
            return redirect()->route('welcome')->with('error', 'User not authenticated.');
        }
    }

   
    public function add_expenditure_towards(Request $request){
        // Create a new Expenditure instance
        // dd($request->all());
        $expenditure = new Expenditure();
        $expenditure->name = $request->name;
        $expenditure->description = $request->description;
        
        // Assign the authenticated user's ID to the 'user_id' attribute
        $expenditure->user = Auth::id();

        // Save the expenditure to the database
        if($expenditure->save()){
            return redirect()->back()->with("success", "Expenditure toward added successfully");
        } else {
            return redirect()->back()->with("error", "Failed to add expenditure");
        }
    }

    public function addExpenditureMain(Request $request) {
        if(Auth::user()) {
            $method = Transaction::find($request->method);
    
            if($method->amount < $request->amount) {
                return redirect()->back()->with("error", "Insufficient balance");
            }
    
            DB::beginTransaction();
    
            try {
                $expenditureMain = new ExpenditureMain();
                $expenditureMain->company_name = $request->branch;
                $expenditureMain->date = $request->transaction_date;
                $expenditureMain->receive_from = $request->account_type;
                $expenditureMain->from_account = $request->from_account;
                $expenditureMain->toward = $request->towards;
                $expenditureMain->amount = $request->amount;
                $expenditureMain->method = $request->method;
                $expenditureMain->remark = $request->remarks;
                $expenditureMain->user = Auth::id();
    
                $method->amount -= $request->amount;
    
                $expenditureMain->save();
                $method->save();
    
                DB::commit();
                return redirect()->back()->with("success", "Expenditure added successfully");
    
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with("error", "Failed to add expenditure: " . $e->getMessage());
            }
        } else {
            return view('welcome');
        }
    }

    public function expenditure_report()
    {
        if(Auth::user()){

            $expenditures = Expenditure::where([
                ['user', Auth::id()],
            ])->get();

            return view('report.expenditure.index', compact('expenditures'));
        }
        else{
            return view('welcome');
        }
       
    }

   

    public function expenditure_report_result(Request $request)
    {
        if (Auth::user()) {

            // dd($request->all());
            // Get the start and end dates from the request
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            $towards = $request->input('towards');

            // Fetch expenditures based on the filters
            $query = ExpenditureMain::query();

            // Convert the dates to MySQL format (Y-m-d)
            // Convert the dates from 'MM/DD/YYYY' to MySQL 'Y-m-d' format and handle errors
            if ($startDate) {
                $startDate = (new DateTime($startDate))->format('Y-m-d');
            }
            if ($endDate) {
                $endDate = (new DateTime($endDate))->format('Y-m-d');
            }

            // Handle date filtering
            if ($startDate && $endDate) {
                // Filter records between startDate and endDate
                $query->whereDate('date', '>=', $startDate)
                    ->whereDate('date', '<=', $endDate);
            } elseif ($startDate) {
                // Filter records from startDate onwards
                $query->whereDate('date', '>=', $startDate);
            } elseif ($endDate) {
                // Filter records up to endDate
                $query->whereDate('date', '<=', $endDate);
            }

            // Handle 'toward' filter
            if ($towards) {
                $query->where('toward', $towards);
            }

            // Retrieve expenditures
            $expenditures = $query->get();

            // Map expenditures with the correct 'toward' and 'method' values
            foreach ($expenditures as $expenditure) {
                $expenditure->toward = Expenditure::where('id', $expenditure->toward)->value('name');
                $expenditure->method = Transaction::find($expenditure->method)->value('name');
            }

            // Render the view and return as JSON
            $html = ViewFacade::make('report.expenditure.report_result', [
                'startdate' => $startDate,
                'enddate' => $endDate,
                'expenditures' => $expenditures
            ])->render();

            return response()->json(['html' => $html]);
        } else {
            return view('welcome');
        }
    }

    public function destroyExpenditureMain($id)
    {
        if(Auth::user()) {
            DB::beginTransaction();
    
            try {
                // Find the expenditure by ID
                $expenditureMain = ExpenditureMain::find($id);
    
                if (!$expenditureMain) {
                    return redirect()->back()->with("error", "Expenditure not found");
                }
                if ($expenditureMain->user != Auth::id()) {
                    return redirect()->back()->with("error", "Unauthorized action");
                }
    
                $method = Transaction::find($expenditureMain->method);
    
                if (!$method) {
                    return redirect()->back()->with("error", "Transaction method not found");
                }
    
                $method->amount += $expenditureMain->amount;
    
                $expenditureMain->delete();
    
                // Save the updated method
                $method->save();
    
                DB::commit();
                return redirect()->back()->with("success", "Expenditure deleted and balance restored successfully");
    
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with("error", "Failed to delete expenditure: " . $e->getMessage());
            }
        } else {
            return view('welcome');
        }
    }
    


}
