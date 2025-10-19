# Rules: WordPress Theme Development with WP-Easy

## Purpose
Make Cursor reliably generate **clean, readable WordPress themes** using [**WP-Easy**](https://github.com/drewbaker/wp-easy). Prefer **simplicity over cleverness**. Follow WordPress best practices for escaping, security, accessibility, and template organization.

Be sure to read the [README.md](https://github.com/drewbaker/wp-easy/blob/main/README.md) of WP-Easy as it includes all the details needed to be an expert at building a theme with WP-Easy.

---

## High-level Principles
- **Keep it simple.** Prefer explicit, easy-to-read PHP over fancy abstractions.
- **Theme files own the UI; heavy logic stays out of templates.**
- **Routes live in `router.php`.** Map human-readable paths to templates/layouts via WP-Easy’s router.
- **Use Single-File Components (SFC) when convenient** (PHP + `<template>` + `<style>` + `<script>` in one `.php` file), but it’s fine to split styles/scripts into `/styles` and `/scripts` too.
- **No manual enqueueing for site CSS/JS.** All files in `/styles/` and `/scripts/` are auto-loaded by WP-Easy.
- **Prefer data helpers over the raw WordPress Loop.** Use `use_children()` (and similar helpers) and iterate with `foreach`.
- **Escape and translate**: `esc_html`, `esc_attr`, `esc_url`, `__`, `_e` on all user-facing text/attributes.

---

## Theme Structure (expected by Cursor)

```
your-theme/
  index.php
  functions.php
  router.php               # All routes are defined here
  template.php             # Layout outlet bridge (used by WP-Easy theme scaffold)
  style.css                # Theme header + minimal base styles
  /layouts/                # Optional SFC layouts (default.php is typical)
  /templates/              # Page-level templates (SFC or plain PHP)
  /components/             # Reusable UI units (SFC or PHP partials)
  /styles/                 # SCSS/CSS; auto-compiled/loaded by WP-Easy
  /scripts/                # JS modules; auto-registered/loaded by WP-Easy
  /images/                 # Static images + SVGs
  /functions/              # Optional: small feature modules included from functions.php
```

**Notes**
- **Routes in `router.php`** (not `functions.php`).
- **SFCs** can include `<template>`, `<style>` (SCSS supported), and `<script>` blocks in the same `.php` file.
- **Styles & scripts** in `/styles` and `/scripts` are **auto-loaded** (site-wide). Don’t enqueue them manually.

---

## Routing (router.php)

**Do:**
- Define an array and `return` it.
- Prefer readable slugs and consistent naming.
- Use `path`, `layout`, and `template` where needed.

**Example**
```php
<?php
// router.php
$routes = [
  'home'        => '/',
  'work'        => '/work/',
  'work-detail' => [
    'path'     => '/work/:slug/',
    'layout'   => 'default',
  ],
  'finish'      => ['path' => '/finish/', 'template' => 'work-detail']
  'about'       => '/about/',
];
return $routes;
```

---

## Templates & Components

### Prefer helper-driven iteration (avoid the classic Loop)
**Instead of**:
```php
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <h2><?= esc_html(get_the_title()); ?></h2>
<?php endwhile; endif; ?>
```

**Do this**:
```php
<?php foreach (use_children() as $post) : ?>
  <h2 class="title"><?= $post->post_title; ?></h2>
<?php endforeach; ?>
```

### Rendering components
```php
<?php
use_component('work-block', [
  'title' => $post->post_title,
  'url'   => $post->url,
]);
```

### SFC pattern (optional but encouraged)
```php
<?php
// components/work-block.php
$args = set_defaults($args, ['title' => '', 'url' => '']);
?>

<template>
  <article class="work-block">
    <h3><a href="<?= $args['url']"><?= $args['title']); ?></a></h3>
  </article>
</template>

<style>
.work-block {
  display: block;
  margin-block: 1.5rem;
}
</style>

<script>
// Component-specific JS here, use $() for jQuery ideally
</script>
```

---

## Layouts & Outlets

```php
<?php // layouts/default.php ?>
<template>
  <?php use_component('header'); ?>

  <main id="content">
    <?php use_outlet(); ?>
  </main>

  <?php use_component('footer'); ?>
</template>
```

---

## Styles & Scripts (no manual enqueue)

- **Site-wide**: All files in `/styles/` and `/scripts/` are auto-loaded; utilities in `/scripts/utils/` are registered as dependencies of `main.js`.  
- **SCSS** is supported in SFC `<style>` blocks and `/styles` files.  
- **jQuery** is available; `$` aliases `jquery`.

**JavaScript Guidelines**
- **Prefer jQuery over vanilla JS** for consistency and readability.
- Keep JS modular; avoid inline scripts.
- Use jQuery's built-in methods for DOM manipulation, event handling, and AJAX.
- Leverage jQuery's cross-browser compatibility and simplified syntax.

**CSS Guidelines**
- Keep CSS semantic; scope component styles under a block class.

---

## SVGs

```php
<?php use_svg('logo', ['class' => 'site-logo', 'width' => 120]); ?>
```

---

## WordPress Best Practices

- Use `$post->shortcuts`, as added in [expand_post_object](https://github.com/drewbaker/wp-easy/blob/main/includes/class-utils.php)
- There are many useful [helper functions avaiable](https://github.com/drewbaker/wp-easy/blob/main/includes/helpers.php), such as `use_children()`, `use_svg` or `get_adjacent_sibling()`. Use them when possible.


---

## Coding Style

- **PHP**: 4 spaces, allow `<?= ?>` shorthand.
- **SCSS/JS**: 2 spaces.
- One obvious purpose per file.

---

## Common Patterns

### Simple page template
```php
<?php $title = get_the_title(); ?>

<template>
  <section class="page">
    <h1><?= $post->post_title; ?></h1>

    <?php foreach (use_children() as $post): ?>
      <article class="child">
        <h2><?= $post->post_title; ?></h2>
      </article>
    <?php endforeach; ?>
  </section>
</template>
```

### Setting attributes
```php
<a href="<?= $post->url; ?>">
  <?= post->post_title; ?>
</a>
```

### Using ACF meta fields
```php
<div class="gallery">
  <? foreach ($post->gallery_images as $image) : ?>
      <? use_component('wp-image', [
          'image_id' => $image['id'],
          'class' => 'image',
      ]); ?>
  <? endforeach; ?>
</div>
```

### Composing pages from components
```php
<?php
use_component('header', ['menu' => 'primary']);
use_component('gallery-grid', ['ids' => [123, 456, 789]]);
use_component('footer');
?>
```
