<?php

namespace App\View\Components\Booking;

use Illuminate\View\Component;

class SuccessQr extends Component
{
    public $booking;
    public $qrCode;

    public function __construct($booking, $qrCode)
    {
        $this->booking = $booking;
        $this->qrCode = $qrCode;
    }

    public function render()
    {
        return view('components.booking.success-qr');
    }
}