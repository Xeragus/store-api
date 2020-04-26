<?php

namespace App\Mail;

use App\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CategoryCreatedNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    private $category;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->category = $category;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('from@example.com')
            ->view('mails.category-created', ['category' => $this->category])
            ->subject('New category has been created!');
    }
}
