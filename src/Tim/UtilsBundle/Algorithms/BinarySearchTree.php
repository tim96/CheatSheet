<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 7/19/2016
 * Time: 9:02 PM
 */

namespace Tim\UtilsBundle\Algorithms;

/**
 * Small description:
 *
 * In computer science, binary search trees (BST), sometimes called ordered or sorted binary trees, are a particular
 * type of containers: data structures that store "items" (such as numbers, names etc.) in memory. They allow fast
 * lookup, addition and removal of items, and can be used to implement either dynamic sets of items, or lookup tables
 * that allow finding an item by its key (e.g., finding the phone number of a person by name).
 *
 * Binary search trees keep their keys in sorted order, so that lookup and other operations can use the principle of
 * binary search: when looking for a key in a tree (or a place to insert a new key), they traverse the tree from root
 * to leaf, making comparisons to keys stored in the nodes of the tree and deciding, based on the comparison, to
 * continue searching in the left or right subtrees. On average, this means that each comparison allows the operations
 * to skip about half of the tree, so that each lookup, insertion or deletion takes time proportional to the logarithm
 * of the number of items stored in the tree. This is much better than the linear time required to find items by key in
 * an (unsorted) array, but slower than the corresponding operations on hash tables.
 *
 * Several variants of the binary search tree have been studied in computer science; this article deals primarily with
 * the basic type, making references to more advanced types when appropriate.
 *
 * Binary search requires an order relation by which every element (item) can be compared with every other element
 * in the sense of a total preorder. The part of the element which effectively takes place in the comparison is
 * called its key. Whether duplicates, i.e. different elements with same key, shall be allowed in the tree or not,
 * does not depend on the order relation, but on the application only.
 *
 * If you use an Array, access is O(1) so it seems like a good idea at first, but that's only in cases where you know
 * the index of the value you want to access. Finding that index means searching the entire array, which is really O(n).
 * If you use a Hash Table, the cost of search is O(1) so it seems like a better idea, but the cost of deletion and
 * insertion can be O(n) in the worst case scenario (where you have 100% collision).
 *
 * The best answer is to use a BST or Binary Search Tree, because they have average O(log n) for search, insertion,
 * and deletion. That is assuming it's a self-balancing tree implementation.
 *
 *
 */
class BinarySearchTree
{
    /**
     * @var TreeNode
     */
    private $root;

    /**
     * @var integer
     *
     * Optional variable for save count elements in tree
     */
    private $count;

    public function __construct()
    {
        $this->root = null;
        $this->count = 0;
    }

    public function create($info)
    {
        if ($this->root === null) {
            $this->root = new TreeNode($info);
            $this->count++;
        } else {
            $current = $this->root;

            while(true) {
                if ($info < $current->info) {
                    if ($current->left) {
                        $current = $current->left;
                    } else {
                        $current->left = new TreeNode($info, $current);
                        $this->count++;
                        break;
                    }
                } elseif ($info > $current->info) {
                    if ($current->right) {
                        $current = $current->right;
                    } else {
                        $current->right = new TreeNode($info, $current);
                        $this->count++;
                        break;
                    }
                } else {
                    break;
                }
            }
        }

        return $this;
    }

    public function search($value)
    {
        $current = $this->root;

//        $i = 0;
        while($current) {
//            echo $i++.'\n';
            if ($value > $current->info) {
                $current = $current->right;
            } elseif ($value < $current->info) {
                $current = $current->left;
            } else {
                break;
            }
        }

        return $current;
    }

    public function delete($value)
    {
        $node = $this->search($value);
        if ($node) {
            $node->delete();
            $this->count--;
            return true;
        }

        return false;
    }

    public function min()
    {
        $current = $this->root;

        while($current->left) {
            if (!$current->left) {
                break;
            }

            $current = $current->left;
        }

        return $current;
    }

    public function minValue()
    {
        if (!$this->root) {
            throw new \RuntimeException('Tree root is empty!');
        }

        $node = $this->root;
        return $node->min();
    }

    public function max()
    {
        $current = $this->root;

        while($current->right) {
            if (!$current->right) {
                break;
            }

            $current = $current->right;
        }

        return $current;
    }

    public function maxValue()
    {
        if (!$this->root) {
            throw new \RuntimeException('Tree root is empty!');
        }

        $node = $this->root;
        return $node->max();
    }

    public function getPreOrder()
    {
        $this->preOrder($this->root);
    }

    public function getInOrder()
    {
        $this->inOrder($this->root);
    }

    public function getPostOrder()
    {
        $this->postOrder($this->root);
    }

    /**
     * @param TreeNode $node
     */
    private function preOrder($node)
    {
        echo $node. ' ';

        if ($node->left) {
            $this->preOrder($node->left);
        }

        if ($node->right) {
            $this->preOrder($node->right);
        }
    }

    /**
     * @param TreeNode $node
     */
    private function inOrder($node)
    {
        if ($node->left) {
            $this->inOrder($node->left);
        }

        echo $node. ' ';

        if ($node->right) {
            $this->inOrder($node->right);
        }
    }

    /**
     * @param TreeNode $node
     */
    private function postOrder($node)
    {
        if ($node->left) {
            $this->inOrder($node->left);
        }

        if ($node->right) {
            $this->inOrder($node->right);
        }

        echo $node. ' ';
    }

    /**
     * @param TreeNode $node
     *
     * @return bool|null|TreeNode
     */
    public function readList($node = null)
    {
        if (null === $node) {
            $node = $this->root;
        }

        if (!$node) {
            return false;
        }

        if ($node->left) {
            $this->readList($node->left);
        }

        if ($node->right) {
            $this->readList($node->right);
        }

        return $node;
    }

    public function isEmpty()
    {
        return $this->root === null;
    }

    public function getItems()
    {
        return $this->count;
    }
}