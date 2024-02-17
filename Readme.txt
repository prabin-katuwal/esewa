Laravel eSewa Integration - README

This repository contains the source code and resources for integrating eSewa payment gateway into a Laravel application.

Environment Variables:
- ESEWA_DEV: The URL for eSewa's development environment.
- ESEWA_LIVE: The URL for eSewa's live (production) environment.
- ESEWA_DEV_MERCHANT: Your eSewa merchant ID for the development environment.
- ESEWA_LIVE_MERCHANT: Your eSewa merchant ID for the live environment.
- PAYMENT_VERIFICATION: The URL for eSewa's payment verification endpoint.

Installation and Setup:
1.composer require prabin/esewa;
2.php artisan vendor:publish
3.Copy this code and place in you config/app.php file in providers section
Prabin\Esewa\EsewaServiceProvider::class,


Usage:
1. Define Routes:
   - `Route::get('/payment-success', [EsewaController::class, 'success'])->name('payment.success');`
   - `Route::get('/payment-failure', [EsewaController::class, 'failure'])->name('payment.failure');`

2. Create Controller Methods:

   namespace App\Http\Controllers;

   use Illuminate\Http\Request;

   class EsewaController extends Controller
   {
       public function success(Request $request)
    {
     $payment=new EsewaPayment();
     // please make sure this totalAmount is come through your database
     // eg:$product=Product::find('id',$request->pid)->first();
     // totalAmount=$product->totalamout;
     // in my case i am passing 100;
     $actualAmount=100;
     $response=$payment->paymentVerify($request->oid,$request->amt,$request->refId,$actualAmount);
     if(strpos($response,'Success')!==false){
         // if you have orders and payment database then update your  database 
         return 'Payment Completed Successfully';//return where you want eg:return redirect('/')
     }
     else{
         return 'failed';
         //return redirect('/')->with('failure','something went Wrong');  
     }
    }

    public function failure()
    {
        // Add logic to handle failed payments here
    }
   }
