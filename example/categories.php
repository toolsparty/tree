<?php

include_once '../src/Configurable.php';
include_once '../src/TreeException.php';
include_once '../src/Tree.php';

use ToolsParty\Tree\Tree;
use ToolsParty\Tree\TreeException;
use ToolsParty\Tree\Configurable;

class Categories extends Tree {
    use Configurable;
}

$categories = [
    [
        'cid' => 1,
        'sub_id' => 0,
        'name' => 'Category 1'
    ],
    [
        'cid' => 2,
        'sub_id' => 0,
        'name' => 'Category 2'
    ],
    [
        'cid' => 3,
        'sub_id' => 1,
        'name' => 'Category 3'
    ],
    [
        'cid' => 4,
        'sub_id' => 3,
        'name' => 'Category 4'
    ],
    [
        'cid' => 5,
        'sub_id' => 3,
        'name' => 'Category 5'
    ],
    [
        'cid' => 6,
        'sub_id' => 2,
        'name' => 'Category 6'
    ],
    [
        'cid' => 7,
        'sub_id' => 5,
        'name' => 'Category 7'
    ],
    [
        'cid' => 8,
        'sub_id' => 7,
        'name' => 'Category 8'
    ],
];

$categoriesTree = new Categories([
    'id' => 'cid',
    'parent' => 'sub_id'
]);

try {
    if ($categoriesTree->prepareData($categories)) {
        $tree = $categoriesTree->getTree(0);

        var_dump($tree);

        $output = '';

        foreach ($tree as $category) {
            $output .= $category['name'] . PHP_EOL;

            if (!empty($category['children'])) {
                $output .= children($category['children'], '-');
            }
        }

        echo $output . PHP_EOL;
    } else {
        print_r($categoriesTree->getErrors());
    }
} catch (TreeException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

function children($categories, $sep = '')
{
    $output = '';

    foreach ($categories as $category) {
        $output .= $sep . $category['name'] . PHP_EOL;

        if (!empty($category['children'])) {
            $output .= children($category['children'], $sep . '-');
        }
    }

    return $output;
}