# Système de Gestion de Rendez-vous Médicaux

Application web Laravel permettant aux patients de consulter des médecins, prendre des rendez-vous et échanger des messages.

---

## Sommaire

- [Installation](#installation)
- [Configuration de la base de données](#configuration-de-la-base-de-données)
- [Migrations et données de test](#migrations-et-données-de-test)
- [Lancement du projet](#lancement-du-projet)
- [Structure des rôles](#structure-des-rôles)
- [Modèle Conceptuel de Données (Merise)](#modèle-conceptuel-de-données-merise)
- [Modèle Logique de Données (MLD)](#modèle-logique-de-données-mld)
- [Fonctionnalités](#fonctionnalités)
- [Fonctionnalités bonus](#fonctionnalités-bonus)
- [Répartition des tâches](#répartition-des-tâches)



## Installation

### 1. Cloner le dépôt

```bash
git clone https://github.com/votre-equipe/medical-appointments.git
cd medical-appointments
```

### 2. Installer les dépendances PHP

```bash
composer install
```

### 3. Installer les dépendances JavaScript

```bash
npm install
```

### 4. Copier le fichier d'environnement

```bash
cp .env.example .env
```

### 5. Générer la clé d'application

```bash
php artisan key:generate
```

### 6. Créer le lien symbolique pour le stockage (photos de profil)

```bash
php artisan storage:link
```

---

## Configuration de la base de données

Ouvrez le fichier `.env` et configurez les variables suivantes :

```env
APP_NAME="Rendez-vous Médicaux"
APP_ENV=local
APP_KEY=                          # généré automatiquement à l'étape 5
APP_DEBUG=true
APP_URL=http://localhost:8000

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=medical_appointments  # nom de la base à créer
DB_USERNAME=root                  # votre utilisateur MySQL
DB_PASSWORD=                      # votre mot de passe MySQL

FILESYSTEM_DISK=local
```

Créez ensuite la base de données dans MySQL :

```sql
CREATE DATABASE medical_appointments CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

---

## Migrations et données de test

### Exécuter les migrations

```bash
php artisan migrate
```

### Peupler la base avec des données de test (seeders)

```bash
php artisan db:seed
```

Ou tout en une seule commande (migration + seed) :

```bash
php artisan migrate:fresh --seed
```


---

## Lancement du projet

### Mode développement (deux terminaux)

Terminal 1 — serveur PHP :

```bash
php artisan serve
```

Terminal 2 — compilation des assets (Vite) :

```bash
npm run dev
```


### Mode production (build optimisé)

```bash
npm run build
php artisan optimize
php artisan serve
```

---

## Structure des rôles

L'application comporte deux rôles distincts, définis lors de l'inscription :

**Médecin** — accède à son tableau de bord, gère ses rendez-vous (accepter, refuser, marquer comme terminé, ajouter des notes), consulte et répond aux messages des patients, et peut bloquer des plages de disponibilité.

**Patient** — recherche des médecins par nom ou spécialisation, prend des rendez-vous, annule ses rendez-vous en attente ou acceptés, et échange des messages avec ses médecins.

---

## Modèle Conceptuel de Données (Merise)

### Entités et attributs

**UTILISATEUR**
- id_utilisateur (PK)
- nom, prénom, email, mot_de_passe
- photo_profil
- rôle {médecin, patient}

**MÉDECIN** (spécialisation de UTILISATEUR)
- id_médecin (PK, FK → UTILISATEUR)
- spécialisation, biographie, frais_consultation, note_moyenne

**PATIENT** (spécialisation de UTILISATEUR)
- id_patient (PK, FK → UTILISATEUR)
- date_naissance, téléphone, adresse

**RENDEZ-VOUS**
- id_rdv (PK)
- id_médecin (FK), id_patient (FK)
- date_heure
- statut {en_attente, accepté, refusé, terminé, annulé}
- notes_consultation

**MESSAGE**
- id_message (PK)
- id_expéditeur (FK → UTILISATEUR), id_destinataire (FK → UTILISATEUR)
- contenu, date_envoi, lu

**NOTE / AVIS** (bonus)
- id_note (PK)
- id_rdv (FK), note {1..5}, commentaire, date_note

**DISPONIBILITÉ** (bonus)
- id_dispo (PK)
- id_médecin (FK)
- date_début, date_fin, motif

### Associations et cardinalités

```
UTILISATEUR ──1,1── est ──1,1── MÉDECIN
UTILISATEUR ──1,1── est ──1,1── PATIENT
MÉDECIN     ──1,n── prend ──1,1── RENDEZ-VOUS
PATIENT     ──1,n── demande ──1,1── RENDEZ-VOUS
RENDEZ-VOUS ──0,1── possède ──1,1── NOTE
MÉDECIN     ──0,n── bloque ──1,1── DISPONIBILITÉ
UTILISATEUR ──0,n── envoie/reçoit ──0,n── MESSAGE
```

---

## Modèle Logique de Données (MLD)

```sql
users(
  id PK,
  name, first_name, email UNIQUE, password,
  role ENUM('doctor','patient'),
  profile_photo NULLABLE,
  created_at, updated_at
)

doctors(
  id PK FK→users.id,
  specialization,
  biography TEXT NULLABLE,
  consultation_fee DECIMAL(8,2),
  average_rating DECIMAL(3,2) DEFAULT 0
)

patients(
  id PK FK→users.id,
  birth_date DATE NULLABLE,
  phone VARCHAR(20) NULLABLE,
  address TEXT NULLABLE
)

appointments(
  id PK,
  doctor_id FK→doctors.id,
  patient_id FK→patients.id,
  appointment_datetime DATETIME,
  status ENUM('pending','accepted','rejected','completed','cancelled') DEFAULT 'pending',
  consultation_notes TEXT NULLABLE,
  created_at, updated_at
)

messages(
  id PK,
  sender_id FK→users.id,
  receiver_id FK→users.id,
  body TEXT,
  is_read BOOLEAN DEFAULT false,
  sent_at TIMESTAMP
)

reviews(
  id PK,
  appointment_id FK→appointments.id UNIQUE,
  rating TINYINT CHECK(rating BETWEEN 1 AND 5),
  comment TEXT NULLABLE,
  created_at
)

unavailabilities(
  id PK,
  doctor_id FK→doctors.id,
  starts_at DATETIME,
  ends_at DATETIME,
  reason VARCHAR(255) NULLABLE
)
```

---

## Fonctionnalités

### Authentification et profil

- Inscription avec choix du rôle (médecin ou patient)
- Champs spécifiques au médecin : spécialisation, frais de consultation, biographie
- Connexion / déconnexion sécurisée
- Modification du profil et upload de photo (JPG/PNG, validation taille et type)

### Tableau de bord médecin

- Compteurs : rendez-vous en attente, acceptés, terminés
- Liste des rendez-vous du jour
- Accès rapide aux messages non lus

### Gestion des rendez-vous (médecin)

- Liste complète avec statuts
- Accepter ou refuser une demande en attente
- Marquer un rendez-vous comme terminé
- Ajouter des notes de consultation
- Filtrer par statut ou par date

### Messagerie (médecin)

- Liste des conversations avec les patients
- Lecture et réponse aux messages (asynchrone)

### Recherche de médecins (patient)

- Liste de tous les médecins disponibles
- Recherche par nom ou spécialisation
- Profil complet : photo, biographie, spécialisation, frais

### Gestion des rendez-vous (patient)

- Prise de rendez-vous (date et heure)
- Annulation d'un rendez-vous en attente ou accepté
- Historique complet avec statuts

### Messagerie (patient)

- Envoi de messages à un médecin
- Consultation des réponses dans un fil de conversation
- Historique de toutes les conversations

---

## Fonctionnalités bonus

- **Système de notation** : le patient peut laisser une note (1 à 5) et un avis après un rendez-vous terminé
- **Filtres avancés** : recherche par fourchette de prix, note moyenne ou disponibilité
- **Blocage de dates** : le médecin peut marquer des indisponibilités (congés, absences)
- **Export PDF** : export des rendez-vous ou de l'historique médical
- **Support multilingue** : français, arabe, anglais

---

## Répartition des tâches

j'ai été obligé de faire le projet tout seul parceque mon binome etait indisponible et desinteressé 



---

## Hébergement

Lien de l'application hébergée : **[je galère avec l'hebergement de l'application depuis une semaine]**
