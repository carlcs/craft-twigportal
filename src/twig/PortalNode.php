<?php

namespace carlcs\twigportal\twig;

use carlcs\twigportal\Plugin;
use Twig\Compiler;
use Twig\Node\Node;

class PortalNode extends Node
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function compile(Compiler $compiler)
    {
        $key = $this->hasNode('key') ? $this->getNode('key') : null;

        $compiler
            ->addDebugInfo($this)
            ->write("ob_start();\n")
            ->subcompile($this->getNode('body'))
            ->write(Plugin::class . '::getInstance()->getPortal()->registerSource(ob_get_clean(), ')
            ->subcompile($this->getNode('target'));

        if ($key) {
            $compiler
                ->write(', ')
                ->subcompile($key);
        }

        $compiler
            ->write(");\n");
    }
}
