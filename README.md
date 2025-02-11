# Waw - Where Are We 🌍🚐  

**Waw** est une plateforme permettant aux utilisateurs inscrits de créer un carnet
de voyage (type road trip avec plusieurs étapes).

---

## 🚀 Fonctionnalités principales  
- 📍 Création et modification de road trips avec photos et descriptions  
- 👥 Accès privé ou public d'un road trip

---

## 🛠️ Installation et démarrage

### 1️⃣ Cloner le projet

```bash
git clone https://github.com/TomCoulais/Waw.travel
cd Waw.travel
```
### 2️⃣ Installer les dépendances

```bash
composer install
symfony console tailwind:init
```

### 3️⃣ Faire les migrations
Pour cette partie, il faut avoir changé la ligne consacrée à la base de données dans le fichier .env ci-dessous.

```.env
DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=8&charset=utf8mb4"
```

```bash
symfony console doctrine:database:create
symfony console make:migration
symfony console doctrine:migrations:migrate
```

### 3️⃣ Lancer le serveur

```bash
symfony server:start -d
symfony console tailwind:build --watch
```
---
