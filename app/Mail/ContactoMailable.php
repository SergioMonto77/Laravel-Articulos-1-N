<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\{Envelope, Address};
use Illuminate\Queue\SerializesModels;

class ContactoMailable extends Mailable
{
    use Queueable, SerializesModels;

    public string $nombre;
    public string $email;
    public string $contenido;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $datos)
    {
        $this->nombre= $datos['nombre'];
        $this->email= ($datos['email']) ? $datos['email'] : auth()->user()->email; //email valdrá el email introducido y si no introduce nada valdrá el email del usuario logueado
        $this->contenido= $datos['contenido'];
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope() //indicamos el asunto y quien lo envía
    {
        return new Envelope(
            from: new Address($this->email, $this->nombre), //debo pasarle primero el mail y luego el nombre
            subject: 'Formulario de Contacto',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'correos.correo1', //lo mostraré en formato de markdown y con with indicaré el valor de las variables que le paso a mi markdown
            with:[
                'nombre'=> $this->nombre,
                'email'=> $this->email,
                'contenido'=> $this->contenido
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
