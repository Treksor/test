<tr>
    <td>{$ad->getId()}</td>
    <td>{$ad->getUserName()}</td>
    <td>{$ad->getAddName()}</td>
    <td>{$ad->getPrice()}</td>
    <td><a class="btn btn-warning" href="../index.php?action=open&id={$ad->getId()}">Открыть</a><a class="delete btn btn-warning"> Удалить</a></td>
</tr>