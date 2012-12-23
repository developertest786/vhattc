<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Admin
 * Date: 27/11/2012
 * Time: 10:29
 * To change this template use File | Settings | File Templates.
 */
class TaxonomyController extends BackendController
{
    public $url_path = '';
    public $taxonomy = '';
    public function beforeExecute(){
        $this->url_path = Ming_Factory::getDocument()->getBaseUrl().'taxonomy';
        $this->taxonomy = new Taxonomy();

    }
    public function executeDefault() {
        $this->view()->assign('taxos',$this->taxonomy->findAll());
    }

    public function executeAdd(){
        $this->setView('add');
        $valid = array();


        if($this->getRequest()->getMethod() == 'POST'){
            $title = $this->getRequest()->post('title');
            $description = $this->getRequest()->post('description');

            if(!$title || $title == ''){
                $valid[] = 'title không được trống';
            }
            $slug = $this->taxonomy->generateSlug($title);
            $data = $this->taxonomy->findOne('title',array('slug'=>"$slug"));

            if(!empty($data)){
                $valid[] = 'slug phải là duy nhất';
            }

            if(empty($valid)){
                $array = array(
                    'title'         =>$title,
                    'slug'          =>$slug,
                    'description'   =>$description
                );
                $this->taxonomy->insert($array);
                $this->getRequest()->redirect($this->url_path);
            }else{
                $this->view()->assign('valid',$valid);
            }
        }
    }
    public function executeRemove(){
        $mongoId = $this->getRequest()->get('id');
        $this->taxonomy->delete($mongoId);
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