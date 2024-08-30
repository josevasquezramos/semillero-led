<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AsistenciaNotificacion extends Mailable
{
    use Queueable, SerializesModels;

    public $alumno;
    public $curso;
    public $apoderado;
    public $fecha;
    public $estado;
    public $diseno;
    public $encabezado;
    /**
     * Create a new message instance.
     */
    public function __construct($alumno, $curso, $apoderado, $fecha, $estado, $diseno, $encabezado)
    {
        $this->alumno = $alumno;
        $this->curso = $curso;
        $this->apoderado = $apoderado;
        $this->fecha = $fecha;
        $this->estado = $estado;
        $this->diseno = $diseno;
        $this->encabezado = $encabezado;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->encabezado,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.asistencia',  // La vista que contiene el contenido del correo
        );
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
