<?php

namespace App\Console\Commands;

use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckExpiredBookings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookings:checkexpired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for expired bookings and update room availability';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $bookings = Booking::where('checking_status', false)->where('status', 'confirmed')
            ->where('check_out', '<', Carbon::now())
            ->get();

        foreach ($bookings as $booking) {
            $room = Room::find($booking->room_id);
            $room->available_rooms += $booking->total_rooms;
            $room->save();

            $booking->checking_status = true;
            $booking->save();
        }
    }
}
