<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indisponibilités — Médecin</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:'Plus Jakarta Sans',sans-serif;background:#f1f0ed;color:#1a1a1a;display:flex;height:100vh;overflow:hidden}
        a{text-decoration:none;color:inherit}
        .sidebar{width:220px;min-width:220px;background:#0f0f0f;display:flex;flex-direction:column;height:100vh;position:fixed;left:0;top:0}
        .logo{font-size:20px;font-weight:600;color:#fff;padding:20px;border-bottom:1px solid #1e1e1e}
        .logo span{color:#0d5c4a}
        .nav{flex:1;padding:12px 0;overflow-y:auto}
        .nav-section{font-size:10px;font-weight:600;color:#444;text-transform:uppercase;letter-spacing:2px;padding:14px 20px 6px}
        .nav-item{display:flex;align-items:center;gap:10px;padding:9px 20px;font-size:13px;color:#888;transition:all .2s;border-left:2px solid transparent}
        .nav-item:hover{color:#fff;background:rgba(255,255,255,0.04)}
        .nav-item.active{color:#fff;border-left-color:#0d5c4a;background:rgba(13,92,74,0.1)}
        .nav-icon{width:18px;text-align:center;font-size:14px;flex-shrink:0}
        .nav-badge{margin-left:auto;background:#ef4444;color:#fff;font-size:10px;font-weight:600;padding:1px 6px;border-radius:100px}
        .sidebar-footer{padding:16px 20px;border-top:1px solid #1e1e1e}
        .user-info{display:flex;align-items:center;gap:10px}
        .user-avatar{width:34px;height:34px;border-radius:50%;background:#1a1a1a;border:1px solid #333;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:600;color:#fff;flex-shrink:0}
        .user-name{font-size:12px;font-weight:500;color:#ccc}
        .user-role{font-size:10px;color:#555;margin-top:1px}
        .logout-btn{background:none;border:none;font-size:13px;color:#888;cursor:pointer;font-family:'Plus Jakarta Sans',sans-serif;padding:9px 20px;width:100%;text-align:left;display:flex;align-items:center;gap:10px;margin-top:4px}
        .logout-btn:hover{color:#ef4444}
        .main{flex:1;margin-left:220px;display:flex;flex-direction:column;height:100vh;overflow:hidden}
        .topbar{display:flex;align-items:center;justify-content:space-between;padding:14px 24px;background:#fff;border-bottom:1px solid #e5e2db;flex-shrink:0}
        .page-title{font-size:16px;font-weight:600;color:#0f0f0f}
        .page-sub{font-size:12px;color:#888;margin-top:1px}
        .body{flex:1;overflow-y:auto;padding:20px 24px}
        .card{background:#fff;border-radius:14px;padding:20px;border:1px solid #e5e2db;margin-bottom:16px}
        .card-title{font-size:13px;font-weight:600;color:#0f0f0f;margin-bottom:16px}
        .form-row{display:flex;gap:10px;align-items:flex-end}
        .form-group{display:flex;flex-direction:column;gap:5px}
        .form-label{font-size:12px;font-weight:500;color:#666}
        .form-input{border:1px solid #e5e2db;border-radius:10px;padding:9px 14px;font-size:13px;font-family:'Plus Jakarta Sans',sans-serif;outline:none;background:#f9f8f6;transition:border .2s}
        .form-input:focus{border-color:#0d5c4a;background:#fff}
        .btn-block{background:#ef4444;color:#fff;border:none;border-radius:10px;padding:9px 20px;font-size:13px;font-weight:500;cursor:pointer;font-family:'Plus Jakarta Sans',sans-serif;white-space:nowrap}
        .btn-block:hover{background:#dc2626}
        .date-item{display:flex;align-items:center;justify-content:space-between;padding:12px 16px;border-bottom:1px solid #f5f4f1;transition:background .15s}
        .date-item:last-child{border-bottom:none}
        .date-item:hover{background:#fafaf8}
        .date-val{font-size:13px;font-weight:500;color:#0f0f0f}
        .date-reason{font-size:11px;color:#888;margin-top:2px}
        .date-badge{background:#fee2e2;color:#991b1b;font-size:10px;padding:2px 10px;border-radius:100px;font-weight:500;margin-right:12px}
        .btn-unblock{background:none;border:1px solid #fca5a5;color:#ef4444;font-size:12px;padding:5px 12px;border-radius:8px;cursor:pointer;font-family:'Plus Jakarta Sans',sans-serif}
        .btn-unblock:hover{background:#fee2e2}
        .empty{padding:32px;text-align:center;color:#aaa;font-size:13px}
        .alert-success{background:#d1fae5;border:1px solid #6ee7b7;color:#065f46;padding:10px 16px;border-radius:10px;font-size:13px;margin-bottom:16px}
    </style>
</head>
<body>

{{-- SIDEBAR --}}
<div class="sidebar">
    <div class="logo">Don<span>ka</span></div>
    <nav class="nav">
        <div class="nav-section">Principal</div>
        <a href="/doctor/dashboard" class="nav-item"><span class="nav-icon">🏠</span> Tableau de bord</a>
        <a href="{{ route('doctor.appointments.index') }}" class="nav-item">
            <span class="nav-icon">📅</span> Rendez-vous
            @php $pending = \App\Models\Appointment::where('doctor_id', auth()->id())->where('status','pending')->count(); @endphp
            @if($pending > 0)<span class="nav-badge">{{ $pending }}</span>@endif
        </a>
        <a href="{{ route('doctor.messages.index') }}" class="nav-item"><span class="nav-icon">💬</span> Messages</a>
        <a href="{{ route('notifications.index') }}" class="nav-item"><span class="nav-icon">🔔</span> Notifications</a>
        <div class="nav-section">Gestion</div>
        <a href="{{ route('doctor.blocked-dates.index') }}" class="nav-item active"><span class="nav-icon">📵</span> Indisponibilités</a>
        <a href="{{ route('doctor.profile') }}" class="nav-item"><span class="nav-icon">👤</span> Mon profil</a>
    </nav>
    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
            <div>
                <div class="user-name">Dr. {{ auth()->user()->name }}</div>
                <div class="user-role">Médecin</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn"><span>🚪</span> Déconnexion</button>
        </form>
    </div>
</div>

{{-- MAIN --}}
<div class="main">
    <div class="topbar">
        <div>
            <div class="page-title">Gérer mes indisponibilités</div>
            <div class="page-sub">Bloquez les dates où vous n'êtes pas disponible</div>
        </div>
    </div>

    <div class="body">

        @if(session('success'))
            <div class="alert-success">✓ {{ session('success') }}</div>
        @endif

        {{-- FORMULAIRE --}}
        <div class="card">
            <div class="card-title">Bloquer une date</div>
            <form method="POST" action="{{ route('doctor.blocked-dates.store') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Date</label>
                        <input type="date" name="date" required class="form-input">
                    </div>
                    <div class="form-group" style="flex:1">
                        <label class="form-label">Raison (optionnel)</label>
                        <input type="text" name="reason" placeholder="Ex: Congé, Formation..." class="form-input">
                    </div>
                    <button type="submit" class="btn-block">📵 Bloquer</button>
                </div>
            </form>
        </div>

        {{-- LISTE --}}
        <div class="card" style="padding:0;overflow:hidden">
            <div style="padding:16px 20px;border-bottom:1px solid #f5f4f1">
                <div class="card-title" style="margin:0">Dates bloquées</div>
            </div>
            @forelse($blocked as $date)
                <div class="date-item">
                    <div>
                        <div class="date-val">{{ \Carbon\Carbon::parse($date->date)->locale('fr')->isoFormat('dddd D MMMM YYYY') }}</div>
                        @if($date->reason)
                            <div class="date-reason">{{ $date->reason }}</div>
                        @endif
                    </div>
                    <div style="display:flex;align-items:center;gap:8px">
                        <span class="date-badge">Bloqué</span>
                        <form method="POST" action="{{ route('doctor.blocked-dates.destroy', $date) }}">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-unblock">Débloquer</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="empty">Aucune date bloquée pour le moment.</div>
            @endforelse
        </div>

    </div>
</div>

</body>
</html>