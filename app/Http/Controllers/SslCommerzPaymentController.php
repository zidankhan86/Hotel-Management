<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Library\SslCommerz\SslCommerzNotification;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'           => 'required',
            'check_in_date'  => 'required',
            'check_out_date' => 'required|after:check_in_date',      
            'address'        => 'required',
            'phone'          => 'required',
            'note'           => 'required',
            'total_rooms'    => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
       
        $room_id = $request->input('room_id');
        $check_in_date = date('Y-m-d H:i:s', strtotime($request->input('check_in_date')));
        $check_out_date = date('Y-m-d H:i:s', strtotime($request->input('check_out_date')));
        $total_rooms = $request->input('total_rooms');
     

        // Get the room details
        $room = Room::find($room_id);

        // Check if the room has enough available rooms for the booking
        if ($room->available_rooms >= $total_rooms) {
           
       
        $post_data = array();
        $post_data['total_amount'] = $room->price;
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $request->name;
        $post_data['room_id'] = $request->room_id;
        $post_data['check_in'] = $check_in_date;
        $post_data['check_out'] = $check_out_date;

        $post_data['user_id'] = auth()->user()->id;
        $post_data['note'] = $request->note;
        $post_data['total_rooms'] = $request->total_rooms;
       
        $post_data['cus_add1'] = $request->address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $request->phone;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('bookings')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'room_id'=> $post_data['room_id'],
                'check_in' => $post_data['check_in'],
                'check_out' => $post_data['check_out'],
                'user_id' => $post_data['user_id'],
                'note' => $post_data['note'],
                'total_rooms' => $post_data['total_rooms'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'price' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
        
        return redirect()->route('home')->with('success', 'Booking successful');
    } else {
        return back()->with('error', 'No room available');
    }
    }

   

    public function success(Request $request)
    {
        echo "Transaction is Successful";

        $tran_id = $request->input('tran_id');
        $price = $request->input('price');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_details = DB::table('bookings')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'price')->first();

        if ($order_details->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $price, $currency);

            if ($validation) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('bookings')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);

                echo "<br >Transaction is successfully Completed";
            }
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            echo "Transaction is successfully Completed";
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }

        return redirect()->route('home')->with('success','Transaction is Successful');
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('bookings')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'price')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('bookings')
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

        $order_details = DB::table('bookings')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'price')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('bookings')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }


    }

    

}
