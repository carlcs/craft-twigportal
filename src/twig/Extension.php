<?php

namespace carlcs\twigportal\twig;

use carlcs\twigportal\Plugin;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class Extension extends AbstractExtension
{
    /**
     * @inheritdoc
     */
    public function getTokenParsers(): array
    {
        return [
            new PortalTokenParser(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getFunctions(): array
    {
        $portal = Plugin::getInstance()->getPortal();

        return [
            new TwigFunction('portal', [$portal, 'registerSource']),
            new TwigFunction('portalTarget', [$portal, 'renderTarget'], ['is_safe' => ['html']]),
        ];
    }


}
