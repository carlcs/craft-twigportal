<?php

namespace carlcs\twigportal\twig;

use carlcs\twigportal\Plugin;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class Extension extends AbstractExtension
{
    // Public Methods
    // =========================================================================

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
            new TwigFunction('portalTarget', [$portal, 'renderTargetComment'], ['is_safe' => ['html']]),
        ];
    }
}
