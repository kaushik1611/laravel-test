<x-mail::message>
# Introduction

Dear **{{ $user->name }}**,
    
We are excited to inform you that your recent purchase on **{{ $product->name }}** was successful. Here are the details of your purchase:
    
**Order Summary**
- **Product Name:** {{ $product->name }}<br>
- **Product Price:** ${{ $product->cost }}


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
