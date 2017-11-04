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
<h1>Olá <?php echo $uid = $this->Session->read('Auth.User.username'); ?></h1>
<h1>Blog posts</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Action</th>
        <th>Created</th>
        <th>Creator</th>
    </tr>
<!-- Here's where we loop through our $posts array, printing out post info -->
<?php //debug($posts); ?>
<?php foreach ($posts as $post): ?>
    <tr>
        <td><?php echo $post['Post']['id']; ?></td>
        <td>
            <?php
                echo $this->Html->link(
                    $post['Post']['title'],
                    array('action' => 'view', $post['Post']['id'])
                );
            ?>
        </td>
        <td>
            <?php
                echo $this->Form->postLink(
                    'Delete',
                    array('action' => 'delete', $post['Post']['id']),
                    array('confirm' => 'Are you sure?')
                );
            ?>
            <?php
                echo $this->Html->link(
                    'Edit',
                    array('action' => 'edit', $post['Post']['id'])
                );
            ?>
        </td>
        <td>
            <?php echo $post['Post']['created']; ?>
        </td>
        <td>
            <?php echo $post['User']['username']; ?>
        </td>
    </tr>
<?php endforeach; ?>

</table>
<?php  echo $this->Paginator->numbers(array('first' => 'First page')); ?>
</br>

