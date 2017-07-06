<?php

namespace app\admin\controller;
use app\admin\model\Category as Column_model;
use app\admin\model\Posts as Posts_model;
use app\admin\model\Tags as Tags_model;
class Article extends Base
{
    public function articleList($id = 0){
        //分类
        $type = new Column_model();
        $res = $type->select();
        $this->assign('res', json_encode($res));

        //文章列表
        $posts = new Posts_model();
        if($id == 0){
            $list = $posts->order('post_date', 'desc')->select();
        }else{
            $list = $posts->where('post_category', $id)->order('post_date', 'desc')->select();
        }
        foreach ($list as $k => $v){
            $list[$k] = $list[$k]->toArray();
            $list[$k]['category'] = $v->category->cname;
            $tagArr = explode(',', trim($v['tags'], ','));
            $list[$k]['tags'] = '';
            foreach ($tagArr as $kk => $vv){
                if(!empty($vv)){
                    $list[$k]['tags'][] = Tags_model::get($vv)->toArray();
                }
            }
        }
        $this->assign('list', $list);
        return $this->fetch('list');
    }

    public function add(){
        //分类
        $type = new Column_model();
        $res = $type->select();
        $this->assign('column', $res);
        return $this->fetch('add');
    }
    public function addAct(){
        $posts = new Posts_model();
        if(input('post.id')){
            //编辑
            $posts->save([
                'post_title' => input('post.title'),
                'post_content' => input('post.editorValue'),
                'post_category' => input('post.column'),
                'status' => input('post.status'),
            ], ['id'=>input('post.id')]);

            echo "<script>window.parent.location.reload();</script>";

        }else{
            //新增
            //tag处理
            $inputTag = str_replace('，', ',', input('post.tags'));
            $tagArr = array_unique(explode(',', trim($inputTag, ',')));
            $tagIdStr = '';
            foreach ($tagArr as $v){
                if(!empty($v)){
                    if(empty($tagIdStr)){
                        $tagIdStr = ',';
                    }
                    $tag = new Tags_model();
                    $res = $tag->where('name', $v)->find();
                    if($res){
                        $tag->where('name', $v)->setInc('num');
                        $tagIdStr .= $res->id.",";
                    }else{
                        $tag->save([
                            'name' => $v
                        ]);
                        $tagIdStr .= $tag->id.",";
                    }
                }
            }
            //获取第一张图片
            if(preg_match_all("/(src)=([\"|']?)([^ \"'>]+\.(gif|jpg|jpeg|bmp|png))\\2/i", input('post.editorValue'), $matches)) {
                $firstPic = $matches[3][0];
            }else{
                $randArr = [];
                $dir = opendir('./upload/image/random/');
                while (($file = readdir($dir)) !== false){
                    if($file != '.' && $file != '..'){
                        $randArr[] = $file;
                    }
                }
                closedir($dir);
                $firstPic = '/upload/image/random/'.$randArr[rand(0, count($randArr)-1)];
            }

            $data=[
                'post_title' => input('post.title'),
                'post_content' => input('post.editorValue'),
                'post_category' => input('post.column'),
                'post_date' => date('Y-m-d H:i:s'),
                'post_pic' => $firstPic,
                'tags' => $tagIdStr,
                'status' => input('post.status'),
            ];

            //添加前验证
            $validate = validate('Article');
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }else{
                $posts->save($data);
                echo "<script>window.parent.location.reload();</script>";
            }
        }
    }
    public function edit($id){
        $posts = new Posts_model();
        $info = $posts->where('id', $id)->find();
        $info['post_content'] = str_replace(PHP_EOL, '\r', $info['post_content']);
        $this->assign('info', $info);
        //分类
        $type = new Column_model();
        $res = $type->select();
        $this->assign('column', $res);
        return $this->fetch('edit');
    }
    public function index(){
    }

    /**
     * 百度主动推送url地址
     * @param $url
     * @param string $type 为1时是添加，其余是更新
     */
    public function bdPush($url, $type = '1'){
        if($type == 1){
            $api = 'http://data.zz.baidu.com/urls?site=www.1p1q.com&token=E7NE7p5nNExQ7krk';
        }else{
            $api = 'http://data.zz.baidu.com/update?site=www.1p1q.com&token=E7NE7p5nNExQ7krk';
        }
        $ch = curl_init();
        $options =  array(
            CURLOPT_URL => $api,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => base64_decode($url),
            CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
        );
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        echo $result;
    }
}