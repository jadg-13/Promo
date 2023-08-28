<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificacionCorreo extends Mailable
{
    use Queueable, SerializesModels;

    public $codigoVerificacion;

    public function __construct($codigoVerificacion)
    {
        $this->codigoVerificacion = $codigoVerificacion;
    }

    public function build()
    {
        return $this->view('emails.verificacion')->with([
            'codigoVerificacion' => $this->codigoVerificacion,
        ]);
    }
}

