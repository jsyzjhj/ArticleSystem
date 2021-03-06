<?php
namespace Admin\Controller;
use Think\Controller;
class CategoryController extends BaseController {
public function getlist(){
        $linkList = M('category') -> select();
        // var_dump($linkList);
        // die();
        $this->assign('linkList',$linkList);
        $this->display();
    }

    public function add(){
        if (IS_POST) {
            $mess['id']=I('post.id');
            $mess['name']=I('post.name');
            $addMess=M('category')->add($mess);
            // var_dump($addMess);
            // die();
            if ($addMess) {
                $this->success('添加成功！',U('getlist','date(now)'));
            } else {
                $this->error('添加失败！');
            }
            
        } else {
            $this->display();
        }
        
    }

    public function edit(){
        if (IS_POST) {
            $where['id']=I('get.id');
            $mess['name']=I('post.name');
            $saveMess=M('category')->where($where)->save($mess);
            // var_dump($saveMess);
            // die();
            if ($saveMess) {
                $this->success('修改成功！',U('getlist','date(now)'));
            } else {
                $this->error('内容不变，修改失败！');
            }
        } else {
            $where['id']=I('get.id');
            $updatemess=M('category')->where($where)->find();
            // var_dump($updatemess);
            // die();
            if ($updatemess) {
                $this->assign('updatemess',$updatemess);
                $this->display();
            } else {
                $this->error('不存在该记录');  
            }       
        }
        
    }

    public function del(){
        $where['id']=I('get.id');
        $delMess=M('category')->where($where)->delete();
        if ($delMess) {
            $this->success('删除成功！',U('getlist','date(now)'));
        } else {
            $this->error('删除失败！');
        }
        
        
    }
}