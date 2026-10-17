=== GB Extras ===
Tags: blocks, gutenberg, block, patterns, styles
Requires at least: 6.9
Tested up to: WordPress 7.1
Stable tag: 3.0.0
Requires PHP: 8.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Enhance your GenerateBlocks experience with GB Extras, featuring a Pattern Importer, v1 to v2 transforms, and more.

== Description ==

GB Extras is an add-on for GenerateBlocks that brings additional functionality and enhancements to your block editing experience. Key features include:

1. **Pattern Importer**: Easily import remote patterns, including all images and unique IDs, ensuring no style conflicts.
2. **Version 1 to Version 2 Blocks Converter**: Convert v1 to v2 blocks with a quick transform.
3. **Adobe Font Support**: Integrate Adobe Fonts from popular font plugins like Astra’s Typekit plugin and Blocksy’s Adobe Font module.
4. **Container Block Wrapping**: Select multiple blocks and wrap them in a Container block with ease.
5. **Transform the Group block to a Container**: Convert Group blocks into Container blocks, maintaining all internal blocks.
6. **Command Palette Shortcuts**: Access GenerateBlocks settings quickly with shortcut commands in the block editor’s Command Palette.
7. **Unique ID Generation**: Avoid style conflicts by generating new unique IDs for duplicated or copied blocks.

GB Extras is perfect for users looking to streamline their GenerateBlocks workflow and add more versatility to their block editor.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/gb-extras` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Use the plugin via the block editor in your WordPress site.

== Frequently Asked Questions ==

= What is the Pattern Importer and how does it work? =
The Pattern Importer allows you to import GenerateBlocks patterns, automatically generating unique IDs and importing images to your site.

== Changelog ==

= 3.0.0 =
* Released on 2026-08-03
* Final release of GB Extras.
* New: Added post type options that'll regenerate GB styles on save (if selected).
* New: Licensing has been removed.
* New: Admin panel has been redesigned to remove branding and to use GenerateBlocks styles.
* New: GB Extras renamed GenerateBlocks Extras.
* New: Admin menu moved towards the end.
* Fix: Shortcuts now work in FSE.

= 2.6.1 =
* Released 2026-04-06
* Fix: Admin menu bar only shows for those with admin privileges.

= 2.6.0 =
* Released 2026-03-08
* New: Added v1 to v2 contextual shortcut, allowing you to transform at the block level including all child blocks.

= 2.5.0 =
* Released 2025-12-26
* New: Improved command palette system for GenerateBlocks tools and transformations.
* New: (Command Palette) Regenerate GenerateBlocks CSS files directly from the command palette.
* New: (Command Palette) Bulk transform core Paragraph blocks into GenerateBlocks Text blocks.
* New: (Command Palette) Bulk transform core Heading blocks (H1–H6) into GenerateBlocks Text blocks.
* Updated: (Command Palette) Experimental command to convert GenerateBlocks v1 blocks to v2 blocks.
* Improved: (Command Palette) Container outline toggle now performs significantly better and no longer causes editor lag.
* Improved: (Command Palette) Shortcuts are now available in more contexts (editor, admin, frontend).
* New: (Command Palette) Optional frontend command palette for administrators.
* New: Admin bar customization options for GenerateBlocks menus.
* Fixed: Outline rendering and cleanup issues that could cause performance problems.


= 2.1.1 =
* Released 2025-08-13
* Hot fix:  Version 1 blocks were still showing despite the option being disabled in the admin. This has been fixed.

= 2.1.0 =
* Released 2025-08-13
* Added new header and site navigation blocks to known blocks.
* Added transform from a Shape to a Text block with icon.
* Added transform from a Shape to a standalone link.
* Added "Delete Block Styles" to the context menu.
* Added Blocksy Local Google Fonts compatibility.
* Bug fix: UniqueID replacements were too greedy and affecting other blocks.


= 2.0.1 =
* Released 2025-05-27
* Fixing block error with unfound file.
* Fixing require_once param not executing.

= 2.0.0 =
 * Released 2025-05-12
 * Added v1 to v2 block converter in command palette.
 * Updating Block Editor shortcuts for the v2 blocks.
 * Adding v1 and v2 options to show both at once, with custom labels and suffixes.
 * Fixing Unique ID generation for Version 2 blocks.

= 1.5.0 =
* Released 2024-06-11
* Renaming plugin to GB Extras.

= 1.4.0 =
* Released 2024-06-11
* Added markdown admin option for using markdown to create Headline blocks.

= 1.3.0 =
* Released 2024-03-03
* When unwrapping a container, the first child in the container is selected by default.
* Added much more reliable image importing when importing patterns with the Pattern Inserter block.
* Added option to skip remote image download in the Pattern Inserter block.
* Tested with WP 6.5, which introduces RichText attributes, which require different validation. This is useful if you have selected the Headline block as the default block.
* Tested with GB 1.9.0-alpha.2 and GB Pro 1.7.0-alpha.2 with no conflicts founds so far.

= 1.2.0 =
* Released 2024-01-19
* Added new command to the command palette, which will let you toggle an outline of all container blocks.
* Added a shortcut to the context menu to unwrap (i.e., flatten) a container block and its content.
* Added a shortcut to the context menu to ungroup a group block.
* Fixing bug fix with default Headline block when in a nested container.
* Added debouncing to block editor if the default block is a Headline block.
* Fixed transforms to paragraphs when transforming to a paragraph block.

= 1.1.9 =
* Released 2023-12-16
* Fixing Blocksy Adobe Fonts integration returning the wrong value and setting the font incorrectly.

= 1.1.5 =
* Released 2023-12-07
* Fixed block shortcuts when Headline is not then selected block.

= 1.1.4 =
* Released 2023-12-03
* Fix for the default block erroring out when no blocks are selected.
* Fix for automatic updates.

= 1.1.0 =
* Released 2023-12-03
* Added Command Palette commands to access GenerateBlocks settings easily from the block editor.
* Can select multiple blocks and have them wrapped in a Container block.
* Can generate a new Unique ID for any block from GenerateBlocks.
* Added documentation and support links to the admin settings.
* Fixed image status not displaying for the Pattern Importer.

= 1.0.0 =
* Initial release.

== Upgrade Notice ==

= 3.0.0 =
Final release of GB Extras. Licensing has been stripped. Admin panel now resembles GenerateBlocks. Branding has been removed/stripped.