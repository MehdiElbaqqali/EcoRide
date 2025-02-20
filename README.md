# EcoRide - Plateforme de Covoiturage Écologique 

EcoRide est une plateforme de covoiturage visant à réduire l’impact environnemental des déplacements tout en offrant une solution économique et accessible.

## 📌 Technologies utilisées
- **Framework Backend :** Symfony 6.4 (Architecture MVC)
- **Langage :** PHP 8.4
- **Base de données relationnelle :** MySQL (MariaDB sous MAMP)
- **ORM :** Doctrine (Gestion des entités et des relations)
- **Front-end :** Twig (avec Bootstrap pour le design responsive)
- **Gestion des assets :** Webpack Encore
- **Déploiement :** Fly.io (Backend) & Vercel (Frontend)
- **Gestion de projet :** Trello (Kanban avec EPICs et priorisation des tâches)

---

## 📥 Installation et Configuration

### **1️⃣ Prérequis**
Avant d'installer le projet, assurez-vous d’avoir installé :
- [MAMP](https://www.mamp.info/en/downloads/) pour la gestion de la base de données MySQL
- [Composer](https://getcomposer.org/download/) pour la gestion des dépendances PHP
- [Git](https://git-scm.com/downloads) pour le versionnement du code
- [Symfony CLI](https://symfony.com/download) pour faciliter le développement avec Symfony


---

## 📌 Organisation du projet

### **🔹 Gestion de projet avec Trello**
Le projet est organisé en **Kanban** sur **Trello**, avec une structure optimisée :
- **Colonnes :**
  - **EPIC** : Fonctionnalités majeures, classées par priorité
  - **Backlog** : Liste des tâches à faire
  - **En cours** : Tâches en développement
  - **Testé & Validé** : Tâches prêtes à être fusionnées
  - **Merge** : Fonctionnalités intégrées mais pas encore déployées
  - **Mise en production** : Fonctionnalités en ligne
  - **En pause / Bloqué** : Tickets suspendus temporairement ou définitivement
- **Étiquettes :**
  - Une étiquette par **EPIC** (ex. "Inscription", "Gestion des trajets")
  - **FRONT / BACK / DESIGN / DOCUMENTATION / API (en pause)**
  
### **🔹 Déploiement**
- **Backend/Frontend :** Hébergé sur **Fly.io**

---
