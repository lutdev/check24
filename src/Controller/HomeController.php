<?php
declare(strict_types=1);

namespace App\Controller;

use App\Application\Service\GetArticlesService;
use App\Configuration\Request;
use App\Controller\Transformer\ArticleTransformer;
use Twig\Environment;

class HomeController extends Controller
{
    //request and twig should not be here. I want to update my code and delete it from here. I need more time
    public function __construct(
        public Request $request,
        private Environment $twig,
        private GetArticlesService $getArticlesService,
        private ArticleTransformer $articleTransformer,
    ) {
        parent::__construct($this->request, $this->twig);
    }

    public function index(): string
    {
        $articles = $this->getArticlesService->process();

        $transformedArticles = $this->articleTransformer->transformAll($articles);

        return $this->view('home', [
            'articles' => $transformedArticles,
            'isUserLogged' => $this->isUserLogged()
        ]);
    }
}