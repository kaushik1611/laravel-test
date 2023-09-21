<?php

namespace App\Http\Controllers;

use App\Mail\ProductCancelled;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Mail\ProductPurchased;
use App\Models\Customer;
use Illuminate\Support\Facades\Mail;
use Laravel\Cashier\Exceptions\IncompletePayment;

class SubscriptionController extends Controller
{
    public function create(Request $request)
    {
        try {
            $product = Product::findOrFail($request->get('product'));

            $userInformation = [
                'name' => $request->user()->name,
                'email' => $request->user()->email,
                'address' => [
                    'line1' => '123 Main St',
                    'postal_code' => '12345',
                    'city' => 'New York',
                    'state' => 'NY',
                    'country' => 'United States',
                ],
            ];
            $request->user()
                ->newSubscription($product->slug, $product->stripe_price)
                ->quantity(1)
                ->trialDays(14)
                ->create($request->paymentMethod, $userInformation);

            if ($product->slug === 'b2b product') {
                $request->user()->assignRole('b2bcustomer');
            } else {
                $request->user()->assignRole('b2cCustomer');
            }

            Mail::to(auth()->user()->email)->send(new ProductPurchased($request->user(), $product));

            return redirect()->route('customer.index')->with('success', 'Your product subscribed successfully');
        } catch (IncompletePayment $exception) {
            return redirect()->route(
                'cashier.payment',
                [$exception->payment->id, 'redirect' => route('customer.index')]
            );
        }
    }
    public function cancel(Customer $customer)
    {
        try {
            if (!$customer->name) {
                $customer = auth()->user();
            }
            $activeSubscription = $customer->activeSubscription->first();
            Mail::to($customer->email)->send(new ProductCancelled($customer, $activeSubscription));
            $customer->subscription($activeSubscription->name)->cancel();
            $customer->syncRoles([]);
            if(auth()->guard('admin')->check()){
                return redirect()->route('admin.index')->with('success', 'Successfully cancle subscription.');
            }else{
                return redirect()->route('customer.index')->with('success', 'Successfully cancle subscription.');
            }
            
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Somethig went wrong', 'error_msg' => $e->getMessage()]);
        }
    }
}
