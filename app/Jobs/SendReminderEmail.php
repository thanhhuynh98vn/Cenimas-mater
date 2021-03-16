<?php

namespace App\Jobs;

use App\Mail\SendEmailMailable;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Mail\Mailable;
use PHPUnit\Framework\Exception;

class SendReminderEmail  implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $email;
    protected $password;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($value)
    {
    $this->email = $value['email'];
    $this->password = $value['password'];

    }

    /**
     * @return void
     */
    public function handle()
    {

        $email = $this->email;
        $password = $this->password;
        Mail::to($email)->send(new SendEmailMailable($email,$password));


    }
    public function failed($exception = null)
    {

    }
}
