<?php

namespace App\Controller;

use App\Entity\Attendance;
use App\Form\AttendanceType;
use App\Repository\AttendanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/attendance")
 */
class AttendanceController extends AbstractController
{
    /**
     * @Route("/", name="app_attendance_index", methods={"GET"})
     */
    public function index(AttendanceRepository $attendanceRepository): Response
    {
        return $this->render('attendance/index.html.twig', [
            'attendances' => $attendanceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_attendance_new", methods={"GET", "POST"})
     */
    public function new(Request $request, AttendanceRepository $attendanceRepository): Response
    {
        $attendance = new Attendance();
        $form = $this->createForm(AttendanceType::class, $attendance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $attendanceRepository->add($attendance, true);

            return $this->redirectToRoute('app_attendance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('attendance/new.html.twig', [
            'attendance' => $attendance,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_attendance_show", methods={"GET"})
     */
    public function show(Attendance $attendance): Response
    {
        return $this->render('attendance/show.html.twig', [
            'attendance' => $attendance,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_attendance_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Attendance $attendance, AttendanceRepository $attendanceRepository): Response
    {
        $form = $this->createForm(Attendance1Type::class, $attendance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $attendanceRepository->add($attendance, true);

            return $this->redirectToRoute('app_attendance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('attendance/edit.html.twig', [
            'attendance' => $attendance,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_attendance_delete", methods={"POST"})
     */
    public function delete(Request $request, Attendance $attendance, AttendanceRepository $attendanceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$attendance->getId(), $request->request->get('_token'))) {
            $attendanceRepository->remove($attendance, true);
        }

        return $this->redirectToRoute('app_attendance_index', [], Response::HTTP_SEE_OTHER);
    }
}
