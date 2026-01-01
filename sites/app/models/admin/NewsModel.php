<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 07.10.2017
 * Time: 14:42
 */
use Model\IN_Model;
class NewsModel extends IN_Model
{
	public function newscreate()
	{
		$up = $_FILES['logo']['name'];
		$title = filter_var($_POST['title'],FILTER_SANITIZE_STRING);
		$content = filter_var($_POST['content'],FILTER_SANITIZE_STRING);
		$content2 = filter_var($_POST['content2'],FILTER_SANITIZE_STRING);
		if ($up == "" || $title == "" || $content == "")
			$result['result'] = false;
		else{
			$upload = $this->upload->image_upload($_FILES['logo']);
			if ($upload["result"] === false)
				$result['result'] = false;
			else
			{
				Cache::delete('patch');
				$tarih = date("Y-m-d H:i:s");
				$this->db->insert('patch',array('title'=>$title,'content'=>$content,'image'=>$upload['paths'],'tarih'=>$tarih,'content2'=>$content2));
				$result['result'] = true;
			}
		}
		echo json_encode($result);
	}
	public function newslist()
	{
		return $this->db->select('id,title,tarih')->table('patch')->get();
	}
	public function delete($arg){
		$this->db->delete('patch',array('id'=>$arg));
		Session::set('changeOK',true);
		URI::redirect('news/liste');
	}
	public function shopnewscreate()
	{
		$image = $_POST['link'];
		$title = $_POST['title'];
		$content = $_POST['content'];
		if ($image === '' || $title === '' || $content === '')
			$result['result'] = false;
		else
		{
			$this->db->insert('banner',['type'=>0,'image'=>$image,'title'=>$title,'content'=>$content]);
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function shopnewscreated()
	{
		$image = $_POST['link'];
		$title = $_POST['title'];
		$content = $_POST['content'];
		if ($image === '' || $title === '' || $content === '')
			$result['result'] = false;
		else
		{
			$this->db->update('banner',['image'=>$image,'title'=>$title,'content'=>$content],['type'=>1]);
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function shopnewslist()
	{
		 return $this->db->select()->table('banner')->where(['type'=>0])->get();
	}
	public function shopdelete($arg){
		$this->db->delete('banner',array('id'=>$arg));
		Session::set('changeOK',true);
		URI::redirect('news/shopnewslist');
	}
	
	public function patchernewscreate()
	{
		$label = $_POST['label'];
		$title = $_POST['title'];
		$url = $_POST['link'];
		if ($label === '' || $title === '' || $url === '')
			$result['result'] = false;
		else
		{
			$this->db->insert('autopatcher',['type'=>'HABER','label'=>$label,'title'=>$title,'url'=>$url]);
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function patcherslidercreate()
	{
		$image = $_POST['image'];
		if ($image === '')
			$result['result'] = false;
		else
		{
			$this->db->insert('autopatcher',['type'=>'SLIDER','image'=>$image]);
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function patcherlinkcreate()
	{
		$title = $_POST['title'];
		$url = $_POST['link'];
		$content = $_POST['content'];
		if ($title === '' || $url === '' || $content === '')
			$result['result'] = false;
		else
		{
			$this->db->insert('autopatcher',['type'=>'MENU','title'=>$title,'url'=>$url,'content'=>$content]);
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function patchernewslist()
	{
		 return $this->db->select()->table('autopatcher')->where(['type'=>'HABER'])->get();
	}
	public function patchersliderlist()
	{
		 return $this->db->select()->table('autopatcher')->where(['type'=>'SLIDER'])->get();
	}
	public function patcherlinklist()
	{
		 return $this->db->select()->table('autopatcher')->where(['type'=>'MENU'])->get();
	}
	public function patcherdelete($arg){
		$this->db->delete('autopatcher',array('id'=>$arg));
		Session::set('changeOK',true);
		URI::redirect('news/patchernewslist');
	}
}