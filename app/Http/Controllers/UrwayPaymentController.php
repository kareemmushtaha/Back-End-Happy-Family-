<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;


use App\Models\OrderPayment;
use App\Models\Package;
use App\Models\User;
use App\Models\UserPackage;
use App\Models\ViewPersonalInformation;
use App\Services\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;


class UrwayPaymentController extends Controller
{

    public $order;
    public $terminalId;
    public $password;
    public $secretKey;
    public $merchant_key;
    public $amount;
    public $user_id;

    public function __construct(Request $request)
    {
        $this->order = $request->auction_number;
        $this->terminalId = 'shammy';
        $this->password = 'shammy@123';
        $this->secretKey = '54e41f9bb30e5a5c20c7d88d4638e62a3bbd9cadbeacbb5bd6e83406f9a38464';
        $this->merchant_key = '54e41f9bb30e5a5c20c7d88d4638e62a3bbd9cadbeacbb5bd6e83406f9a38464';
    }

    public function getTransaction(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (checkUserHaveSubscription(auth()->user()->id)) {
            toastr()->success(trans('global.sorry_you_have_package_activated'), ['timeOut' => 20000, 'closeButton' => true]);
            return redirect()->back();
        } else {

            $package = Package::query()->findOrFail($request->packageId);
            if ($package->price == 0) {
                Subscription::CheckFreeSubscription(auth()->user());
                toastr()->success(trans('global.subscribed_free_successfully'), ['timeOut' => 20000, 'closeButton' => true]);
                return redirect()->route('package', $package->id);
            } else {
                $userPackage = UserPackage::query()->create([
                    'package_id' => $package->id,
                    'user_id' => auth()->user()->id,
                    'price' => $package->price,
                    'start_date' => Carbon::now(),
                    'end_date' => Carbon::now()->addDays(30),
                    'status' => 0, //subscription is not active
                ]);
            }
        }

        $trackId = $userPackage->id;
        $amount = $userPackage->price;


        $txn_details = $trackId . "|" . $this->terminalId . "|" . $this->password . "|" . $this->secretKey . "|" . $amount . "|SAR";
        $hash = hash('sha256', $txn_details);
        $fields = array(
            'trackid' => $trackId,
            'terminalId' => $this->terminalId,
            'customerEmail' => 'test@hotmail.com',
            'action' => "1",
            'merchantIp' => \request()->ip(),
            'password' => $this->password,
            'currency' => "SAR",
            'country' => "SA",
            'amount' => $amount,
            "udf1" => "Test1",
            "udf2" => route('urway.payment.response', $userPackage->id),//Response page URL
            "udf3" => "",
            "udf4" => "",
            "udf5" => "Test5",
            'requestHash' => $hash //generated Hash
        );

        $data = json_encode($fields);
        $ch = curl_init('https://payments-dev.urway-tech.com/URWAYPGService/transaction/jsonProcess/JSONrequest');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
//execute post
        $result = curl_exec($ch);
        $urldecode = (json_decode($result, true));
//close connection

        curl_close($ch);
        if ($urldecode['payid'] != NULL) {
            $url = $urldecode['targetUrl'] . "?paymentid=" . $urldecode['payid'];
            echo
                '<html>
                 <form name="myform" method="POST" action="' . $url . '">
                 <h1> Transaction is processing........</h1>
                 </form>
                 <script type="text/javascript">document.myform.submit();
                 </script>
                 </html>';
        } else {
            echo "<b>Something went wrong!!!!</b>";
        }
    }

    public function getResponse()
    {

        $currency = "SAR";

        if ($_GET !== NULL) {
            $requestHash = "" . $_GET['TranId'] . "|" . $this->merchant_key . "|" . $_GET['ResponseCode'] . "|" . $_GET['amount'] . "";

            $hash = hash('sha256', $requestHash);
            if ($hash === $_GET['responseHash']) {

                $txn_details1 = "" . $_GET['TrackId'] . "|" . $this->terminalId . "|" . $this->password . "|" . $this->merchant_key . "|" . $_GET['amount'] . "|SAR";
                //Secure check
                $requestHash1 = hash('sha256', $txn_details1);
                $apifields = array(
                    'trackid' => $_GET['TrackId'],
                    'terminalId' => $this->terminalId,
                    'action' => '10',
                    'merchantIp' => "",
                    'password' => $this->password,
                    'currency' => $currency,
                    'transid' => $_GET['TranId'],
                    'amount' => $_GET['amount'],
                    'udf5' => "",
                    'udf3' => "",
                    'udf4' => "",
                    'udf1' => "",
                    'udf2' => "",
                    'requestHash' => $requestHash1
                );

                $apifields_string = json_encode($apifields);

                $url = "https://payments-dev.urway-tech.com/URWAYPGService/transaction/jsonProcess/JSONrequest";//test mode
//                $url = "https://payments.urway-tech.com/URWAYPGService/transaction/jsonProcess/JSONrequest";//live mode

                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $apifields_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($apifields_string)
                ));
                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

                //execute post
                $apiresult = curl_exec($ch);
                // print_r($apiresult);die;
                $urldecodeapi = (json_decode($apiresult, true));
                $inquiryResponsecode = $urldecodeapi['responseCode'];
                $inquirystatus = $urldecodeapi['result'];


                if ($inquirystatus == 'Successful' || $inquiryResponsecode == '000') {

                    $trackid = $_GET['TrackId'];
                    $responseCode = $_GET['ResponseCode'];
                    $amount = $_GET['amount'];
                    $cardBrand = $_GET['cardBrand'];
                    $authCode = $_GET['AuthCode'];
                    $paymentId = $_GET['PaymentId'];
                    $tranId = $_GET['TranId'];

                    $payment_information = UserPackage::query()->find(\request()->TrackId)->update(['status' => 1]);
                    $payment_information = UserPackage::query()->find(\request()->TrackId);

                    $paymentTransactions = new  OrderPayment();
                    $paymentTransactions->track_id = $trackid;
                    $paymentTransactions->payment_reference = $authCode;
                    $paymentTransactions->reference_no = $responseCode;
                    $paymentTransactions->payment_reference_at = Carbon::now();
                    $paymentTransactions->transaction_id = $paymentId;
                    $paymentTransactions->amount = $amount;
                    $paymentTransactions->user_id = $payment_information->user_id;
                    $paymentTransactions->details = 'Subscription';
                    $paymentTransactions->save();
                    toastr()->success(trans('global.subscribed_successfully'), ['timeOut' => 20000, 'closeButton' => true]);
                    return redirect()->route('package', $payment_information->package_id);

                } else {
                    return redirect(route('urway.fail.transaction'));
                }

            } else {
                return redirect(route('urway.fail.transaction'));
            }
        } else {
            return redirect(route('urway.fail.transaction'));
        }
    }

    public function urwaySuccess()
    {
        return 'Payment success';
    }

    public function urwayFail()
    {
        return 'Payment failed';
    }


}
