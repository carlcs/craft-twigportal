<?php

namespace carlcs\twigportal\services;

use craft\base\Component;
use craft\helpers\ArrayHelper;

class Portal extends Component
{
    // Properties
    // =========================================================================

    private array $_portals = [];

    // Public Methods
    // =========================================================================

    public function registerSource(string $html, string $target, int $order = 0)
    {
        $this->_portals[$target][] = compact('html', 'order');
    }

    public function renderTargetTag(string $target): string
    {
        return "<div data-portal-target=\"$target\"></div>";
    }

    public function replaceTargetTags(string $html): string
    {
        return preg_replace_callback('/<div[\s\r\n]+data-portal-target="(\w+)"><\/div>/', function($matches) {
            if (($portal = $this->_portals[$matches[1]] ?? false) === false) {
                return '';
            }

            ArrayHelper::multisort($portal, 'order', SORT_ASC, SORT_NUMERIC);
            $rows = ArrayHelper::getColumn($portal, 'html');

            return implode("\n", $rows);
        }, $html);
    }
}
