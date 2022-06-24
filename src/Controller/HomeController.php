<?php
declare(strict_types=1);

namespace App\Controller;

use App\Application\Service\GetArticlesService;
use App\Controller\Transformer\ArticleTransformer;

class HomeController extends Controller
{
    //I want to use DI, but I need more time to configure this
    public function __construct(
        //private GetArticlesService $getArticlesService,
    ) {
    }

    public function index():  string
    {
        $articles = (new GetArticlesService($this->getEntityManager()))
            ->process();

        $transformedArticles = (new ArticleTransformer())->transformAll($articles);

        return $this->view('home', [
            'articles' => $transformedArticles
        ]);
    }
}