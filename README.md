# wp-easy

A plugin that provides a framework for building modern WordPress themes, but make it easy.

wp-easy takes a lot of inspiration from modern JS frameworks, but keeps everything server side with PHP just like you are used to. The goal is to make building PHP templates for WordPress a more enjoyable experience for beginners, but also encourage them to build with a more modern approach. We've tried to balance coding "best practices" with performance and ease of use.

The main inovation of wp-easy is to introduce the concept of single-file-components into WP theme building, and directory based template routing. 

## Use cases

- You're new to PHP, but have an understanding of JS frameworks
- You've got the basics down of PHP "the WordPress way", but you want to level up to building sites the "right way" without having to be a full PHP wizard.
- You've mastered WordPress and PHP, and you want to build an easy theme quickly without having to managed a ton of dependecies or complexity (otherwise you could use Roots.io)

## Install

1. Install the wp-easy plugin

### Directory based routing

Once you've installed the plugin, you'll want to create a folder structure in your theme directory. Each directory will have some related automatic features enabled. These are explained more below, but to start you'll want to create a `pages` directory. This direcotry serves as a template routing structure, similiar to frontend frameworks like Nuxt.

```
/my-theme
  /pages
    /page.php <-- This file will be used as the template when a visitng the sites home page
    /fallback.php <-- This file is used if nothing matches
    /work
      page.php <-- This file will be used as the template when a visiting /work/
      _foo.php <-- This file will be used as the template when a visiting /work/bar/ or /work/boo/ etc...
      /baz/page.php <-- This is the list view for`/work/baz/`
```

Pages work like the same as components, but they have `$post` automatically available. They are included into where `page_outlet()` is called in the `layout.php` file depending on the route.


### Site global layout

The releveant page template is insterted into a global layout, so that things like the Header and Footer don't need to be included in every page template.

```
/my-theme
  /layout.php
```

This file will contain the following code as a minimum.  Note the `wp_head()` and `wp_footer()` functions are default WordPress functions and allow things like 3rd party plugins to work, or `wp-easy` to know where to insert scripts etc.

```
<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php html_class(); ?>>
    <head>
        <?php wp_head();?>
    </head>

    <body <?php body_class(); ?>>
        <?php page_outlet(); ?> <!-- The requested page template from the `/pages` directory will be rendered here.
        
        <?php wp_footer(); ?>
    </body>
</html>
```

But often times you'll want to do something like this to include a header on every page.

```
<html <?php language_attributes(); ?> <?php html_class(); ?>>
    <head>
        <?php wp_head();?>
    </head>

    <body <?php body_class(['layout']); ?>>
    
        <?php use_component('header'); ?>

        <?php page_outlet();?>

        <?php wp_footer(); ?>
    </body>
</html>
```

### Reusing templates

If you want to reuse a page template at multple routes, your should place the template in `/templates` and then in the `/pages/foo.php` file simply call `use_template('foobar')` where `foobar` is `/templates/foobar.php`

### Components

You should create a `/components` directory, and keep all your components in here.

```
/my-theme
  /components
    /my-component.php
```

If you are not sure what a "component" is, the general idea is that they are isolated re-usable templates of code that don't know anything about their outside surroundings. So you have to "pass in" properties to them. It's easier to udnerstand if you see them in action...

So a page template might use the above `my-component` like this:

```
<div class="page">
    <?php use_component('my-component', ['post' => $post, 'text' => 'Some text']); ?>
</div>
```

And then the component might look like this:

```
<?php
// Do some PHP code here if you need
// `$props` comes from the array passed in via the `use_component` function in the page template. 
$meta = $props['post']->some_meta_field;
?>

<div class="my-component">
  <?php echo $props['text']; ?>

  <div class="meta">
    <?php echo $meta; ?>
  </div>
</div>

<style>
/* Some CSS here */
.my-component {
  .meta {
    background: red;  
  }
}
</style>

<script>
// This would be sick! But not required...
$el.click(()=>{
    console.log('I was clicked on')
})
<script>
```

For now, the prop syntax works in two different flavors. 

```
// basic usage for props
use_component( 'my-component', [ $post, $text ] ); // The prop names will be the same as the variables.

// custom prop names
use_component( 'my-component', [ $post, 'cta_text' => $text ] ); // $post and $cta_text will be the variables 
```

### CSS

CSS used in layouts, pages and components can actually be SCSS, meaning you can nest your CSS rules like this:

```
<style>
/* Some CSS here */
.my-component {
  .meta {
    background: red;  
  }
}
</style>
```

It is highly recommended that your component file name and your component root CSS class match. 

Your `<style>` block should only ever have one top leve class. 

This is good:
```
<style>
.my-component {
  .meta {
    background: red;  
  }
}
</style>
```

This is bad and won't work:
```
<style>
/* This is bad */
.my-component {
  font-size: 20px;
}
.meta {
  background: red;  
}
</style>
```

#### CSS files

If you want to load complete style sheets, then these should live in `/my-theme/styles` and the order they are loaded is defined in `wp-easy.config.php` file, like this:

```
<?php
wp_easy_config([
    'styles' => [
        '/styles/global.scss',
        '/styles/fonts.css'
    ],
])
?>
```

### Fonts

Font files should live in `/public/fonts` and then be loaded using `@font-face` rules in the `/styles/font.css` file.

### SVGs

SVGs can be placed in `/public/svgs` and used in your files using `use_svg('svg-file-name')`. SVGs will be optimized, leaving in ID, class and viewbox attributes.

### Scripts

You should place external scripts in `/my-theme/scripts` and can be loaded in a specific order in `wp-easy.config.php`.

For example, here is loading an external jQuery script and an internal `/my-theme/scripts/somefile.js` script.

```
<?php
wp_easy_config([
    'styles' => [
        '/styles/global.scss',
        '/styles/fonts.css'
    ],
    'scripts' => [
      [
        'id'    => 'somefile',
        'src'   => '/scripts/somefile.js'
      ],
      [
        'id'    => 'jquery',
        'async' => true,
        'defer' => true,
        'src'   => 'https://code.jquery.com/jquery-3.7.0.slim.min.js'
      ],      
    ]
])
?>
```

### Utility functions

The plugin enables a few useful common functions.

#### get_route_name()
`get_route_name()` this takes no arguments, returns a string of the resolved route name. This name is also added to the `<html>` element prefixed like `route-${route-name-here}`

#### get_route_params()
`get_route_params()` takes no arguments, and returns an array of route params found in the URL. A route param is basically anything in your page directory that has an `_` in it.

For example, if you have a page structure like `/my-theme/pages/cars/_foo/_bar` and some visit the URL `/work/cars/bmw/m3` then `get_route_params()` will return `['foo' => 'bmw', 'bar' => 'm3']`.

### Open graph tags

The theme will auto generate basic open graph tags for you.

### Custom functions

If you want to add your own custom PHP or WordPress functions, you can use `/my-theme/functions.php` just like any other WordPress theme. Copy-paste away!

### Favicon

Place your favicon in `/my-theme/public/images/favicon.*` and it will be automatically added to you site code.

# TODO

- Explain SFC script tags, $el, $store...
- Provide some nice patterns and a helper on how to observe state, to encourage reactive approach to JS but keep it easy... Thinking something like `$store.watch('menuOpened', (newVal, oldVal)=>{})`
- What about `html_classes()`, current best practices is to use html for classes and avoid body. Should we put `body_classes()` on `<html>`?
- How to use theme.css best practice...
- Nested CSS: 
  - https://github.com/sed-seyedi/nested-css
  - https://scssphp.github.io/scssphp/
  - https://github.com/Ed-ITSolutions/wp_enqueue_less
