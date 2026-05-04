<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Conversation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
<div class="max-w-3xl mx-auto py-10 px-4">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-semibold text-gray-800">{{ $conversation->patient->name }}</h1>
        <a href="{{ route('doctor.messages.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Messages</a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-6 space-y-4 mb-4 min-h-64">
        @forelse($messages as $msg)
            <div class="flex {{ $msg->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                <div class="max-w-xs lg:max-w-md px-4 py-2.5 rounded-2xl text-sm
                    {{ $msg->sender_id === auth()->id()
                        ? 'bg-blue-600 text-white rounded-br-sm'
                        : 'bg-gray-100 text-gray-800 rounded-bl-sm' }}">
                    <p>{{ $msg->body }}</p>
                    <p class="text-xs mt-1 opacity-60">{{ $msg->created_at->format('H:i') }}</p>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-400 text-sm py-8">Aucun message</p>
        @endforelse
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-4">
        <form method="POST" action="{{ route('doctor.messages.store', $conversation) }}" class="flex gap-3">
            @csrf
            <input type="text" name="body" placeholder="Répondre..."
                   class="flex-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
            <button type="submit" class="bg-blue-600 text-white px-5 py-2.5 rounded-lg text-sm hover:bg-blue-700 transition">
                Envoyer
            </button>
        </form>
    </div>
</div>
</body>
</html>