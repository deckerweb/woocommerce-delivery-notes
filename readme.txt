=== WooCommerce Delivery Notes ===
Contributors: daveshine
Donate link: http://genesisthemes.de/en/donate/
Tags: delivery notes, delivery, shipping, print, order, invoice, woocommerce, woo commerce, woothemes, administration, shop, shop manager, deckerweb
Requires at least: 3.3
Tested up to: 3.3
Stable tag: 1.0

This plugin adds Delivery Notes for the WooCommerce Shop Plugin. You can add company info as well as personal notes and policies to the print page.

== Description ==

With this plugin you can print out delivery notes for the orders via the WooCommerce Shop Plugin. You can edit the Company/Shop name, Company/Shop postal address and also add personal notes, conditions/policies (like a refund policy) and a footer imprint/branding.

The plugin adds a new side panel on the order page to allow shop administrators to print out delivery notes. This is useful for a lot of shops that sell goods which need delivery notes for shipping or with added refund policies etc. In some countries (e.g. in the European Union) such refund policies are required so this plugin could help to combine this with the order info for the customer.

= Special Features =
* The plugin comes with an attached template for the delivery note (printing) page - you could also copy this to your theme and customize it to your needs! The plugin will recognize the new place. (See under [FAQ here](http://wordpress.org/extend/plugins/woocommerce-delivery-notes/faq/))
* All setting fields on the settings pages are optional - you can leave them empty to not use them at all or only apply what you need.
* If the company/shop name field is left empty then the regular website/blog title is used (defined via regular WordPress options)
* Included contextual help tab system with new WordPress 3.3 standard! (Will also be extended if needed!)

= Localization =
* English (default) - always included
* German - always included
* .pot file (`woocommerce-delivery-notes.pot`) for translators is also always included :)
* Your translation? - [Just send it in](http://genesisthemes.de/en/contact/)

Credit where credit is due: This plugin here is inspired and based on the work of Steve Clark, Trigvvy Gunderson and PiffPaffPuff and the awesome "Jigoshop Delivery Notes" plugin! See below how you can contribute to the further development of both:

= Contribute =
Since this is a fork I've made the plugin available in a developer repository at GitHub just like the original.

* [Forked WooCommerce Delivery Notes repository at GitHub.com](https://github.com/deckerweb/woocommerce-delivery-notes)
* [Original Jigoshop Delivery Notes repository at GitHub.com](https://github.com/piffpaffpuff/jigoshop-delivery-notes)
* Thank you in advance for all feedback, suggestions, contributions/commits!

[A plugin from deckerweb.de and GenesisThemes](http://genesisthemes.de/en/)

= Feedback =
* I am open for your suggestions and feedback - Thank you for using or trying out one of my plugins!
* Drop me a line [@deckerweb](http://twitter.com/#!/deckerweb) on Twitter
* Follow me on [my Facebook page](http://www.facebook.com/deckerweb.service)
* Or follow me on [@David Decker](http://deckerweb.de/gplus) on Google Plus ;-)

= More =
* [Also see my other plugins](http://genesisthemes.de/en/wp-plugins/) or see [my WordPress.org profile page](http://profiles.wordpress.org/users/daveshine/)
* Tip: [*GenesisFinder* - Find then create. Your Genesis Framework Search Engine.](http://genesisfinder.com/)

== Installation ==

1. Upload the entire `woocommerce-delivery-notes` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Look under the WooCommerce menu for the entry "Delivery Notes Settings" and adjust them to your needs
4. On single order pages you'll find a new meta box on the right side where it says "View & Print Delivery Note" you can open the delivery note for the actual order and print it out directly
5. Go and manage your orders - good luck with sales :)

== Frequently Asked Questions ==

= Can I use a Custom Template for the printing page? =
If you want to use your own template then all you need to do is copy the `/wp-content/plugins/woocommerce-delivery-notes/delivery-note-template` folder and paste it inside your `/wp-content/themes/your-theme-name/woocommerce` folder (if not there just create it). The folder from the plugin comes with the default template and the basic CSS stylesheet file. You can modifiy this to fit your own needs.

*Note:* This works with both single themes and child themes (if you use some framework like Genesis). If your current active theme is a child theme put the custom folder there! (e.g. `/wp-content/themes/your-child-theme-name/woocommerce`)

= What Template Functions can I use? =
Various functions are available in the template, especially many Delivery Notes specific template functions. Open the `woocommerce-delivery-notes/wcdn-print.php` file to see all available functions.

*Please note:* This is only intended for developers who know what they do! Please be careful with adding any code/functions! The default template and functions should fit most use cases.

== Screenshots ==

1. Plugin's settings page where you can set up to four fields for the delivery note.
2. Contextual help tabs on the plugin's settings page.
3. Delivery Note printing page with default template - and the four custom sections marked (yellow)

== Changelog ==

= 1.0 =
* Initial release
* Forked and extended from original plugin for Jigoshop ("Jigoshop Delivery Notes" at GitHub)

== Upgrade Notice ==
= 1.0 =
Just released into the wild.

== Translations ==

* English - default, always included
* German: Deutsch - immer dabei! [Download auch via deckerweb.de](http://deckerweb.de/material/sprachdateien/woocommerce-und-extensions/#woocommerce-delivery-notes)

Note: All my plugins are localized/ translateable by default. This is very important for all users worldwide. So please contribute your language to the plugin to make it even more useful. For translating I recommend the awesome ["Codestyling Localization" plugin](http://wordpress.org/extend/plugins/codestyling-localization/) and for validating the ["Poedit Editor"](http://www.poedit.net/).

== Additional Info ==
**Idea Behind / Philosophy:** Just a little plugin for all the WooCommerce shop managers out there to make their daily shop admin life a bit easier.
