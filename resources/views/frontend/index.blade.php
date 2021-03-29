<!DOCTYPE html>
<html lang=fr dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toilettage Lady'S Dogs</title>
    <link rel="stylesheet" href="{{ url('/css/style.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  </head>

  <body>
    <span id="accueilAnchor"></span>
    <header>
      <a href="tel:0492087565" class="clickable external" id="phoneNumber">0492/08.75.65</a>
      <div id="burger" class="clickable">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </header>

      <nav>
        <ul>
          <li><a href="#accueilAnchor" class="clickable" id="accueilBtn">Accueil</a></li>
          <li><a href="#QuiSuisJeAnchor" class="clickable">Qui suis-je ?</a></li>
          <li><a href="#salon" class="clickable">Le Salon</a></li>
          <li><a href="#servicesAnchor" class="clickable">Mes services</a></li>
          <li><a href="#contact" class="clickable">Contactez-moi</a></li>
        </ul>
      </nav>

    <main>
      <section id="accueil">
        <img id="scissors" class="more1440" src="images/ciseauxBlancs.png" alt="Ciseaux de toilettage">
        <img id="foots" class="more1440" src="images/pattesBlanches.png" alt="Pattes de chiens">
        <h1><img src="{{ url('images/logo.png') }}" alt="Logo Lady'S Dogs"></h1>            
        <span class="flexAccueil">
            <figure><img class="imagesRondes" src="{{ url('images/photolaeti.jpeg') }}" alt="Photo de la toiletteuse avec son chien"></figure>
            <article>
                <h3>Salon d'esthétique canin</h3>
                <h4>Toiletteuse diplomée</h4>
                <h4>Ophain, depuis 2016</h4>
              </article>
          </span>
        

        <article class="horaires" id="horairesTop">
          <div class="horaire1">
            <p>Lundi au vendredi</p>
            <p>8h30 à 18h00</p>
          </div>
          <div class="horaire2">
            <p>Le premier samedi du mois</p>
            <p>Uniquement sur rendez-vous</p>
          </div>
        </article>
      </section>

      <span id="QuiSuisJeAnchor"></span>
      <h2>Qui suis-je ?</h2> 
      <section id="quiSuisJe">       
        <img id="photoFormation" src="{{ url('images/formation.jpeg') }}" alt="Toilettage d'un chien sur une table lors d'une formation pro">
        <p class="section-txt">
          <span class="citation">" Laëtitia Cheron, toiletteuse diplômée en 2015 après 3 ans de formation. "</span> <br><br>
          Ma formation a commencé en 2012 au salon "Nom d'un Chien..." à Waterloo et a été enrichie par differents toiletteurs reconnus dans le métier, 
          me permettant de me spécialiser en coupes ciseaux. <br><br>
          Grâce à ces expériences enrichissantes, j'ai eu l'opportunité d'ouvrir le salon <strong>Lady'S Dogs</strong> dans la maison familiale. <br><br>
          Après quelques mois de travaux, le salon a ouvert ses portes en décembre 2016.
        </p>
      </section>

      
      <section id="salon">   
        <h2>Le Salon</h2>     
        <!-- IMG -->
        <p class="section-txt">
          <span class="citation">" Chez <strong>Lady'S Dogs</strong>, le bien-être animal passe avant tout ! "</span> <br><br>
          Pour votre chien, je vous propose un soin complet, adapté à son poil et une coupe pour le mettre encore plus en valeur. <br><br>
          Petits et grands sont les bienvenus. <br><br>
          J'utilise des produits conçus spécifiquement pour chaque type de poil. Ceux-ci permettent de garder et améliorer la texture du pelage ainsi qu'un bon entretien
          de la peau. <br><br>
          <span class="underline">Tous mes produits sont à base d'ingrédients naturels.</span>
        </p>
      </section>

      <span id="servicesAnchor"></span>
      <h2>Mes services</h2>  
      <section id="services">        
        <article id="service1">
          <h5>Toilettage en salon</h5>
          <figure>
            <img src="{{ url('images/bouvier-cut.jpeg') }}" alt="Bouvier benois au bain tenant dans sa gueule le pommeau de douche" class="imagesRondes">
          </figure>
          <p class="section-txt">
            Le <strong>toilettage en salon</strong> offre à votre chien un soin complet de qualité optimale pour qu'il se sente comme à la maison ! <br><br>
            Grâce au <span class="underline">matériel du salon</span>, baignoire et table électriques, le poids et la taille de votre animal n'ont plus d'importance.
          </p>
        </article>
        
        <article id="service2">
          <h5 class="h5-increased-margin">Taxi-Dog</h5>
          <figure>
            <img src="{{ url('images/taxidog.jpeg') }}" alt="Petit chichuahua sur un siège de voiture" class="imagesRondes">
          </figure>
          <p class="section-txt">
            Le <strong>Taxi-Dog</strong> a été mis en place pour faciliter l'accès au toilettage pour les personnes qui ne savent pas se déplacer ou qui ont des soucis de mobilité. <br><br>
            Cela consiste à aller chercher et ramener votre chien à votre <span class="underline">domicile</span>.
          </p>
        </article>

        <article id="service3">
          <h5 class="h5-increased-margin">Toilettage à domicile</h5>
          <figure>
            <img src="{{ url('images/chihuahua.jpeg') }}" alt="Petit chien couché dans l'herbe" class="imagesRondes">
          </figure>
          <p class="section-txt">
            Agenda chargé ou des difficultés pour vous déplacer ? Plus de soucis avec <strong>Lady'S Dogs</strong> ! <br>
            Je vous propose un toilettage à <span class="underline">votre domicile</span>. <br><br>
            Je me déplace avec tout mon matériel. Je dois juste avoir accès à une douche ou une baignoire pour lui donner le bain et les soins comme
            il se doit.
          </p>
        </article>
      </section>

      <!-- <section id="portfolio">
      </section> -->

      <section id="contact">
          <h2>Contact</h2>
        <section id="contactContent">
          <div id="mapDiv">
            <iframe id="integratedMap" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2529.107951702477!2d4.341773915901861!3d50.66225617996109!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c3cdc7be1f0a25%3A0xb4ca20148a50a811!2sLady&#39;s%20Dogs%20Toilettage!5e0!3m2!1sfr!2sbe!4v1566808283742!5m2!1sfr!2sbe" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
          </div>
    
          <div id="flexContact">
            <article id="infoContact">
              <h3 class="clickable"><a href="https://goo.gl/maps/euH6FTXRN1WF5zj36" target="_blank">Rue de dinant, 9 <br> 1421 ophain </a></h3>
            <a href="tel:0492087565" class="clickable external">0492/08.75.65</a> <br>
            <a href="mailto:toilettage.ladysdogs@gmail.com" class="clickable external">toilettage.ladysdogs@gmail.com</a>
            </article>
                
            <article class="horaires" id="horairesBottom">
              <p>Lundi au vendredi</p>
              <p>8h30 à 18h00</p>
              <p>Le premier samedi du mois</p>
              <p>Uniquement sur rendez-vous</p>
            </article>
          
            <article class="social">
              <a href="https://www.facebook.com/ladysdogs/" target="_blank"><img src="images/fb.png" alt="" class="imagesRondes clickable external"></a>
              <a href="https://www.instagram.com/ladys_dogs_toilettage/?hl=fr" target="_blank"><img src="images/insta.png" alt="" class="imagesRondes clickable external"></a>
            </article>    
          </div>
        </section>
    </section>  
          
    </main>
  </body>

  <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous">
  </script>
<script src="{{ url('js/script.js') }}"></script>

</html>
