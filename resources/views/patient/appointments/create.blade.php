<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Prendre un RDV</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
<div class="max-w-2xl mx-auto py-10 px-4">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-semibold text-gray-800">Prendre un rendez-vous</h1>
        <a href="/patient/dashboard" class="text-sm text-gray-500 hover:text-gray-700">← Dashboard</a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm p-8">
        <form method="POST" action="{{ route('patient.appointments.store') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Choisir un médecin</label>
                <select name="doctor_id" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                    <option value="">-- Sélectionner --</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}">
                            Dr. {{ $doctor->name }}
                            @if($doctor->doctorProfile)
                                — {{ $doctor->doctorProfile->specialization }}
                                ({{ $doctor->doctorProfile->consultation_fee }} DH)
                            @endif
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('doctor_id')" class="mt-2"/>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                <input type="date" name="date" value="{{ old('date') }}"
                       class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                <x-input-error :messages="$errors->get('date')" class="mt-2"/>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Heure</label>
                <input type="time" name="time" value="{{ old('time') }}"
                       class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                <x-input-error :messages="$errors->get('time')" class="mt-2"/>
            </div>

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-lg px-4 py-3">
                    <ul class="text-sm text-red-600 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg text-sm transition">
                Confirmer le rendez-vous
            </button>
        </form>
    </div>
</div>
</body>
</html>