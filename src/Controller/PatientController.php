<?php

namespace App\Controller;

use App\Entity\Admission;
use App\Entity\Patient;
use App\Form\PatientType;
use App\Form\AdmissionType;
use App\Repository\PatientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
/**
 * @Route("/patient")
 */
class PatientController extends AbstractController
{
    /**
     * @Route("/", name="patient_index", methods={"GET"})
     */
    public function index(PatientRepository $patientRepository,Request $request): Response
    {
        $patient = new Patient();
        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($patient);
            $entityManager->flush();

            return $this->redirectToRoute('patient_index');
        }
        return $this->render('patient/index.html.twig', [
            'patients' => $patientRepository->findAll(),
            'patient' => $patient,
            'formPatient' => $form->createView(),
        ]);

        
    }

    /**
     * @Route("/new", name="patient_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $patient = new Patient();
        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($patient);
            $entityManager->flush();

            return $this->redirectToRoute('patient_index');
        }

        return $this->render('patient/new.html.twig', [
            'patient' => $patient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="patient_show",  methods={"GET","POST"})
     */
    public function show(Patient $patient,Request $request, EntityManagerInterface $manager): Response
    {
        $admission = new Admission();
        $admission->setPatient($patient);
        $admissionForm = $this->createForm(AdmissionType::class, $admission);
        $admissionForm->handleRequest($request);


        if ($admissionForm->isSubmitted() && $admissionForm->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($admission);
            $manager->flush();

            return $this->redirectToRoute('admission_index');

        }
        


        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('patient_index');
            
        }

        return $this->render('patient/show.html.twig', [
            'admission' => $admission,
            'createAdmission' => $admissionForm->createView(),
            'patient' => $patient,
            'formEdition' => $form->createView(),
        ]);


    }

    /**
     * @Route("/{id}/edit", name="patient_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Patient $patient): Response
    {
        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('patient_index');
            
        }

        return $this->render('patient/edit.html.twig', [
            'patient' => $patient,
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/{id}", name="patient_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Patient $patient): Response
    {
        if ($this->isCsrfTokenValid('delete'.$patient->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($patient);
            $entityManager->flush();
        }

        return $this->redirectToRoute('patient_index');
    }
}
