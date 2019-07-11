# Twig Portal plugin for Craft CMS

Adds a portal tag to Twig, to render DOM anywhere in the document.

## Installation

The plugin is in beta right now. You can install it manually from the command line with the following commands.

```
> composer require carlcs/craft-twigportal:^1.0.0-beta.1
> ./craft install/plugin twig-portal
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
