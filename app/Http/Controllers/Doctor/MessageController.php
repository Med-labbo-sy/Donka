<?php
namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // Liste des conversations du médecin
    public function index()
    {
        $conversations = Conversation::where('doctor_id', auth()->id())
                                     ->with(['patient', 'lastMessage'])
                                     ->latest()
                                     ->get();
        return view('doctor.messages.index', compact('conversations'));
    }

    // Ouvrir une conversation
    public function show(Conversation $conversation)
    {
        if ($conversation->doctor_id !== auth()->id()) {
            abort(403);
        }

        $messages = $conversation->messages()->with('sender')->orderBy('created_at')->get();

        // Marquer comme lus
        $conversation->messages()
                     ->where('sender_id', '!=', auth()->id())
                     ->whereNull('read_at')
                     ->update(['read_at' => now()]);

        return view('doctor.messages.show', compact('conversation', 'messages'));
    }

    // Répondre
    public function store(Request $request, Conversation $conversation)
    {
        if ($conversation->doctor_id !== auth()->id()) {
            abort(403);
        }

        $request->validate(['body' => 'required|string|max:1000']);

        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id'       => auth()->id(),
            'body'            => $request->body,
        ]);

        return back();
    }
}