<?php

namespace NewsProject\Helpers;

class FilterHelper
{


   public function getFilter($rubric):array
   {

       if($rubric==''){
            $filter = ["!PROPERTY_CARUSEL_VALUE" => 'Y'];
       }
       else {
            $filter = ["SECTION_CODE" => $rubric];
       }

       return $filter;
   }
    public function getSort($sortVar):array
    {

        if($sortVar=='new'){
            $sort = ["ACTIVE_FROM","DESC"];
        }

        else {
            switch ($sortVar){
                case "old":
                    $sort = ["ACTIVE_FROM","ASC"];
                    break;
                case "popular":
                    $sort = ["SHOW_COUNTER","DESC"];
                    break;
                case "unpopular":
                    $sort = ["SHOW_COUNTER","ASC"];
                    break;
                default:
                    $sort = ["ACTIVE_FROM","DESC"];
                    break;
            }
        }

        return $sort;
    }
}
