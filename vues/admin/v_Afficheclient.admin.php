<div style="display: flex; justify-content: center;" class="aymanleplubo">

<table width=90%  border='2'>
<?php foreach ($LesNoms as $ligne): ?>
    <tr>
        <td><?php echo $ligne['nom']; ?></td>
    </tr>
<?php endforeach; ?>
</table>
</div>