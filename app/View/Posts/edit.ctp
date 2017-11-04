<nav>
    <ul>
        <li><?php echo $this->Html->link(
        'Página inicial',
        array('controller' => 'posts', 'action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(
    'Add User',
    array('controller' => 'users', 'action' => 'add')
); ?></li>
        <li><?php echo $this->Html->link(
    'Add Post',
    array('controller' => 'posts', 'action' => 'add')
); ?></li>
        <li><?php echo $this->Html->link(
        'Search',
        array('controller' => 'posts', 'action' => 'search', 'new')); ?></li>
        <li><?php echo $this->Html->link(
    'log out',
    array('controller' => 'users', 'action' => 'logout')
    
); ?></li>
    </ul>
</nav>
<h1>Edit Post</h1>
<?php
echo $this->Form->create('Post');
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows' => '3'));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Save Post');
?>