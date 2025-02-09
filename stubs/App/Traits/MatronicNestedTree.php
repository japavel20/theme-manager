<?php

namespace App\Traits;

trait MatronicNestedTree
{
    public $defaultJSTreeIcon = 'fa fa-folder text-success';

    public function prepareJSTreeData($nodes, $label = "title")
    {
        if (!empty($nodes)) {
            $nodes[0]['icon']   =   $this->defaultJSTreeIcon;
            $nodes[0]['state']  =   [
                'selected'  =>  true,
                'opened'    =>  true,
            ];
        }

        $traverse = function (&$nodes) use (&$traverse, &$label) {
            foreach ($nodes as $key => $node) {
                $nodes[$key]['id']      =   $node['id'];
                $nodes[$key]['text']    =   $node[$label];
                $nodes[$key]['icon']    =   $this->defaultJSTreeIcon;

                unset($nodes[$key][$label]);
                unset($nodes[$key]['parent_id']);
                unset($nodes[$key]['_lft']);
                unset($nodes[$key]['_rgt']);
                unset($nodes[$key]['created_at']);
                unset($nodes[$key]['updated_at']);

                $traverse($nodes[$key]['children']);
            }
        };

        $traverse($nodes);

        return $nodes;
    }

    public function prepareNestedSetData($nodes, $label)
    {
        $whitelistedKeys = [$label, 'children'];

        $traverse = function (&$nodes) use (&$traverse, &$whitelistedKeys, &$label) {
            foreach ($nodes as $key => $node) {
                $nodes[$key][$label] = $node['text'];

                foreach ($nodes[$key] as $index => $value) {
                    if (!in_array($index, $whitelistedKeys)) {
                        unset($nodes[$key][$index]);
                    }
                }

                $traverse($nodes[$key]['children']);
            }
        };

        $traverse($nodes);

        return $nodes;
    }
}
