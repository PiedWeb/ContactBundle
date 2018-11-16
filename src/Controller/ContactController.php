<?php

namespace PiedWeb\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use PiedWeb\ContactBundle\Entity\Contact;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Translation\TranslatorInterface;

class ContactController extends AbstractController
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function getContactForm()
    {
        $contact = new Contact();

        if ($this->getUser()) {
            $contact = new Contact();
            $contact->setFr0m($this->getUser()->getEmail());
            $contact->setName($this->getUser()->getFirstname().' '.$this->getUser()->getLastname());
        }

        $form = $this->createFormBuilder($contact)
            ->setAction($this->generateUrl('piedweb_cms_contact'));
        if (!$this->getUser()) {
            $form->add('name');
            $form->add('fr0m', EmailType::class);
        }
        $form->add('message', TextareaType::class);

        return $form->getForm();
    }

    public function show(Request $request, ValidatorInterface $validator)
    {
        $form = $this->getContactForm();
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $this->sendMessage($form->getData());

                $form = $form->createView();

                return $this->render('@PiedWebCMS/component/_alert.html.twig', ['message' => $this->translator->trans('contact.send.success'), 'context' => 'success']);
            } else {
                $form = $form->createView();

                return $this->render('@PiedWebContact/contact/_form_contact.html.twig', ['contact' => $form]);
            }
        } else {
            $form = $form->createView();

            return $this->render('@PiedWebContact/contact/_contact.html.twig', ['contact' => $form]);
        }
    }

    protected function sendMessage(Contact $contact)
    {
        $message = (new \Swift_Message())
                ->setSubject($this->translator->trans('contact.send.prefix_subject').' '.$contact->getName())
                ->setFrom($this->container->getParameter('app.email.sender'))
                ->setReplyTo($contact->getFr0m())
                ->setTo($this->container->getParameter('app_contact_email'))
                ->setBody($this->renderView('@PiedWebContact/contact/sendmail.html.twig', ['message' => $contact->getMessage()]), 'text/html');
        $this->get('mailer')->send($message);

        return;
    }
}
