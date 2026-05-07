<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Médecin — Donka</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'DM Sans', sans-serif; box-sizing: border-box; }
        body { background: #f0f4f8; margin: 0; }

        .sidebar {
            width: 260px;
            background: #0d1f16;
            min-height: 100vh;
            position: fixed;
            left: 0; top: 0;
            display: flex;
            flex-direction: column;
            z-index: 50;
        }
        .sidebar-logo { padding: 28px 24px 20px; border-bottom: 1px solid rgba(255,255,255,0.07); }
        .logo-text { font-family: 'DM Serif Display', serif; font-size: 26px; color: #ffffff; }
        .logo-sub { font-size: 10px; color: rgba(255,255,255,0.35); letter-spacing: 1.5px; text-transform: uppercase; margin-top: 3px; }
        .sidebar-section-label { font-size: 10px; font-weight: 600; letter-spacing: 1.5px; text-transform: uppercase; color: rgba(255,255,255,0.3); padding: 20px 24px 8px; }
        .nav-item { display: flex; align-items: center; gap: 12px; padding: 11px 24px; color: rgba(255,255,255,0.55); text-decoration: none; font-size: 14px; border-left: 3px solid transparent; transition: all 0.2s; }
        .nav-item:hover { color: #fff; background: rgba(255,255,255,0.06); border-left-color: rgba(74,222,128,0.5); }
        .nav-item.active { color: #fff; background: rgba(74,222,128,0.1); border-left-color: #4ade80; font-weight: 500; }
        .nav-icon { width: 20px; height: 20px; flex-shrink: 0; opacity: 0.7; }
        .nav-item.active .nav-icon, .nav-item:hover .nav-icon { opacity: 1; }
        .sidebar-footer { margin-top: auto; border-top: 1px solid rgba(255,255,255,0.07); padding: 16px 24px; }
        .avatar { width: 36px; height: 36px; border-radius: 50%; background: #16a34a; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 600; color: white; flex-shrink: 0; }
        .main-content { margin-left: 260px; min-height: 100vh; }
        .topbar { background: white; border-bottom: 1px solid #e8edf2; padding: 0 36px; height: 64px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 40; }
        .page-body { padding: 32px 36px; }
        .stat-card { background: white; border-radius: 14px; padding: 22px 24px; border: 1px solid #e8edf2; }
        .stat-icon { width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 14px; }
        .quick-action { background: white; border: 1px solid #e8edf2; border-radius: 14px; padding: 18px 20px; text-decoration: none; display: flex; align-items: center; gap: 16px; transition: all 0.2s; cursor: pointer; }
        .quick-action:hover { box-shadow: 0 6px 24px rgba(0,0,0,0.08); transform: translateY(-2px); border-color: #86efac; }
        .qa-icon { width: 46px; height: 46px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .card-section { background: white; border-radius: 14px; border: 1px solid #e8edf2; padding: 22px 24px; }
        .appt-row { display: flex; align-items: center; padding: 14px 0; border-bottom: 1px solid #f0f4f8; }
        .appt-row:last-child { border-bottom: none; }
        .status-badge { font-size: 11px; font-weight: 600; padding: 3px 10px; border-radius: 20px; }
        .status-pending   { background: #fef3cd; color: #b7791f; }
        .status-accepted  { background: #d4edda; color: #276749; }
        .status-completed { background: #dbeafe; color: #1e40af; }
        .status-cancelled { background: #fee2e2; color: #9b2c2c; }
        .welcome-banner { background: linear-gradient(135deg, #0d2b1a 0%, #1a5c35 100%); border-radius: 16px; padding: 28px 32px; color: white; margin-bottom: 28px; }
        .logout-btn { background: none; border: none; color: rgba(255,255,255,0.4); cursor: pointer; padding: 0; display: flex; align-items: center; transition: color 0.2s; font-family: 'DM Sans', sans-serif; }
        .logout-btn:hover { color: rgba(255,255,255,0.85); }
        .action-btn { font-size: 12px; font-weight: 600; padding: 4px 10px; border-radius: 6px; border: none; cursor: pointer; transition: opacity 0.2s; text-decoration: none; display: inline-block; white-space: nowrap; }
        .btn-accept { background: #d4edda; color: #276749; }
        .btn-refuse { background: #fee2e2; color: #9b2c2c; }
        .btn-accept:hover, .btn-refuse:hover { opacity: 0.8; }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="sidebar-logo">
        <div class="logo-text">Donka</div>
        <div class="logo-sub">Espace Médecin</div>
    </div>

    <div class="sidebar-section-label">Principal</div>

    <a href="{{ route('doctor.dashboard') }}" class="nav-item active">
        <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        Tableau de bord
    </a>

    <a href="{{ route('doctor.appointments.index') }}" class="nav-item">
        <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        Rendez-vous
    </a>

    <a href="{{ route('doctor.messages.index') }}" class="nav-item">
        <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
        Messages
    </a>

    <a href="{{ route('doctor.blocked-dates.index') }}" class="nav-item">
        <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
        Dates bloquées
    </a>

    <div class="sidebar-section-label">Mon Profil</div>

    <a href="{{ route('doctor.profile') }}" class="nav-item">
        <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        Mon Profil
    </a>

    <a href="{{ route('notifications.index') }}" class="nav-item">
        <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
        Notifications
    </a>

    <a href="{{ route('doctors.show', $user) }}" class="nav-item">
        <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
        Ma page publique
    </a>

    <div class="sidebar-footer">
        <div style="display:flex; align-items:center; gap:12px;">
            <div class="avatar">{{ strtoupper(substr($user->name, 0, 2)) }}</div>
            <div style="flex:1; min-width:0;">
                <div style="font-size:13px; font-weight:500; color:#fff; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">Dr. {{ $user->name }}</div>
                <div style="font-size:11px; color:rgba(255,255,255,0.35);">Médecin</div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn" title="Se déconnecter">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- MAIN -->
<div class="main-content">
    <div class="topbar">
        <div style="font-size:18px; font-weight:600; color:#1a2635;">Tableau de bord</div>
        <div style="display:flex; gap:10px; align-items:center;">
            <a href="{{ route('doctor.appointments.index') }}?status=pending"
               style="background:#16a34a; color:white; font-size:13px; font-weight:500; padding:9px 18px; border-radius:8px; text-decoration:none; display:flex; align-items:center; gap:6px;">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                Gérer les demandes
            </a>
        </div>
    </div>

    <div class="page-body">

        @if(session('success'))
        <div style="background:#d4edda; border:1px solid #c3e6cb; color:#276749; padding:12px 18px; border-radius:10px; margin-bottom:20px; font-size:14px;">
            ✓ {{ session('success') }}
        </div>
        @endif

        <!-- WELCOME BANNER -->
        <div class="welcome-banner">
            <div style="font-size:10px; font-weight:600; letter-spacing:1.5px; text-transform:uppercase; opacity:0.55; margin-bottom:8px;">Bonjour</div>
            <div style="font-size:26px; font-weight:700; font-family:'DM Serif Display',serif; margin-bottom:6px;">Dr. {{ $user->name }}</div>
            <div style="font-size:14px; opacity:0.65;">Gérez vos consultations et suivez l'activité de votre cabinet.</div>
        </div>

        <!-- STATS -->
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:28px;">
            <div class="stat-card">
                <div class="stat-icon" style="background:#d4edda;">
                    <svg width="22" height="22" fill="none" stroke="#276749" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div style="font-size:28px; font-weight:700; color:#1a2635; line-height:1;">{{ $stats['total'] ?? 0 }}</div>
                <div style="font-size:13px; color:#7a8fa0; margin-top:4px;">Total RDV</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background:#fef3cd;">
                    <svg width="22" height="22" fill="none" stroke="#d69e2e" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div style="font-size:28px; font-weight:700; color:#1a2635; line-height:1;">{{ $stats['pending'] ?? 0 }}</div>
                <div style="font-size:13px; color:#7a8fa0; margin-top:4px;">En attente</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background:#dbeafe;">
                    <svg width="22" height="22" fill="none" stroke="#2563eb" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div style="font-size:28px; font-weight:700; color:#1a2635; line-height:1;">{{ $stats['completed'] ?? 0 }}</div>
                <div style="font-size:13px; color:#7a8fa0; margin-top:4px;">Consultations</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background:#e9d8fd;">
                    <svg width="22" height="22" fill="none" stroke="#6b46c1" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div style="font-size:28px; font-weight:700; color:#1a2635; line-height:1;">{{ $stats['patients_count'] ?? 0 }}</div>
                <div style="font-size:13px; color:#7a8fa0; margin-top:4px;">Patients</div>
            </div>
        </div>

        <!-- QUICK ACTIONS -->
        <div style="margin-bottom:28px;">
            <div style="font-size:15px; font-weight:600; color:#1a2635; margin-bottom:14px;">Accès rapide</div>
            <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:12px;">

                <a href="{{ route('doctor.appointments.index') }}" class="quick-action">
                    <div class="qa-icon" style="background:#d4edda;">
                        <svg width="22" height="22" fill="none" stroke="#276749" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <div style="font-size:14px; font-weight:600; color:#1a2635;">Rendez-vous</div>
                        <div style="font-size:12px; color:#7a8fa0; margin-top:2px;">Accepter / Refuser</div>
                    </div>
                </a>

                <a href="{{ route('doctor.appointments.index') }}?status=pending" class="quick-action">
                    <div class="qa-icon" style="background:#fef3cd;">
                        <svg width="22" height="22" fill="none" stroke="#d69e2e" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div style="font-size:14px; font-weight:600; color:#1a2635;">Demandes en attente</div>
                        <div style="font-size:12px; color:#7a8fa0; margin-top:2px;">{{ $stats['pending'] ?? 0 }} à traiter</div>
                    </div>
                </a>

                <a href="{{ route('doctor.messages.index') }}" class="quick-action">
                    <div class="qa-icon" style="background:#dbeafe;">
                        <svg width="22" height="22" fill="none" stroke="#2563eb" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    </div>
                    <div>
                        <div style="font-size:14px; font-weight:600; color:#1a2635;">Messages</div>
                        <div style="font-size:12px; color:#7a8fa0; margin-top:2px;">Contacter mes patients</div>
                    </div>
                </a>

                <a href="{{ route('doctor.blocked-dates.index') }}" class="quick-action">
                    <div class="qa-icon" style="background:#fee2e2;">
                        <svg width="22" height="22" fill="none" stroke="#c53030" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                    </div>
                    <div>
                        <div style="font-size:14px; font-weight:600; color:#1a2635;">Bloquer des dates</div>
                        <div style="font-size:12px; color:#7a8fa0; margin-top:2px;">Gérer mes disponibilités</div>
                    </div>
                </a>

                <a href="{{ route('doctor.profile') }}" class="quick-action">
                    <div class="qa-icon" style="background:#e9d8fd;">
                        <svg width="22" height="22" fill="none" stroke="#6b46c1" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div>
                        <div style="font-size:14px; font-weight:600; color:#1a2635;">Mon profil</div>
                        <div style="font-size:12px; color:#7a8fa0; margin-top:2px;">Spécialité & informations</div>
                    </div>
                </a>

                <a href="{{ route('doctors.show', $user) }}" class="quick-action">
                    <div class="qa-icon" style="background:#c6f6d5;">
                        <svg width="22" height="22" fill="none" stroke="#276749" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                    <div>
                        <div style="font-size:14px; font-weight:600; color:#1a2635;">Page publique</div>
                        <div style="font-size:12px; color:#7a8fa0; margin-top:2px;">Voir comme un patient</div>
                    </div>
                </a>
            </div>
        </div>

        <!-- PENDING APPOINTMENTS -->
        <div class="card-section">
            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px;">
                <div style="font-size:15px; font-weight:600; color:#1a2635;">
                    Demandes en attente
                    @if(isset($pendingAppointments) && count($pendingAppointments))
                    <span style="background:#fef3cd; color:#b7791f; font-size:11px; font-weight:600; padding:2px 8px; border-radius:20px; margin-left:8px;">{{ count($pendingAppointments) }}</span>
                    @endif
                </div>
                <a href="{{ route('doctor.appointments.index') }}" style="font-size:13px; color:#16a34a; text-decoration:none; font-weight:500;">Voir tout →</a>
            </div>

            @if(isset($pendingAppointments) && count($pendingAppointments))
                @foreach($pendingAppointments as $rdv)
                <div class="appt-row">
                    <div style="width:38px; height:38px; border-radius:10px; background:#d4edda; display:flex; align-items:center; justify-content:center; margin-right:14px; flex-shrink:0;">
                        <svg width="18" height="18" fill="none" stroke="#276749" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div style="flex:1;">
                        <div style="font-size:14px; font-weight:500; color:#1a2635;">{{ $rdv->patient->name }}</div>
                        <div style="font-size:12px; color:#7a8fa0; margin-top:2px;">{{ \Carbon\Carbon::parse($rdv->date)->format('d/m/Y') }} à {{ $rdv->time }}</div>
                    </div>
                    <div style="display:flex; gap:6px; align-items:center; flex-shrink:0;">
                        <form method="POST" action="{{ route('doctor.appointments.accept', $rdv) }}" style="display:inline;">
                            @csrf @method('PATCH')
                            <button type="submit" class="action-btn btn-accept">✓ Accepter</button>
                        </form>
                        <form method="POST" action="{{ route('doctor.appointments.refuse', $rdv) }}" style="display:inline;">
                            @csrf @method('PATCH')
                            <button type="submit" class="action-btn btn-refuse">✗ Refuser</button>
                        </form>
                    </div>
                </div>
                @endforeach
            @else
                <div style="text-align:center; padding:36px 0; color:#9ab0c0;">
                    <svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto 12px; display:block; opacity:0.4;"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p style="font-size:14px;">Aucune demande en attente.</p>
                </div>
            @endif
        </div>

    </div>
</div>

</body>
</html>