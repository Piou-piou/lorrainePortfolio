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
     * @Route("/projet", name="project")
     */
    public function project()
    {
        return $this->render("pages/project.html.twig");
    }

    /**
     * @Route("/commandes", name="orders")
     */
    public function orders()
    {
        return $this->render("pages/orders.html.twig");
    }

    /**
     * @Route("/a-propos", name="about")
     */
    public function about()
    {
        return $this->render("pages/about.html.twig");
    }
}