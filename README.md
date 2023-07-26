# wp-easy starter

This is a starter theme for the WP-Easy plugin. It's meant to show you how the directory strucutre works, and serve as a starting point for you building your own custom themes.


## Directory Structure

```bash
├── packages # Ignore this, in the real starter it will be be installed via composer.
├── public # This is where all your static assets go.
├── src # This is where the theme code goes.
├── ├── components # This is where your components go.
├── ├── includes # This for for PHP logic
├── │  ├── access-functions.php # This is where you put your access functions.
├── │  ├── Main.php # The PHP loader for the theme.
├── ├── pages # The page router
├── ├── styles # Your (s)Css (or maybe in ./assets/styles, if we're building)
├── ├── templates # We need to figure out what this means in the context of WP-Easy
├── └── layout.php # The global layout.
├── composer.json # Installs the deps.
├── functions.php # This is responsible for booting the theme. It should not be edited.
├── ... # other config files. 
└── wp-easy.config.php # The WPEasy config file.
```
