<?php

/*
 * This file is part of markdown-docs.
 *
 * (c) Mobizel
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class SearchAction extends AbstractController
{
    /** @var string */
    private $templateDir;

    public function __construct(string $templateDir)
    {
        $this->templateDir = $templateDir;
    }

    /**
     * @Route("search", name="search", requirements={"query"=".+"})
     */
    public function __invoke(Request $request): Response
    {
        $query = $request->get('query', '');

        $finder = new Finder();
        $finder->files()->in($this->templateDir.'/docs')->contains($query);

        return $this->render('search/index.html.twig', [
            'files' => $finder,
        ]);
    }
}
