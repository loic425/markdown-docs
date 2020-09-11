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

namespace App\Twig\Extension;

use App\Template\TemplateHandlerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class PageTitleExtension extends AbstractExtension
{
    /** @var TemplateHandlerInterface */
    private $templateHandler;

    public function __construct(TemplateHandlerInterface $templateHandler)
    {
        $this->templateHandler = $templateHandler;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('page_title', [$this, 'pageTitle']),
        ];
    }

    public function pageTitle(string $slug): string
    {
        $path = $this->templateHandler->getTemplateAbsolutePath($slug);
        $line = $this->getFirstLine($path);

        if (false === strpos($line, '# ')) {
            return $this->getDefaultTitle($slug);
        }

        return ltrim($line, '# ');
    }

    private function getFirstLine(string $path): string
    {
        $resource = fopen($path, 'r');
        $line = fgets($resource);
        fclose($resource);

        return $line;
    }

    private function getDefaultTitle($slug): string
    {
        $parts = explode('/', $slug);

        return ucfirst(end($parts));
    }
}
