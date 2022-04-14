<?php

namespace carlcs\twigportal\twig;

use carlcs\twigportal\Plugin;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class Extension extends AbstractExtension
{
    public function getTokenParsers(): array
    {
        return [
            new PortalTokenParser(),
        ];
    }

    public function getFunctions(): array
    {
        $portal = Plugin::getInstance()->getPortal();

        return [
            new TwigFunction('portalTarget', [$portal, 'renderTargetComment'], ['is_safe' => ['html']]),
        ];
    }
}
