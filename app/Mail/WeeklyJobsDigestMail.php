<?php

declare(strict_types = 1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * The new jobs mail notification.
 */
class WeeklyJobsDigestMail extends Mailable {
  use Queueable, SerializesModels;

  /**
   * Create a new message instance.
   */
  public function __construct(
    public $user,
    public Collection $jobs,
  ) {}

  /**
   * Get the message envelope.
   */
  public function envelope(): Envelope {
    return new Envelope(
      to: $this->user->email,
      from: new Address(config('mail.from.address')),
      subject: 'Weekly Jobs Digest',
    );
  }

  /**
   * Get the message content definition.
   */
  public function content(): Content {
    return new Content(
      view: 'emails.weekly_jobs_digest',
      with: [
        'user' => $this->user,
        'jobs' => $this->jobs,
      ]
    );
  }

  /**
   * Get the attachments for the message.
   *
   * @return array<int, \Illuminate\Mail\Mailables\Attachment>
   */
  public function attachments(): array {
    return [];
  }

}
