<?php


namespace App\Form\AdminForm;

use App\Controller\admin\AdminController;
use App\Entity\BddCms;
use App\Entity\Credit;
use App\Entity\Taux;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ObjectAddType extends AbstractType
{
    private $nameOfClass;
    private  $object;
    public function __construct($nameOfClass = null,$object = null,EntityManagerInterface $entityManager)
    {
        $this->nameOfClass = $nameOfClass;
        $this->object=$object;
        $this->repository = $entityManager->getRepository(BddCms::class);
        $this->entityManager = $entityManager;
    }
    
        

    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $this->setNameOfClass($options['attr']['class']);
        $this->setObject($options['attr']['object']);

        $var=$this->object->typeVars();
        $namevar=$this->object->vars();
        for($i=0;$i<count($var);$i++){
            switch ($var[$i]) {
              case 'string':
                    $builder->add($namevar[$i],TextType::class,[

                        'required' => false,

                    ]);
                    break;
                case 'textarea':
                    $builder->add($namevar[$i],TextareaType::class,[

                        'required' => false,

                    ]);
                    break;
                case 'String':
                        $builder->add($namevar[$i],TextType::class,[

                            'required' => false,
    
                        ]);
                 break;
                case 'int' :
                    $builder->add($namevar[$i],IntegerType::class,[

                        'required' => false,

                    ]);
                    break;
                case 'file' :
                        $builder->add($namevar[$i],FileType::class, [
                            'mapped' => false,

                            'required' => false,
 
                        ]);
                    break;
                case 'num':
                    $builder->add($namevar[$i],NumberType::class,[

                        'required' => false,

                    ]);
                    break;
                case "email":
                    $builder->add("$namevar[$i]",EmailType::class,[

                        'required' => false,

                    ]);
                    break;
                case 'password':
                    $builder->add($namevar[$i],PasswordType::class,[

                        'required' => false,

                    ]);
                    break;
                case 'tel':
                    $builder->add($namevar[$i],TelType::class,[

                        'required' => false,

                    ]);
                    break;
                case 'date':
                    $builder->add($namevar[$i],DateType::class,[

                        'required' => false,

                    ]);
                    break;
                case 'datetime':
                    $builder->add($namevar[$i],DateTimeType::class,[

                        'required' => false,

                    ]);
                    break;
                case 'choice':
                   /* $builder->add($var[$i],*/
                    break;
                case 'float':
                     $builder->add($namevar[$i],NumberType::class,[

                        'required' => false,

                    ]);
                    break;
                case 'range':
                    $builder->add($namevar[$i],RangeType::class,[

                        'required' => false,

                    ]);
                    break;
                default :
                    $categorieCms = $this->repository->findAll();
                 
                    $contr = new AdminController($this->entityManager);
                    $repo=$contr->nameClass($var[$i],"repository",true,$this->entityManager);
                    $class_v=$contr->nameClass($var[$i],"class_v",true,$this->entityManager);
                    $liste = $repo->findAll();
                    $tbl=[];
                    for($o = 0 ; $o<count($liste) ; $o++){
                        $tbl[$o]=$liste[$o]->getNom();
                    }
                    if($var[$i]=="credit"){
                    $builder->add($namevar[$i], EntityType::class, [
                                'class' =>  Credit::class ,
                                "choices" => $liste,
                                'choice_label'  =>  function ($liste) {
                                    return $liste->getNom();
                                },
                                
                                
                            ]);}

                        
                    
               
                   

            }
        }
    }

    /**
     * @return mixed|null
     */
    public function getNameOfClass()
    {
        return $this->nameOfClass;
    }

    /**
     * @param mixed|null $nameOfClass
     */
    public function setNameOfClass($nameOfClass): void
    {
        $this->nameOfClass = $nameOfClass;
    }

    /**
     * @return mixed|null
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @param mixed|null $object
     */
    public function setObject($object): void
    {
        $this->object = $object;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        if($this->nameOfClass == "user"){
        $resolver->setDefaults([
            'data_class' => User::class,
            
        ]);
    }
    else if($this->nameOfClass == "credit"){
        $resolver->setDefaults([
            'data_class' => Credit::class,
            
        ]);
    }
    else if($this->nameOfClass == "taux"){
        $resolver->setDefaults([
            'data_class' => Taux::class,
            
        ]);
    }
    }

}