<?php
namespace Woldy\Cms\Components\Form;
use Woldy\Cms\Components\Form\Element\Native;
use Woldy\Cms\Components\Form\Element\Advanced;
use Woldy\Cms\Components\Form\Element\Masks;
use Woldy\Cms\Components\Form\Element\Misc;

use DB;
use Request;
class Form{
    private $html='';
    private $js_list=[];
    private $css_list=[];
    private $code_list=[];
    private $config_tpl=[
        'attr'=>[
            'id'=>'',
        ]
    ];

	private $Native=["area","text","password","email","file","textarea","select","checkbox","radio","switch"];


//
    public static function init($config){
        $form=new Form();
        $form->form($config);
        return $form;
    }

    public static function build($config){
        $form=new Form();
        $formConfig=$config[0];
        $fromstyle=isset($formConfig['class'])?$formConfig['class']:'';

        foreach ($config as $item) {
            $item['class']=isset($item['class'])?$item['class']:'';
            $item['class_label']=$fromstyle=='form-horizontal'?'col-sm-2':'';
            $item['class_div']=$fromstyle=='form-horizontal'?'col-sm-10':'';

            $form->$item['type']($item);
        }
        return $form->get();
    }


    public static function attr($attr){
        $result='';
        if(is_array($attr)){
            foreach ($attr as $key => $value) {
                $result.=" {$key}=\"{$value}\" ";
            }
        }else{
            $result=$attr;
        }
        return $result;
    }


    public function end(){
        return $this->endform();
    }

    public function show(){
        echo $this->html;
    }

    public function get(){
        return $this->html;
    }

    public function form($config){
        $this->html.=Native::form($config);
        return $this;
    }

    public function endform(){
        $this->html.=Native::endform();
        return $this;        
    }





    //-------------------
    //
    public function separator(){
        $this->html.=Native::separator();
        return $this;         
    }
    public function text($config){
        $this->html.=Native::text($config);
        return $this; 
    }

    public function iSwitch($config){
        $this->html.=Native::iSwitch($config);
        return $this; 
    }

    public function button($config){
        $this->html.=Native::button($config);
        return $this;         
    }

    public function submit($config){
        $this->html.=Native::submit($config);
        return $this;         
    }

    public function hidden($config){
        $this->html.=Native::hidden($config);
        return $this;         
    }

}