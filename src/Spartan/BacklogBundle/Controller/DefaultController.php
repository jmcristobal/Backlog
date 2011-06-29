<?php

namespace Spartan\BacklogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Spartan\BacklogBundle\Document\Item;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        $item = new Item();
		$item->setName($name);
		$item->setStatus(false);
		
		$dm = $this->get('doctrine.odm.mongodb.document_manager');
		$dm->persist($item);
		$dm->flush();
		
		return array('name' => $name);
    }

    /**
     * @Route("/new/{name}")
     * @Template()
     */
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
}
