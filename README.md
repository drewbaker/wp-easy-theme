# wp-easy

A framework for building modern WordPress themes, but make it easy.

wp-easy takes a lot of inspiration from modern JS frameworks, but keeps everything server side with PHP just like you are used to. The goal is to make building PHP templates for WordPress a more enjoyable experience for beginners, but also encourage them to build with a more modern approach. We've tried to balance coding "best practices" with performance and ease of use.

The main inovation of wp-easy is to introduce the concept of single-file-components into WP theme building, and directory based template routing. 

## Install

1. Install the wp-easy plugin

### Directory based routing

Once you've installed the plugin, you'll want to create a folder structure in your theme directory. Each directory will have some related automatic features enabled. These are explained more below, but to start you'll want to create a `pages` directory. This direcotry serves as a template routing structure, similiar to frontend frameworks like Nuxt.

```
/my-theme
  /pages
    /page.php <-- This file will be used as the template when a visitng the sites home page
    /work
      page.php <-- This file will be used as the template when a visiting /work/
      _foo.php <-- This file will be used as the template when a visiting /work/bar/ or /work/bar/ etc...
      /baz/page.php <-- This is the list view for`/work/baz/`
```

### Site global layout

The releveant page template is insterted into a global layout, so that things like the Header and Footer don't need to be included in every page template.

```
/my-theme
  /layout.php
```

This file will contain the following code as a minimum.

```
<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php html_class(); ?>>
    <head>
        <?php wp_head();?>
    </head>

    <body <?php body_class(); ?>>
        <?php page_outlet(); ?> <!-- The requested page template from the `/pages` directory will be rendered here.
    </body>
</html>
```

### Page templates

TODO Explain where page templates live, and how to re-use theme.

```
<div class="page">
    Whatever I want...
</div>
```

### Components

You should create a `components` directory, and keep all your components in here.

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


# TODO

- Explain SFC script tags, $el, $store...
- Router params and route name... `get_route_name()` and `get_route_params()` would be useful.
- Some nice patterns and a helper on how to observe state, to encourage reactive approach to JS but keep it easy... Thinking something like `$store.watch('menuOpened', (newVal, oldVal)=>{})`
- Fonts
- SVGs (could we run through SVGO?)
- How to include 3rd party scripts easily?
- What do we use functions.php file for?
  - Include some useful utils? `is_in_tree('slug'), has_children()`
  - Include some logic for using theme.css
- What about `html_classes()`, current best practices is to use budy for classes. Should we put `body_classes()` on `<html>`?
  - Auto Route name as class to `html`...
- How to use theme.css best practice...
- Nested CSS: https://github.com/sed-seyedi/nested-css or https://scssphp.github.io/scssphp/
- - What about scoping CSS?
- - How to deal with >>> deep selectors?
- Something to add basic open graph tags
- Handle auto load of favicon if present
- Could we map `/public` to serve files like there are in root?
