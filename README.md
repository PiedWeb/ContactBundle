<p align="center"><a href="https://piedweb.com">
<img src="https://raw.githubusercontent.com/PiedWeb/piedweb-devoluix-theme/master/src/img/logo_title.png" width="200" height="200" alt="theme devoluix bootstrap 4" />
</a></p>

# Contact Bundle

Add a contact form via fetch (ajax) to your app.

Initially dev to be use with [PiedWeb CMS](https://github.com/PiedWeb/CMS).

<p align="center"><img src="https://raw.githubusercontent.com/PiedWeb/ContactBundle/master/demo.png" alt="demo contact bundle form" /></p>

## Installation

Via [Packagist](https://packagist.org/packages/piedweb/contact-bundle) :

```
# Get the Bundle
composer require piedweb/contact-bundle

# Add the route to your Routes:
contact:
    resource: '@PiedWebContactBundle/Resources/config/routes/contact.yaml'
```

## Usage

### You can use it as is and include it in your Page with two manners :

```bash
# Load form in ajax
<div data-sky="{{ path('piedweb_cms_contact') }}"></div>

# Render form in Controller
{{ render(controller('PiedWeb\\ContactBundle\\Controller\\ContactController::show')) }}
```

### Or you can...

... customize everything by overriding any part of the bundle (especially `src/Resources/views/contact/`)


## TODO

- test

## Contributors

* [Robin](https://www.robin-d.fr/) / [Pied Web](https://piedweb.com)
* ...

Check coding standard before to commit :
```
php-cs-fixer fix src --rules=@Symfony --verbose
php-cs-fixer fix src --rules='{"array_syntax": {"syntax": "short"}}' --verbose
```

## License

MIT (see the LICENSE file for details)
