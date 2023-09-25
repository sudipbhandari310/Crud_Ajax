<tr id="row-<?php echo $row['id']?>">
    <td class="modalId"><?php echo $row['id']?></td>
    <td class="modalName"><?php echo $row['name']?></td>
    <td class="modalColor"><?php echo $row['color']?></td>
    <td class="modalTransmission"><?php echo $row['transmission']?></td>
    <td class="modalPrice"><?php echo $row['price']?></td>
    <td><?php echo $row['created_at']?></td>
    <td>
        <a href="javascript:void(0);" class="btn btn-primary" onclick="showEditForm(<?php echo $row['id']?>)">Edit</a>
    </td>
    <td>
        <a href="#" onclick="confirmDeleteModel(<?php echo $row['id']?>)" class="btn btn-danger">Delete</a>
    </td>


</tr>