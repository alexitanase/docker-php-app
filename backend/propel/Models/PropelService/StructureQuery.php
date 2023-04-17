<?php

namespace PropelService;

use PropelService\Base\StructureQuery as BaseStructureQuery;

/**
 * Skeleton subclass for performing query and update operations on the 'structure' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 */
class StructureQuery extends BaseStructureQuery
{
    public function getAlTreeStructure($isTree = false, $parent = ''){

        $format = [];

        if($parent == ''){
            array_push($format, [
                "IntId" => 0,
                "Code" => '',
                "Name" => 'Owner',
                "Parent" => '',
                "Childrens" => []
            ]);
            $results = StructureQuery::create()->filterByParent($parent)->find();
        }else{
            $results = StructureQuery::create()->filterByCode($parent)->find();
        }

        if($results->count() == 0){
            return $format;
        }

        foreach ($results as $structure){
            if(!$isTree){
                array_push($format, [
                    "IntId" => $structure->getIntId(),
                    "Code" => $structure->getCode(),
                    "Name" => $structure->getName(),
                    "Parent" => $structure->getParent(),
                    "Childrens" => $this->getAllSubTreeStructure($isTree, $structure->getCode())
                ]);
            }else{
                array_push($format, [
                    "Code" => strtoupper($structure->getCode()),
                    "Childrens" => $this->getAllSubTreeStructure($isTree, $structure->getCode())
                ]);
            }
        }

        return $format;
    }

    public function getAllSubTreeStructure($isTree = false, $parent = ''){

        $format = [];

        $results = StructureQuery::create()->filterByParent($parent)->find();

        if($results->count() == 0){
            return array();
        }

        foreach ($results as $structure){
            if(!$isTree){
                array_push($format, [
                    "IntId" => $structure->getIntId(),
                    "Code" => $structure->getCode(),
                    "Name" => $structure->getName(),
                    "Parent" => $structure->getParent(),
                    "Childrens" => $this->getAllSubTreeStructure($isTree, $structure->getCode())
                ]);
            }else{
                array_push($format, [
                    "Code" => strtoupper($structure->getCode()),
                    "Childrens" => $this->getAllSubTreeStructure($isTree, $structure->getCode())
                ]);
            }
        }

        return $format;
    }

    public function selectorOptions($list, $left = '', $exclude = false){
        $html = '';
        $html_left = '';
        $count = substr_count($left, '-');
        $count = ($count+1);
        for ($x = 0; $x < $count; $x++){
            $html_left .= '-';
        }
        foreach ($list as $index => $value){
            if($exclude === false || $exclude !== $value['Code']){
                $html .= '<option value="'.$value['Code'].'">'.($value['Code']===''?'':$html_left.' ').$value['Name'].'</option>';
                $html .= $this->selectorOptions($value['Childrens'], $html_left, $exclude);
            }
        }
        return $html;
    }

    public function getArrayStructures(string $structure, $array = []){

        array_push($array, $structure);

        $results = StructureQuery::create()->filterByParent($structure)->find();

        if($results->count() == 0){
            return $array;
        }

        foreach ($results as $structure){
            array_push($array, $structure->getCode());
            $more = $this->getArrayStructures($structure->getCode(), $array);
            $array = array_merge($array, $more);
        }

        return $array;
    }
}
