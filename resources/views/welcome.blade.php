<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donka — Votre santé, un rendez-vous à la fois</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,wght@0,400;0,600;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:'Plus Jakarta Sans',sans-serif;background:#f9f7f4;color:#1a1a1a;overflow-x:hidden}
        a{text-decoration:none}

        /* NAV */
        nav{display:flex;align-items:center;justify-content:space-between;padding:18px 48px;background:rgba(249,247,244,0.95);border-bottom:1px solid #ece9e3;position:sticky;top:0;z-index:100;backdrop-filter:blur(8px)}
        .logo{font-family:'Fraunces',serif;font-size:24px;font-weight:600;color:#0d5c4a;letter-spacing:-0.5px;display:flex;align-items:center;gap:8px}
        .logo-dot{width:8px;height:8px;background:#0d5c4a;border-radius:50%}
        .nav-links{display:flex;gap:28px;align-items:center}
        .nav-links a{font-size:13px;color:#666;font-weight:400;transition:color .2s}
        .nav-links a:hover{color:#0d5c4a}
        .lang-switcher{display:flex;gap:4px;background:#eee8e0;border-radius:100px;padding:3px}
        .lang-btn{font-size:11px;font-weight:500;padding:3px 10px;border-radius:100px;border:none;background:none;cursor:pointer;color:#888;font-family:'Plus Jakarta Sans',sans-serif}
        .lang-btn.active{background:#fff;color:#0d5c4a;box-shadow:0 1px 3px rgba(0,0,0,0.1)}
        .btn-outline{border:1.5px solid #0d5c4a;color:#0d5c4a;padding:8px 18px;border-radius:100px;font-size:13px;font-weight:500;background:none;cursor:pointer;font-family:'Plus Jakarta Sans',sans-serif;transition:all .2s}
        .btn-outline:hover{background:#0d5c4a;color:#fff}
        .btn-solid{background:#0d5c4a;color:#fff;padding:8px 18px;border-radius:100px;font-size:13px;font-weight:500;border:none;cursor:pointer;font-family:'Plus Jakarta Sans',sans-serif;transition:background .2s}
        .btn-solid:hover{background:#0a4a3a}

        /* HERO */
        .hero{display:grid;grid-template-columns:1.1fr 0.9fr;min-height:560px}
        .hero-left{padding:64px 48px;display:flex;flex-direction:column;justify-content:center}
        .hero-pill{display:inline-flex;align-items:center;gap:8px;background:#e0f0ec;color:#0a4a3a;font-size:12px;font-weight:500;padding:5px 14px;border-radius:100px;margin-bottom:28px;width:fit-content}
        .pulse{width:7px;height:7px;background:#0d5c4a;border-radius:50%;position:relative;flex-shrink:0}
        .pulse::after{content:'';position:absolute;inset:-3px;border-radius:50%;border:2px solid #0d5c4a;opacity:0.4;animation:pulse 2s infinite}
        @keyframes pulse{0%,100%{transform:scale(1);opacity:0.4}50%{transform:scale(1.5);opacity:0}}
        .hero-title{font-family:'Fraunces',serif;font-size:52px;line-height:1.1;font-weight:600;color:#0f0f0f;margin-bottom:18px;letter-spacing:-1.5px}
        .hero-title em{font-style:italic;color:#0d5c4a}
        .hero-sub{font-size:15px;color:#777;line-height:1.75;margin-bottom:36px;font-weight:300;max-width:440px}
        .hero-sub strong{color:#1a1a1a;font-weight:500}
        .hero-actions{display:flex;gap:12px;align-items:center;flex-wrap:wrap}
        .cta-main{background:#0d5c4a;color:#fff;padding:14px 30px;border-radius:100px;font-size:14px;font-weight:500;border:none;cursor:pointer;font-family:'Plus Jakarta Sans',sans-serif;display:inline-flex;align-items:center;gap:8px;transition:background .2s}
        .cta-main:hover{background:#0a4a3a}
        .cta-arrow{width:18px;height:18px;background:rgba(255,255,255,0.2);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:10px}
        .cta-sec{background:none;color:#1a1a1a;padding:14px 24px;border-radius:100px;font-size:14px;font-weight:400;border:1.5px solid #d5cfc6;cursor:pointer;font-family:'Plus Jakarta Sans',sans-serif;transition:border-color .2s}
        .cta-sec:hover{border-color:#0d5c4a;color:#0d5c4a}

        /* HERO RIGHT */
        .hero-right{background:#0d5c4a;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:16px;padding:40px;position:relative;overflow:hidden}
        .geo-circle{position:absolute;border-radius:50%;border:1px solid rgba(255,255,255,0.07)}
        .geo-1{width:400px;height:400px;top:-100px;right:-100px}
        .geo-2{width:250px;height:250px;bottom:-60px;left:-60px}
        .float-card{background:#fff;border-radius:18px;padding:18px 20px;width:280px;position:relative;z-index:2;box-shadow:0 20px 60px rgba(0,0,0,0.15)}
        .fc-header{display:flex;align-items:center;gap:10px;margin-bottom:14px}
        .fc-avatar{width:40px;height:40px;border-radius:50%;background:linear-gradient(135deg,#e0f0ec,#b8ddd4);display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0}
        .fc-name{font-size:14px;font-weight:600;color:#0f0f0f}
        .fc-spec{font-size:12px;color:#888;margin-top:1px}
        .stars{display:flex;gap:2px;align-items:center;margin-bottom:14px}
        .star{color:#f59e0b;font-size:13px}
        .rating-text{font-size:12px;color:#888;margin-left:4px}
        .fc-slots{display:flex;flex-direction:column;gap:7px}
        .slot-row{display:flex;align-items:center;justify-content:space-between;background:#f8f7f4;border-radius:9px;padding:9px 12px}
        .slot-time{font-size:12px;font-weight:500;color:#1a1a1a}
        .slot-badge{font-size:10px;padding:3px 9px;border-radius:100px;font-weight:500}
        .avail{background:#e0f0ec;color:#0a4a3a}
        .taken{background:#f1efe8;color:#aaa}
        .fc-btn{width:100%;background:#0d5c4a;color:#fff;border:none;border-radius:10px;padding:10px;font-size:13px;font-weight:500;cursor:pointer;font-family:'Plus Jakarta Sans',sans-serif;margin-top:14px}
        .notif-card{background:#fff;border-radius:14px;padding:12px 16px;width:280px;display:flex;align-items:center;gap:12px;position:relative;z-index:2}
        .notif-icon{width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:14px;flex-shrink:0;background:#e0f0ec}
        .notif-text{font-size:12px;color:#1a1a1a;font-weight:500}
        .notif-sub{font-size:11px;color:#888;margin-top:2px;font-weight:300}

        /* STATS */
        .stats{display:grid;grid-template-columns:repeat(4,1fr);border-top:1px solid #ece9e3;border-bottom:1px solid #ece9e3}
        .stat{padding:24px 32px;border-right:1px solid #ece9e3;text-align:center}
        .stat:last-child{border-right:none}
        .stat-num{font-family:'Fraunces',serif;font-size:30px;font-weight:600;color:#0d5c4a}
        .stat-label{font-size:12px;color:#888;margin-top:4px;font-weight:300}

        /* SECTIONS */
        .section{padding:72px 48px}
        .section-eyebrow{font-size:11px;font-weight:600;color:#0d5c4a;text-transform:uppercase;letter-spacing:3px;margin-bottom:10px}
        .section-h{font-family:'Fraunces',serif;font-size:36px;font-weight:600;line-height:1.2;color:#0f0f0f;margin-bottom:14px;letter-spacing:-0.8px}
        .section-h em{font-style:italic;color:#0d5c4a}
        .section-p{font-size:14px;color:#888;line-height:1.8;font-weight:300;max-width:480px;margin-bottom:48px}

        /* STEPS */
        .steps{display:grid;grid-template-columns:repeat(3,1fr);gap:2px;background:#ece9e3}
        .step{background:#f9f7f4;padding:36px 32px}
        .step-n{font-family:'Fraunces',serif;font-size:52px;font-weight:600;color:#ece9e3;line-height:1;margin-bottom:20px}
        .step-icon{width:44px;height:44px;border-radius:12px;background:#e0f0ec;display:flex;align-items:center;justify-content:center;font-size:20px;margin-bottom:16px}
        .step-t{font-size:15px;font-weight:600;color:#0f0f0f;margin-bottom:8px}
        .step-d{font-size:13px;color:#888;line-height:1.65;font-weight:300}

        /* FEATURES */
        .features{display:grid;grid-template-columns:repeat(3,1fr);gap:16px}
        .feat{background:#fff;border-radius:16px;padding:24px;border:1px solid #ece9e3}
        .feat-icon{width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;margin-bottom:14px}
        .feat-t{font-size:14px;font-weight:600;color:#0f0f0f;margin-bottom:6px}
        .feat-d{font-size:12px;color:#888;line-height:1.6;font-weight:300}

        /* ROLES */
        .roles{display:grid;grid-template-columns:1fr 1fr;gap:2px;background:#ece9e3}
        .role{padding:56px 48px;position:relative;overflow:hidden}
        .role-p{background:#0d5c4a}
        .role-d{background:#111}
        .role-tag{font-size:11px;font-weight:600;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,0.4);margin-bottom:20px}
        .role-title{font-family:'Fraunces',serif;font-size:32px;font-weight:600;color:#fff;margin-bottom:14px;line-height:1.2;letter-spacing:-0.5px}
        .role-title em{font-style:italic;opacity:0.7}
        .role-desc{font-size:13px;color:rgba(255,255,255,0.55);line-height:1.8;margin-bottom:24px;font-weight:300;max-width:380px}
        .role-list{list-style:none;margin-bottom:32px}
        .role-list li{font-size:13px;color:rgba(255,255,255,0.7);padding:6px 0;display:flex;align-items:center;gap:8px;font-weight:300;border-bottom:1px solid rgba(255,255,255,0.06)}
        .role-list li::before{content:'';width:5px;height:5px;background:rgba(255,255,255,0.4);border-radius:50%;flex-shrink:0}
        .role-btn{display:inline-block;background:rgba(255,255,255,0.12);color:#fff;padding:11px 24px;border-radius:100px;font-size:13px;font-weight:500;border:1px solid rgba(255,255,255,0.2);cursor:pointer;font-family:'Plus Jakarta Sans',sans-serif;transition:background .2s}
        .role-btn:hover{background:rgba(255,255,255,0.2)}
        .role-bg-circle{position:absolute;border-radius:50%;border:1px solid rgba(255,255,255,0.05)}
        .rb1{width:300px;height:300px;right:-80px;bottom:-80px}
        .rb2{width:160px;height:160px;right:60px;bottom:60px}

        /* REVIEWS */
        .review-section{padding:72px 48px;background:#fff;border-top:1px solid #ece9e3}
        .reviews{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-top:48px}
        .review{background:#f9f7f4;border-radius:16px;padding:24px;border:1px solid #ece9e3}
        .review-stars{display:flex;gap:3px;margin-bottom:12px}
        .rv-star{color:#f59e0b;font-size:12px}
        .review-text{font-size:13px;color:#555;line-height:1.7;font-weight:300;margin-bottom:16px;font-style:italic}
        .review-author{display:flex;align-items:center;gap:10px}
        .rv-avatar{width:32px;height:32px;border-radius:50%;background:#e0f0ec;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:600;color:#0d5c4a;flex-shrink:0}
        .rv-name{font-size:13px;font-weight:500;color:#0f0f0f}
        .rv-date{font-size:11px;color:#aaa;margin-top:1px}

        /* FOOTER */
        footer{background:#0f0f0f;padding:40px 48px;display:flex;align-items:center;justify-content:space-between}
        .footer-logo{font-family:'Fraunces',serif;font-size:20px;font-weight:600;color:#fff}
        .footer-copy{font-size:12px;color:#555;font-weight:300}
        .footer-links{display:flex;gap:24px}
        .footer-links a{font-size:12px;color:#555}
    </style>
</head>
<body>

{{-- NAV --}}
<nav>
    <div class="logo"><div class="logo-dot"></div>Donka</div>
    <div class="nav-links">
        <a href="{{ route('doctors.index') }}">Médecins</a>
        <a href="#comment">Comment ça marche</a>
        <a href="#avis">Avis</a>
    </div>
    <div style="display:flex;gap:10px;align-items:center">
        <div class="lang-switcher">
            <button class="lang-btn active">FR</button>
            <button class="lang-btn">AR</button>
            <button class="lang-btn">EN</button>
        </div>
        @auth
            @if(auth()->user()->role === 'doctor')
                <a href="/doctor/dashboard" class="btn-solid">Mon dashboard</a>
            @else
                <a href="/patient/dashboard" class="btn-solid">Mon dashboard</a>
            @endif
        @else
            <a href="{{ route('login') }}" class="btn-outline">Connexion</a>
            <a href="{{ route('register') }}" class="btn-solid">S'inscrire</a>
        @endauth
    </div>
</nav>

{{-- HERO --}}
<section class="hero">
    <div class="hero-left">
        <div class="hero-pill"><span class="pulse"></span>Plateforme médicale — Maroc</div>
        <h1 class="hero-title">
            Prenez soin<br>
            de vous, <em>on</em><br>
            <em>s'occupe</em> du reste.
        </h1>
        <p class="hero-sub">Trouvez le <strong>bon médecin</strong> près de chez vous, réservez en quelques clics et suivez tout votre parcours médical depuis un seul endroit.</p>
        <div class="hero-actions">
            <a href="{{ route('doctors.index') }}" class="cta-main">
                Trouver un médecin
                <span class="cta-arrow">→</span>
            </a>
            <a href="{{ route('register') }}" class="cta-sec">Rejoindre en tant que médecin</a>
        </div>
    </div>
    <div class="hero-right">
        <div class="geo-circle geo-1"></div>
        <div class="geo-circle geo-2"></div>
        <div class="notif-card">
            <div class="notif-icon">✓</div>
            <div>
                <div class="notif-text">Rendez-vous confirmé !</div>
                <div class="notif-sub">Dr. Benali · Lundi 09:00</div>
            </div>
        </div>
        <div class="float-card">
            <div class="fc-header">
                <div class="fc-avatar">👩‍⚕️</div>
                <div>
                    <div class="fc-name">Dr. Amina Benali</div>
                    <div class="fc-spec">Cardiologue · 300 DH</div>
                </div>
            </div>
            <div class="stars">
                <span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span>
                <span class="rating-text">4.9 (128 avis)</span>
            </div>
            <div class="fc-slots">
                <div class="slot-row"><span class="slot-time">Lun 09:00</span><span class="slot-badge avail">Disponible</span></div>
                <div class="slot-row"><span class="slot-time">Lun 10:30</span><span class="slot-badge taken">Réservé</span></div>
                <div class="slot-row"><span class="slot-time">Mar 14:00</span><span class="slot-badge avail">Disponible</span></div>
            </div>
            <a href="{{ route('register') }}" class="fc-btn" style="display:block;text-align:center;color:#fff">Prendre rendez-vous</a>
        </div>
        <div class="notif-card">
            <div class="notif-icon" style="background:#faeeda">⭐</div>
            <div>
                <div class="notif-text">Laissez un avis</div>
                <div class="notif-sub">Votre consultation est terminée</div>
            </div>
        </div>
    </div>
</section>

{{-- STATS --}}
<div class="stats">
    <div class="stat"><div class="stat-num">120+</div><div class="stat-label">Médecins vérifiés</div></div>
    <div class="stat"><div class="stat-num">2 400</div><div class="stat-label">Rendez-vous pris</div></div>
    <div class="stat"><div class="stat-num">4.8 ★</div><div class="stat-label">Note moyenne</div></div>
    <div class="stat"><div class="stat-num">15+</div><div class="stat-label">Spécialisations</div></div>
</div>

{{-- COMMENT ÇA MARCHE --}}
<section class="section" id="comment" style="padding-bottom:0">
    <div class="section-eyebrow">Comment ça marche</div>
    <div class="section-h">Trois étapes,<br><em>c'est tout.</em></div>
    <div class="section-p">Pas de paperasse, pas d'attente au téléphone. Donka simplifie l'accès aux soins pour tout le monde.</div>
</section>
<div class="steps">
    <div class="step">
        <div class="step-n">01</div>
        <div class="step-icon">🔍</div>
        <div class="step-t">Cherchez & filtrez</div>
        <div class="step-d">Filtrez par spécialisation, fourchette de prix, note moyenne ou disponibilité en temps réel.</div>
    </div>
    <div class="step">
        <div class="step-n">02</div>
        <div class="step-icon">📅</div>
        <div class="step-t">Réservez en ligne</div>
        <div class="step-d">Choisissez un créneau, confirmez et recevez une notification immédiate par email.</div>
    </div>
    <div class="step">
        <div class="step-n">03</div>
        <div class="step-icon">💬</div>
        <div class="step-t">Suivez & échangez</div>
        <div class="step-d">Messagerie directe, historique médical exportable en PDF et notes de consultation.</div>
    </div>
</div>

{{-- FONCTIONNALITÉS --}}
<section class="section">
    <div class="section-eyebrow">Fonctionnalités</div>
    <div class="section-h">Tout ce dont vous<br><em>avez besoin.</em></div>
    <div class="features">
        <div class="feat">
            <div class="feat-icon" style="background:#e0f0ec">⭐</div>
            <div class="feat-t">Système de notation</div>
            <div class="feat-d">Notez votre médecin et lisez les avis vérifiés d'autres patients après chaque consultation.</div>
        </div>
        <div class="feat">
            <div class="feat-icon" style="background:#e6f1fb">🔍</div>
            <div class="feat-t">Filtres avancés</div>
            <div class="feat-d">Recherche par prix, note, spécialisation et disponibilité pour trouver le bon praticien.</div>
        </div>
        <div class="feat">
            <div class="feat-icon" style="background:#faeeda">📄</div>
            <div class="feat-t">Export PDF</div>
            <div class="feat-d">Téléchargez votre historique médical et vos rendez-vous en un clic au format PDF.</div>
        </div>
        <div class="feat">
            <div class="feat-icon" style="background:#fbeaf0">🔔</div>
            <div class="feat-t">Notifications</div>
            <div class="feat-d">Rappels de rendez-vous, confirmations et messages en temps réel.</div>
        </div>
        <div class="feat">
            <div class="feat-icon" style="background:#e1f5ee">🌍</div>
            <div class="feat-t">Multilingue</div>
            <div class="feat-d">Interface disponible en Français, Arabe et Anglais pour tous les utilisateurs.</div>
        </div>
        <div class="feat">
            <div class="feat-icon" style="background:#f1efe8">📵</div>
            <div class="feat-t">Blocage de dates</div>
            <div class="feat-d">Les médecins gèrent leurs indisponibilités et congés directement depuis leur tableau de bord.</div>
        </div>
    </div>
</section>

{{-- ROLES --}}
<div class="roles">
    <div class="role role-p">
        <div class="role-bg-circle rb1"></div>
        <div class="role-bg-circle rb2"></div>
        <div class="role-tag">Pour les patients</div>
        <div class="role-title">Votre santé,<br><em>entre de bonnes mains.</em></div>
        <div class="role-desc">Un espace personnel pour gérer toute votre vie médicale, de la recherche du médecin à l'export de votre historique.</div>
        <ul class="role-list">
            <li>Recherche & filtres avancés</li>
            <li>Prise de RDV en ligne</li>
            <li>Messagerie avec le médecin</li>
            <li>Notation & avis vérifiés</li>
            <li>Export PDF de l'historique</li>
        </ul>
        <a href="{{ route('register') }}" class="role-btn">S'inscrire comme patient →</a>
    </div>
    <div class="role role-d">
        <div class="role-bg-circle rb1"></div>
        <div class="role-bg-circle rb2"></div>
        <div class="role-tag">Pour les médecins</div>
        <div class="role-title">Gérez votre cabinet,<br><em>pas votre agenda.</em></div>
        <div class="role-desc">Un tableau de bord complet pour accueillir de nouveaux patients, gérer vos disponibilités et communiquer efficacement.</div>
        <ul class="role-list">
            <li>Tableau de bord & statistiques</li>
            <li>Gestion des rendez-vous</li>
            <li>Blocage de dates / congés</li>
            <li>Messagerie patients</li>
            <li>Profil public visible</li>
        </ul>
        <a href="{{ route('register') }}" class="role-btn">Rejoindre en tant que médecin →</a>
    </div>
</div>

{{-- AVIS --}}
<section class="review-section" id="avis">
    <div class="section-eyebrow">Avis patients</div>
    <div class="section-h">Ils nous font<br><em>confiance.</em></div>
    <div class="reviews">
        <div class="review">
            <div class="review-stars"><span class="rv-star">★</span><span class="rv-star">★</span><span class="rv-star">★</span><span class="rv-star">★</span><span class="rv-star">★</span></div>
            <div class="review-text">"Enfin une plateforme qui comprend les besoins des patients marocains. J'ai trouvé un cardiologue en 2 minutes."</div>
            <div class="review-author">
                <div class="rv-avatar">SA</div>
                <div><div class="rv-name">Khadija B.</div><div class="rv-date">Il y a 3 jours</div></div>
            </div>
        </div>
        <div class="review">
            <div class="review-stars"><span class="rv-star">★</span><span class="rv-star">★</span><span class="rv-star">★</span><span class="rv-star">★</span><span class="rv-star">★</span></div>
            <div class="review-text">"La messagerie avec mon médecin est vraiment pratique. Plus besoin d'appeler pour poser une simple question."</div>
            <div class="review-author">
                <div class="rv-avatar">YB</div>
                <div><div class="rv-name">Amadou.</div><div class="rv-date">Il y a 1 semaine</div></div>
            </div>
        </div>
        <div class="review">
            <div class="review-stars"><span class="rv-star">★</span><span class="rv-star">★</span><span class="rv-star">★</span><span class="rv-star">★</span><span class="rv-star">★</span></div>
            <div class="review-text">"L'export PDF de mon historique m'a sauvé lors d'une consultation à l'étranger. Fonctionnalité indispensable."</div>
            <div class="review-author">
                <div class="rv-avatar">NM</div>
                <div><div class="rv-name">Diarraye.</div><div class="rv-date">Il y a 2 semaines</div></div>
            </div>
        </div>
    </div>
</section>

{{-- FOOTER --}}
<footer>
    <div class="footer-logo">Donka.</div>
    <div class="footer-copy">© {{ date('Y') }} Donka — Tous droits réservés</div>
    <div class="footer-links">
        <a href="#">Confidentialité</a>
        <a href="#">CGU</a>
        <a href="#">Contact</a>
    </div>
</footer>

</body>
</html>