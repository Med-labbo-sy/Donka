<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Laisser un avis</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
<div class="max-w-xl mx-auto py-10 px-4">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-semibold text-gray-800">Laisser un avis</h1>
        <a href="{{ route('patient.appointments.index') }}" class="text-sm text-gray-500">← Retour</a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-8">
        <p class="text-sm text-gray-500 mb-6">Consultation avec <strong>Dr. {{ $appointment->doctor->name }}</strong> le {{ $appointment->date }}</p>

        <form method="POST" action="{{ route('patient.review.store', $appointment) }}" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">Note</label>
                <div class="flex gap-3" id="stars">
                    @for($i = 1; $i <= 5; $i++)
                        <label class="cursor-pointer">
                            <input type="radio" name="rating" value="{{ $i }}" class="hidden" required>
                            <span class="text-4xl text-gray-300 hover:text-yellow-400 transition star-label">★</span>
                        </label>
                    @endfor
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Commentaire (optionnel)</label>
                <textarea name="comment" rows="4" placeholder="Décrivez votre expérience..."
                          class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 resize-none"></textarea>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg text-sm transition">
                Publier l'avis
            </button>
        </form>
    </div>
</div>
<script>
document.querySelectorAll('#stars label').forEach((label, i, all) => {
    label.addEventListener('click', () => {
        all.forEach((l, j) => {
            l.querySelector('span').style.color = j <= i ? '#f59e0b' : '#d1d5db';
        });
    });
});
</script>
</body>
</html>