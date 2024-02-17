<?php
namespace Prabin\Esewa;
use Exception;
class EsewaPayment{
    public function paymentVerify($oid,$amt,$refId,$actualAmount)
    {
        try{
            $url = config('esewa.PAYMENT_VERIFICATION');
            $data =[
            'amt'=> $actualAmount,
            'rid'=> $refId,
            'pid'=>$oid,
            'scd'=> config('esewa.ESEWA_DEV_MERCHANT')
            ];
         $curl = curl_init($url);
         curl_setopt($curl, CURLOPT_POST, true);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
         $response = curl_exec($curl);
         curl_close($curl);
          return $response;
            }
            catch(Exception $e)
            {
                return $e->getMessage();
            }
    }
    public function afterFailure()
    {
        return 'failure';
    }
    public function order(){
        return 'order';
    }
}