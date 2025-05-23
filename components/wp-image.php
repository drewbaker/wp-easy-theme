<?php
// Set default args for the component
$args = set_defaults($args, [
    'class'     => '',
    'id'        => '',
    'image_id'  => 0,
    'sizes'     => '',
    'mode'      => 'default',
]);

$sizes = $args['sizes'];

// Handle some custom size shortcuts
switch ($sizes) {
    case "full":
    case "full-screen":
    case "fullscreen":
        $sizes = "(max-width: 850px) 1920px, 100vw";
        break;

    case "half":
    case "half-screen":
        $sizes = "(max-width: 850px) 100vw, 50vw";
        break;

    case "third":
    case "third-screen":
        $sizes = "(max-width: 850px) 100vw, 33.33vw";
        break;

    case "quarter":
    case "quarter-screen":
        $sizes = "(max-width: 850px) 100vw, 25vw";
        break;
}

// Get the image HTML
$image = wp_get_attachment_image(
    $args['image_id'],
    'fullscreen-xlarge',
    false,
    [
        'class' => 'media media-image',
        'sizes' => $sizes,
    ]
);

// Set the image aspect ratio as CSS vars
$img_meta = wp_get_attachment_metadata($args['image_id']);
if ($img_meta && $img_meta['width'] && $img_meta['height']) {
    $ratio = $img_meta['width'] . ' / ' . $img_meta['height'];
}

// Check for Video
$video_url = get_field('video_url', $args['image_id']);

// Build out all the CSS classes
$classes = ['wp-image', $args['class'], 'mode-' . $args['mode']];

?>

<?php if (!$image) return; ?>

<template>
    <figure
        id="<?= $args['id']; ?>"
        class="<?= implode(' ', $classes); ?>"
        style="--aspect-ratio: <?= $ratio; ?>">

        <?= $image; ?>

        <?php if ($video_url) : ?>
            <video class="media media-video" playsinline autoplay muted loading="lazy" src="<?= $video_url; ?>" loop></video>
        <?php endif; ?>
    </figure>
</template>

<style>
    .wp-image {
        width: 100%;
        margin: 0;
        aspect-ratio: var(--aspect-ratio);

        .media {
            width: 100%;
            height: auto;
            display: block;
        }

        .media-video {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            object-fit: cover;
        }

        // Modes
        :where(&.mode-cover) {
            position: relative;
        }

        &.mode-cover {
            height: 100%;
            aspect-ratio: unset;
            
            .media {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
        }
    }
</style>
