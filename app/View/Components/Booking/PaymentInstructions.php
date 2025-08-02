<?php

namespace App\View\Components\Booking;

use Illuminate\View\Component;

class PaymentInstructions extends Component
{
    public function render()
    {
        return view('components.booking.payment-instructions');
    }
}