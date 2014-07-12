<?php
class CommunityController extends AppController {
	
	public $uses = array('Forum','Forumpost');
	
	public function index() {
		$forums = $this->Forum->find('all');
		$this->set('forums',$forums);
	}
	
	public function view($forum_id) {
		$forum = $this->Forum->findById($forum_id);
		$forumposts = $this->Forumpost->find('all',array('conditions'=>array('forum_id'=>$forum_id,'parent_id'=>0),'order'=>array('created'=>'desc')));
		$this->set('forum',$forum);
		$this->set('forumposts',$forumposts);
		if ($this->request->is('post')) {
            $this->Forumpost->create();
            $data = $this->request->data;
            $data['user_id'] = $this->user['id'];
            $data['parent_id'] = 0;
            $data['forum_id'] = $forum_id;
            if ($this->Forumpost->save($data)) {
                $this->Session->setFlash(__('Your topic has been posted'));
                $this->redirect( $this->referer() );
            }
            $this->Session->setFlash(
                __('We could not add this topic')
            );
        }
	}
	
	public function viewpost($post_id) {
		$post = $this->Forumpost->findById($post_id);
		if(empty($post)) {
			echo 'bad post id';
			die();
		}
		if ($this->request->is('post')) {
            $this->Forumpost->create();
            $data = $this->request->data;
            $data['user_id'] = $this->user['id'];
            $data['parent_id'] = $post_id;
            $data['forum_id'] = $post['Forumpost']['forum_id'];
            if ($this->Forumpost->save($data)) {
                $this->Session->setFlash(__('Your reply has been posted'));
                $this->redirect( $this->referer() );
            }
            $this->Session->setFlash(
                __('We could not add this reply at this time')
            );
        }
		$forum = $this->Forum->findById($post['Forumpost']['forum_id']);
		$replies = $this->Forumpost->find('all',array('conditions'=>array('forum_id'=>$post['Forumpost']['forum_id'],'parent_id'=>$post_id),'order'=>array('created'=>'asc')));
		$this->set('forum',$forum);
		$this->set('post',$post);
		$this->set('replies',$replies);
	}
}
?>