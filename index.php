<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Touiteur.app — Fil d'actu</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Icônes -->
<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <symbol id="i-menu" viewBox="0 0 24 24"><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></symbol>
  <symbol id="i-person" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></symbol>
  <symbol id="i-star" viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zm4.24 16L12 15.45 7.77 18l1.12-4.81-3.73-3.23 4.92-.42L12 5l1.92 4.53 4.92.42-3.73 3.23L16.23 18z"/></symbol>
  <symbol id="i-back" viewBox="0 0 24 24"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></symbol>
  <symbol id="i-image" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></symbol>
  <symbol id="i-publish" viewBox="0 0 24 24"><path d="M19 7v4H5.83l3.58-3.59L8 6l-6 6 6 6 1.41-1.41L5.83 13H21V7z"/></symbol>
  <symbol id="i-down" viewBox="0 0 24 24"><path d="M16.59 8.59 12 13.17 7.41 8.59 6 10l6 6 6-6z"/></symbol>
  <symbol id="i-up" viewBox="0 0 24 24"><path d="M12 8l-6 6 1.41 1.41L12 10.83l4.59 4.58L18 14z"/></symbol>
</svg>

<input type="checkbox" id="menu" class="toggle" aria-label="Ouvrir le menu">

<div class="layout">
  <label for="menu" class="scrim" aria-hidden="true"></label>

  <nav class="sidebar" aria-label="Navigation principale">
    <div class="side-head">
      <label for="menu" class="menu-btn" title="Menu">
        <svg class="icon"><use href="#i-menu"/></svg>
      </label>
      <span class="brand">Touiteur</span>
    </div>

    <a href="profil.php" class="profile-link" aria-label="Mon profil">
      <span class="avatar"><svg class="icon"><use href="#i-person"/></svg></span>
      <span class="nav-label">Mon profil</span>
    </a>

    <div class="nav">
      <a href="index.php" class="nav-item active" aria-current="page">
        <span class="nav-icon"><svg class="icon"><use href="#i-star"/></svg></span>
        <span class="nav-label">Fil d'actu</span>
      </a>
      <a href="#" class="nav-item">
        <span class="nav-icon"><svg class="icon"><use href="#i-star"/></svg></span>
        <span class="nav-label">Following</span>
      </a>
      <a href="#" class="nav-item">
        <span class="nav-icon"><svg class="icon"><use href="#i-star"/></svg></span>
        <span class="nav-label">#1</span>
      </a>
    </div>
  </nav>

  <main class="main">
    <div class="content">
      <h1 class="sr-only">Fil d'actu</h1>


      <!-- Rédaction d'un touite : username et texte modifiables, boutons encore inactifs -->
      <section class="composer" aria-label="Écrire un touite">
        <span class="deco d1"></span>
        <span class="deco d2"></span>
        <span class="deco d3"></span>

        <div class="composer-user">
          <span class="avatar big"><svg class="icon"><use href="#i-person"/></svg></span>
          <input class="username-input" type="text" name="username" value="username"
                 placeholder="username" maxlength="30" autocomplete="nickname"
                 aria-label="Nom d'utilisateur">
        </div>

        <textarea class="composer-text" name="touite" placeholder="Touite" maxlength="235" rows="2"
                  aria-label="Texte du touite (235 caractères maximum)"></textarea>

        <div class="composer-actions">
          <button class="chip" type="button" disabled>
            <svg class="icon"><use href="#i-image"/></svg>Ajouter une image
          </button>
          <button class="chip" type="button" disabled>
            <svg class="icon"><use href="#i-publish"/></svg>Publier
          </button>
        </div>
      </section>

      <!-- Liste des touites -->
      <section class="touites" aria-label="Touites">

        <article class="touite">
          <div class="thumb t1" role="img" aria-label="Image du touite"><span>R</span></div>
          <div class="touite-body">
            <div class="touite-head">
              <h2 class="author">Random kid</h2>
              <div class="votes">
                <input class="vote-input vote-none" type="radio" name="vote-1" id="v1-none" checked>
                <input class="vote-input vote-up" type="radio" name="vote-1" id="v1-up">
                <input class="vote-input vote-down" type="radio" name="vote-1" id="v1-down">
                <label class="vote-btn l-down-off" for="v1-down" title="Dislike"><svg class="icon"><use href="#i-down"/></svg></label>
                <label class="vote-btn l-down-on" for="v1-none" title="Retirer le dislike"><svg class="icon"><use href="#i-down"/></svg></label>
                <label class="vote-btn l-up-off" for="v1-up" title="Like"><svg class="icon"><use href="#i-up"/></svg></label>
                <label class="vote-btn l-up-on" for="v1-none" title="Retirer le like"><svg class="icon"><use href="#i-up"/></svg></label>
              </div>
            </div>
            <p class="text">Phoenix just died !! <span class="tag">#help</span></p>
            <time class="date" datetime="2026-11-02T16:12">02/11/2026 · 16:12</time>
          </div>
        </article>

        <article class="touite">
          <div class="thumb t2" role="img" aria-label="Image du touite"><span>C</span></div>
          <div class="touite-body">
            <div class="touite-head">
              <h2 class="author">Camille</h2>
              <div class="votes">
                <input class="vote-input vote-none" type="radio" name="vote-2" id="v2-none" checked>
                <input class="vote-input vote-up" type="radio" name="vote-2" id="v2-up">
                <input class="vote-input vote-down" type="radio" name="vote-2" id="v2-down">
                <label class="vote-btn l-down-off" for="v2-down" title="Dislike"><svg class="icon"><use href="#i-down"/></svg></label>
                <label class="vote-btn l-down-on" for="v2-none" title="Retirer le dislike"><svg class="icon"><use href="#i-down"/></svg></label>
                <label class="vote-btn l-up-off" for="v2-up" title="Like"><svg class="icon"><use href="#i-up"/></svg></label>
                <label class="vote-btn l-up-on" for="v2-none" title="Retirer le like"><svg class="icon"><use href="#i-up"/></svg></label>
              </div>
            </div>
            <p class="text">Premier jour de SAE, le café est déjà vide. <span class="tag">#iut</span> <span class="tag">#sae</span></p>
            <time class="date" datetime="2026-11-02T15:48">02/11/2026 · 15:48</time>
          </div>
        </article>

        <article class="touite">
          <div class="thumb t3" role="img" aria-label="Image du touite"><span>L</span></div>
          <div class="touite-body">
            <div class="touite-head">
              <h2 class="author">Lucas</h2>
              <div class="votes">
                <input class="vote-input vote-none" type="radio" name="vote-3" id="v3-none" checked>
                <input class="vote-input vote-up" type="radio" name="vote-3" id="v3-up">
                <input class="vote-input vote-down" type="radio" name="vote-3" id="v3-down">
                <label class="vote-btn l-down-off" for="v3-down" title="Dislike"><svg class="icon"><use href="#i-down"/></svg></label>
                <label class="vote-btn l-down-on" for="v3-none" title="Retirer le dislike"><svg class="icon"><use href="#i-down"/></svg></label>
                <label class="vote-btn l-up-off" for="v3-up" title="Like"><svg class="icon"><use href="#i-up"/></svg></label>
                <label class="vote-btn l-up-on" for="v3-none" title="Retirer le like"><svg class="icon"><use href="#i-up"/></svg></label>
              </div>
            </div>
            <p class="text">Quelqu'un a une bonne playlist pour coder ? <span class="tag">#musique</span> <span class="tag">#dev</span></p>
            <time class="date" datetime="2026-11-02T14:30">02/11/2026 · 14:30</time>
          </div>
        </article>

        <article class="touite">
          <div class="thumb t4" role="img" aria-label="Image du touite"><span>M</span></div>
          <div class="touite-body">
            <div class="touite-head">
              <h2 class="author">Manon</h2>
              <div class="votes">
                <input class="vote-input vote-none" type="radio" name="vote-4" id="v4-none" checked>
                <input class="vote-input vote-up" type="radio" name="vote-4" id="v4-up">
                <input class="vote-input vote-down" type="radio" name="vote-4" id="v4-down">
                <label class="vote-btn l-down-off" for="v4-down" title="Dislike"><svg class="icon"><use href="#i-down"/></svg></label>
                <label class="vote-btn l-down-on" for="v4-none" title="Retirer le dislike"><svg class="icon"><use href="#i-down"/></svg></label>
                <label class="vote-btn l-up-off" for="v4-up" title="Like"><svg class="icon"><use href="#i-up"/></svg></label>
                <label class="vote-btn l-up-on" for="v4-none" title="Retirer le like"><svg class="icon"><use href="#i-up"/></svg></label>
              </div>
            </div>
            <p class="text">Il pleut à Strasbourg, parfait pour rester au chaud et finir le CSS. <span class="tag">#css</span></p>
            <time class="date" datetime="2026-11-02T12:05">02/11/2026 · 12:05</time>
          </div>
        </article>

        <article class="touite">
          <div class="thumb t5" role="img" aria-label="Image du touite"><span>T</span></div>
          <div class="touite-body">
            <div class="touite-head">
              <h2 class="author">Théo</h2>
              <div class="votes">
                <input class="vote-input vote-none" type="radio" name="vote-5" id="v5-none" checked>
                <input class="vote-input vote-up" type="radio" name="vote-5" id="v5-up">
                <input class="vote-input vote-down" type="radio" name="vote-5" id="v5-down">
                <label class="vote-btn l-down-off" for="v5-down" title="Dislike"><svg class="icon"><use href="#i-down"/></svg></label>
                <label class="vote-btn l-down-on" for="v5-none" title="Retirer le dislike"><svg class="icon"><use href="#i-down"/></svg></label>
                <label class="vote-btn l-up-off" for="v5-up" title="Like"><svg class="icon"><use href="#i-up"/></svg></label>
                <label class="vote-btn l-up-on" for="v5-none" title="Retirer le like"><svg class="icon"><use href="#i-up"/></svg></label>
              </div>
            </div>
            <p class="text">N'oubliez pas de hasher les mots de passe ! <span class="tag">#sécurité</span> <span class="tag">#bcrypt</span></p>
            <time class="date" datetime="2026-11-02T09:20">02/11/2026 · 09:20</time>
          </div>
        </article>

      </section>
    </div>
  </main>
</div>

</body>
</html>
