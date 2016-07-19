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
        } else {
            $current = $this->root;

            while(true) {
                if ($info < $current->info) {
                    if ($current->left) {
                        $current = $current->left;
                    } else {
                        $current->left = new TreeNode($info);
                        $this->count++;
                        break;
                    }
                } elseif ($info > $current->info) {
                    if ($current->right) {
                        $current = $current->right;
                    } else {
                        $current->right = new TreeNode($info);
                        $this->count++;
                        break;
                    }
                } else {
                    break;
                }
            }
        }
    }

    public function search($value)
    {
        $current = $this->root;

        while($current) {
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

    public function isEmpty()
    {
        return $this->root === null;
    }

    public function getItems()
    {
        return $this->count;
    }
}