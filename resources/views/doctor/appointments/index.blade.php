<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Rendez-vous</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
<div class="max-w-5xl mx-auto py-10 px-4">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-semibold text-gray-800">Rendez-vous</h1>
        <a href="/doctor/dashboard" class="text-sm text-gray-500 hover:text-gray-700">← Dashboard</a>
    </div>

    {{-- Filtres --}}
    <form method="GET" class="bg-white rounded-xl shadow-sm p-4 mb-6 flex gap-4">
        <select name="status" class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none">
            <option value="">Tous les statuts</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
            <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Acceptés</option>
            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Terminés</option>
            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Annulés</option>
        </select>
        <input type="date" name="date" value="{{ request('date') }}"
               class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">Filtrer</button>
        <a href="{{ route('doctor.appointments.index') }}" class="text-sm text-gray-500 hover:text-gray-700 self-center">Réinitialiser</a>
    </form>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        @forelse($appointments as $rdv)
            <div class="p-5 border-b border-gray-100 last:border-0">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="font-medium text-gray-800">{{ $rdv->patient->name }}</p>
                        <p class="text-sm text-gray-500">{{ $rdv->date }} à {{ $rdv->time }}</p>
                    </div>
                    <span class="text-xs font-medium px-3 py-1 rounded-full
                        @if($rdv->status === 'pending') bg-yellow-100 text-yellow-700
                        @elseif($rdv->status === 'accepted') bg-green-100 text-green-700
                        @elseif($rdv->status === 'completed') bg-blue-100 text-blue-700
                        @else bg-red-100 text-red-700
                        @endif">
                        {{ $rdv->status }}
                    </span>
                </div>

                {{-- Actions selon statut --}}
                @if($rdv->status === 'pending')
                    <div class="flex gap-3 mt-3">
                        <form method="POST" action="{{ route('doctor.appointments.accept', $rdv) }}">
                            @csrf @method('PATCH')
                            <button class="text-sm bg-green-500 text-white px-3 py-1.5 rounded-lg hover:bg-green-600">Accepter</button>
                        </form>
                        <form method="POST" action="{{ route('doctor.appointments.refuse', $rdv) }}">
                            @csrf @method('PATCH')
                            <button class="text-sm bg-red-500 text-white px-3 py-1.5 rounded-lg hover:bg-red-600">Refuser</button>
                        </form>
                    </div>
                @elseif($rdv->status === 'accepted')
                    <form method="POST" action="{{ route('doctor.appointments.complete', $rdv) }}" class="mt-3 flex gap-3">
                        @csrf @method('PATCH')
                        <input type="text" name="notes" placeholder="Notes de consultation (optionnel)"
                               class="flex-1 border border-gray-200 rounded-lg px-3 py-1.5 text-sm focus:outline-none">
                        <button class="text-sm bg-blue-500 text-white px-3 py-1.5 rounded-lg hover:bg-blue-600">Terminer</button>
                    </form>
                @elseif($rdv->status === 'completed' && $rdv->notes)
                    <p class="text-xs text-gray-400 mt-2">Notes : {{ $rdv->notes }}</p>
                @endif
            </div>
        @empty
            <div class="p-10 text-center text-gray-400 text-sm">Aucun rendez-vous.</div>
        @endforelse
    </div>
</div>
</body>
</html>