<?php

namespace App\Controller;

use App\Entity\Project;
use App\Service\FileTreaterFineUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PagesController extends AbstractController
{
	/**
	 * @Route("/", name="index")
	 */
	public function index()
	{
		return $this->render("pages/index.html.twig");
	}

    /**
     * @Route("/commandes", name="orders")
     */
    public function orders()
    {
        return $this->render("pages/orders.html.twig");
    }
}