<?php

namespace Acme\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\StoreBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller {

    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name) {
        return array('name' => $name);
    }

    /**
     * @Route("/create")
     * @Template()
     */
    public function createAction() {
        //die('FD');
        $product = new Product();
        $product->setName('A Foo Bar');
        $product->setPrice('19.99');
        $product->setDescription('Lorem ipsum dolor');
        $product->setDescription2('Lorem ipsum dolor222');

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($product);
        $em->flush();

        return new Response('Created product id ' . $product->getId());
    }
    
    /**
     * @Route("/add")
     * @Template()
     */
    public function addAction(){
        $product = new Product();
        $form = $this->createForm($product)
                ->add('name')
//                ->add('price')
//                ->add('description')
//                ->add('category')
                ->getForm();
        
        return $this->render('AcmeStoreBundle:Default:add.html.twig', array('form' =>  $form->createView(),));
    }

    /**
     * @Route("/show/{id}")
     * @Template()
     */
    public function showAction($id) {
        
       /* $repository = $this->getDoctrine()
                ->getRepository('AcmeStoreBundle:Product');
        */
        $product = $this->getDoctrine()
                ->getRepository('AcmeStoreBundle:Product')
                ->findAll();
                //->find($id);

        if (!$product) {
            throw $this->createNotFoundException('No product found for id ' . $id);
        }
        
      /*  $query = $repository->createQueryBuilder('p')
                ->from()
                ->where('p.id = :id')
                ->setParameter('id', $id)
                ->rightJoin()
                ->getQuery();
        $result = $query->getArrayResult();
        */
         //$category = $product->getCategory();
        
         return $this->render('AcmeStoreBundle:Default:index.html.twig', array('products' => $product));
         
        //die(var_dump($product->toArray()));
        //
        // делает что-нибудь, например передаёт объект $product в шаблон
    }

}
