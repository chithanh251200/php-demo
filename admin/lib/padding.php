<?php
    function padding($page , $total , $base =""){

        $str_ling = '';
    
        $str_ling .="<ul class='pagination'>";

        if($page >= 1){
            if($page > 1){
                $after = $page - 1;
                $str_ling .="<li class='page-item'>";
                    $str_ling .= "<a class='page-link' href='{$base}&page={$after}'>Previous</a>";
                $str_ling .= "</li>";
            }
            else{
                $str_ling .="<li class='page-item'>";
                $str_ling .= "<a class='page-link' href='{$base}&page={$page}'>Previous</a>";
                $str_ling .= "</li>";
            }
        }
       
        for($i = 1 ; $i <= $total ; $i++){
            // kiểm tra nếu khác $page
            if($i != $page){
                if($i > $page - 3 && $i < $page + 3 ){
                    $str_ling .="<li class='page-item'><a class='page-link' href='{$base}&page={$i}'>{$i}</a></li>";
                }
            }else{
                $str_ling .="<li class='page-item'><a class='page-link' href='{$base}&page={$i}'>{$i}</a></li>";
            }   
           
        }
   


        if($page <= $total ){
            if($page < $total){
                $next = $page + 1;
                $str_ling .= "<li class='page-item'>";
                    $str_ling .="<a class='page-link' href='{$base}&page={$next}'>Next</a>";
                $str_ling .="</li>";
            }else{
                $str_ling .= "<li class='page-item'>";
                    $str_ling .="<a class='page-link' href='{$base}&page={$page}'>Next</a>";
                $str_ling .="</li>";
            }
           
        }
     

        $str_ling .= "</ul>";

        return $str_ling;
    }
?>