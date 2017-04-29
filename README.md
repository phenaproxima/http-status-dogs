This is a Drupal 8 module that replaces all HTML error responses (like 403 and 404 pages, etc.) with images from HTTP Status Dogs. I expect it to become more popular than Views.

## Probable FAQs

### Why has my entire website has been replaced with dogs?!
Every day, on the first day of April (server time), all 200 HTML responses are replaced by dogs! This is hard-coded behavior. So if you're using this module on a production site, you might want to turn this module off for April Fools Day. Or, y'know, spend the day looking at dogs. If this is happening to you and it's NOT April Fools Day, you have either found a bug and should file an issue, or you have the coding chops to fix it yourself ;-)

### Why did I get a 5xx image for a 404 response?
This is a feature called "wat mode" (enabled by default). If you enable wat mode, responses that are replaced by dogs show a totally random image, just for variety. So a 404 response might show a 501 image, or a 503 might show a 200 image, and so forth into a veritable kaleidoscope of canine combinations. To disable this, set the ```http_status_dogs.settings.wat``` configuration option to false.

### But I'm a cat person.
My condolences.

### No but srsly, can I use a different set of images?
Sure! Just change the ```http_status_dogs.settings.images_dir``` config option to the URI of the directory that contains your image library. The images you want to use must be named for the appropriate status code(s), e.g. 301.gif, 401.png, 502.jpg, etc.

### Is this module tested?
I aim to provide 100% test coverage before rolling a stable release. Because even the ~~stupidest~~ best modules should be thoroughly tested.

### Why isn't this on drupal.org?
Because this module includes all of the images on httpstatusdogs.com. It's unclear if that constitutes copyright violation, so I'm keeping it on GitHub to be safe(r) for the time being. I've sent a tweet to the creator of HTTP Status Dogs requesting permission to include his images. If he's OK with that, I'll post this on drupal.org.
