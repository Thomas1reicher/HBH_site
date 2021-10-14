<?php


namespace App\Controller\admin;


use App\Entity\Actualite;
use App\Entity\Projet;
use App\Entity\Contact;
use App\Entity\Team;
use App\Entity\Image;
use App\Form\AdminForm\ObjectAddType;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\BddCms;
use App\Entity\Demandecredit;
use App\Entity\Taux;
use App\Repository\ActualiteRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class AdminController extends AbstractController
{

    private $itemsMenu;
    private $Actualiterepository;
    private $Contactrepository;
    private $Projetrepository;
    private $Teamrepository;
    private $imagerepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $repository = $entityManager->getRepository(BddCms::class);
        $this->Actualiterepository = $entityManager->getRepository(Actualite::class);
        $this->Contactrepository = $entityManager->getRepository(Contact::class);
        $this->Projetrepository = $entityManager->getRepository(Projet::class);
        $this->Teamrepository = $entityManager->getRepository(Team::class);
        $this->imagerepository = $entityManager->getRepository(Image::class);
        $categorieCms = $repository->findBy(
            array(),
            array('div_num' => 'ASC')
        );
        $this->itemsMenu = array();
        for ( $i =0; $i<count($categorieCms);$i++){
            $this->itemsMenu[$i] = array("nom" => $categorieCms[$i]->getName(), "lien" => "admin/".$categorieCms[$i]->getName(), "picto" =>$categorieCms[$i]->getIcon(),"color" =>$categorieCms[$i]->getColor() , "div_num"=>$categorieCms[$i]->getDivNum());
        }

    }
    /**
     *
     *
     * @Route("/admin/dashboard", name="accueilAdmin")
     */
    public function home()
    {

        return $this->render('admin/dashboard.html.twig', [
                'itemsMenu' => $this->itemsMenu,

            ]
        );
    }
    /**
     *
     *
     * @Route("/admin/{name}", name="catAdmin")
     */
    public function CatCms(string $name){
  
        $repository = $this->nameClass($name,"repository");
        $Objects = $repository->findAll();
        $obj = $this->nameClass($name,"class");
        $tbl_var = $obj->vars();
        return $this->render('admin/admin_tbl_view.html.twig', [
                'itemsMenu' => $this->itemsMenu,
                'objects' => $Objects,
                'tbl_var' => $tbl_var,
                'name' => $name
            ]
        );


    }
    /**
     *
     *
     * @Route("/admin/create/{name}", name="catAdminAdd")
     */
    public function CatCmsAdd(string $name,Request $request) : Response
    {
     
        $entityManager = $this->getDoctrine()->getManager();
        $object = $this->nameClass($name,"class");
        $form = $this->createForm(ObjectAddType::class, (object)  $object ,  array(
            'attr' => array('class' => $name ,
                'object' => $object,
            )));
        if($_POST){
        
            /*for($i=0;$i<count($object->typeVars());$i++){
            if($tbl[$object->typeVars()[$i]] != null){

            }*/
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
            $obj = $form->getData(); 
            if($name == "Team"){
                $file = $form->get('image_profil')->getData();
                $file->move('assets/images/upload', $file->getClientOriginalName());
                $obj->setImageProfil($file->getClientOriginalName());
                $objectMainRepo = $this->nameClass($name,"repository");
                $objectAll =$objectMainRepo->findAllPosition($obj->getPosition());
                foreach($objectAll as $object){
                    $object->setPosition($object->getPosition()+1);
                }
                $entityManager->flush();
               
            }
            elseif ($name == "Actualite" || $name == "Projet"){
                $file = $form->get('image')->getData();
                $file->move('assets/images/upload', $file->getClientOriginalName());
                $obj->setImage($file->getClientOriginalName());
            }
            $entityManager->persist($obj);
            $entityManager->flush();
            return $this->redirectToRoute("catAdmin", array(
                'name' => $name
            ));
        }
        return $this->render('admin/admin_add_object.html.twig', [
            'itemsMenu' => $this->itemsMenu,
            'name' => $name,
            'form' => $form->createView()

        ]
    );
        }
        else{
            return $this->render('admin/admin_add_object.html.twig', [
                    'itemsMenu' => $this->itemsMenu,
                    'name' => $name,
                    'form' => $form->createView(),
                    'edit' => false
                ]
            );
        }
    }
    /**
     *
     *
     * @Route("/admin/images/create/{name}/{id}", name="catAdminAddImg")
     */
    public function CatCmsAddImg(string $name,int $id ,Request $request) : Response
    {
     
        $entityManager = $this->getDoctrine()->getManager();
        $objectMain = $this->nameClass($name,"class");
        $objectMainRepo = $this->nameClass($name,"repository");
        $objectMain =$objectMainRepo->find($id);
        $object = new Image();
        $form = $this->createForm(ObjectAddType::class, (object)  $object ,  array(
            'attr' => array('class' => $name ,
                'object' => $object,
            )));
        if($_POST){
        
            /*for($i=0;$i<count($object->typeVars());$i++){
            if($tbl[$object->typeVars()[$i]] != null){

            }*/
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
            $obj = $form->getData(); 

                $file = $form->get('nom_img')->getData();
                $file->move('assets/images/upload', $file->getClientOriginalName());
                $obj->setNomImg($file->getClientOriginalName());
                $objectMain->addImages($obj);
              
            $entityManager->persist($obj);
            $entityManager->flush();
            return $this->redirectToRoute("catAdminImages", array(
                'name' => $name,
                'id' => $id
            ));
        }
        return $this->render('admin/admin_add_object_img.html.twig', [
            'itemsMenu' => $this->itemsMenu,
            'name' => $name,
            'form' => $form->createView(),
            'edit' => false,
            'id' => $id

        ]
    );
        }
        else{
            return $this->render('admin/admin_add_object_img.html.twig', [
                    'itemsMenu' => $this->itemsMenu,
                    'name' => $name,
                    'form' => $form->createView(),
                    'edit' => false,
                    'id' => $id
                ]
            );
        }
    }
    /**
     *
     *
     * @Route("/admin/update/{name}/{id}", name="catAdminUpdate")
     */
    public function CatCmsUpdate (string $name,int $id,Request $request):Response
    {   
   
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $this->nameClass($name,"repository");
        $object =$repository->find($id);
        $form = $this->createForm(ObjectAddType::class, $object,  array(
            'attr' => array('class' => $name ,
                'object' => $object,
            )));
        
            if($_POST){
     
                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {
              
                    if ($name == "Actualite" || $name == "Projet" ){
                        $file = $form->get('image')->getData();
                        if ($file != null){
                            $file->move('assets/images/upload', $file->getClientOriginalName());
                            $object->setImage($file->getClientOriginalName());
                        }else{
                            
                            $object->setImage($_POST["hintdata"]);
                        }                                  
                    }
                    else if($name == "Team"){
                        $file = $form->get('image_profil')->getData();
                        if ($file != null){
                        $file->move('assets/images/upload', $file->getClientOriginalName());
                        $object->setImageProfil($file->getClientOriginalName());
                        }else{
                            $object->setImageProfil($_POST["hintdata"]);
                        }
                        $objectAll =$repository->findAllPosition($object->getPosition());
                        foreach($objectAll as $object){
                            $object->setPosition($object->getPosition()+1);
                        }
                        $entityManager->flush();

                        
                    }
                $entityManager->flush();
                return $this->redirectToRoute("catAdmin", array(
                    'name' => $name
                ));
            }
        }
        if ($name == "Actualite" || $name == "Projet" ){
                 $hintdata=$object->getImage();                   
        }
        else if($name == "Team"){
                $hintdata=$object->getImageProfil();
            
        }
        else{
                $hintdata="";
        }
            return $this->render('admin/admin_add_object.html.twig', [
                'itemsMenu' => $this->itemsMenu,
                'hintdata' => $hintdata,
                'name' => $name,
                'form' => $form->createView(),
                'edit' => true,
                'id'   => $id

            ]
        );

    }
        /**
     *
     *
     * @Route("/admin/images/{name}/{id}", name="catAdminImages")
     */
    public function CatAdminImages (string $name,int $id,Request $request):Response
    {   
        $repository = $this->nameClass($name,"repository");
        $Objects = $repository->find($id);
        if($Objects == null){
            $listImg =$Objects;
        }else{
            $listImg=$Objects->getImages();
        }
        $obj = $this->nameClass($name,"class");
        $tbl_var[0] = "Image";
        return $this->render('admin/admin_tbl_view_img.html.twig', [
                'itemsMenu' => $this->itemsMenu,
                'objects' => $listImg,
                'tbl_var' => $tbl_var,
                'name' => $name,
                'id' =>$id
            ]
        );

    }
    /**
     *
     *
     * @Route("/admin/delete/{name}/{id}", name="catAdminDelete")
     */
    public function CatCmsDelete(string $name,int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $this->nameClass($name,"repository");
        $object =$repository->find($id);
     
        $entityManager->remove($object);
        $entityManager->flush();
        return $this->redirectToRoute("catAdmin", array(
            'name' => $name
        ));

    }
    /**
     *
     *
     * @Route("/admin/delete/image/{name}/{id}", name="catAdminDeleteImg")
     */
    public function CatCmsDeleteImg(string $name,int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $object =$this->imagerepository->find($id);
      
        if($name == "Projet"){
        $id = $object->getProjet()->getId();
        }else{
            $id = $object->getActualite()->getId();
        }
        $entityManager->remove($object);
        $entityManager->flush();
        return $this->redirectToRoute("catAdminImages", array(
            'name' => $name,
            'id' => $id
        ));

    }
    public function nameClass(string $name ,string $type,bool $form = false,EntityManagerInterface $entityManager = null){

     
        if($form){
            $orm = $entityManager;
        }else{
            $orm=$this->getDoctrine();
        }
  
        
        $name1 ='App\Entity\\'.$name;
        $obj =new $name1();
        $Repository = $name."repository";

        $repository = $this->{$Repository};
        $class = $obj;
        
        if($type == "repository"){
            return $repository;
        }else if ($type="class"){
            
            return $class;
        }
        
        else{
            
            return $class_v;
        }

    }




}