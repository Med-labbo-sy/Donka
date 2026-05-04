<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nos Médecins</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
<div class="max-w-5xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-semibold text-gray-800 mb-8">Nos Médecins</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($doctors as $doctor)
            <a href="{{ route('doctors.show', $doctor) }}" class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-md transition flex gap-4">
                @if($doctor->doctorProfile?->photo)
                    <img src="{{ asset('storage/'.$doctor->doctorProfile->photo) }}"
                         class="w-16 h-16 rounded-full object-cover flex-shrink-0">
                @else
                    <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                        <span class="text-2xl">👨‍⚕️</span>
                    </div>
                @endif
                <div>
                    <p class="font-medium text-gray-800">Dr. {{ $doctor->name }}</p>
                    <p class="text-sm text-blue-600">{{ $doctor->doctorProfile?->specialization ?? 'Généraliste' }}</p>
                    <p class="text-sm text-gray-500 mt-1">{{ $doctor->doctorProfile?->consultation_fee ?? '—' }} DH</p>
                </div>
            </a>
        @empty
            <p class="text-gray-400 text-sm">Aucun médecin disponible.</p>
        @endforelse
    </div>
</div>
</body>
</html>