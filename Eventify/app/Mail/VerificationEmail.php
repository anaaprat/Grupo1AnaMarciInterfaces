<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class VerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $verificationUrl;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->verificationUrl = route('verification.verify', [
            'id' => $this->user->id,
            'hash' => sha1($this->user->email),
        ]);
    }

    public function build()
    {
        return $this->view('emails.verify')
                    ->with([
                        'verificationUrl' => $this->verificationUrl,
                    ]);
    }
}
