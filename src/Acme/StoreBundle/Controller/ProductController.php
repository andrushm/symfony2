<?php

namespace Acme\StoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\StoreBundle\Entity\Product;
use Acme\StoreBundle\Form\ProductType;
use Acme\StoreBundle\Entity\Category;
use Doctrine\Common\Collections\Criteria;

/**
 * Product controller.
 *
 * @Route("/product")
 */
class ProductController extends Controller {

    /**
     * Lists all Product entities.
     *
     * @Route("/", name="product")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeStoreBundle:Product')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Product entity.
     *
     * @Route("/", name="product_create")
     * @Method("POST")
     * @Template("AcmeStoreBundle:Product:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Product();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('product')); // array('id' => $entity->getId()
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Product entity.
     *
     * @param Product $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Product $entity) {
        $form = $this->createForm(new ProductType(), $entity, array(
            'action' => $this->generateUrl('product_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Product entity.
     *
     * @Route("/new", name="product_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction() {
        $entity = new Product();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

   

     /**
     * @Route("/list", name="product_list")
     * @Template()
     */
    public function listAction(Request $request) {
    
        $get = $request->query->all();
        
        $columns = array('id', 'name', 'price', 'description', 'description2', 'category');
        $get['columns'] = &$columns;
//        var_dump($get);
//        exit;
        
        $em = $this->getDoctrine()->getEntityManager();
        //$rResult = $em->getRepository('AcmeStoreBundle:Product')->findAjaxTable($get, true)->getArrayResult();
        $orderCol = (int)$get['order'][0]['column'];
        $orderDir = $get['order'][0]['dir'];
        $rResult = $em->getRepository('AcmeStoreBundle:Product')->findBy(array(), array($get['columns'][$orderCol] => $orderDir), (int)$get['length'],(int)$get['start']);
       
        $iFilteredTotal = count($rResult);
        $recordsTotal = $em->getRepository('AcmeStoreBundle:Product')->getCount();
        /*
         * Output
         */
        $output = array(
           // "sEcho" => intval($get['sEcho']),
            "draw" => $get['draw'] + 1,
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsTotal,
            "aaData" => array()
        );

        $count = count($columns);
        foreach ($rResult as $aRow) {
            $row[] = $aRow->getId();
            $row[] = $aRow->getName();
            $row[] = $aRow->getPrice();
            $row[] = $aRow->getDescription();
            $row[] = $aRow->getDescription2();
            $row[] = $aRow->getCategory()->getName();
            $row[] = '<a class="edit" id="edit_id_' .$aRow->getId(). '" href="">Edit</a> <a class="show" id="show_id_' .$aRow->getId(). '" href="">Show</a>';
            
//            echo $aRow->getId().':'; 
//            $row = array();
//            for ($i = 0; $i < $count; $i++) {
//                $row[] = $aRow->getCategory()->getName();
//                if ($columns[$i] == "version") { 
//                    /* Special output formatting for 'version' column */
//                   $row[] = ($aRow[$columns[$i]] == "0") ? '-' : $aRow[$columns[$i]];
//                } elseif ($columns[$i] != ' ') {
//                    /* General output */
//                    $row[] = $aRow[$columns[$i]];
//                }
//            }
            $output['aaData'][] = $row;
            unset($row);
        }
       

        unset($rResult);

        return new Response(
                json_encode($output)
        );
    }

     /**
     * Finds and displays a Product entity.
     *
     * @Route("/{id}", name="product_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeStoreBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }
    
    /**
     * Displays a form to edit an existing Product entity.
     *
     * @Route("/{id}/edit", name="product_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeStoreBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Creates a form to edit a Product entity.
     *
     * @param Product $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Product $entity) {
        $form = $this->createForm(new ProductType(), $entity, array(
            'action' => $this->generateUrl('product_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array('id' => 'form_update'),
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Product entity.
     *
     * @Route("/{id}", name="product_update")
     * @Method("PUT")
     * @Template("AcmeStoreBundle:Product:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
//var_dump($request); exit;
        $entity = $em->getRepository('AcmeStoreBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        
        if ($editForm->isValid()) {
            $em->flush();
            //var_dump(1); exit;
            return $this->redirect($this->generateUrl('product'));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Product entity.
     *
     * @Route("/{id}", name="product_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);
        var_dump($request); exit;
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeStoreBundle:Product')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Product entity.');
            }

           // $em->remove($entity);
          //  $em->flush();
        }

        return 1; //$this->redirect($this->generateUrl('product'));
    }

    /**
     * Creates a form to delete a Product entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder(null,  ['attr' => ['id' => 'form_delete']])
                        ->setAction($this->generateUrl('product_delete', array('id' => $id)))
                        ->setMethod('DELETE')                    
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm();
    }

   
}
