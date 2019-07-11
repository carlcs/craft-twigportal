<?php

namespace carlcs\twigportal\services;

use craft\base\Component;
use craft\helpers\StringHelper;

class Portal extends Component
{
    /**
     * @var array
     */
    private $_portals = [];

    /**
     * @param string $html
     * @param string $target
     * @param string|null $key
     */
    public function registerSource(string $html, string $target, string $key = null)
    {
        $key = $key ?: StringHelper::randomString(8);
        $this->_portals[$target][$key] = $html;
    }

    /**
     * @param string $target
     * @return string
     */
    public function renderTarget(string $target): string
    {
        if (!isset($this->_portals[$target])) {
            return '';
        }

        return implode("\n", $this->_portals[$target]);
    }
}
