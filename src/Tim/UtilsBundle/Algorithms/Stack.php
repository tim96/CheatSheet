<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 7/26/2016
 * Time: 10:10 PM
 */

namespace Tim\UtilsBundle\Algorithms;

/**
 * Class Stack
 *
 * A stack is a collection that is based on the last-in-first-out (LIFO) policy.
 *
 * http://php.net/manual/ru/class.splstack.php
 *
 * @package Tim\UtilsBundle\Algorithms
 */
class Stack
{
    private $stack;

    private $limit;

    public function __construct($limit = 10)
    {
        $this->limit = $limit;
        $this->stack = array();
    }

    public function pop()
    {
        return array_pop($this->stack);
    }

    public function push($value)
    {
        if (count($this->stack) < $this->limit) {
            // array_push($this->stack, $value);
            $this->stack[] = $value;
        } else {
            throw new \RuntimeException('Stack is full!');
        }
    }

    public function top()
    {
        return end($this->stack);
    }

    public function contains($value)
    {
        foreach ($this->stack as $item) {
            if ($item === $value) {
                return true;
            }
        }

        return false;
    }

    public function isEmpty()
    {
        return count($this->stack) === 0;
    }

    public function count()
    {
        return count($this->stack);
    }

    public function clear()
    {
        $this->stack = array();
    }
}