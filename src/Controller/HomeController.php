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
            'title' => 'home',
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
            'title' => 'services'
        ]);
    }

    /**
     * @Route("/services_espace_collaboratif", name="services_espace_collaboratif")
     * @return Response
     */
    public function services_espace_collaboratif()
    {
        return $this->render('services-espace-collaboratif.html.twig', [
            'title' => 'services-espace-collaboratif'
        ]);
    }

    /**
     * @Route("/services_labellisation", name="services_labellisation")
     * @return Response
     */
    public function services_labellisation()
    {
        return $this->render('services-labellisation.html.twig', [
            'title' => 'services-labellisation'
        ]);
    }

    /**
     * @Route("/services_management_projet", name="services_management_projet")
     * @return Response
     */
    public function services_management_projet()
    {
        return $this->render('services-management-projet.html.twig', [
            'title' => 'services-management-projet'
        ]);
    }

    /**
     * @Route("/services_securite_sante", name="services_securite_sante")
     * @return Response
     */
    public function services_securite_sante()
    {
        return $this->render('services-securite-sante.html.twig', [
            'title' => 'services-securite-sante'
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
            'title' => 'projets',
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
        $ListTeam = $repoTeam->findAll();
        return $this->render('presentation.html.twig', [
            'title' => 'presentation',
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
            'title' => 'actualites',
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
            $objall = array_rand($objall , 3);
        }
        return $this->render('actualite.html.twig', [
            'title' => 'actualites',
            'obj' => $obj,
            'objall' => $objall
        ]);
    }
 

    
}