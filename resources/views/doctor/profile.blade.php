<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-2xl mx-auto py-10 px-4">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-semibold text-gray-800">Mon Profil</h1>
        <a href="/doctor/dashboard" class="text-sm text-gray-500 hover:text-gray-700">← Dashboard</a>
    </div>

    {{-- Succès --}}
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Card --}}
    <div class="bg-white rounded-2xl shadow-sm p-8">

        {{-- Photo actuelle --}}
        <div class="flex flex-col items-center mb-8">
            @if($profile->photo)
                <img src="{{ asset('storage/'.$profile->photo) }}"
                     class="w-24 h-24 rounded-full object-cover ring-4 ring-blue-100 mb-3">
            @else
                <div class="w-24 h-24 rounded-full bg-blue-100 flex items-center justify-center mb-3">
                    <span class="text-3xl text-blue-400">👨‍⚕️</span>
                </div>
            @endif
            <p class="text-gray-500 text-sm">Photo de profil</p>
        </div>

        {{-- Formulaire --}}
        <form method="POST" action="{{ route('doctor.profile.update') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Nom --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nom complet</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                       class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>

            {{-- Spécialisation --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Spécialisation</label>
                <input type="text" name="specialization" value="{{ old('specialization', $profile->specialization) }}"
                       placeholder="Ex: Cardiologue, Généraliste..."
                       class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>

            {{-- Frais --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Frais de consultation (DH)</label>
                <input type="number" name="consultation_fee" value="{{ old('consultation_fee', $profile->consultation_fee) }}"
                       class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>

            {{-- Biographie --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Biographie</label>
                <textarea name="biography" rows="4"
                          placeholder="Décrivez votre expérience, vos spécialités..."
                          class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 resize-none">{{ old('biography', $profile->biography) }}</textarea>
            </div>

            {{-- Upload photo --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Changer la photo</label>
                <input type="file" name="photo" accept="image/jpg,image/jpeg,image/png"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <p class="text-xs text-gray-400 mt-1">JPG ou PNG, max 2Mo</p>
            </div>

            {{-- Erreurs --}}
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-lg px-4 py-3">
                    <ul class="text-sm text-red-600 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Submit --}}
            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg text-sm transition">
                Enregistrer les modifications
            </button>

        </form>
    </div>
</div>

</body>
</html>