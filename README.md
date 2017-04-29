This is a Drupal 8 module that replaces all HTML error responses (like 403 and 404 pages, etc.) with images from HTTP Status Dogs. I expect it to become more popular than Views.

## Features/FAQs

### Why has my entire website has been replaced with dogs!?
Every April 1st (server time) ALL HTML responses, including 2xx responses, are replaced by dogs! This is hard-coded behavior. So if you're using this module on a production site, you might want to turn this module off on April 1st. Or, y'know, look at dogs all day. If this is happening to you and it's NOT April 1st, you have found a bug and you should file an issue.

### Why did I get a 5xx image for a 404 response?
This is a feature called "wat mode" (enabled by default). If you enable wat mode, responses that are replaced by dogs will use a random image, just for variety. So a 404 response might show a 501 image, or 302, or 420, or...take your pick. To disable wat mode, set the http_status_dogs.settings.wat configuration option to false.

### But I'm a cat person.
My condolences.

### No but srsly, how can I use a different set of images?
Sure! Just change the http_status_dogs.settings.images_dir config option to the URI of the directory that contains your image library.

### Is this module tested?
I aim to provide 100% test coverage before rolling a stable release. Because even ~~stupid~~the best modules should be thoroughly tested.

## Why isn't this on drupal.org?
Because this module includes all of the images on httpstatusdogs.com. It's not yet clear if that constitutes copyright violation, so I'm keeping it on GitHub to be safe(r) for the time being. I've sent a tweet to the creator of HTTP Status Dogs requesting permission to package the images. If he's OK with it, I'll post this on drupal.org.
