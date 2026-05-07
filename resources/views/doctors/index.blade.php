<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nos Médecins</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
<div class="max-w-5xl mx-auto py-10 px-4">
    <a href="/" class="text-sm text-gray-500 hover:text-gray-700">← Retour</a>
    <h1 class="text-2xl font-semibold text-center text-gray-800 mb-6">Nos Médecins</h1>

    {{-- Filtres avancés --}}
    <form method="GET" class="bg-white rounded-xl shadow-sm p-5 mb-8 grid grid-cols-2 md:grid-cols-4 gap-4">
        <div>
            <label class="text-xs text-gray-500 mb-1 block">Recherche</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Nom ou spécialisation"
                   class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none">
        </div>
        <div>
            <label class="text-xs text-gray-500 mb-1 block">Prix min (DH)</label>
            <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="0"
                   class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none">
        </div>
        <div>
            <label class="text-xs text-gray-500 mb-1 block">Prix max (DH)</label>
            <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="1000"
                   class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none">
        </div>
        <div>
            <label class="text-xs text-gray-500 mb-1 block">Note min</label>
            <select name="min_rating" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none">
                <option value="">Toutes</option>
                <option value="3" {{ request('min_rating') == 3 ? 'selected' : '' }}>3★ et plus</option>
                <option value="4" {{ request('min_rating') == 4 ? 'selected' : '' }}>4★ et plus</option>
                <option value="5" {{ request('min_rating') == 5 ? 'selected' : '' }}>5★ seulement</option>
            </select>
        </div>
        <div class="col-span-2 md:col-span-4 flex gap-3">
            <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg text-sm hover:bg-blue-700">Filtrer</button>
            <a href="{{ route('doctors.index') }}" class="text-sm text-gray-500 self-center hover:text-gray-700">Réinitialiser</a>
        </div>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($doctors as $doctor)
            <a href="{{ route('doctors.show', $doctor) }}"
               class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-md transition flex gap-4">
                @if($doctor->doctorProfile?->photo)
                    <img src="{{ asset('storage/'.$doctor->doctorProfile->photo) }}"
                         class="w-16 h-16 rounded-full object-cover flex-shrink-0">
                @else
                    <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                        <span class="text-2xl">👨‍⚕️</span>
                    </div>
                @endif
                <div class="flex-1">
                    <p class="font-medium text-gray-800">Dr. {{ $doctor->name }}</p>
                    <p class="text-sm text-blue-600">{{ $doctor->doctorProfile?->specialization ?? 'Généraliste' }}</p>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="text-yellow-400 text-sm">★</span>
                        <span class="text-xs text-gray-500">{{ number_format($doctor->averageRating(), 1) }} ({{ $doctor->reviews->count() }} avis)</span>
                        <span class="text-xs text-gray-400">·</span>
                        <span class="text-xs text-gray-500">{{ $doctor->doctorProfile?->consultation_fee ?? '—' }} DH</span>
                    </div>
                </div>
            </a>
        @empty
            <p class="text-gray-400 text-sm col-span-2 text-center py-8">Aucun médecin trouvé.</p>
        @endforelse
    </div>
</div>
</body>
</html>