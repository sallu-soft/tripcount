<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Karim007\LaravelBkashTokenize\Facade\BkashPaymentTokenize;
use Karim007\LaravelBkashTokenize\Facade\BkashRefundTokenize;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class BkashTokenizePaymentController extends Controller
{
    public function payment_index(){
        return view('payment.index');
    }
    public function index()
    {
        return view('bkashT::bkash-payment');
    }
    public function createPayment(Request $request)
    {
        // dd("here");
        $inv = uniqid();
        $request['intent'] = 'sale';
        $request['mode'] = '0011'; //0011 for checkout
        $request['payerReference'] = $inv;
        $request['currency'] = 'BDT';
        $request['amount'] = 1000;
        $request['merchantInvoiceNumber'] = $inv;
        $request['callbackURL'] = config("bkash.callbackURL");;

        $request_data_json = json_encode($request->all());
        // dd($request_data_json);
        $response =  BkashPaymentTokenize::cPayment($request_data_json);
        // dd($response);
        Log::info('Create payment request: ',['response'=>$response]);

        //$response =  BkashPaymentTokenize::cPayment($request_data_json,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..

        //store paymentID and your account number for matching in callback request
        // dd($response) //if you are using sandbox and not submit info to bkash use it for 1 response

        if (isset($response['bkashURL'])) return redirect()->away($response['bkashURL']);
        else return redirect()->back()->with('error-alert2', $response['statusMessage']);
    }

    // public function callBack(Request $request)
    // {
       
    //     if ($request->status == 'success'){
    //         $response = BkashPaymentTokenize::executePayment($request->paymentID);
    //         if (!$response){ //if executePayment payment not found call queryPayment
    //             $response = BkashPaymentTokenize::queryPayment($request->paymentID);
    //         }

    //         if (isset($response['statusCode']) && $response['statusCode'] == "0000" && $response['transactionStatus'] == "Completed") {
              
    //             return BkashPaymentTokenize::success('Thank you for your payment', $response['trxID']);
    //         }
    //         return BkashPaymentTokenize::failure($response['statusMessage']);
    //     }else if ($request->status == 'cancel'){
    //         return BkashPaymentTokenize::cancel('Your payment is canceled');
    //     }else{
    //         return BkashPaymentTokenize::failure('Your transaction is failed');
    //     }
    // }
    public function callBack(Request $request)
    {
        //callback request params
        // paymentID=your_payment_id&status=success&apiVersion=1.2.0-beta
        //using paymentID find the account number for sending params

        if ($request->status == 'success'){
            session_start();
            $response = BkashPaymentTokenize::executePayment($request->paymentID);
            Log::info('Execute payment request: ',['response'=>$response]);
            //$response = BkashPaymentTokenize::executePayment($request->paymentID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
            if (!$response){ //if executePayment payment not found call queryPayment
                $response = BkashPaymentTokenize::queryPayment($request->paymentID);
                //$response = BkashPaymentTokenize::queryPayment($request->paymentID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
            }

            if (isset($response['statusCode']) && $response['statusCode'] == "0000" && $response['transactionStatus'] == "Completed") {
                /*
                 * for refund need to store
                 * paymentID and trxID
                 * */
                
                // dd(1,session('user_id'),2,'success');
                $userid = session('user_id');
                $user = User::find($userid);
                $currentDateTime = Carbon::now();
                $user->prev_month = $currentDateTime->format('Y-m-d H:i:s');
                $user->is_paid = 1;
                $user->save();
                return BkashPaymentTokenize::success('Thank you for your payment', $response['trxID']);
            }
            return BkashPaymentTokenize::failure($response['statusMessage']);
        }else if ($request->status == 'cancel'){
            return BkashPaymentTokenize::cancel('Your payment is canceled');
        }else{
            // dd(session('user_id'));
            return BkashPaymentTokenize::failure('Your transaction is failed');
        }
    }


    public function searchTnx($trxID)
    {
        //response
        return BkashPaymentTokenize::searchTransaction($trxID);
        //return BkashPaymentTokenize::searchTransaction($trxID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }

    public function refund(Request $request)
    {
        $paymentID='Your payment id';
        $trxID='your transaction no';
        $amount=5;
        $reason='this is test reason';
        $sku='abc';
        //response
        return BkashRefundTokenize::refund($paymentID,$trxID,$amount,$reason,$sku);
        //return BkashRefundTokenize::refund($paymentID,$trxID,$amount,$reason,$sku, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }
    public function refundStatus(Request $request)
    {
        $paymentID='Your payment id';
        $trxID='your transaction no';
        return BkashRefundTokenize::refundStatus($paymentID,$trxID);
        //return BkashRefundTokenize::refundStatus($paymentID,$trxID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }
}
