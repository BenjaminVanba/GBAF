# 🔒 GBAF - Plateforme de Connexion Sécurisée 

Bienvenue sur mon tout premier projet web, une application PHP de connexion sécurisée pour la plateforme fictive **GBAF (Groupement Banque Assurance Français)**. Ce projet m'a permis de découvrir et d'appliquer les bases du développement web en PHP et MySQL.

---

## 🌟 Fonctionnalités Principales

- 🔐 **Inscription avec validation des données**  
- 🔑 **Connexion sécurisée**  
- 🔄 **Récupération du mot de passe via question secrète**  
- 👤 **Gestion des sessions utilisateurs**  
- 📰 **Affichage d'articles avec commentaires et votes (likes/dislikes)**  
- 📜 **Pages légales : mentions légales et contact**

---

## 🛠️ Technologies Utilisées

- **PHP** pour le back-end
- **MySQL** pour la base de données
- **HTML5** et **CSS3** pour le front-end
- **PDO** pour des interactions sécurisées avec la base de données
- **Sessions PHP** pour gérer l'authentification des utilisateurs

---

## 🚀 Installation

1. **Cloner le dépôt :**  
   ```bash
   git clone <url-du-dépôt>

---

## 🧑‍💻 Utilisation

- **S'inscrire :** Accéder à `register.php`.  
- **Se connecter :** Utiliser `index.html`.  
- **Mot de passe oublié :** Utiliser `loginviaquestion.php`.  
- **Profil :** Modifier vos informations dans `edition.php`.  
- **Se déconnecter :** Cliquer sur "Déconnexion" ou accéder à `logout.php`.  

---

## 📂 Structure du Projet

### 🔓 Pages Publiques

- `index.html` : Page de connexion  
- `register.php` : Page d'inscription  
- `loginviaquestion.php` : Connexion via question secrète  
- `mention.php` : Mentions légales  
- `contact.php` : Page de contact  

### 🔒 Pages Sécurisées

- `home.php` : Accueil après connexion (affichage des articles)  
- `article.php` : Page d'un article spécifique (commentaires, likes/dislikes)  
- `edition.php` : Modification des informations utilisateur  
- `logout.php` : Déconnexion  

### ⚙️ Scripts d'Authentification et de Traitement

- `authenticate.php` : Validation des connexions  
- `register.php` : Gestion des inscriptions  
- `authoQuestion.php` : Validation de la question secrète  
- `action.php` : Gestion des likes/dislikes  

### 📁 Dossiers

- **`IMG/`** : Images du site  
- **`Style/`** : Feuilles de style CSS  

---

## 🗂️ Base de Données

### Tables principales :

- **`accounts` :** Utilisateurs (`id`, `username`, `password`, `email`, `question secrète`, `réponse`, etc.)  
- **`articles` :** Articles affichés (`id`, `titre`, `contenu`, etc.)  
- **`commentaires` :** Commentaires des utilisateurs  
- **`likes` et `dislikes` :** Gestion des votes  

### Sécurité :

- Validation des données avec `htmlspecialchars`.  
- Hashage des mots de passe avec `password_hash`.  
- Vérification via `password_verify`.  

---

## 🔐 Sécurité

- Validation stricte des données utilisateurs.  
- Sessions sécurisées avec `session_start()` pour authentifier les utilisateurs.  
- Prévention des attaques par injection SQL grâce aux requêtes préparées avec PDO.  

---

## 🖥️ Interface Utilisateur

- **HTML5 et CSS3 :** Structure et style modernes.  
- **Responsive Design :** Media queries pour une adaptation optimale sur mobiles et tablettes.  

---

## 📈 Améliorations Futures

### Sécurité :

- Renforcer les validations avec des bibliothèques modernes.  
- Utiliser HTTPS pour protéger les communications.  

### Fonctionnalités :

- Ajouter une récupération de mot de passe par email.  
- Permettre plusieurs commentaires par article.  

### Architecture :

- Refactorisation du code avec un framework PHP comme Laravel.  
- Séparer la logique métier de la présentation.  
