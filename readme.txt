=== WooCommerce Delivery Notes ===
Contributors: daveshine
Donate link: http://genesisthemes.de/en/donate/
Tags: delivery notes, delivery, shipping, print, order, invoice, woocommerce, woo commerce, woothemes, administration, shop, shop manager, deckerweb
Requires at least: 3.3 and WooCommerce 1.4+
Tested up to: 3.3.1
Stable tag: 1.1.2

This plugin adds invoices and delivery notes for the WooCommerce shop plugin. You can add company info as well as personal notes and policies to the print page.

== Description ==

With this plugin you can print out invoices and delivery notes for the orders via the WooCommerce Shop Plugin. You can edit the Company/Shop name, Company/Shop postal address and also add personal notes, conditions/policies (like a refund policy) and a footer imprint/branding.

The plugin adds a new side panel on the order page to allow shop administrators to print out delivery notes. This is useful for a lot of shops that sell goods which need delivery notes for shipping or with added refund policies etc. In some countries (e.g. in the European Union) such refund policies are required so this plugin could help to combine this with the order info for the customer.

= Features =
* The plugin comes with an attached template for the invoice and delivery note (printing) page - you could also copy this to your theme and customize it to your needs! The plugin will recognize the new place. (See under [FAQ here](http://wordpress.org/extend/plugins/woocommerce-delivery-notes/faq/))
* All setting fields on the settings pages are optional - you can leave them empty to not use them at all or only apply what you need.
* If the company/shop name field is left empty then the regular website/blog title is used (defined via regular WordPress options)
* If there are added "Customer Notes" (regular WooCommerce feature) for an order these will automatically displayed at the bottom of the delivery note.
* Included contextual help tab system with new WordPress 3.3 standard! (Will also be extended if needed!)

= Localization =
* English (default) - always included
* German - always included
* Swedish - user-submitted, thanks to [Christopher Anderton](http://www.deluxive.se/)
* .pot file (`woocommerce-delivery-notes.pot`) for translators is also always included :)
* *Your translation? - [Just send it in](http://genesisthemes.de/en/contact/)*

Credit where credit is due: This plugin here is inspired and based on the work of Steve Clark, Trigvvy Gunderson and the awesome "Jigoshop Delivery Notes" plugin! See below how you can contribute to the further development of both:

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
* Or follow me on [+David Decker](http://deckerweb.de/gplus) on Google Plus ;-)

= More =
* [Also see my other plugins](http://genesisthemes.de/en/wp-plugins/) or see [my WordPress.org profile page](http://profiles.wordpress.org/users/daveshine/)
* Tip: [*GenesisFinder* - Find then create. Your Genesis Framework Search Engine.](http://genesisfinder.com/)

== Installation ==

1. Upload the entire `woocommerce-delivery-notes` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Look under the WooCommerce menu for the entry "Delivery Notes Settings" and adjust them to your needs
4. On single order pages you'll find a new meta box on the right side where it says "View & Print Delivery Note" you can open the delivery note for the actual order and print it out directly
5. Go and manage your orders - good luck with sales :)

**Please note:** You must run WordPress 3.3 or higher and WooCommerce 1.4 or higher in order tun this plugin. This is due to changes in WooCommerc v1.4+!

== Frequently Asked Questions ==

= Can I use a custom template for the printing page? =
If you want to use your own template then all you need to do is copy the `/wp-content/plugins/woocommerce-delivery-notes/templates/delivery-notes` folder and paste it inside your `/wp-content/themes/your-theme-name/woocommerce` folder (if not there just create it). The folder from the plugin comes with the default template and the basic CSS stylesheet file. You can modifiy this to fit your own needs.

*Note:* This works with both single themes and child themes (if you use some framework like Genesis). If your current active theme is a child theme put the custom folder there! (e.g. `/wp-content/themes/your-child-theme-name/woocommerce`)

= Can I use a different custom template for invoices and delivery notes? =
Yes. Create in the `your-theme-name/woocommerce/delivery-notes` folder a file named `print-invoice.php` and another `print-delivery-note.php`. Now write some nice code to make your templates look as you like. 

*Note:* The `print.php` isn't needed when you have a `print-invoice.php` and `print-delivery-note.php` file. However the template system falls back to the `print.php` file inside your themes folder and then inside the plugins folder when `print-invoice.php` and/or `print-delivery-note.php` weren't found.

= What Template Functions can I use? =
Various functions are available in the template, especially many Delivery Notes specific template functions. Open the `woocommerce-delivery-notes/woocommerce-delivery-notes-print.php` file to see all available functions.

*Please note:* This is only intended for developers who know what they do! Please be careful with adding any code/functions! The default template and functions should fit most use cases.

= What will actually get printed out? =
No worries, the print buttons at the top and the bottom will automatically be hidden on print!
The other sections get printed as styled via the packaged template (or your custom template if configured). For the shop/company name and all other notes sections: only these will get printed which are actually configured.
Beyond the styling of your template be aware of any special features of your used browser - I highly recommend to use the "Print Preview" feature of your browser which all current versions of Firefox, Chrome and Opera support.

= Can you update the plugin with feature X or option Y?
Mmh. Maybe.
The basic intention is to have the plugin at the same time as leightweight and useful as possible. So any feature request needs to ...

== Screenshots ==

1. Plugin's settings page where you can set up to five fields for the delivery note.
2. Contextual help tabs on the plugin's settings page.
3. Delivery Note printing page with default template - and the five custom sections marked (yellow)

== Changelog ==

= 1.1.2 =
* Basic invoice template support
* Custom order number

= 1.1.1 =
* Restructured classes
* Settings are part of the WooCommerce settings
* Template folder renaming (custom templates must be renamed to work)

= 1.1 =
* Maintenance release
* UPDATE: Changed product price calculation due to changes in WooCommerce itself -- this led to **new required versions** for this plugin: **at least WordPress 3.3 and WooCommerce 1.4** or higher (Note: If you still have WooCommerc 1.3.x running then use version 1.0 of the Delivery Notes plugin!)
* UPDATE: Custom fields on settings page now accept proper `img` tags, so you can add logo images or such via HTML IMG tag (for example: `<img src="your-image-url" width="100" height="100" alt="Logo" title="My Shop" />`)
* UPDATE: Corrected readme.txt file
* NEW: Added Swedish translation - Thanx to Christopher Anderton
* UPDATE: Updated German translations and also the .pot file for all translators!

= 1.0 =
* Initial release
* Forked and extended from original plugin for Jigoshop ("Jigoshop Delivery Notes" at GitHub)

== Upgrade Notice ==

= 1.1 =
Several changes: Changed price calculation due to WC 1.4+ changes. Added img tag support for fields on settings page. Corrected readme.txt file, added Swedish translations, also updated .pot file together with German translations.

= 1.0 =
Just released into the wild.

== Translations ==

* English - default, always included
* German: Deutsch - immer dabei! [Download auch via deckerweb.de](http://deckerweb.de/material/sprachdateien/woocommerce-und-extensions/#woocommerce-delivery-notes)
* Swedish: Svenska - user-submitted by [Christopher Anderton](http://www.deluxive.se/)

*Note:* All my plugins are localized/ translateable by default. This is very important for all users worldwide. So please contribute your language to the plugin to make it even more useful. For translating I recommend the awesome ["Codestyling Localization" plugin](http://wordpress.org/extend/plugins/codestyling-localization/) and for validating the ["Poedit Editor"](http://www.poedit.net/).

== Additional Info ==
**Idea Behind / Philosophy:** Just a little plugin for all the WooCommerce shop managers out there to make their daily shop admin life a bit easier.
