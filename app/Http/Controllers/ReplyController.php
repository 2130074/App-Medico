<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function store(Request $request, $notificationId)
    {
        $request->validate([
            'message' => 'required|string|max:500',
        ]);

        $reply = new Reply();
        $reply->notification_id = $notificationId;
        $reply->user_id = Auth::id(); // Asignar el ID del doctor autenticado
        $reply->message = $request->message;
        $reply->save();

        return redirect()->back()->with('success', 'Respuesta enviada con éxito.');
    }

    public function showNotificationsWithReplies()
    {
        // Obtener las notificaciones que tienen respuestas
        $notificaciones = Notification::with('replies.user')
            ->whereHas('replies')
            ->get();

        // Pasar las notificaciones a la vista
        return view('doc.notificaciones', compact('notificaciones'));
    }
}
