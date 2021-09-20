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
        return $this->render('home.html.twig', [
            'title' => 'home'
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
        return $this->render('projets.html.twig', [
            'title' => 'projets'
        ]);
    }
        /**
     * @Route("/projet", name="projet")
     * @return Response
     */
    public function projet()
    {
        return $this->render('projet.html.twig', [
            'title' => 'projets'
        ]);
    }

    /**
     * @Route("/presentation", name="presentation")
     * @return Response
     */
    public function presentation()
    {
        return $this->render('presentation.html.twig', [
            'title' => 'presentation'
        ]);
    }

    /**
     * @Route("/actualites", name="actualites")
     * @return Response
     */
    public function actualites()
    {
        return $this->render('actualites.html.twig', [
            'title' => 'actualites'
        ]);
    }
        /**
     * @Route("/actualite", name="actualite")
     * @return Response
     */
    public function actualite()
    {
        return $this->render('actualite.html.twig', [
            'title' => 'actualites'
        ]);
    }
 

    
}