<?php
    require_once('configLivre.php');

    try{
        $pdo = new PDO(MYSQL_DSN, DB_USER, DB_PWD);  
    }
    catch (PDOException $e){
 
        echo $e->getMessage();  
        $pdo = null;            
        die('Problème technique'); 
    }
    $sql_characters = $pdo->query('SELECT * 
                                  FROM ecrit,auteurs,livres 
								  WHERE numLivre = numLiv 
							      AND numA = numAuteur  
                                  ORDER BY nomA ASC');
    $data = $sql_characters->fetchAll(PDO::FETCH_ASSOC); //tableau à 2 dimensions 
//    var_dump($data); 
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LIVRES</title>
        <link rel="stylesheet" href="CSS/font-awesome.css">
        <link rel="stylesheet" href="CSS/font-awesome.min.css">
        <link rel="stylesheet" href="CSS/normalize.css">
        <link rel="stylesheet" href="css/styleALL.css">
        <script src="js/jquery-3.2.1.min.js"></script>
        <script>
            $(document).ready(function(e) {
                $('img').mouseleave(function(e) {
                    $('p').css('color', 'red');
                });
                $('img').mouseleave(function(e) {
                    $('p').css('width', '20%');
                });
            });

        </script>
    </head>

    <body>
        <header>
            <button><i class="fa fa-2x fa-bars" aria-hidden="true"></i></button>
            <div id="imgLogoAll"><img src="assets/images/logofinalbeige.svg" alt="logo"></div>
            <div id="iconesHeaderAll">
                <div><i class="fa fa-user fa-2x" aria-hidden="true"></i>
                </div>
                <div><i class="fa fa-search fa-2x" aria-hidden="true"></i>
                </div>
                <div><i class="fa fa-shopping-basket fa-2x" aria-hidden="true"></i>
                </div>
            </div>
            <nav>
                <button><i class="fa fa-2x fa-bars" aria-hidden="true"></i></button>
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="index.html">Accueil</a>
                <a href="Apropos.html">A propos</a>
                <a href="pageAll.php">Livres</a>
                <a href="abonnements.html">Abonnements</a>
                <a href="contact.html">Contact</a>
                <a href="connexion.html">S'enregistrer/Connexion</a>
                <div id="frEng">
                    <a href="index.html">FR</a>
                    <a href="indexEn.html">ENG</a>
                </div>
            </nav>
        </header>
        <main>
            <h1><i class="fa fa-book fa-2x" aria-hidden="true"></i> Livres</h1>
            <div>
                <div class="menu">
                    <ul>
                        <li>
                            <a href="index.html">
            <img src="assets/icons/beige/Accueil.png" alt="">
            <span>Accueil</span>
            </a>
                        </li>
                        <?php
                    echo '<li> 
                        <a href="categorie.php?type=jeunesse">
           <img src="assets/icons/beige/Enfant.png" alt="tête de ourse">
            <span>Jeunesse</span>
            </a>
                    </li>';
                    echo'<li>
                        <a href="categorie.php?type=horreur">
           <img src="assets/icons/beige/Horreur.png" alt="couteau avec du sang">
            <span>Horreur</span>
               </a>
                    </li>';
                    echo '<li>
                        <a href="categorie.php?type=cuisine">
           <img src="assets/icons/beige/Cuisine.png" alt="chapeau de cuisine">
            <span>Cuisine</span>
            </a>
                    </li>';
                    echo '<li>
                        <a href="categorie.php?type=policier">
           <img src="assets/icons/beige/Policier.png" alt="chapeau de policier">
            <span>Policier</span>
            </a>
                    </li>';
                    echo '<li>
                        <a href="categorie.php?type=science_fiction">
   <img src="assets/icons/beige/Sciences%20Fictions.png" alt="tête d"alleen">
            <span>Science Fiction</span>
            </a>
                    </li>';
                    echo '<li>
                        <a href="categorie.php?type=comedie">
           <img src="assets/icons/beige/Commedie.png" alt="">
            <span>Comedie</span>
            </a>
                    </li>';
                    echo '<li>
                        <a href="categorie.php?type=informatique">
           <img src="assets/icons/beige/laptop%20(1).png" alt="ordinateur">
            <span>Informatique</span>
            </a>
                    </li>';
                    echo '<li>
                        <a href="categorie.php?type=jardin">
           <img src="assets/icons/beige/Jardin.png" alt="">
            <span>Jardinage</span>
            </a>
                    </li>';
                    echo '<li>
                        <a href="categorie.php?type=fantastique">
           <img src="assets/icons/beige/fantasie.png" alt="">
            <span>Fantastique</span>
           </a>
                    </li>';
                    echo '<li>
                            <a href="categorie.php?type=romance">
           <img src="assets/icons/beige/romance.png" alt="coeur">
            <span>Romance</span>
            </a>
                        </li>';
                        ?>
                    </ul>
                </div>
                <div id="resSoc">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                </div>
                <div id="divLivres">
                    <?php
            for($i = 0; $i < count($data); $i++){
            echo '<a href="livreDetail.php?idp=' .  $data[$i]['numLivre'] . '"><figure class="effetLivres"><img src="assets/images/' . $data[$i]['numLivre'] . '.jpg" alt="" class="imgLivres"><figcaption><h4>' . $data[$i]['prenomA'] . " " . $data[$i]['nomA'] . '</h4><h5>' . $data[$i]['titre'] . '</h5></figcaption></figure></a>';
            }
            ?>
                </div>
            </div>
        </main>
        <footer>
            &copy; Interface3 2017 - WEB06 - Cat, Dje, Zuz'
        </footer>
        <script>
            function toggleMenu(evt) {
                //console.log(window.matchMedia('(min-width: 800px)')); // Retourne un objet contenant 2 keys : la media query et son résultat (Boolean) fa-times: affiche le x quand on ouvre le menu
                if (window.matchMedia) {
                    nav.classList.toggle('visible');
                    btn.children[0].classList.toggle('fa-bars');
                    //                btn.children[0].classList.toggle('fa-times');
                    /*
                    if (btn.innerHTML == 'Open') {
                        btn.innerHTML = 'Close';
                    } else {
                        btn.innerHTML = 'Open';   
                    }
                    */
                }
            }


            var btn = document.querySelector('header button');
            var nav = document.querySelector('nav');
            var links = document.querySelectorAll('nav a');

            btn.addEventListener('click', toggleMenu);

            for (var i = 0; i < links.length; i++) {
                links[i].addEventListener('click', toggleMenu);
            }

            function closeNav() {
                //   document.getElementsByTagName("nav").style.width = "0";
            }

        </script>
    </body>

    </html>
