<?php
// src/Controller/JeuxController.php
namespace App\Controller;

use App\Entity\Jeux;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


class JeuxController extends AbstractController
{
    /**
     * @Route("/jeux", name="jeu")
     */
    public function voir(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Récupérez les données du formulaire
        $nom = $request->request->get('nom');
        $description = $request->request->get('description');
        $prix = $request->request->get('prix');
        // $date = $request->request->get('date');
        // $note = $request->request->get('note');
        $image = $request->request->get('image');
        $stock = $request->request->get('stock');
        $genre = $request->request->get('genre');

        // Créez une nouvelle instance de l'entité Jeux
        $jeu = new Jeux();
        $jeu->setNom("Persona 5 Royal");
        $jeu->setDescription("Le jour, vous êtes un étudiant lambda, avec sa vie, ou ses amis (et alliés, ici appelés Confidents) avec
        lesquels vous devrez interagir pour booster vos stats et vos liens d’amitié (plus ils seront forts, et
        plus vos Thieves seront performants). Dans cette partie, vous pouvez aussi suivre les cours, trouver un
        petit job, faire de multiples activités comme dans Yakuza… La nuit, vous devenez Phantom Thieves, pour
        explorer et libérer des donjons, au nombre de 9, appelés Palais (version distordue de la réalité), dans
        un monde parallèle. Nos Lupins en herbe pénètrent ainsi l’inconscient maléfique de leurs victimes pour
        commettre de véritables « hold-ups de cœurs » en provoquant leur Métanoïa.
");
        $jeu->setPrix("52");
         $jeu->setGenre('RPG');
        // $jeu->setDate($date);
        // $jeu->setNote($note);
        $jeu->setStock("14");
        $jeu->setImage("https://m.media-amazon.com/images/I/81RYPL46ZhL.jpg");

        // Persistez l'entité en base de données
        $entityManager->persist($jeu);
        $entityManager->flush();

        // Redirigez vers la page de confirmation ou une autre page appropriée
        return new Response("<h1>Bravo le jeu a été ajouté<h1>");
        return $this->render('home/index.html.twig', [
            'jeu' => [
                'nom' => $nom,
                'image' => $image,
                'prix' => $prix,
                "description" => $description,
                "stock" => $stock,
                "genre" => $genre
            ],
        ]);
    }

    /**
     * @Route("/jeux/add", name="jeux_add")
     */

    public function maPageDeJeux(): Response
    {
        $jeu = [
            [
                'id' => 1,
                'nom' => 'The Legend of Zelda: Tears of the Kingdom',
                'image' => '/image/the_legend_of_zelda_tears_of_the_kingdom.jpg',
                'prix' => '60',
            ],
            [
                'id' => 8,
                'nom' => 'Persona 5 Royal',
                'image' => 'https://m.media-amazon.com/images/I/81RYPL46ZhL.jpg',
                "prix" => "52"
            ],
            [
                'id' => 3,
                'nom' => 'Street Fighter 6',
                'image' => '/image/street_fighter_6.webp',
                'prix' => '56',
            ],
        ];

        return $this->render('home/index.html.twig', [
            'jeu' => $jeu,
        ]);
    }
    /**
     * @Route("/nouveautes/add", name="nouveautés")
     */
    public function maPageDeNouveautes(): Response
    {
        $nouveautes = [
            [
                'id' => 1,
                'nom' => 'The Legend of Zelda: Tears of the Kingdom',
                'image' => '/image/the_legend_of_zelda_tears_of_the_kingdom.jpg',
                'prix' => '70',
            ],
            [
                'id' => 2,
                'nom' => 'Pikimin 4',
                'image' => '/image/pikmin_4.webp',
                'prix' => '70',
            ],
            [
                'id' => 3,
                'nom' => 'Street Fighter 6',
                'image' => '/image/street_fighter_6.webp',
                'prix' => '70',
            ],
        ];

        // Pass the details of the nouveautes to the Twig view
        return $this->render('home/index.html.twig', [
            'nouveaute' => $nouveautes,
        ]);
    }
    /**
     * @Route("/jeu/{id}", name="jeu_details")
     */
    public function details($id): Response
    {
        // Remplacez ce code par la logique pour récupérer les informations du jeu depuis votre base de données ou autre source de données
        $jeu = [

            'id' => 1,
            'nom' => 'The Legend Of Zelda Tears Of The Kingdom Edition Collector SWITCH',

            'image' => 'https://api.editioncollector.fr/uploads/image/file/52836/The-Legend-of-Zelda-Tears-of-the-Kingdom-%C3%A9dition-collector.jpg',

            'description' => "The Legend of Zelda: Tears of the Kingdom Edition Collector pour Nintendo Switch est un jeu d'action-aventure immersif qui emmène les joueurs dans un voyage épique à travers le monde fantastique d'Hyrule. Le jeu fait partie de la franchise acclamée par la critique Legend of Zelda et est connu pour ses énigmes complexes, ses personnages mémorables et son scénario captivant.

            Le jeu suit le protagoniste Link, qui se lance dans une quête pour sauver le royaume d'Hyrule d'une force maléfique qui menace de le détruire. En cours de route, les joueurs doivent explorer de vastes paysages, résoudre des énigmes difficiles et combattre des ennemis redoutables en utilisant une variété d'armes et de capacités.
            
            L'édition collector du jeu comprend un certain nombre de fonctionnalités supplémentaires, telles que des illustrations exclusives, un boîtier spécial et un CD de bande sonore. Ces extras rendent le jeu encore plus immersif et ajoutent à l'expérience globale.",

            'screenshots' => [
                'https://s1.dmcdn.net/v/UfND91Zv36x0vCW4Y',
                'https://assets-prd.ignimgs.com/2023/02/08/zelda-3-1675896445050.png',
                "https://static1.dualshockersimages.com/wordpress/wp-content/uploads/2023/02/the-legend-of-zelda-tears-of-the-kingdom.jpg",
                "https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/zelda-tears-of-the-kingdom-1675897360.jpg?crop=1.00xw:0.892xh;0,0&resize=1200:*",
                "https://i.ytimg.com/vi/H1xPp8EXyWA/maxresdefault.jpg",
                "https://www.switch-actu.fr/wp-content/uploads/2023/03/nintendo-switch-oled-zelda-tears-of-the-kingdom-manette-pro.jpg"
            ],


            'video' => "/image/Édition collector de The Legend of Zelda_ Tears of the Kingdom – Disponible le 12 mai.mp4",


            'features' => [
                "Un gameplay immersif : Le jeu propose une expérience de jeu captivante qui combine des éléments d'action,
                d'aventure et de puzzle-solving.
      ",
                "Un monde ouvert vaste et détaillé : Les joueurs peuvent explorer de vastes paysages, des donjons complexes
                et des villes animées tout en découvrant des secrets et en débloquant de nouvelles zones.
              Des graphismes magnifiques : Le jeu offre des graphismes époustouflants et une direction artistique soignée
                qui ajoutent à l'immersion dans le monde de Hyrule.",
                "Des personnages mémorables : Les joueurs rencontreront une variété de personnages inoubliables, chacun ayant
                sa propre personnalité et sa propre histoire."
            ],


            'id' => 8,
            'nom' => 'Persona 5 Royal',

            'image' => 'https://m.media-amazon.com/images/W/IMAGERENDERING_521856-T1/images/I/71j7jHmiIfL._AC_SX385_.jpg',

            'description' => "Le jour, vous êtes un étudiant lambda, avec sa vie, ou ses amis (et alliés, ici appelés Confidents) avec
            lesquels vous devrez interagir pour booster vos stats et vos liens d’amitié (plus ils seront forts, et
            plus vos Thieves seront performants). Dans cette partie, vous pouvez aussi suivre les cours, trouver un
            petit job, faire de multiples activités comme dans Yakuza… La nuit, vous devenez Phantom Thieves, pour
            explorer et libérer des donjons, au nombre de 9, appelés Palais (version distordue de la réalité), dans
            un monde parallèle. Nos Lupins en herbe pénètrent ainsi l’inconscient maléfique de leurs victimes pour
            commettre de véritables « hold-ups de cœurs » en provoquant leur Métanoïa.
  ",

            'screenshots' => [
               "/image/persona-5-royal-kasumi-and-joker-768x432.jpg",
       "/image/persona-5-royal-avis-switch-06.jpg",
       "/image/persona-5-royal-screen-08-ps4-en-10feb20_1581354839567-768x432.png",
          
       "https://new-game-plus.fr/wp-content/uploads/2020/05/test-Persona-5-Royal-New-Game-Plus-01.jpg",
          
       "https://www.pssurf.com/_gfx/screenshots/640x360/4640_DC2CuFY6pzKK99O2HokyfadZ.jpg",
       "https://www.thetechgame.com/images/news/article/b88a0ad76d.jpg" 
            ],


            'video' => "/image/Persona 5 Royal  Disponible - VOSTFR  PS4.mp4",


            'features' => [
                "Longue durée de jeu
                De nouveaux événements scénarisés : Persona 5 Royal propose de nouveaux événements scénarisés qui ajoutent
                  plus de profondeur à l'histoire et aux personnages.
                Musique entrainantes de différents genres(musicaux, notamment le jazz, le rock, le pop, le funk et
                  la musique électronique)
                Des ajouts et améliorations par rapport à la version originale : Persona 5 Royal offre de nouveaux
                  personnages, palais, fins alternatives et améliorations de gameplay qui améliorent l'expérience globale du
                  jeu."
            ],


            'id' => 1,
            'nom' => 'The Legend Of Zelda Tears Of The Kingdom Edition Collector SWITCH',

            'image' => 'https://api.editioncollector.fr/uploads/image/file/52836/The-Legend-of-Zelda-Tears-of-the-Kingdom-%C3%A9dition-collector.jpg',

            'description' => "The Legend of Zelda: Tears of the Kingdom Edition Collector pour Nintendo Switch est un jeu d'action-aventure immersif qui emmène les joueurs dans un voyage épique à travers le monde fantastique d'Hyrule. Le jeu fait partie de la franchise acclamée par la critique Legend of Zelda et est connu pour ses énigmes complexes, ses personnages mémorables et son scénario captivant.

            Le jeu suit le protagoniste Link, qui se lance dans une quête pour sauver le royaume d'Hyrule d'une force maléfique qui menace de le détruire. En cours de route, les joueurs doivent explorer de vastes paysages, résoudre des énigmes difficiles et combattre des ennemis redoutables en utilisant une variété d'armes et de capacités.
            
            L'édition collector du jeu comprend un certain nombre de fonctionnalités supplémentaires, telles que des illustrations exclusives, un boîtier spécial et un CD de bande sonore. Ces extras rendent le jeu encore plus immersif et ajoutent à l'expérience globale.",

            'screenshots' => [
                'https://s1.dmcdn.net/v/UfND91Zv36x0vCW4Y',
                'https://assets-prd.ignimgs.com/2023/02/08/zelda-3-1675896445050.png',
                "https://static1.dualshockersimages.com/wordpress/wp-content/uploads/2023/02/the-legend-of-zelda-tears-of-the-kingdom.jpg",
                "https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/zelda-tears-of-the-kingdom-1675897360.jpg?crop=1.00xw:0.892xh;0,0&resize=1200:*",
                "https://i.ytimg.com/vi/H1xPp8EXyWA/maxresdefault.jpg",
                "https://www.switch-actu.fr/wp-content/uploads/2023/03/nintendo-switch-oled-zelda-tears-of-the-kingdom-manette-pro.jpg"
            ],


            'video' => "/image/Édition collector de The Legend of Zelda_ Tears of the Kingdom – Disponible le 12 mai.mp4",


            'features' => [
                "Un gameplay immersif : Le jeu propose une expérience de jeu captivante qui combine des éléments d'action,
                d'aventure et de puzzle-solving.
      ",
                "Un monde ouvert vaste et détaillé : Les joueurs peuvent explorer de vastes paysages, des donjons complexes
                et des villes animées tout en découvrant des secrets et en débloquant de nouvelles zones.</li>
              Des graphismes magnifiques : Le jeu offre des graphismes époustouflants et une direction artistique soignée
                qui ajoutent à l'immersion dans le monde de Hyrule.",
                "Des personnages mémorables : Les joueurs rencontreront une variété de personnages inoubliables, chacun ayant
                sa propre personnalité et sa propre histoire."
            ],
        ];

        return $this->render('jeux/details.html.twig', [
            'jeu' => $jeu,
        ]);
    }
}
