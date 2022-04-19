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
    public function init()
    {
        parent::init();

        $this->setComponents([
            'portal' => Portal::class,
        ]);

        Craft::$app->getView()->registerTwigExtension(new Extension());

        Event::on(View::class, View::EVENT_AFTER_RENDER_PAGE_TEMPLATE, function(TemplateEvent $event) {
            $event->output = $this->getPortal()->replaceTargetTags($event->output);
        }, null, false);
    }

    public function getPortal(): Portal
    {
        return $this->get('portal');
    }
}
