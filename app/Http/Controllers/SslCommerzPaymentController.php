<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Order; 
use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Session;
use App\Models\Customer;

class SslCommerzPaymentController extends Controller
{
    private $customer;

    public function index(Request $request)
    {
        // 1. Customer Handling
        if(Session::get('customer_id')) {
            $this->customer = Customer::find(Session::get('customer_id'));
        } else {
            $request->validate([
                'name'             => 'required|string|min:2|max:255',
                'email'            => 'required|email|max:255',
                'mobile'           => 'required|string|min:11',
                'delivery_address' => 'required|string|min:10|max:500',
            ]);
            $this->customer = Customer::newCustomer($request);
            Session::put('customer_id', $this->customer->id);
            Session::put('customer_name', $this->customer->name);
        }

        // 2. Prepare Payment Data
        $post_data = array();
        $post_data['total_amount'] = Session::get('order_total');
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); 

        $post_data['cus_name'] = $this->customer->name;
        $post_data['cus_email'] = $this->customer->email;
        $post_data['cus_add1'] = $request->delivery_address;
        $post_data['cus_phone'] = $this->customer->mobile;
        $post_data['cus_country'] = "Bangladesh";

        // Required physical goods parameters
        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        // 3. Save Order using DB transaction to ensure OrderDetail is saved too
        DB::transaction(function () use ($post_data, $request) {
            // Using updateOrInsert
            DB::table('orders')->updateOrInsert(
                ['transaction_id' => $post_data['tran_id']],
                [
                    'customer_id'      => $this->customer->id,
                    'order_date'       => date('Y-m-d'),
                    'order_timestamp'  => now(), // Changed from time() to now()
                    'order_total'      => $post_data['total_amount'],
                    'tax_total'        => Session::get('tax_total', 0),
                    'shipping_total'   => Session::get('shipping_total', 0),
                    'delivery_address' => $request->delivery_address,
                    'payment_type'     => $request->payment_type,
                    'order_status'     => 'Pending', // Consistently use 'order_status'
                    'currency'         => $post_data['currency']
                ]
            );

            // Fetch the ID of the record we just inserted
            $order = DB::table('orders')->where('transaction_id', $post_data['tran_id'])->first();
            
            // Pass the ID to OrderDetail
            OrderDetail::newOrderDetail($order->id);
        });

        // 4. Initiate Payment
        $sslc = new SslCommerzNotification();
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
        }
    }

    public function success(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        // Note: Check if your table uses 'order_status' or 'status'
        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->first();

        if ($order_details->order_status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

           if ($validation) {
                DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['order_status' => 'Processing']);

                // dd('Validation passed, redirecting now...'); // Uncomment this to test
                return redirect('/complete-order')->with('message', 'Congratulations! Your order has been placed successfully.');
            }
        } 
        
        return redirect()->route('home')->with('error', 'Invalid Transaction');
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

    //end function
}