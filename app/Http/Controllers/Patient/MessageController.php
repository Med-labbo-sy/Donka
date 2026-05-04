<?php
namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // Liste des conversations du patient
    public function index()
    {
        $conversations = Conversation::where('patient_id', auth()->id())
                                     ->with(['doctor', 'lastMessage'])
                                     ->latest()
                                     ->get();
        return view('patient.messages.index', compact('conversations'));
    }

    // Ouvrir ou créer une conversation avec un médecin
    public function show($doctorId)
    {
        $doctor = User::findOrFail($doctorId);

        $conversation = Conversation::firstOrCreate([
            'patient_id' => auth()->id(),
            'doctor_id'  => $doctorId,
        ]);

        $messages = $conversation->messages()->with('sender')->orderBy('created_at')->get();

        // Marquer les messages comme lus
        $conversation->messages()
                     ->where('sender_id', '!=', auth()->id())
                     ->whereNull('read_at')
                     ->update(['read_at' => now()]);

        return view('patient.messages.show', compact('conversation', 'messages', 'doctor'));
    }

    // Envoyer un message
    public function store(Request $request, Conversation $conversation)
    {
        $request->validate(['body' => 'required|string|max:1000']);

        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id'       => auth()->id(),
            'body'            => $request->body,
        ]);

        return back();
    }
}