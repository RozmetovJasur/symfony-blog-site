<?php
/**
 *
 * Created by PhpStorm.
 * User: Rozmetov Jasur ( @rozmetovjasur )
 * Date: 03/08/21
 * Time: 10:43
 */

namespace App\Controller;

use App\Entity\Payment;
use App\Form\PaymentType;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractFOSRestController
{
    /**
     * @return Response
     * @Route("/payments", name="payment_list")
     */
    public function list(): Response
    {
        return $this->render('payments/list.twig',[
            'list' => ['1','2']
        ]);
    }

    /**
     * @param Request $request
     * @param FormFactoryInterface $formFactory
     * @param EntityManagerInterface $entityManager
     * @return Response
     *
     * @Route("payments/create", name="payment_create")
     */
    public function create(Request $request, FormFactoryInterface $formFactory, EntityManagerInterface $entityManager): Response
    {
        $payment = new Payment();
        $form = $formFactory
            ->createNamed('', PaymentType::class, $payment, [
                'method' => 'post'
            ])
            ->add('submit', SubmitType::class)
            ->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($payment);
//            $form->get('note')->getData();
            $entityManager->flush();
            return $this->redirectToRoute('payment_list');
        }
        return $this->render('payments/create.twig', [
            'form' => $form->createView()
        ]);
    }
}