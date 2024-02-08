> [!WARNING]  
> **This plugin has been abandoned.** With the release of Craft 4.5, the [`_globals`](https://craftcms.com/docs/4.x/dev/global-variables.html#globals) Twig variable has been added, rendering this plugin obsolete. The functionality it provided can now be achieved using the new variable.

# Twig Portal plugin for Craft CMS

Adds a portal tag to Twig, to render DOM anywhere in the document.

## Installation

Twig Portal is available in the Plugin Store. You can also install the plugin manually from the command line with the following commands.

```
composer require carlcs/craft-twigportal
php craft plugin/install twig-portal
```

## Usage

_layout.html

```twig
<body>
    {% block content %}
    {% endblock %}

    {{ portalTarget('modals') }}
</body>
```

index.html

```twig
{% extends '_layout' %}

{% block content %}
    {{ include('_component') }}
{% endblock %}
```

_component.html

```twig
{% portal 'modals' %}
    <p>This will be rendered where the “modals” portal target function is located.</p>
{% endportal %}
```

## License

[MIT](LICENSE.md)
