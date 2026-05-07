<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #1a1a1a; }
        .header { background: #0d5c4a; color: white; padding: 20px; margin-bottom: 24px; }
        .header h1 { font-size: 20px; margin: 0; }
        .header p { margin: 4px 0 0; font-size: 11px; opacity: 0.8; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #f1efe8; padding: 10px; text-align: left; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; }
        td { padding: 10px; border-bottom: 1px solid #ece9e3; font-size: 12px; }
        .badge { padding: 3px 8px; border-radius: 4px; font-size: 10px; font-weight: bold; }
        .pending   { background: #fef3c7; color: #92400e; }
        .accepted  { background: #d1fae5; color: #065f46; }
        .completed { background: #dbeafe; color: #1e40af; }
        .cancelled { background: #fee2e2; color: #991b1b; }
        .footer { margin-top: 32px; font-size: 10px; color: #888; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Historique des rendez-vous</h1>
        <p>Patient : {{ $user->name }} — Généré le {{ now()->format('d/m/Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Médecin</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Statut</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @forelse($appointments as $rdv)
                <tr>
                    <td>Dr. {{ $rdv->doctor->name }}</td>
                    <td>{{ $rdv->date }}</td>
                    <td>{{ $rdv->time }}</td>
                    <td><span class="badge {{ $rdv->status }}">{{ $rdv->status }}</span></td>
                    <td>{{ $rdv->notes ?? '—' }}</td>
                </tr>
            @empty
                <tr><td colspan="5" style="text-align:center;color:#888">Aucun rendez-vous</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">Donka — Plateforme médicale · donka.ma</div>
</body>
</html>