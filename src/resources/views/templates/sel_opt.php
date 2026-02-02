<?php
$par='';
if(is_object($data)){
    $field=$data->list_fields();
    if($required && $data->num_rows()==1) $sel='selected';else{
        $sel='';
        if(!$required) echo '<option value selected>- Select option -</option>';
        if(isset($all_option) && $all_option) echo '<option value="[[ALL]]" selected>- ALL -</option>';
    }
    if(isset($add_options) && count($add_options)>0){
        foreach($add_options as $opt){
            echo '<option value="'.$opt['id'].'">'.$opt['caption'].'</option>';
        }
    }
    if(in_array('group',$field)){
        $c_grp='';
        $increment = 0;
        foreach($data->result_array() as $d){
            $increment++;

            $_par = '';

            if(!empty($d['param'])) $_par .= $d['param'];
            if(!empty($d['tags'])) $_par .= " data-tags='".$d['tags']."'";
            if(!empty($d['json_params'])) $_par .= ' data-json="'.urlencode($d['json_params']).'"';
            if($c_grp==''){
                echo '<optgroup label="'.$d['group'].'">';
                $c_grp=$d['group'];
            }else
            if($d['group']!=$c_grp){
                echo '</optgroup>';
                echo '<optgroup label="'.$d['group'].'">';
                $c_grp=$d['group'];
            }
            if($encrypt) $id_=base64_encode($d['id']);
            else if($urlencode) $id_=urlencode($d['id']);
            else $id_=$d['id'];

            // working with caption
            $caption = $d['caption'];
            $caption = str_replace('[[inc]]', $increment, $caption);

            echo '<option value="'.$id_.'" '.$_par.'>'.$caption.'</option>';
        }
    }else{
        $increment = 0;
        foreach($data->result_array() as $d){
            $increment++;

            if($encrypt) $id_=base64_encode($d['id']);
            else if($urlencode) $id_=urlencode($d['id']);
            else $id_=$d['id'];
            if(!empty($d['param'])) $par .= $d['param'];
            if(!empty($d['tags'])) $par .= " data-tags='".$d['tags']."'";

            // working with caption
            $caption = $d['caption'];
            $caption = str_replace('[[inc]]', $increment, $caption);

            echo '<option value="'.$id_.'" '.$par.'>'.$caption.'</option>';
        }
    }
}else if(is_array($data) && count($data)>0){
    $req = '';

    if($required && count($data)==1) $req='selected="selected"'; else {
        if($required){
            $req = 'selected="selected"';
            $required = false;
        } else if(isset($placeholder) && $placeholder) echo '<option value selected>- Select option -</option>';
    }

    if(isset($add_options) && count($add_options)>0){
        foreach($add_options as $opt){
            echo '<option value="'.$opt['id'].'">'.$opt['caption'].'</option>';
        }
    }

    if(is_object($data[0])) $data[0] = (array) $data[0];

    if(isset($data[0]['group'])){
        $c_grp='';
        $increment = 0;
        foreach($data as $d){
            if(is_object($d)) $d = (array) $d;
            $increment++;

            if(!empty($d['param'])) $par .= $d['param'];
            if(!empty($d['tags'])) $par .= " data-tags='".$d['tags']."'";
            if(!empty($d['json_params'])) $par .= ' data-json="'.urlencode($d['json_params']).'"';
            if($c_grp==''){
                echo '<optgroup label="'.$d['group'].'">';
                $c_grp=$d['group'];
            }else
            if($d['group']!=$c_grp){
                echo '</optgroup>';
                echo '<optgroup label="'.$d['group'].'">';
                $c_grp=$d['group'];
            }
            if($encrypt) $id_=base64_encode($d['id']);
            else if($urlencode) $id_=urlencode($d['id']);
            else $id_=$d['id'];

            // working with caption
            $caption = $d['caption'];
            $caption = str_replace('[[inc]]', $increment, $caption);

            echo '<option value="'.$id_.'" '.$par.'>'.$caption.'</option>';
        }
    } else {
        foreach($data as $d){
            if(is_object($d)) $d = (array) $d;
            if(!empty($d['param'])) $par .= $d['param'];
            if(!empty($d['tags'])) $par .= " data-tags='".$d['tags']."'";
            if($encrypt) $id_=base64_encode($d['id']);
            else if($urlencode) $id_=urlencode($d['id']);
            else $id_=$d['id'];
            echo '<option value="'.$id_.'" '.$par.' '.$req.'>'.$d['caption'].'</option>';
        }
    }
}

?>