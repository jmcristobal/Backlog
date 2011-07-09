<?php

namespace Spartan\BacklogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Spartan\BacklogBundle\Document\Item;
use Spartan\BacklogBundle\Form\ItemType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ItemController extends Controller
{

    /**
     * @Route("/item")
     * @Template()
     */
/*
	public function newAction($name)
	{
        $item = new Item();
		$item->setName($name);
		$item->setStatus(false);
		
		$dm = $this->get('doctrine.odm.mongodb.document_manager');
		$dm->persist($item);
		$dm->flush();
				
		return array('name' => $name);
	}
	*/
	
   /**
     * @Route("/item", name="_item_new")
     * @Template()
     */
	public function newAction()
	{
		$form = $this->get('form.factory')->create(new ItemType());
		$request = $this->get('request');
        if ('POST' == $request->getMethod()) {
            $form->bindRequest($request);
            if ($form->isValid()) {
        		$item = new Item();
				$item->setName("created");
				$item->setStatus(false);
		
				$dm = $this->get('doctrine.odm.mongodb.document_manager');
				$dm->persist($item);
				$dm->flush();
                $this->get('session')->setFlash('notice', 'Item created');

                //return new RedirectResponse($this->generateUrl('_item_list'));
            }
        }		
		return array('form' => $form->createView());
	}	
	
    /**
     * @Route("/items", name="_item_list")
     * @Template()
     */
	public function listAction()
	{
		$dm = $this->get('doctrine.odm.mongodb.document_manager');
		$repository = $dm->getRepository('SpartanBacklogBundle:Item');
		$items = $repository->findAll();
		return array('items' => $items);
	}
}
