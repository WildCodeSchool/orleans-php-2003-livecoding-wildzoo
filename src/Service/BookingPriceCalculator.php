<?php

namespace App\Service;

use App\Entity\Booking;

class BookingPriceCalculator
{
    public function getTotal(Booking $booking): float
    {
        return $booking->getNumber() * Booking::TICKET_PRICE;
    }
}
