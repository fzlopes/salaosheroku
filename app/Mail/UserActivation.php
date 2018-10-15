<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserActivation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The user instance.
     *
     * @var User
     */
    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $actionUrl = url('/user/activate/' . $this->user->activation_code);
        $name = $this->user->name;

        return $this->from('financeiro@suaradionanet.info')
            ->subject('Seja bem vindo ao sistema financeiro Sua Rádio Na Net')
            ->view('notifications.new-user')
            ->with(compact('actionUrl', 'name'));
    }
}
