<?php
namespace Prabin\Esewa;
class EsewaPayment{
    public function paymentVerify($oid,$amt,$refId,$actualAmount)
    {
        $url = "https://uat.esewa.com.np/epay/transrec";
        $data =[
        'amt'=> $actualAmount,
        'rid'=> $refId,
        'pid'=>'1234s',
        'scd'=> 'EPAYTEST'
        ];
     $curl = curl_init($url);
     curl_setopt($curl, CURLOPT_POST, true);
     curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
     $response = curl_exec($curl);
     curl_close($curl);
    return $response;
    }
    public function afterFailure()
    {
        return 'failure';
    }
    public function order(){
        return 'order';
    }
}