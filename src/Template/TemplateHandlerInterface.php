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

namespace App\Template;

interface TemplateHandlerInterface
{
    public function getTemplatePath($slug): ?string;

    public function getTemplateAbsolutePath($slug): ?string;
}
