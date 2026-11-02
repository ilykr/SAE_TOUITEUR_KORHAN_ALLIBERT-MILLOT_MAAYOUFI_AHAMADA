<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Touiteur.app — Profil</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Icônes -->
<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <symbol id="i-menu" viewBox="0 0 24 24"><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></symbol>
  <symbol id="i-person" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></symbol>
  <symbol id="i-star" viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zm4.24 16L12 15.45 7.77 18l1.12-4.81-3.73-3.23 4.92-.42L12 5l1.92 4.53 4.92.42-3.73 3.23L16.23 18z"/></symbol>
  <symbol id="i-back" viewBox="0 0 24 24"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></symbol>
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

    <a href="profil.php" class="profile-link active" aria-label="Mon profil" aria-current="page">
      <span class="avatar"><svg class="icon"><use href="#i-person"/></svg></span>
      <span class="nav-label">Mon profil</span>
    </a>

    <div class="nav">
      <a href="indexinterface.php" class="nav-item">
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

      <a href="indexinterface.php" class="back" aria-label="Retour au fil d'actu">
        <svg class="icon"><use href="#i-back"/></svg>
      </a>

      <section class="profile-head" aria-label="Informations du profil">
        <span class="avatar xl"><svg class="icon"><use href="#i-person"/></svg></span>
        <div>
          <h1 class="profile-name">username</h1>
          <p class="profile-handle">@username</p>
          <p class="profile-bio">Étudiant en BUT Informatique. J'écris des touites entre deux compilations.</p>
        </div>
      </section>

      <section class="stats" aria-label="Statistiques">
        <div class="stat"><strong>3</strong><span>Touites</span></div>
        <div class="stat"><strong>128</strong><span>Abonnés</span></div>
        <div class="stat"><strong>64</strong><span>Abonnements</span></div>
      </section>

      <h2 class="section-title">Mes touites</h2>

      <section class="touites" aria-label="Mes touites">

        <article class="touite">
          <div class="thumb t4" role="img" aria-label="Image du touite"><span>U</span></div>
          <div class="touite-body">
            <div class="touite-head">
              <h3 class="author">username</h3>
              <div class="votes">
                <input class="vote-input vote-none" type="radio" name="vote-1" id="p1-none" checked>
                <input class="vote-input vote-up" type="radio" name="vote-1" id="p1-up">
                <input class="vote-input vote-down" type="radio" name="vote-1" id="p1-down">
                <label class="vote-btn l-down-off" for="p1-down" title="Dislike"><svg class="icon"><use href="#i-down"/></svg></label>
                <label class="vote-btn l-down-on" for="p1-none" title="Retirer le dislike"><svg class="icon"><use href="#i-down"/></svg></label>
                <label class="vote-btn l-up-off" for="p1-up" title="Like"><svg class="icon"><use href="#i-up"/></svg></label>
                <label class="vote-btn l-up-on" for="p1-none" title="Retirer le like"><svg class="icon"><use href="#i-up"/></svg></label>
              </div>
            </div>
            <p class="text">Mon tout premier touite sur Touiteur.app ! <span class="tag">#bienvenue</span></p>
            <time class="date" datetime="2026-11-02T10:00">02/11/2026 · 10:00</time>
          </div>
        </article>

        <article class="touite">
          <div class="thumb t3" role="img" aria-label="Image du touite"><span>U</span></div>
          <div class="touite-body">
            <div class="touite-head">
              <h3 class="author">username</h3>
              <div class="votes">
                <input class="vote-input vote-none" type="radio" name="vote-2" id="p2-none" checked>
                <input class="vote-input vote-up" type="radio" name="vote-2" id="p2-up">
                <input class="vote-input vote-down" type="radio" name="vote-2" id="p2-down">
                <label class="vote-btn l-down-off" for="p2-down" title="Dislike"><svg class="icon"><use href="#i-down"/></svg></label>
                <label class="vote-btn l-down-on" for="p2-none" title="Retirer le dislike"><svg class="icon"><use href="#i-down"/></svg></label>
                <label class="vote-btn l-up-off" for="p2-up" title="Like"><svg class="icon"><use href="#i-up"/></svg></label>
                <label class="vote-btn l-up-on" for="p2-none" title="Retirer le like"><svg class="icon"><use href="#i-up"/></svg></label>
              </div>
            </div>
            <p class="text">Le CSS sans JavaScript, c'est plus puissant qu'on le croit. <span class="tag">#css</span> <span class="tag">#web</span></p>
            <time class="date" datetime="2026-11-01T18:42">01/11/2026 · 18:42</time>
          </div>
        </article>

        <article class="touite">
          <div class="thumb t2" role="img" aria-label="Image du touite"><span>U</span></div>
          <div class="touite-body">
            <div class="touite-head">
              <h3 class="author">username</h3>
              <div class="votes">
                <input class="vote-input vote-none" type="radio" name="vote-3" id="p3-none" checked>
                <input class="vote-input vote-up" type="radio" name="vote-3" id="p3-up">
                <input class="vote-input vote-down" type="radio" name="vote-3" id="p3-down">
                <label class="vote-btn l-down-off" for="p3-down" title="Dislike"><svg class="icon"><use href="#i-down"/></svg></label>
                <label class="vote-btn l-down-on" for="p3-none" title="Retirer le dislike"><svg class="icon"><use href="#i-down"/></svg></label>
                <label class="vote-btn l-up-off" for="p3-up" title="Like"><svg class="icon"><use href="#i-up"/></svg></label>
                <label class="vote-btn l-up-on" for="p3-none" title="Retirer le like"><svg class="icon"><use href="#i-up"/></svg></label>
              </div>
            </div>
            <p class="text">Rendu de la SAE dans une semaine, on respire. <span class="tag">#sae</span></p>
            <time class="date" datetime="2026-10-30T21:15">30/10/2026 · 21:15</time>
          </div>
        </article>

      </section>
    </div>
  </main>
</div>

</body>
</html>
