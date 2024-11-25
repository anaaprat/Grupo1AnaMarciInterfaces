<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;



class InformesController extends Controller
{

    public function sendEventsPdf(Request $request)
    {
        $user = auth()->user();

        // Obtener los eventos del usuario
        $events = $user->attendedEvents; // Usamos la relación correcta

        // Verificar si el usuario tiene eventos
        if ($events->isEmpty()) {
            return redirect()->back()->with('error', 'No events to send.');
        }

        // Convertir cada imagen a base64 antes de enviarlas a la vista
        foreach ($events as $event) {
            // Definir la ruta de la imagen
            $imagePath = public_path('storage/imagesEvent/' . $event->image_url);

            // Verificar si el archivo existe
            if (file_exists($imagePath)) {
                // Convertir la imagen a base64
                $imageData = base64_encode(file_get_contents($imagePath));
                // Crear una URL de base64 para la imagen
                $event->base64_image = 'data:image/jpeg;base64,' . $imageData;
            } else {
                // Si no existe la imagen, asignar una imagen por defecto
                $event->base64_image = 'data:image/jpeg;base64,' . base64_encode(file_get_contents(public_path('storage/imagesEvent/default.jpg')));
            }
        }

        // Crear el PDF con los eventos
        $pdf = PDF::loadView('users.usersEventsPDF', compact('user', 'events'));

        // Guardar el PDF en el servidor
        $pdfPath = storage_path('app/public/user_events.pdf');
        $pdf->save($pdfPath);

        // Enviar el correo con el PDF adjunto
        Mail::send('users.generar', compact('user', 'events'), function ($message) use ($user, $pdfPath) {
            $message->to($user->email)
                ->subject('Your Registered Events')
                ->attach($pdfPath, [
                    'as' => 'events.pdf',
                    'mime' => 'application/pdf',
                ]);
        });

        // Retornar con un mensaje de éxito
        return redirect()->back()->with('success', 'The events PDF has been sent to your email.');
    }


}
