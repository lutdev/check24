<?php
declare(strict_types=1);

namespace App\Controller\Transformer;

use App\Domain\Entity\Article;
use JetBrains\PhpStorm\ArrayShape;

class ArticleTransformer
{
    #[ArrayShape(['id' => "int"])]
    public function transform(Article $article): array
    {
        return [
            'id' => $article->getId()
        ];
    }

    /**
     * @param Article[] $articles
     * @return array
     */
    public function transformAll(array $articles): array
    {
        return \array_map(
            fn(Article $article) => $this->transform($article),
            $articles
        );
    }
}