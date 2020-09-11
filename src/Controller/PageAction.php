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

use App\Template\TemplateHandlerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Error\LoaderError;

final class PageAction extends AbstractController
{
    /** @var TemplateHandlerInterface */
    private $templateHandler;

    public function __construct(TemplateHandlerInterface $templateHandler)
    {
        $this->templateHandler = $templateHandler;
    }

    /**
     * @Route("{slug}", name="page_show", requirements={"slug"="docs/.+"}, priority=-999)
     */
    public function __invoke(string $slug = 'index'): Response
    {
        if (false !== strpos($slug, '.md')) {
            return $this->redirectToRoute('page_show', ['slug' => rtrim($slug, '.md')]);
        }

        try {
            return $this->render('page/show.html.twig', [
                'slug' => $slug,
                'template' => $this->templateHandler->getTemplatePath($slug),
            ]);
        } catch (LoaderError $exception) {
            throw new NotFoundHttpException($exception->getMessage());
        }
    }
}
