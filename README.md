# laravel-tracable

This library provides a mechanism to allow on demand logging of any information to a number of destinations from anywhere in the code.

Why not just use the default Monolog logger that comes out of the box with Laravel?
This is more of a tool for writing out debugging or verbose information that normally would not go in an application log. Information that can assist with debugging problems or monitoring the application on demand.
You would probably use this in situations where you would otherwise reach for something like Laravel's `dump()` helper.
The problem with the dump helper is that you don't really want to leave that in production code and cause it to spew output all the time.

Here is an example:

You have a console app that you want to run in verbose mode. What if you want to trace data that gets created inside of code that does not have access to the console IO facility? You could pass the IO facility into your classes. This gets really messy with deeply nested structures.

Here is how tracable works
```
// In any class that you want to trace output from

class Foo
{
    use Traceable;
    
    protected function bar()
    {
        $msg = 'A very important message I want to see in the terminal';
        $this->trace($msg, Trace::INFO);
        
        // You can also trace objects and arrays (anything you can pass to dump())
        $this->trace(['foo' => 'bar'], Trace::ERROR);
    }
}
```

Create a console command and extend it from `TraceableCommand` instead of `Command`.
```
class MyCommand extends TracableCommand
{
}
```

To enable tracing to stdout
```
$ php artisan my:command -t
```

Extending the command from TracableCommand will add a `-t` or `--trace` option that sends any traced data to standard out. It does this by registering the `TraceStdOut` listener.
To send the trace to a different destination simply implement a custom listener that listenes for `Trace` events.

