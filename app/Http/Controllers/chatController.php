<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class chatController extends Controller
{
    public function enviarMensaje(Request $request)
    {
        {
            if ($request->has("contenido")){
                
                    $request->validate([
                        "contenido" => 'required|string'
                    ]);
            
                    $chat = new Chat();
                    $chat->contenido = $request->contenido;
                    $chat->visto = false;
                    $chat->save();
                    
                    $interactua = new Interactua();
                    $interactua->usuario_id1 = $request->usuario_id1;
                    $interactua->usuario_id2 = $request->usuario_id2;
                    $interactua->chat_id = $chat->id;
                    $interactua->save();

                    return response()->json(['mensaje' => 'Mensaje enviado con éxito'], 201);
            }
            return response()->json(["error mesage" => "El mensaje no fue enviado correctamente"]);
        }
    }

    public function obtenerMensajes(){
        $usuario1 = $request->usuario_id1;
        $usuario2 = $request->usuario_id2;
    
        $mensajes = Interactua::where(function ($query) use ($usuario1, $usuario2) {
            $query->where('usuario_id1', $usuario1)
                  ->where('usuario_id2', $usuario2);
        })->orWhere(function ($query) use ($usuario1, $usuario2) {
            $query->where('usuario_id1', $usuario2)
                  ->where('usuario_id2', $usuario1);
        })->with('chat')->get();
    
        return response()->json($mensajes, 200);
    }

    public function marcarComoVisto(Request $request, $id)
    {
        $mensaje = Chat::findOrFail($id);
        $mensaje->visto = true;
        $mensaje->save();

        return response()->json(['mensaje' => 'Mensaje marcado como visto'], 200);
    }
}
