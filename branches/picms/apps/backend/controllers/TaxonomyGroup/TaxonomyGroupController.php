<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Admin
 * Date: 27/11/2012
 * Time: 10:29
 * To change this template use File | Settings | File Templates.
 */
class TaxonomyGroupController extends BackendController
{
    public $url_path = '';
    public $taxonomy = '';
    public $taxonomy_group = '';
    public function beforeExecute(){
        $this->url_path = Ming_Factory::getDocument()->getBaseUrl().'taxonomy_group';
        $this->taxonomy_group = new TaxonomyGroup();
        $this->taxonomy = new Taxonomy();
    }
    public function executeDefault() {
        $datas  = $this->taxonomy_group->findAll();

        $this->view()->assign('taxo_groups',$datas);
    }

    public function executeAdd(){
        $this->setView('add');
        $valid = array();


        if($this->getRequest()->getMethod() == 'POST'){
            $title = $this->getRequest()->post('title');
            $taxonomys = $this->getRequest()->post('taxonamys');

            if(!$title || $title == ''){
                $valid[] = 'title không được trống';
            }
            if($taxonomys && trim($taxonomys)!=''){
                /*nếu có dấu , thì là nhiều ko thì là 1*/
                if(strpos($taxonomys,',')){
                    $taxonomys_array = explode(',',$taxonomys);
                }else{
                    $taxonomys_array[] = $taxonomys;
                }
                $taxonomy_data = array();
                foreach ($taxonomys_array as $taxonomy){
                    $taxonomy_data[] = $this->taxonomy->findOne('title,slug,description',array('title'=>"$taxonomy"));
                }
            }
            if(true == empty($valid)){
                $array = array(
                    'title'=>$title,
                    'taxonomys'=>$taxonomy_data
                );
                $this->taxonomy_group->insert($array);
                $this->getRequest()->redirect($this->url_path);
            }
        }
    }
    public function executeRemove(){
        $mongoId = $this->getRequest()->get('id');
        $this->taxonomy_group->delete($mongoId);
        $this->getRequest()->redirect($this->url_path);
    }
    public function executeEdit(){
        $this->setView('edit');
        $mongoId = $this->getRequest()->get('id');
        $taxo = $this->taxonomy->findOneByID('title,description',$mongoId);

        $this->view()->assign('taxo',$taxo);
        if($this->getRequest()->getMethod() == 'POST'){
            $data = array(
                'title'=>  $this->getRequest()->post('title'),
                'description' => $this->getRequest()->post('description'),
            );
            $this->taxonomy->update($mongoId, $data);
            $this->getRequest()->redirect($this->url_path);
        }
    }
   
}