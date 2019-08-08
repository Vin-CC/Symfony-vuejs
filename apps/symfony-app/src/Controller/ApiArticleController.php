<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\ArticleService;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class ApiPostController
 * @package App\Controller
 */
final class ApiArticleController  extends AbstractFOSRestController
{

    /** @var SerializerInterface */
    private $serializer;

    /** @var ArticleService */
    private $articleService;

    /** @var ArticleRepository */
    private $repository;

    /**
     * ApiPostController constructor.
     * @param SerializerInterface $serializer
     * @param ArticleService $articleService
     */
    public function __construct(SerializerInterface $serializer, ArticleService $articleService, ArticleRepository $repository)
    {
        $this->serializer = $serializer;
        $this->articleService = $articleService;
        $this->repository = $repository;
    }

    /**
     * @Rest\Get("/api/articles", name="getAllArticles")
     * @return JsonResponse
     */
    public function getAllArticles(PaginatorInterface $paginator, Request $request): JsonResponse
    {
        $articleEntities = $paginator->paginate(
            $this->repository->findAllQuery(),
            $request->query->getInt('page', 1),
            4
        );
        
        $data = $this->serializer->serialize($articleEntities, 'json');

        return new JsonResponse($data, 200, [], true);
    }

    /**
     * @Rest\Get("/api/articles/{id}", name="getArticleById")
     * @return JsonResponse
     */
    public function getArticleById($id): JsonResponse
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        if ($article) {
            $data = $this->serializer->serialize($article, 'json');
            return new JsonResponse($data, 200, [], true);
        } else {
            throw new NotFoundHttpException(sprintf("Article with id '%s' could not be found.", $id));
        }
    }

    /**
     * @Rest\Post("api/articles", name="createArticle")
     * @param Request $request
     * @return JsonResponse
     * @ParamConverter("article", converter="fos_rest.request_body")
     */
    public function createArticle(Article $article): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();

        $articleEntity = new Article();
        $articleEntity->setTitle($article->getTitle());
        $articleEntity->setDescription($article->getDescription());
        $articleEntity->setAutor($article->getAutor());
        $articleEntity->setModification($article->getModification());
        $entityManager->persist($articleEntity);
        $entityManager->flush();

        $data = $this->serializer->serialize($articleEntity, 'json');

        return new JsonResponse($data, 200, [], true);
    }

    /**
     * @Rest\Post("/api/articles/{id}", name="updateArticle")
     * @param Request $request
     * @return JsonResponse
     * @ParamConverter("article", converter="fos_rest.request_body")
     */
    public function updateArticle($id, Article $article): JsonResponse
    {

        $entityManager = $this->getDoctrine()->getManager();
        $articleToUpdate = $entityManager->getRepository(Article::class)->find($id);

        if (!$articleToUpdate) {
            throw new NotFoundHttpException(sprintf("Article with id '%s' could not be found.", $id));
        }

        $articleToUpdate->setTitle($article->getTitle());
        $articleToUpdate->setDescription($article->getDescription());
        $articleToUpdate->setAutor($article->getAutor());
        $articleToUpdate->setModification($article->getModification());
        $entityManager->flush();

        $data = $this->serializer->serialize($articleToUpdate, 'json');

        return new JsonResponse($data, 200, [], true);
    }
}
