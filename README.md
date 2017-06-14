# Automated Sass Export
*For [WordPress Customizer Extended](https://github.com/jtmcgrath/wpc-extended)*

This plugin adds automatic Sass export to [WPC Extended](https://github.com/jtmcgrath/wpc-extended). With both plugins installed, any customizer settings are compiled directly to Sass, and the live stylesheet is updated when the customizer settings are saved. Check out the child plugin repo for more information.

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
7. Add customizer options in your theme's `functions.php` file.

## [Wiki](https://github.com/jtmcgrath/wpc-extended-sass/wiki)

[**Guide**](https://github.com/jtmcgrath/wpc-extended-sass/wiki/Guide) - Detailed, step-by-step instructions on how to configure the plugin using a simple example.

[**Options**](https://github.com/jtmcgrath/wpc-extended-sass/wiki/Options) - A list of all available options specific to the Sass extension.

[**Using Settings**](https://github.com/jtmcgrath/wpc-extended-sass/wiki/Using-Settings) - A list of methods which allow you to access the Customizer settings in php files.

[**Sass Vardump**](https://github.com/jtmcgrath/wpc-extended-sass/wiki/Sass-Vardump) - An explanation of the Sass Vardump file, including an example.

### Refer to the [WPC Extended wiki](https://github.com/jtmcgrath/wpc-extended/wiki) for further information on the following topics:

[**Options**](https://github.com/jtmcgrath/wpc-extended/wiki/Options) - A list of all available Customizer-related options.

[**Controls**](https://github.com/jtmcgrath/wpc-extended/wiki/Controls) - A list of all available Customizer controls.

[**Using Settings**](https://github.com/jtmcgrath/wpc-extended/wiki/Using-Settings) - A list of methods which allow you to access the Customizer settings in php files.

[**Comprehensive Example**](https://github.com/jtmcgrath/wpc-extended/wiki/Comprehensive-Example) - Example code for a theme's `functions.php` file demonstrating all available controls.

## Built With

- [SCSSPHP](https://github.com/leafo/scssphp) - SCSS compiler written in PHP.
