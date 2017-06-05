# Automated Sass Export plugin for [WordPress Customizer Extended](https://github.com/jtmcgrath/wpc-extended)

This plugin adds automatic Sass export to the [WPC Extended](https://github.com/jtmcgrath/wpc-extended) plugin. With both plugins installed, any customizer settings are compiled directly to Sass, and the live stylesheet is updated when the customizer settings are saved. Check out the child plugin repo for more information.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. *Note that this plugin has not been tested thoroughly, and is not intended for production use at present.*

### Installation

By default, the plugin looks for a file located at `theme_directory/sass/style.scss` as its entry point, and stores the temporary compiled css into a file located at `theme_directory/sass_output/style.css`. The files are generated automatically, so for the basic setup you only need to carry out these steps:

1. Install and activate [WPC Extended](https://github.com/jtmcgrath/wpc-extended).
2. Install and activate **WPC Extended Sass**.
3. Add the following subdirectories to your theme's directory:
```
/sass/
/sass_output/
```
4. Create a `style.scss` file in the `/sass/` folder.
5. Add your theme's metadata to the top of the `style.scss` file (either directly or via an `@import` statement).
6. Create your Scss as desired.
7. Add options to the Customizer.

## Built With

- [SCSSPHP](https://github.com/leafo/scssphp) - SCSS compiler written in PHP.
