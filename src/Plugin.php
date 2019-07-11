<?php

namespace carlcs\twigportal;

use carlcs\twigportal\services\Portal;
use carlcs\twigportal\twig\Extension;
use Craft;
use craft\events\TemplateEvent;
use craft\web\View;
use yii\base\Event;

/**
 * @property Portal $portal
 * @method static Plugin getInstance()
 */
class Plugin extends \craft\base\Plugin
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->setComponents([
            'portal' => Portal::class,
        ]);

        $view = Craft::$app->getView();
        $view->registerTwigExtension(new Extension());
    }

    /**
     * Returns the portal service.
     *
     * @return Portal
     */
    public function getPortal(): Portal
    {
        return $this->get('portal');
    }
}
