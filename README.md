# Org: WPezClasses
### Product: Class_WP_ezClasses_Transients_Helpers_1

##### WordPress transients done The ezWay. 

Centralize your transients (and their definitions and settings) and treat them more like methods / functions. And by using a static method
you can access your transients from just about anywhere. 

=======================================================================================

#### WPezClasses: Getting Started
- https://github.com/WPezClasses/wp-ezclasses-docs-getting-started

=======================================================================================


#### Overview

With this approach / structure, all = or at least most - of your transients can defined and managed via a single centralized class. 

For example, most blog posts on how to use transients show the get, the if (i.e., is the transient value still available) and the recalculation (of the transient) all in the same spot, and quite possibly repeated throughout your code. Obviously, that gets messy. Additionally, chances are the logic / rules for the delete transients is elsewhere as well.  Again, more possible disconnect.  

With this new & improved approach (i.e., The ezWay), via a single static get all that  is necessary is done for you. Well okay, you have to set it up, but the point is you do your get and these helpers enable the handling of the rest for you. Has the requested transient expired? No problem. You don't need to know, nor do you care. You just need the value.

Or if the definition of the calculation for the value changes - say, a different WP_Query - you know exactly where to make that update. No more sprawl, or ideally a lot less. 

You can also define when a transient should be deleted. For example, if a particular post_type is updated (i.e., action: save_post) you can have transients that need that lean on that update / post_type be deleted (indirectly) by that save_post event. 

You can also "automate" the creation of transients that are based on post ID and user ID. Again, you define what you need and once that's done all you have to really worry about is using the transient (via a static get). 

Think less. Do more. The ezWay.


#### Demo / Example / How To

- See the example in the folder: product-packaging.

- TODO: Example for WPezPlugins


####Share This Repo

+ [Twitter](http://twitter.com/share?url=https%3A%2F%2Fgithub.com%2FWPezClasses%2Fclass-wp-ezclasses-transients-helpers-1%2F&text=%23WordPress%20%3D%3E%20WPezClasses%20-%20Transients%3A%20Helpers%201%20%23GitHub%20%40WPezClasses%20Please%20RT)
+ [Google+](https://plus.google.com/share?url=https%3A%2F%2Fgithub.com%2FWPezClasses%2Fclass-wp-ezclasses-transients-helpers-1%0A&title=WordPress%20%3D%3E%20WPezClasses%20-%20Transients%3A%20Helpers%201)
+ [Facebook](http://www.facebook.com/sharer.php?u=https://github.com/WPezClasses/class-wp-ezclasses-transients-helpers-1&t=WordPress => WPezClasses: Transients Helpers 1)
+ [LinkedIn](http://www.linkedin.com/shareArticle?mini=true&url=https%3A%2F%2Fgithub.com%2FWPezClasses%2Fclass-wp-ezclasses-transients-helpers-1&title=WordPress%20%3D%3E%20WPezClasses%20-%20Transients%3A%20Helpers%201%20&summary=WordPress%20Transients%20done%20The%20ezWay.%0A)
