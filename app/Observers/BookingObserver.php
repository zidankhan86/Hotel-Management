<?php

namespace App\Observers;

use App\Events\CheckoutEvent;
use App\Models\Booking;

class BookingObserver
{
    /**
     * Handle the Booking "created" event.
     */
    public function created(Booking $booking): void
    {
        //
    }

    /**
     * Handle the Booking "updated" event.
     */
    public function updated(Booking $booking): void
    {
        //
    }

    /**
     * Handle the Booking "deleted" event.
     */
    public function deleted(Booking $booking): void
    {
        //
    }

    /**
     * Handle the Booking "restored" event.
     */
    public function restored(Booking $booking): void
    {
        //
    }

    /**
     * Handle the Booking "force deleted" event.
     */
    public function forceDeleted(Booking $booking): void
    {
        //
    }

    public function checkedOut(Booking $booking)
    {
        if ($booking->check_out !== null) {
            // Dispatch event to increment room availability
            event(new CheckoutEvent($booking->room_id));
        }
    }

    public function updating(Booking $booking)
    {
        // Check if check_out column is being updated
        if ($booking->isDirty('check_out')) {
            // Check if the new value of check_out is not null
            if ($booking->check_out !== null) {
                // Dispatch event to increment room availability
                event(new CheckoutEvent($booking->room_id));
            }
        }
    }
}
