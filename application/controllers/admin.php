<?php

class admin extends MY_controller
{
  

  
 public function welcome()
 {
     $this->load->model('loginmodel','ar');
  $this->load->library('pagination');

  $config=[
        'base_url' => base_url('admin/welcome'),
        'per_page' =>2,
        'total_rows' => $this->ar->num_rows(),
        'full_tag_open'=>"<ul class='pagination'>",
        'full_tag_close'=>"</ul>",
        'next_tag_open' =>"<li>",
        'next_tag_close' =>"</li>",
        'prev_tag_open' =>"<li>",
        'prev_tag_close' =>"</li>",
        'num_tag_open' =>"<li>",
        'num_tag_close' =>"</li>",
        'cur_tag_open' =>"<li class='active'><a>",
        'cur_tag_close' =>"</a></li>"

 ];


  $this->pagination->initialize($config);

 
  $articles=$this->ar->articleList($config['per_page'],$this->uri->segment(3));
  $this->load->view('admin/dashboard',['articles'=>$articles]);
 }

 public function adduser()
 {
    
   $this->load->view('admin/add_article');
  
 }
 public function userValidation()
 {
$config=[
'upload_path'=>'./upload/',
'allowed_types'=>'gif|jpg|png',
];
               
$this->load->library('upload',$config); //upload is a image uplaoding libaray
  if($this->form_validation->run('add_article_rules') && $this->upload->do_upload()) //add_article_rules is declared config method
  {
      $post=$this->input->post(); //take all input of add articles
     
     $data=$this->upload->data();  //upload image by using data variable in $data method means uplaoded image is stred in $data method //means upload imafe in $data method

   

      $image_path=base_url("upload/".$data['raw_name'].$data['file_ext']);  //stored image by using there name and there extension in $image_path
     
        $post['image_path']=$image_path; //stored image by using there name in database in $post variable


      $this->load->model('loginmodel','useradd');
      if($this->useradd->add_articles($post))  //add articles from $post method
      {
         $this->session->set_flashdata('msg','Articles added successfully');
          $this->session->set_flashdata('msg_class','alert-success');
      }
      else
      {
         $this->session->set_flashdata('msg','Articles not added Please try again!!');
         $this->session->set_flashdata('msg_class','alert-danger');
      }
      return redirect('admin/welcome');
}
  else
  {
  $upload_error=$this->upload->display_errors();
  //if error is fiding then stored in $upload_error
  $this->load->view('admin/add_article',compact('upload_error'));
      //compact is a codeigniter php method which stored  error in a varible and display it
  }

 }
 public function edituser($id)
 {
 $this->load->model('loginmodel');
 $article=$this->loginmodel->find_article($id);
 $this->load->view('admin/edit_article',['article'=>$article]);
 }
 public function updatearticle($article_id)
 {
if($this->form_validation->run('add_article_rules'))
  {
      $post=$this->input->post(); 
      //$articleid=$post['article_id'];
      //unset($articleid);
      $this->load->model('loginmodel','editupdate');
      if($this->editupdate->update_article($article_id,$post)) //article_is is a column name
      {
         $this->session->set_flashdata('msg','Article Update successfully');
          $this->session->set_flashdata('msg_class','alert-success');
      }
      else
      {
         $this->session->set_flashdata('msg','Articles not update Please try again!!');
         $this->session->set_flashdata('msg_class','alert-danger');
      }
      return redirect('admin/welcome');
     }
  else
  {
    $this->edituser($article_id); //if false then goes to the edit user method in admin controller (means this method) and $article_id is used for dending on perticular user by using the there id
  }

 }
 public function delarticles()
 {
   $id=$this->input->post('id');
  
    $this->load->model('loginmodel','delarticle');
      if($this->delarticle->del($id))
      {
          $this->session->set_flashdata('msg','Delete Successfully');
          $this->session->set_flashdata('msg_class','alert-success');
      }
      else
      {
         $this->session->set_flashdata('msg','Please try again..not delete');
         $this->session->set_flashdata('msg_class','alert-danger');
      }
      return redirect('admin/welcome');

 }
 public function __construct()
  {
    parent::__construct();
    if( ! $this->session->userdata('id') )
    return redirect('login');
    
  }
  public function logout()
  {
    $this->session->unset_userdata('id');
    return redirect('login');
  }
 

	
}


?>