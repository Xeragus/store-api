<?php


namespace App\Mail;

use App\Location;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LocationAddedNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    private $location;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Location $location)
    {
        $this->location = $location;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('from@example.com')
            ->view('mails.location-added', ['location' => $this->location])
            ->subject('New address has been added!');
    }


}
