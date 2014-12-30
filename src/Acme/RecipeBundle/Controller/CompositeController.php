<?php

namespace Acme\RecipeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\RecipeBundle\Entity\Composite;
use Acme\RecipeBundle\Form\CompositeType;

/**
 * Composite controller.
 *
 * @Route("/composite")
 */
class CompositeController extends Controller
{

    /**
     * Lists all Composite entities.
     *
     * @Route("/", name="composite")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeRecipeBundle:Composite')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Composite entity.
     *
     * @Route("/", name="composite_create")
     * @Method("POST")
     * @Template("AcmeRecipeBundle:Composite:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Composite();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('composite_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Composite entity.
     *
     * @param Composite $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Composite $entity)
    {
        $form = $this->createForm(new CompositeType(), $entity, array(
            'action' => $this->generateUrl('composite_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Composite entity.
     *
     * @Route("/new", name="composite_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Composite();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Composite entity.
     *
     * @Route("/{id}", name="composite_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeRecipeBundle:Composite')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Composite entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Composite entity.
     *
     * @Route("/{id}/edit", name="composite_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeRecipeBundle:Composite')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Composite entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Composite entity.
    *
    * @param Composite $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Composite $entity)
    {
        $form = $this->createForm(new CompositeType(), $entity, array(
            'action' => $this->generateUrl('composite_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Composite entity.
     *
     * @Route("/{id}", name="composite_update")
     * @Method("PUT")
     * @Template("AcmeRecipeBundle:Composite:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeRecipeBundle:Composite')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Composite entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('composite_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Composite entity.
     *
     * @Route("/{id}", name="composite_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeRecipeBundle:Composite')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Composite entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('composite'));
    }

    /**
     * Creates a form to delete a Composite entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('composite_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
