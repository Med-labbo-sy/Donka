<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Messages</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
<div class="max-w-3xl mx-auto py-10 px-4">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-semibold text-gray-800">Mes Messages</h1>
        <a href="/patient/dashboard" class="text-sm text-gray-500 hover:text-gray-700">← Dashboard</a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        @forelse($conversations as $conv)
            <a href="{{ route('patient.messages.show', $conv->doctor_id) }}"
               class="flex items-center gap-4 p-5 border-b border-gray-100 hover:bg-gray-50 transition last:border-0">
                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                    <span class="text-lg">👨‍⚕️</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-medium text-gray-800">Dr. {{ $conv->doctor->name }}</p>
                    <p class="text-sm text-gray-400 truncate">
                        {{ $conv->lastMessage?->body ?? 'Aucun message' }}
                    </p>
                </div>
                <span class="text-xs text-gray-400">
                    {{ $conv->lastMessage?->created_at?->diffForHumans() }}
                </span>
            </a>
        @empty
            <div class="p-10 text-center text-gray-400 text-sm">
                Aucune conversation. Consultez un médecin pour lui envoyer un message.
            </div>
        @endforelse
    </div>
</div>
</body>
</html>