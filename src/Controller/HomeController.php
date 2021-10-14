<?php

namespace App\Controller;
//use Symfony\Component\HttpFoundation\Request;
use App\passerelle\ClipConnection;
use SoapClient;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Component\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Actualite;
use App\Entity\Projet;
use App\Entity\Contact;
use App\Entity\Team;

class HomeController extends AbstractController
{
    /**
     * Page d'accueil
     *
     * @Route("/", name="accueil")
     * @return Response
     */
    public function home()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repoTeam = $entityManager->getRepository(Projet::class);
        $List = $repoTeam->findAll();
        $repoActu= $entityManager->getRepository(Actualite::class);
        $objall = $repoActu->findAll();
        if(isset($_COOKIE["view"]) ){
            $splash = false;
        }else{
            $splash = true;
        }
        
        return $this->render('home.html.twig', [
            'title' => 'HBH - Société leader pour gérer vos projets de construction',
            'description' => 'Forte d’une équipe de collaborateurs expérimentés en bâtiment, principalement ingénieurs et architectes, HBH Luxembourg offre un large choix de services.',
            'list' => $List ,
            'objall' => $objall, 
            'splash' => $splash
        ]);
    }

    /**
     * @Route("/services", name="services")
     * @return Response
     */
    public function services()
    {
        return $this->render('services.html.twig', [
            'title' => 'HBH - Les services proposés pour vos projets de construction',
            'description' => 'HBH gère vos projets de construction et répond aux besoins de ses clients, tant
            en assistance au Maître d’Ouvrage que pour la gestion de la sécurité et la santé'
        ]);
    }

    /**
     * @Route("/services_espace_collaboratif", name="services_espace_collaboratif")
     * @return Response
     */
    public function services_espace_collaboratif()
    {
        return $this->render('services-espace-collaboratif.html.twig', [
            'title' => "HBH - Création d'espaces collaboratifs pour le bien de vos projets ",
            'description' => "Dans le cadre des missions de Project Management, HBH assure que toutes les parties prenantes ont accès à la
            bonne information et au bon moment. "
        ]);
    }

    /**
     * @Route("/services_labellisation", name="services_labellisation")
     * @return Response
     */
    public function services_labellisation()
    {
        return $this->render('services-labellisation.html.twig', [
            'title' => 'HBH - La labellisation de vos projets de construction ',
            'description' => "Depuis 2019, HBH assiste les investisseurs et les Maîtres d’Ouvrage pour labelliser leurs projets en DGNB, la norme de référence allemande en construction durable.
            "
        ]);
    }

    /**
     * @Route("/services_management_projet", name="services_management_projet")
     * @return Response
     */
    public function services_management_projet()
    {
        return $this->render('services-management-projet.html.twig', [
            'title' => "HBH - Le management de projets pour les maîtres d'ouvrages",
            'description' => "Forte de son expérience de terrain, d’équipes compétentes et de son expertise, HBH répond aux besoins des Maîtres d’Ouvrage et bureaux d’études."
        ]);
    }

    /**
     * @Route("/services_securite_sante", name="services_securite_sante")
     * @return Response
     */
    public function services_securite_sante()
    {
        return $this->render('services-securite-sante.html.twig', [
            'title' => 'HBH - La sécurité et la santé de vos collaborateurs',
            'description' => "HBH prend en compte tous les types de risques liés à la co-activité, à l’interactivité et à l’environnement du chantier pour la santé de vos ouvriers."
        ]);
    }

    /**
     * @Route("/projets", name="projets")
     * @return Response
     */
    public function projets()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repoTeam = $entityManager->getRepository(Projet::class);
        $List = $repoTeam->findAll();
        return $this->render('projets.html.twig', [
            'title' => 'HBH - Découvrez nos projets au Luxembourg et dans la Grande-Région',
            'description' => "Management de projet ou sécurité/santé, HBH vous propose de découvrir les derniers projets mis en lumière par nos services",
            'list' => $List, 
            'nb' => count($List)
        ]);
    }
        /**
     * @Route("/projet/{id}", name="projet")
     * @return Response
     */
    public function projet(int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repoTeam = $entityManager->getRepository(Projet::class);
        $obj = $repoTeam->find($id);
        $objall = $repoTeam->findAll();
        if(count($objall)<3){
       
        }else{
            $tbl[0]=$objall[0];
            $tbl[1]=$objall[1];
            $tbl[2]=$objall[2];
            $objall = $tbl;
        }
        return $this->render('projet.html.twig', [
            'title' => 'projets',
            'obj' => $obj,
            'objall' => $objall
        ]);
    }

    /**
     * @Route("/presentation", name="presentation")
     * @return Response
     */
    public function presentation()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repoTeam = $entityManager->getRepository(Team::class);
        $ListTeam = $repoTeam->findAllAscPosition();
        return $this->render('presentation.html.twig', [
            'title' => 'HBH - A propos de notre entreprise et de notre équipe',
            'description' => "Créée en 1988, HBH est aujourd'hui une société leader au Luxembourg en management de projets et en sécurité et santé dans le secteur de la construction.",
            'list' => $ListTeam,        ]);
    }

    /**
     * @Route("/actualites", name="actualites")
     * @return Response
     */
    public function actualites()
    {  
        $entityManager = $this->getDoctrine()->getManager();
        $repoTeam = $entityManager->getRepository(Actualite::class);
        $List = $repoTeam->findAll();
        return $this->render('actualites.html.twig', [
            'title' => 'HBH - Découvrez ici nos actualités en rapport avec notre activité',
            'description' => "Vous retrouverez ici les actualités de l'entreprise HBH au Luxembourg, société leader en projets de construction.",
            'list' => $List
        ]);
    }
        /**
     * @Route("/actualite/{id}", name="actualite")
     * @return Response
     */
    public function actualite(int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repoTeam = $entityManager->getRepository(Actualite::class);
        $obj = $repoTeam->find($id);
        $objall = $repoTeam->findAll();
        if(count($objall)<3){
       
        }else{
            $tbl[0]=$objall[0];
            $tbl[1]=$objall[1];
            $tbl[2]=$objall[2];
            $objall = $tbl;
        }
        return $this->render('actualite.html.twig', [
            'title' => 'actualites',
            'obj' => $obj,
            'objall' => $objall
        ]);
    }
        /**
     * @Route("/mentions_legales", name="mentionlegales")
     * @return Response
     */
    public function mention_legales()
    {
        return $this->render('mention.html.twig', [
            'title' => 'HBH - Nos mentions légales',
            'description' => "Vous retrouverez ici les mentions légales de l'entreprise HBH au Luxembourg, société leader en projets de consutrction"
        ]);
    }
 

    
}