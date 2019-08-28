<?php

namespace App\Controller;

use App\Entity\Project;
use App\Service\FileTreaterFineUploader;
use Swift_Mailer;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render("pages/contact.html.twig");
    }

    /**
     * @Route("/contact/send", name="contact_send")
     * @param Request $request
     * @param Swift_Mailer $mailer
     * @return RedirectResponse
     */
    public function sendForm(Request $request, Swift_Mailer $mailer): RedirectResponse
    {
        $message = "<h2> Message de la part de  :" . $request->get("firstname") . " " . $request->get("lastname") . "</h2><br><br>";

        $mail = $message . $request->get("message");

        $message = (new Swift_Message("Message de lorrainelonguet.fr, sujet : " . $request->get("object")))
            ->setFrom("no-reply@anthony-pilloud.fr")
            ->setReplyTo($request->get("email"))
            ->setTo("pilloud.anthony@gmail.comn@gmail.com")
            ->setBody($mail, "text/html");

        $mailer->send($message);
        $this->addFlash("success", "Votre message a été envoyé");

        return $this->redirectToRoute("contact");
    }
}
