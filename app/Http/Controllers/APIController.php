<?php

namespace App\Http\Controllers;

use App\PaymentRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class APIController extends Controller
{
    public function index()
    {
        return view('payment');
    }

    /**
     * @param Request $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function proceedPayment(Request $request)
    {
        $return_url = "http://127.0.0.1:8000/redirectURL";
        $merchantCode = $request->input('merchantCode');
        $prn = uniqid();
        $amount = $request->input('amount');
        $crn = "NRP";
        $date_format = date('m/d/Y');
        $remarks1 = $request->input('remarks1');
        $remarks2 = $request->input('remarks2');
        $md = "P";

        $value = array('product_id' => $prn, 'amount' => $amount);

        $request->session()->put('value', $value);

        $secret_key = "158324969d9240f8bf8d85017bc77f67";

        $data = $merchantCode.",".$md.",".$prn.",".$amount.",".$crn.",".$date_format.",".$remarks1.",".$remarks2.",".$return_url;
        $dataValidation = hash_hmac('sha512', $data, $secret_key);

        //send request
        ?>

        <form method="POST" id ="payment-form" action="https://dev-clientapi.fonepay.com/api/merchantRequest">
            <input type="hidden" name="PID" value="<?php echo $merchantCode; ?>" >
            <input type="hidden" name="MD"   value="<?php echo $md; ?>">
            <input type="hidden" name="AMT" value="<?php echo $amount; ?>">
            <input type="hidden" name="CRN" value="<?php echo $crn; ?>">
            <input type="hidden" name="DT" value="<?php echo $date_format; ?>">
            <input type="hidden" name="R1" value="<?php echo $remarks1; ?>">
            <input type="hidden" name="R2" value="<?php echo $remarks2; ?>">
            <input type="hidden" name="DV" value="<?php echo $dataValidation; ?>">
            <input type="hidden" name="RU" value="<?php echo $return_url; ?>">
            <input type="hidden" name="PRN" value="<?php echo $prn; ?>">
        </form>

        <script type="text/javascript">
            document.getElementById('payment-form').submit(); // SUBMIT FORM
        </script>

        <?php

    }


    public function getRedirect()
    {
        $product_id = session()->get('value.product_id');
        $amount = session()->get('value.amount');

        $PID = 'YXSB';

        $secret_key = '158324969d9240f8bf8d85017bc77f67';

        $requestData = [
            'PRN' => $_GET['PRN'],
            'PID' => $PID,
            'BID' => $_GET['BID'],
            'AMT' => $amount, // original payment amount
            'UID' => $_GET['UID'],
            'DV' => hash_hmac('sha512', $PID.','.$amount.','.$_GET['PRN'].','.$_GET['BID'].','.$_GET['UID'], $secret_key),
        ];

        if($product_id == $requestData['PRN']) {

            $verifyDevUrl = 'https://dev-clientapi.fonepay.com/api/merchantRequest/verificationMerchant';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $verifyDevUrl . '?' . http_build_query($requestData));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $responseXML = curl_exec($ch);

            $response = simplexml_load_string($responseXML);

            if($response->success == 'true'){
                //verification
                $check = PaymentRecord::where('PRN', $requestData['PRN'])->first();

                if ($check == true)
                {
                    return $product_id;
                }
                else {
                    //store record
                    $record = new PaymentRecord();
                    $record->PID = $PID;
                    $record->PRN = $_GET['PRN'];
                    $record->AMT = $amount;
                    $record->BID = $_GET['BID'];
                    $record->UID = $_GET['UID'];
                    $record->DV = $requestData['DV'];

                    $record->save();
                }
            }
            return view('redirect_page', compact('response'))->with('product_id', $product_id)->with('amount', $amount)->with('requestData', $requestData);

        }
        else{
            echo "Payment Failed!";
        }

    }

//    public function test()
//    {
//        $session = session()->get('value.product_id');
//
//        $aaa = session()->get('value.amount');
//
//        dd($aaa);
//    }
}
