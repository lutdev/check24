<?php
declare(strict_types=1);

namespace App\Controller;

use App\Application\Service\GetArticlesService;
use App\Controller\Transformer\ArticleTransformer;
use Twig\Environment;

class HomeController extends Controller
{
    public function __construct(
        private Environment $twig,
        private GetArticlesService $getArticlesService,
        private ArticleTransformer $articleTransformer,
    ) {
        parent::__construct($this->twig);
    }

    public function index():  string
    {
        $articles = $this->getArticlesService->process();

        $transformedArticles = $this->articleTransformer->transformAll($articles);

        return $this->view('home', [
            'articles' => $transformedArticles
        ]);
    }
}