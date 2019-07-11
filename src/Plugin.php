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

        $this->_registerCraftEventHandlers();
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

    // Private Methods
    // =========================================================================

    /**
     * Registers event handlers.
     */
    private function _registerCraftEventHandlers()
    {
        Event::on(View::class, View::EVENT_AFTER_RENDER_PAGE_TEMPLATE, function (TemplateEvent $event) {
            $event->output = $this->getPortal()->replaceTargetComments($event->output);
        });
    }
}
