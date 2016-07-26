<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 7/26/2016
 * Time: 9:05 PM
 */

namespace Tim\UtilsBundle\Algorithms;

/**
 * Class Queue
 *
 * A FIFO queue (or just a queue) is a collection that is based on the first-in-first-out (FIFO) policy.
 *
 * http://php.net/manual/ru/class.splqueue.php
 *
 * @package Tim\UtilsBundle\Algorithms
 */
class Queue
{
    private $queue;

    public function __construct($queue_items = array())
    {
        if (is_array($queue_items)) {
            $this->queue = $queue_items;
        } else {
            $this->queue = array();
        }
    }

    public function clear()
    {
        $this->queue = array();
    }

    public function contains($value)
    {
        foreach ($this->queue as $item) {
            if ($item === $value) {
                return true;
            }
        }

        return false;
    }

    public function enqueue($value)
    {
        $this->queue[] = $value;
    }

    public function dequeue()
    {
        return array_shift($this->queue);
    }

    public function peek()
    {
        // Why I need add this ?
        // Without this line this code create error: $queue->peek(). Return false instead of first element
        reset($this->queue);

        return current($this->queue);
    }

    public function isEmpty()
    {
        return count($this->queue) === 0;
    }

    public function count()
    {
        return count($this->queue);
    }
}