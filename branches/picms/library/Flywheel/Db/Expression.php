<?php
namespace Flywheel\Db;
class Expression {
    public $expression;

    public function __construct($expression)
    {
        $this->expression = $expression;
    }

}
