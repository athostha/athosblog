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
<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->input('role', array(
            'options' => array('admin' => 'Admin', 'author' => 'Author')
        ));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>