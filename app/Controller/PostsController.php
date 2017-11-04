<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppController', 'Controller');
class PostsController extends AppController {
    public $helpers = array('Html', 'Form');
    
    

    public function isAuthorized($user) {
        // All registered users can add posts
        if ($this->action === 'add') {
            return true;
        }

        // The owner of a post can edit and delete it
        if (in_array($this->action, array('edit', 'delete'))) {
            $postId = (int) $this->request->params['pass'][0];
            if ($this->Post->isOwnedBy($postId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }
    
    public $components = array('Paginator');

    public $paginate = array(
        'limit' => 5,
        'order' => array(
            'Post.id' => 'asc'
        )
    );
    public function index() {
        //$this->set('posts', $this->Post->find('all', 
                //array('conditions'=>array('user_id'=> $this->Auth->user('id')))));
        $this->Paginator->settings = $this->paginate;

    // similar to findAll(), but fetches paged results
        $posts = $this->Paginator->paginate('Post',
            array('User.id' => $this->Auth->user('id')));
        $this->set('posts', $posts);
        
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('post', $post);
    }
    public function add() {
        if ($this->request->is('post')) {
            $this->request->data['Post']['user_id'] = $this->Auth->user('id');
            
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success(__('Your post has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add your post.'));
        }
    }
    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Post->id = $id;
            if ($this->Post->save($this->request->data)) {
              $this->Flash->success(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your post.'));
        }

        if (!$this->request->data) {
            $this->request->data = $post;
        }
    }
    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Post->delete($id)) {
            $this->Flash->success(
                __('The post with id: %s has been deleted.', h($id))
            );
        } else {
            $this->Flash->error(
                __('The post with id: %s could not be deleted.', h($id))
            );
        }

        return $this->redirect(array('action' => 'index'));
        
    }
    public function search($tipo = null){
        if($tipo == 'new'){
            $this->Session->delete('busca.titulo', 'busca.corpo');
            //$this->Paginator->settings = $this->paginate;
        
            //$posts = $this->Paginator->paginate('Post',
           //array('User.id' => 0));
            //$this->set('posts', $posts);
        }
        
        
        //Se o formulário for enviado
        if($this->request->is('post')){
            
            //Salvando os dados do formulário na sessão
            $this->Session->write('busca.titulo', $this->request->data('search.title'));
            $this->Session->write('busca.corpo', $this->request->data('search.body'));
            //return $this->redirect(array('action' => 'search'));
            
        }
        
        if($this->Session->check('busca.titulo') && $this->Session->check('busca.corpo')) {
            
            $this->Paginator->settings = $this->paginate;
        
            $posts = $this->Paginator->paginate('Post',
            array('User.id' => $this->Auth->user('id'),
                'title LIKE' => '%'.$this->Session->read('busca.titulo').'%',
                'body LIKE' => '%'.$this->Session->read('busca.corpo').'%'));

            $this->set('posts', $posts);
        }
        
    }
    
}

