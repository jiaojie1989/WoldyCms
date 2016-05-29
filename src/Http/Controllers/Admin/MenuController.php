<?php
namespace Woldy\Cms\Http\Controllers\Admin;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;
use App\Http\Requests;
use Woldy\Cms\Http\Controllers\Controller;
use Woldy\Cms\Models\MenuModel;
use Redirect;
use Tpl;
use Form;

class MenuController extends Controller
{
    public function getList(){
//private $Native=["area","text","password","email","file","textarea","select","checkbox","radio","switch"];
    	$config=[
    		[
    			'type'=>'form',
    			'attr'=>[
           			'action'=>'/admin/menu/item',
            		'method'=>'post',
            		'class'=>"validate",
            		'novalidate'=>"novalidate"
    			],
    		],

    		[
    			'type'=>'text',
    			'label'=>'标签',
    			'attr'=>[
           			'name'=>'title',
           			'id'=>'title',
           			'data-validate'=>'required',
					'data-message-required'=>'请输入标签名称！' 
 
    			],
    		],
 
    		[
    			'type'=>'text',
    			'label'=>'连接',
    			'attr'=>[
           			'name'=>'url',
           			'id'=>'url',
    			],
    		],

    		[
    			'type'=>'text',
    			'label'=>'图标',
    			'attr'=>[
           			'name'=>'icon',
           			'id'=>'icon',
    			],
    		],

    		[
    			'type'=>'text',
    			'label'=>'class',
    			'attr'=>[
           			'name'=>'class',
           			'id'=>'class',
    			],
    		],

    		[
    			'type'=>'hidden',
    			'attr'=>[
           			'name'=>'id',
           			'id'=>'id',
           			'value'=>'0'
    			],
    		],

    		[
    			'type'=>'hidden',
    			'attr'=>[
           			'name'=>'type',
           			'id'=>'type',
           			'value'=>intval(Input::get('type'))
    			],
    		],

    		[
    			'type'=>'submit',
    			'label'=>'增加',
    			'attr'=>[
    				'class'=>'btn btn-primary btn-single pull-right',
           			'id'=>'submit',
    			],
    		],

     		[
    			'type'=>'endform'
    		],

    	];


        $cfgform['attr']=[
            'action'=>'/admin/menu/list',
            'mothod'=>'post'
        ];

        $listform=Form::build($config);

    	//Form::init($cfgform)->show();
    	//$form->show();
    	//Menu::show();
    	return Tpl::admin('menu.list',['listform'=>$listform]);
    }


    public function postSort(){
    	$pids=[];
		$sortstr=Input::get('sortstr');
		$items=explode("\n", $sortstr);
		$idx=0;
		foreach ($items as $item) {
			$path='0';
			$idx++;
			if(empty($item)){
				return;
			}
			$item=explode('|', $item);
			$id=$item[0];
			$level=$item[1];
			$pids[$level]=$id;
			if($level==0){
				$pid=0;
			}else{
				$pid=$pids[$level-1];
			}

			for($i=0;$i<=$level;$i++){
				$path.='-'.$pids[$i];
			}

			MenuModel::where('id', $id)
			->update([
				'pid' => $pid,
				'idx'=>$idx,
				'path'=>$path

			]);
		}
		echo "ok";
    }

    public function getItem(){
    	$id=Input::get('id');
    	$item=\Woldy\Cms\Models\MenuModel::find($id);
    	return response()->json($item);
    }


    public function postItem(){
    	$id=intval(Input::get('id'));
    	if($id==0){
        	$item = new \Woldy\Cms\Models\MenuModel;
        	$item->pid=0;
        	$item->display=1;
        	$item->enable=1;
    	}else{
    		$item = \Woldy\Cms\Models\MenuModel::find($id);

    	}
    	$item->title = Input::get('title');
		$item->url = Input::get('url');
		$item->class = Input::get('class');
		$item->icon = Input::get('icon');
		$item->type = intval(Input::get('type'));
		$item->save();
 
    	return Redirect::back();
    }
}