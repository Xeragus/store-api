<?php
namespace App\Mail;

use App\Location;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LocationWasDeletedNotificationMail extends Mailable
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
        return $this->from('filip@email.com')
            ->view('mails.location-deleted', ['location' => $this->location])
            ->subject('The address was deleted!');
    }


}
