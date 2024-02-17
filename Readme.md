# Laravel eSewa Integration

[![License](https://img.shields.io/badge/License-MIT-blue.svg)](https://opensource.org/licenses/MIT)

This repository contains the source code and resources for integrating the eSewa payment gateway into a Laravel application.

#Lets start from form
When you copy form from esewa please make sure to include
```html
  <form action="https://uat.esewa.com.np/epay/main" method="POST">
            <input value="100" name="tAmt" type="hidden">
            <input value="90" name="amt" type="hidden">
            <input value="5" name="txAmt" type="hidden">
            <input value="2" name="psc" type="hidden">
            <input value="3" name="pdc" type="hidden">
            <input value="EPAYTEST" name="scd" type="hidden">
            <input value="1234strsst" name="pid" type="hidden">
            <input value="{{route('payment.success')}}" type="hidden" name="su">
            <input value="{{route('payment.failure')}}" type="hidden" name="fu">
            <input value="Submit" type="submit">
            </form>
```


## Environment Variables

ESEWA_DEV="https://uat.esewa.com.np"
ESEWA_LIVE="https://esewa.com.np"
ESEWA_DEV_MERCHANT="EPAYTEST"
ESEWA_LIVE_MERCHANT=""
PAYMENT_VERIFICATION="https://uat.esewa.com.np/epay/transrec"

## Installation and Setup

1. Install the eSewa package via Composer:

    ```bash
    composer require prabin/esewa
    ```

2. Publish the vendor files:

    ```bash
    php artisan vendor:publish
    ```

3. Add the following code to your `config/app.php` file in the providers section:

    ```php
    Prabin\Esewa\EsewaServiceProvider::class,
    ```

## Usage

1. **Define Routes**:

    ```php
    Route::get('/payment-success', [EsewaController::class, 'success'])->name('payment.success');
    Route::get('/payment-failure', [EsewaController::class, 'failure'])->name('payment.failure');
    ```

2. **Create Controller Methods**:

    ```php
    namespace App\Http\Controllers;

    use Prabin\Esewa\EsewaPayment;
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
    ```

## License

This project is licensed under the [MIT License](LICENSE).
