<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * This is Main Controller .. All controller extended from this class
 * @author	Hamid Pourhashemi
 */
class MY_Controller extends CI_Controller {
    protected $user;
    public $link;
    protected $error;
    protected $bu;
    protected $indexphp;

    public function __construct(){
        parent::__construct();
        $this->indexphp = "index.php";
        // $this->bu = 'http://mehr.academy/``';
        $this->bu = 'http://localhost:8181/mehrre/';
        $js_url = $this->bu . 'client/assets/js/';
        $this->link = array(
          'base' => $this->bu . $this->indexphp . '/',
          'admin' => $this->bu . $this->indexphp . '/admin/',
          'pageLink' => $this->bu . $this->indexphp . '/page?name=',
            'panelAssets'=> $this->bu  . '/panel/assets/',
            'firstpart' => $this->bu . $this->indexphp . '/',
            'panel' => $this->bu . $this->indexphp . '/' . "panel/",
            'file' => $this->bu . '',
            'no_image_available_pic' => $this->bu . '/file/image/' . "No_Image_Available.png"

        );
        $this->link['dashboard']=$this->link['pageLink']."dashboard";
        $this->link['login']=$this->link['pageLink']."signup";
        $this->link['signup']=$this->link['pageLink']."signup";
        $this->link['forgotpassword']=$this->link['pageLink']."signup";
        $this->link['logout']=$this->link['pageLink']."logout";
        $this->link['ajax']= array(
          'editItem'=>$this->link['admin']."ajaxEditItem",
          'ajaxAddItem'=>$this->link['admin']."ajaxAddItem",
          'ajaxEditItem'=>$this->link['admin']."ajaxEditItem",
          'api'=>$this->link['base']."api",

        'routadmin'=>  "panel/ajax/admin/"
        );
          $this->user=array(
            "id"=>'',
            "email"=>'',
            "name"=>'',
            "logined"=>0,
            "activation"=>0,
            "phone_prefix"=>'',
            "phone"=>'',
            "avatar"=>'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7d/Irancell_Logo.gif/250px-Irancell_Logo.gif'
                  );

                  $this->load->library("usermanage");

            if($this->usermanage->checkLogin()){
              $uaserRow=$this->usermanage->getUserBySession();
              if(isset($uaserRow) && count($uaserRow) > 0){
                foreach ($uaserRow as $key => $value) {

                  $this->user=array(
                    "user_id"=>$value->user_id,
                    "email"=>'',
                    "name"=>$value->user_name,
                    "logined"=>1,
                    "activation"=>$value->user_activation,
                    "phone_prefix"=>$value->user_phone_prefix,
                    "phone"=>$value->user_phone,
                    "avatar"=>'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7d/Irancell_Logo.gif/250px-Irancell_Logo.gif'
                          );


                }
              }


            }


          }

          public function render($view_name="home",$data=array(),$them="") {
            $this->load->library('menu');
              $data['link'] = $this->link;
              $data['user'] = $this->user;
            if($them=="client"){

                }elseif($them=="admin"){

                }elseif($them=="panel"){

                }else{

                  $this->load->view('panel/header', $data);
                  $this->menu->getmenu($data);
                  $this->load->view('panel/'.$view_name, $data);
                  $this->load->view('panel/footer', $data);

                }



              }

                // ***********

                public function renderPage($view_name="home",$data=array()) {
                  $this->load->library('menu');
                  $this->load->library('pager');
                    $data['link'] = $this->link;
                    $data['user'] = $this->user;
                  $pageItem=  $this->pager->load($view_name, $data);
                      if(isset($pageItem) && count($pageItem)>0){
                        $data['pageOption']['title']=$pageItem['item_name'];
                        $data['pageOption']['description']=$pageItem['item_description'];
                      }
                      $data['thisIncdata']=array();
                        $this->load->view('panel/header', $data);
                        $this->menu->getmenu($data);
                        if(isset($pageItem) && count($pageItem) > 0){
                        foreach ($pageItem['inc'] as $keyInc => $valueInc) {
                          $data['thisIncdata']=$valueInc;
                          $this->load->view($valueInc['value'], $data);
                        }
                      }
                        $this->load->view('panel/footer', $data);





                    }

                      // ***********



// ****End c
    }
