<?php

namespace App\Controller;

use App\Entity\Project;
use App\Service\FileTreaterFineUploader;
use Doctrine\ORM\EntityManagerInterface;
use Swift_Mailer;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PagesController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @Route("/commandes", name="orders")
     * @param Request $request
     * @param FileTreaterFineUploader $fine_uploader
     * @return Response
     */
	public function index(Request $request, FileTreaterFineUploader $fine_uploader)
	{
	    $route = $request->get("_route");
	    $template = $route === "index" ? "pages/index.html.twig" : "pages/orders.html.twig";
	    $type = $route === "index" ? Project::TYPE_PROJECT : Project::TYPE_ORDER;
        $projects = $this->getDoctrine()->getManager()->getRepository(Project::class)->findBy([
            "state" => Project::PUBLISHED,
            "type" => $type
        ]);

        $images = [];
        foreach ($projects as $project) {
            $image = null;

            if ($project->getImagesDir() !== null) {
                $image = json_decode($fine_uploader->getImagesDisplayed($project->getImagesDir())->getContent());
                $images[$project->getId()] = $image[0]->thumbnailUrl;
            }
        }

		return $this->render($template, [
            "projects" => $projects,
            "images" => $images
        ]);
	}

    /**
     * @Route("/projet/{id}", name="project")
     * @param EntityManagerInterface $em
     * @param FileTreaterFineUploader $fine_uploader
     * @param int $id
     * @return Response
     */
    public function project(EntityManagerInterface $em, FileTreaterFineUploader $fine_uploader, int $id)
    {
        $project = $em->getRepository(Project::class)->find($id);
        $image = null;

        if ($project->getImagesDir() !== null) {
            $image = json_decode($fine_uploader->getImagesDisplayed($project->getImagesDir())->getContent());
        }

        return $this->render("pages/project.html.twig", [
            "project" => $project,
            "images" => $image
        ]);
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
        $message = "<h2> Message de la part de  : " . $request->get("firstname") . " " . $request->get("lastname") . "</h2><br><br>";

        $mail = $message . $request->get("message");

        $message = (new Swift_Message("Message de lorrainelonguet.fr, sujet : " . $request->get("object")))
            ->setFrom("no-reply@anthony-pilloud.fr")
            ->setReplyTo($request->get("email"))
            ->setTo("pilloud.anthony@gmail.com")
            ->setBody($mail, "text/html");

        $mailer->send($message);
        $this->addFlash("success", "Votre message a été envoyé");

        return $this->redirectToRoute("contact");
    }
}
