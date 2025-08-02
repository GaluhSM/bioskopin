<?php

namespace App\View\Components\Booking;

use Illuminate\View\Component;

class PaymentSummary extends Component
{
    public $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    public function render()
    {
        return view('components.booking.payment-summary');
    }
}