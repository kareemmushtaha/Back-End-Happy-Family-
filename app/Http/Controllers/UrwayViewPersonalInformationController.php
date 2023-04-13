<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;


use App\Jobs\SendMails;
use App\Mail\SendOfStepUserStatusEmail;
use App\Models\OrderPayment;
use App\Models\Package;
use App\Models\User;
use App\Models\UserPackage;
use App\Models\ViewPersonalInformation;
use App\Notifications\AcceptRequestViewPersonaInformationNotification;
use App\Notifications\RejectRequestViewPersonaInformationNotification;
use App\Notifications\RequestToViewPersonalInformationNotification;
use App\Notifications\VerifyUserNotification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;


class UrwayViewPersonalInformationController extends Controller
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
        $checkCanShowUserInfo = User::query()->findOrFail($request->userId);
        $viewPersonalInformation = ViewPersonalInformation::query()->where('to_user_id', $request->userId)->where('from_user_id', auth()->user()->id)->first();

        if ($checkCanShowUserInfo->show_profile == 0) {
            toastr()->success(trans('global.Sorry_this_user_does_not_want_to_share_his_personal_data'), ['timeOut' => 20000, 'closeButton' => true]);
            return redirect()->back();
        }

        if ($viewPersonalInformation) {
            if ($viewPersonalInformation->status == -1) {
                //status -1 this awaiting accept by user
                toastr()->success(trans('global.your_request_has_been_pending_accept'), ['timeOut' => 20000, 'closeButton' => true]);
                return redirect()->back();
            }

            if ($viewPersonalInformation->status == -2) {
                //status -2 this reject accept by user
                toastr()->success(trans('global.reject_your_request_by_user'), ['timeOut' => 20000, 'closeButton' => true]);
                return redirect()->back();
            }

            if ($viewPersonalInformation->status == 1) {
                //status 1 this payment has been made successfully
                toastr()->success(trans('global.Sorry_this_user_data_has_already_been_exposed'), ['timeOut' => 20000, 'closeButton' => true]);
                return redirect()->back();
            }

            if ($viewPersonalInformation->status == 0) {
                //status 0 awaiting payment
                $trackId = $viewPersonalInformation->id;
                $amount = $viewPersonalInformation->price;

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
                    "udf2" => url('urway/response/send_personal_info', $viewPersonalInformation->id),//Response page URL
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
        } else {
            $personToDisplay = User::query()->findOrFail($request->userId);

            if ($personToDisplay->getType() == "FollowMediator") {
                $mediator = User::query()->find($personToDisplay->mediator_id);

                $viewPersonalInformation = ViewPersonalInformation::query()->create([
                    'from_user_id' => auth()->user()->id,
                    'to_user_id' => $mediator->id,
                    'price' => settingContentAr('price_show_user_information'),
                    'status' => -1, // awaiting accept by user
                    'hashToken' => Str::random(100), // awaiting accept by user
                ]);
                Mail::to($mediator->email)->send(new RequestToViewPersonalInformationNotification(auth()->user(), $viewPersonalInformation->hashToken,$personToDisplay));

            }else{
                $viewPersonalInformation = ViewPersonalInformation::query()->create([
                    'from_user_id' => auth()->user()->id,
                    'to_user_id' => $personToDisplay->id,
                    'price' => settingContentAr('price_show_user_information'),
                    'status' => -1, // awaiting accept by user
                    'hashToken' => Str::random(100), // awaiting accept by user
                ]);
                Mail::to($personToDisplay->email)->send(new RequestToViewPersonalInformationNotification(auth()->user(), $viewPersonalInformation->hashToken));
            }

            toastr()->success(trans('global.add_request_view_personal_information_successfully_has_been_pending_accept'), ['timeOut' => 20000, 'closeButton' => true]);
            return redirect()->back();
        }
    }

    public function accept($hashToken)
    {
        $viewPersonalInformation = ViewPersonalInformation::query()->where('hashToken', $hashToken)->first();
        if ($viewPersonalInformation) {
            $viewPersonalInformation->updateQuietly([
                'status' => 0,
                'hashToken' => null,
            ]);
            //send email to sender accepted  payment
            $sender = $viewPersonalInformation->fromUser;
            $receiver = $viewPersonalInformation->toUser;
            Notification::send($sender, new AcceptRequestViewPersonaInformationNotification($receiver));
            toastr()->success(trans('global.accepted_request_successfully'), ['timeOut' => 20000, 'closeButton' => true]);
        } else {
            toastr()->error(trans('global.sorry_cant_accept_this_request'), ['timeOut' => 20000, 'closeButton' => true]);
        }
        return redirect()->route('home');

    }

    public function reject($hashToken)
    {
        $viewPersonalInformation = ViewPersonalInformation::query()->where('hashToken', $hashToken)->first();
        if ($viewPersonalInformation) {
            $viewPersonalInformation->updateQuietly([
                'status' => -2,
                'hashToken' => null,
            ]);
            //send email to sender  reject your request
            $sender = $viewPersonalInformation->fromUser;
            $receiver = $viewPersonalInformation->toUser;
            Notification::send($sender, new RejectRequestViewPersonaInformationNotification($receiver));
            toastr()->success(trans('global.rejected_request_successfully'), ['timeOut' => 20000, 'closeButton' => true]);
        } else {
            toastr()->error(trans('global.sorry_cant_reject_this_request'), ['timeOut' => 20000, 'closeButton' => true]);
        }

        return redirect()->route('home');
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

                    $payment_information = ViewPersonalInformation::query()->find(\request()->TrackId)->update(['status' => 1]);
                    $payment_information = ViewPersonalInformation::query()->find(\request()->TrackId);

                    $paymentTransactions = new  OrderPayment();
                    $paymentTransactions->track_id = $trackid;
                    $paymentTransactions->payment_reference = $authCode;
                    $paymentTransactions->reference_no = $responseCode;
                    $paymentTransactions->payment_reference_at = Carbon::now();
                    $paymentTransactions->transaction_id = $paymentId;
                    $paymentTransactions->amount = $amount;
                    $paymentTransactions->user_id = $payment_information->from_user_id;
                    $paymentTransactions->details = 'ViewPersonalInformation';
                    $paymentTransactions->save();
                    //send email

                    $checkUser = User::query()->find($payment_information->to_user_id);
                    if ($checkUser->getType() == 'FollowMediator') {
                        //send email to parent user "Mediator"

                        $mediator = User::query()->find($checkUser->mediator_id);

                        $data = [
                            'name' => $mediator->first_name . ' ' . $mediator->last_name,
                            'email' => $mediator->email,
                            'birth_date' => $checkUser->birth_date,
                            'gender' => $checkUser->gender,
                            'phone' => $mediator->phone,
                            'message' => 'يمكنك التواصل مع الوسيط لتكملة الإجراءات الرسمية',
                        ];
                        Mail::to([auth()->user()->email])->send(new SendOfStepUserStatusEmail($data));

                    } else {
                        //send email direct to user
                        $data = [
                            'name' => $checkUser->first_name . ' ' . $checkUser->last_name,
                            'email' => $checkUser->email,
                            'birth_date' => $checkUser->birth_date,
                            'gender' => $checkUser->gender,
                            'phone' => $checkUser->phone,
                            'message' => 'يمكنك التواصل مع الطرف الآخر لتكملة الإجراءات الرسمية',
                        ];
                        Mail::to([auth()->user()->email])->send(new SendOfStepUserStatusEmail($data));
                    }


                    toastr()->success(trans('global.subscribed_successfully'), ['timeOut' => 20000, 'closeButton' => true]);
                    return redirect()->route('personally', $payment_information->to_user_id);

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
