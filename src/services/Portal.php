<?php

namespace carlcs\twigportal\services;

use craft\base\Component;
use craft\helpers\StringHelper;

class Portal extends Component
{
    // Properties
    // =========================================================================

    /**
     * @var array
     */
    private $_portals = [];

    // Public Methods
    // =========================================================================

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
    public function renderTargetComment(string $target): string
    {
        return "<!-- portal-target: {$target} -->";
    }

    /**
     * @param string $html
     * @return string
     */
    public function replaceTargetComments(string $html): string
    {
        return preg_replace_callback('/<\!-- portal-target: (\w+) -->/', function($matches) {
            if (!isset($this->_portals[$matches[1]])) {
                return '';
            }

            return implode("\n", $this->_portals[$matches[1]]);
        }, $html);
    }
}
