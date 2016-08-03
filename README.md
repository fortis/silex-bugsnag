#Silex 2 Service Provider for Bugsnag

[Bugsnag](https://bugsnag.com) captures errors in real-time from your web,
mobile and desktop applications, helping you to understand and resolve them
as fast as possible. [Create a free account](https://bugsnag.com) to start
capturing errors from your applications.

## Usage
### Register

```php
$app->register(new \Bugsnag\Silex\Provider\BugsnagServiceProvider, array(
    'bugsnag.options' => array(
        'apiKey' => '06615ad354054619aa3d601ea89af945'
    )
));
```

Thats it, all exceptions will be sent to Bugsnag dashboard.

If you want to access the bugsnag client directly (for example, to configure it
or to send a crash report manually), you can use `$app['bugsnag']`.
