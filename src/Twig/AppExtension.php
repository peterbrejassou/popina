<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('prix', [$this, 'formatPrix']),
        ];
    }

    public function formatPrix($prix)
    {
        return number_format($prix, 2) . '€';
    }
}