<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TeacherRepository;

class TeacherController extends AbstractController
{

    use \App\Util\ApiTrait;

    /**
     * @Route("/api/tutors", name="get_tutors", methods={"GET"})
     */
    public function getTutors(TeacherRepository $teacherRepository): Response
    {
        $tutors = $teacherRepository->findTutors();
        if (count($tutors) > 0) {
            return $this->getActionSuccess(Response::HTTP_OK, $tutors);
        }
        return $this->getActionFailure(Response::HTTP_NOT_FOUND, "W bazie danych brak informacji o wychowacach.");
    }
}
