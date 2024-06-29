<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Goal;

class GoalStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $goal;
    /**
     * Create a new message instance.
     */
    public function __construct(Goal $goal)
    {
        $this->goal = $goal;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Meta cambio de estatus',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->subject('Cambio de Estado de Meta')
                    ->view('emails.goal_status_changed')
                    ->with([
                        'goal' => $this->goal,
                    ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
