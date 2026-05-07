<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Notifications</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
<div class="max-w-2xl mx-auto py-10 px-4">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-semibold text-gray-800">Notifications</h1>
        <a href="javascript:history.back()" class="text-sm text-gray-500">← Retour</a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        @forelse($notifications as $notif)
            <div class="flex items-start gap-4 p-5 border-b border-gray-100 last:border-0 {{ $notif->read_at ? 'opacity-60' : '' }}">
                <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 text-lg
                    @if($notif->type === 'appointment') bg-blue-100
                    @elseif($notif->type === 'message') bg-green-100
                    @else bg-yellow-100
                    @endif">
                    @if($notif->type === 'appointment') 📅
                    @elseif($notif->type === 'message') 💬
                    @else ⭐
                    @endif
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-800">{{ $notif->title }}</p>
                    <p class="text-sm text-gray-500 mt-0.5">{{ $notif->body }}</p>
                    <p class="text-xs text-gray-400 mt-1">{{ $notif->created_at->diffForHumans() }}</p>
                </div>
                @if(!$notif->read_at)
                    <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 flex-shrink-0"></div>
                @endif
            </div>
        @empty
            <div class="p-10 text-center text-gray-400 text-sm">Aucune notification.</div>
        @endforelse
    </div>
</div>
</body>
</html>