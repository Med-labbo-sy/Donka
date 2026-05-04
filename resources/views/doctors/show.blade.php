<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dr. {{ $user->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
<div class="max-w-2xl mx-auto py-10 px-4">
    <a href="{{ route('doctors.index') }}" class="text-sm text-gray-500 hover:text-gray-700 mb-6 inline-block">← Tous les médecins</a>

    <div class="bg-white rounded-2xl shadow-sm p-8">
        <div class="flex gap-6 items-start">
            @if($profile?->photo)
                <img src="{{ asset('storage/'.$profile->photo) }}" class="w-24 h-24 rounded-full object-cover">
            @else
                <div class="w-24 h-24 rounded-full bg-blue-100 flex items-center justify-center">
                    <span class="text-4xl">👨‍⚕️</span>
                </div>
            @endif
            <div>
                <h1 class="text-xl font-semibold text-gray-800">Dr. {{ $user->name }}</h1>
                <p class="text-blue-600 text-sm">{{ $profile?->specialization ?? 'Généraliste' }}</p>
                <p class="text-gray-500 text-sm mt-1">Frais : {{ $profile?->consultation_fee ?? '—' }} DH</p>
            </div>
        </div>

        @if($profile?->biography)
            <div class="mt-6">
                <h2 class="text-sm font-medium text-gray-700 mb-2">Biographie</h2>
                <p class="text-sm text-gray-600 leading-relaxed">{{ $profile->biography }}</p>
            </div>
        @endif

        @auth
            @if(auth()->user()->role === 'patient')
                <a href="{{ route('patient.appointments.create') }}?doctor_id={{ $user->id }}"
                   class="mt-6 block w-full text-center bg-blue-600 text-white py-2.5 rounded-lg text-sm hover:bg-blue-700 transition">
                    Prendre un rendez-vous
                </a>
            @endif
        @endauth
    </div>
</div>
</body>
</html>