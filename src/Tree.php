<?php

namespace ToolsParty\Tree;

/**
 * Class Tree
 * @package ToolsParty\Tree
 */
class Tree
{
    /**
     * @var string
     */
    public $parent = 'parent_id';

    /**
     * @var string
     */
    public $id = 'id';

    /**
     * @var array
     */
    protected $treeData = [];

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @param array $items
     * @param bool $checkData
     * @return bool
     */
    public function prepareData(array $items, $checkData = false)
    {
        if ($checkData) {
            foreach ($items as $key => $item) {
                if ($this->checkItem($item, $key)) {
                    $this->push($item);
                }
            }

            return empty($this->errors);
        } else {
            try {
                foreach ($items as $item) {
                    $this->push($item);
                }
            } catch (\Exception $exception) {
                $this->treeData = [];
                return false;
            }
        }

        return true;
    }

    /**
     * @return array
     */
    public function getTreeData() {
        return $this->treeData;
    }

    /**
     * @return array
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * @param $parent
     * @return array
     */
    public function getTree($parent) {
        $tree = [];
        $i = 0;

        if (isset($this->treeData[$parent])) {
            foreach ($this->treeData[$parent] as $item) {
                $tree[$i] = $item;

                if (isset($this->treeData[$item[$this->id]])) {
                    $tree[$i]['children'] = $this->getTree($item[$this->id]);
                }

                $i++;
            }
        }

        return $tree;
    }

    /**
     * @param $item
     */
    protected function push($item) {
        if (isset($item[$this->parent]) && isset($item[$this->id])) {
            $this->treeData[$item[$this->parent]][$item[$this->id]] = $item;
        }
    }

    /**
     * @param array $item
     * @param $key
     * @return bool
     * @throws TreeException
     */
    protected function checkItem(array $item, $key) {
        if (!is_array($item)) {
            throw new TreeException('Item should be array');
        }

        if (!isset($item[$this->id])) {
            $this->errors[$key] = "'{$this->id}' is required (key: $key)";
        }

        if (!isset($item[$this->parent])) {
            $this->errors[$key] = "'{$this->parent}' is required (key: $key)";
        }

        return empty($this->errors);
    }
}