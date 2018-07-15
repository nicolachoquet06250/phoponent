# © 2018 - Phoponent
## LICENCE GNU GPL

[![Sbuild](https://scrutinizer-ci.com/g/nicolachoquet06250/phoponent/badges/build.png?b=master)](https://scrutinizer-ci.com/g/nicolachoquet06250/phoponent/?branch=master) [![Scrutinizer Code intelligence](https://scrutinizer-ci.com/g/nicolachoquet06250/phoponent/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/g/nicolachoquet06250/phoponent/?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/nicolachoquet06250/phoponent/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/nicolachoquet06250/phoponent/?branch=master)

PHP framework for creating HTML components in PHP. each component is an MVC pattern and its view can contain other components.

## Installation

Clone Phoponent git repository:
```bash
    git clone https://github.com/nicolachoquet06250/phoponent
```

## Usage

Use the available commands.

Several commands are available:

- ```php Phoponent```
    - help command
- ```php Phoponent make:debug```
    - enable and disable debug mode.
- ...etc

## Create html page.

For create an Html page, create Html file in ```app``` directory.

For view this page, go to your browser and tape ```http(s)://your_domain.com/?p=index.html```

## Create php component

For create a php component, simply tape this command in your terminal:

```bash
php Phoponent make:component
```

this command takes 2 parameters of which 1 obligatory:
- tag : this is the tag name of your component.
- type : this is the type of your component ( core or custom ) 
    - => core is default value.

this command will create for you:
- one demo model:
    - processes datas
- one demo PHP view with its associate PHP class:
    - processes view
- one demo controller:
    - return render

Thereafter, update files for get the expected result.

For your component to be taken into account, 
it must be written on the html page.

You can write it in 3 different ways without impacting its understanding 
by the framework:
 - 1st way:
```html
<My_component parameter="value"></My_component>
```
 - 2nd way:
```html
<My_component parameter="value">
    text to write in the 'value' variable
</My_component>
```
 - 3rd way:
```html
<My_component parameter="value"/>
```

For externals libs, include them in ```external_libs``` directory

If you add external_libraries or class and you would like add at dependency in component:
- go to phoponent/Autoload.php file and add your file to ```self::$dependencies[]``` variable.
    - class name is key and value is class ( ```self::$dependencies['ma_class'] = \namespace\ma_class::class;``` )

- Voir les sites suivants:
	- pour tester le framework:
		- http(s)://domain.fr?(:port)/?p=index.html
		- http(s)://domain.fr?(:port)/?p=doc/index.html
	- [https://github.com/nicolachoquet06250/phoponent](https://github.com/nicolachoquet06250/phoponent)
