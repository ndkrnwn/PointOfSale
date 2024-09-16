<?php $no = 1;
if ($cart !== null && count($cart) > 0) {
    foreach ($cart as $c => $data) { ?>
        <tr>
            <td><?= $no++ ?>.</td>
            <td class="item"><?= $data->item_name ?></td>
            <td><?= $data->item_price ?> </td>
            <td><?= $data->qty ?> </td>
            <td><?= $data->item_point ?></td>
            <td id="totalpoint"><?= $data->total_point ?></td>
            <td><?= $data->discount_item ?>%</td>
            <td id="subtotal"><?= $data->sub_price ?></td>
            <td id="disctotal"><?= $data->disc_total ?></td>
            <td id="totalprice"><?= $data->total_price ?> </td>
            <td class="text-center" width="150px">
                <button data-toggle="modal" <?php if ($data->item_type == 'product') { ?> data-target="#product-edit-modal-cart" id="update_cart_product" <?php } else { ?> data-target="#service-edit-modal-cart" id="update_cart_service" <?php } ?> data-id="<?= $data->cart_id ?>" data-item-name="<?= $data->item_name ?>" data-item-price="<?= $data->item_price ?>" data-item-qty="<?= $data->qty ?>" data-item-stock="<?= $data->stock ?>" data-item-discount="<?= $data->discount_item ?>" data-disc-total="<?= $data->disc_total ?>" data-subtotal="<?= $data->sub_price ?>" data-total="<?= $data->total_price ?>" data-item-point="<?= $data->item_point ?>" data-total-point="<?= $data->total_point ?>" class="btn btn-xs btn-outline-primary" data-toggle="tooltip" title="Edit">
                    <i class="fas fa-pencil-alt"></i>
                </button>
                <button id="del_cart" data-id="<?= $data->cart_id ?>" class="btn btn-xs btn-outline-danger" data-toggle="tooltip" title="Delete">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
<?php }
} else {
    echo '<tr> <td colspan="9" class="text-center">No data available in table </td> </tr>';
} ?>