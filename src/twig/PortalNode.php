<?php

namespace carlcs\twigportal\twig;

use carlcs\twigportal\Plugin;
use Twig\Compiler;
use Twig\Node\Node;
use Twig\Node\NodeCaptureInterface;

class PortalNode extends Node implements NodeCaptureInterface
{
    public function compile(Compiler $compiler)
    {
        $order = $this->hasNode('order') ? $this->getNode('order') : null;

        $compiler
            ->addDebugInfo($this)
            ->write("ob_start();\n")
            ->subcompile($this->getNode('body'))
            ->write(Plugin::class . '::getInstance()->getPortal()->registerSource(ob_get_clean(), ')
            ->subcompile($this->getNode('target'));

        if ($order) {
            $compiler
                ->write(', ')
                ->subcompile($order);
        }

        $compiler
            ->write(");\n");
    }
}
