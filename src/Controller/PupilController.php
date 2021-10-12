<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PupilRepository;

class PupilController extends AbstractController
{

    use \App\Util\ApiTrait;

    /**
     * @Route("/api/pupils/{classSymbol}/{languageGroup}", name="get_pupils", methods={"GET"})
     */
    public function getPupils(PupilRepository $pupilRepository, string $classSymbol, string $languageGroup = null): Response
    {
        if ( is_null($languageGroup) ) {
            $pupils = $pupilRepository->findByClassAssigned($classSymbol);
            if (count($pupils) > 0) {
                return $this->getActionSuccess(Response::HTTP_OK, $pupils);
            }
            return $this->getActionFailure(Response::HTTP_NOT_FOUND, "Brak klasy o podanym symbolu.");
        }
        $pupils = $pupilRepository->findByClassAndLaguageGroup($classSymbol, $languageGroup);
        if (count($pupils) > 0) {
            return $this->getActionSuccess(Response::HTTP_OK, $pupils);
        }
        return $this->getActionFailure(Response::HTTP_NOT_FOUND, "Brak klasy o podanym symbolu lub niewlasciwy symbol grupy jezykowej.");
    }
}
