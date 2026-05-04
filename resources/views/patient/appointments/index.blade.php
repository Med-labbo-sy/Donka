<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Rendez-vous</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
<div class="max-w-4xl mx-auto py-10 px-4">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-semibold text-gray-800">Mes Rendez-vous</h1>
        <div class="flex gap-3">
            <a href="{{ route('patient.appointments.create') }}" class="bg-blue-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-blue-700">+ Nouveau RDV</a>
            <a href="/patient/dashboard" class="text-sm text-gray-500 hover:text-gray-700">← Dashboard</a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        @forelse($appointments as $rdv)
            <div class="flex items-center justify-between p-5 border-b border-gray-100 last:border-0">
                <div>
                    <p class="font-medium text-gray-800">Dr. {{ $rdv->doctor->name }}</p>
                    <p class="text-sm text-gray-500">{{ $rdv->date }} à {{ $rdv->time }}</p>
                    @if($rdv->notes)
                        <p class="text-xs text-gray-400 mt-1">Notes : {{ $rdv->notes }}</p>
                    @endif
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-xs font-medium px-3 py-1 rounded-full
                        @if($rdv->status === 'pending') bg-yellow-100 text-yellow-700
                        @elseif($rdv->status === 'accepted') bg-green-100 text-green-700
                        @elseif($rdv->status === 'completed') bg-blue-100 text-blue-700
                        @else bg-red-100 text-red-700
                        @endif">
                        {{ $rdv->status }}
                    </span>
                    @if(in_array($rdv->status, ['pending', 'accepted']))
                        <form method="POST" action="{{ route('patient.appointments.cancel', $rdv) }}">
                            @csrf
                            @method('PATCH')
                            <button class="text-xs text-red-500 hover:text-red-700">Annuler</button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="p-10 text-center text-gray-400 text-sm">
                Aucun rendez-vous pour le moment.
                <a href="{{ route('patient.appointments.create') }}" class="text-blue-500 hover:underline ml-1">Prendre un RDV</a>
            </div>
        @endforelse
    </div>
</div>
</body>
</html>