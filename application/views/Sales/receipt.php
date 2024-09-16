<!DOCTYPE html>
<html>

<head>
    <title>Podiy - Print Nota</title>
    <style type="text/css">
        html {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .content {
            width: 80mm;
            font-size: 12px;
            padding: 5px;
        }

        .text-sm {
            font-size: 11px;
            font-style: italic;
        }

        .title {
            text-align: center;
            font-size: 13px;
            padding-bottom: 5px;
            border-bottom: 1px dashed;
        }

        .head {
            margin-top: 5px;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid;
        }

        .bottom {
            margin-bottom: 5px;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px dashed;
        }

        table {
            width: 100%;
            font-size: 12px;
        }

        .thanks {
            margin-top: 10px;
            padding-top: 10px;
            text-align: center;
            border-top: 1px dashed;
        }

        .center-text {
            text-align: center;
        }

        .right-text {
            text-align: right;
        }

        .left-text {
            text-align: left;
        }


        .item-table {
            padding-bottom: 10px;
            margin-top: 10px;
            margin-bottom: 10px;
            border-bottom: 1px solid;
        }

        .item-heading {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        @media print {
            @page {
                width: 80mm;
                margin: 0mm;
            }
        }
    </style>
</head>

<body>
    <div class="content">
        <table>
            <tr>
                <td class="center-text" colspan="2">
                    <h2>Point Of Sales</h2>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="head">
                        <table>
                            <tr>
                                <td>Date:</td>
                                <td class="right-text"><?= date("d M Y", strtotime($sale->sale_date)) ?></td>
                            </tr>
                            <tr>
                                <td>Time:</td>
                                <td class="right-text"><?= date("H:i", strtotime($sale->sale_date)); ?></td>
                            </tr>
                            <tr>
                                <td>Customer:</td>
                                <td class="right-text">
                                    <?php
                                    if ($sale->customer_name === 'Umum Perempuan' || $sale->customer_name === 'Umum Laki - Laki') {
                                        echo '-';
                                    } else {
                                        echo $sale->customer_name;
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Cashier:</td>
                                <td class="right-text"><?= $sale->casiher_name ?></td>
                            </tr>
                            <tr>
                                <td>Order ID:</td>
                                <td class="right-text"><?= $sale->invoice ?></td>
                            </tr>

                        </table>
                        <div class="center-text">
                            <hr style="border: 1px dashed">
                            <span class="center-text"><b>Queue No:<?= substr($sale->invoice, 9) ?></b></span>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <table class="item-table">
                    <?php foreach ($sale_detail as $key => $value) { ?>
                        <tr>
                            <td colspan="4" class="left-text"><b><?= $value->item_name ?></b></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="left-text"><?= $value->qty ?> &nbsp;&times; @<?= $value->detail_price ?></td>
                            <td colspan="2" class="right-text"><?= indo_currency($value->sub_price) ?></td>
                        </tr>
                        <?php if ($value->discount_item > 0) : ?>
                            <td colspan="2" class="left-text text-sm">Disc / Item <?= $value->discount_item ?> &#37;</td>
                            <td colspan="2" class="right-text text-sm">- <?= indo_currency($value->disc_total) ?></td>
                        <?php else :
                        endif; ?>
                    <?php } ?>
                </table>
            </tr>
            <tr>
                <td>
                    <table>

                        <tr>
                            <td>Sub Total</td>
                            <td class="right-text"><?= indo_currency($sale->sub_total) ?></td>
                        </tr>
                        <?php if ($sale->disc_total > 0) : ?>
                            <tr>
                                <td>Discount Total</td>
                                <td class="right-text"><?= indo_currency($sale->disc_total) ?></td>
                            </tr>
                        <?php else :
                        endif; ?>
                        <tr>
                            <td>Total</td>
                            <td class="right-text"><?= indo_currency($sale->total_price) ?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <?php if ($sale->payment == 'CASH') : ?>
                        <table class="bottom">
                            <tr>
                                <td>Payment Method</td>
                                <td class="right-text"><?= $sale->payment ?></td>
                            </tr>
                            <tr>
                                <td>Cash</td>
                                <td class="right-text"><?= indo_currency($sale->cash) ?></td>
                            </tr>
                            <tr>
                                <td>Change</td>
                                <td class="right-text"><?= indo_currency($sale->remaining) ?></td>
                            </tr>
                        </table>
                    <?php elseif ($sale->payment == 'POINT') : ?>
                        <table class="bottom">
                            <tr>
                                <td>Payment Method</td>
                                <td class="right-text"><?= $sale->payment ?></td>
                            </tr>
                            <tr>
                                <td>Total Points Used</td>
                                <td class="right-text"><?= $sale->pay_point ?></td>
                            </tr>
                        </table>
                    <?php else : ?>
                        <table class="bottom">
                            <tr>
                                <td>Payment Method</td>
                                <td class="right-text"><?= $sale->payment ?></td>
                            </tr>
                        </table>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="thanks">
                        <p>Thank you for shopping with us!</p>
                        <p class="center-text text-sm">ITEMS THAT HAVE BEEN PURCHASED CANNOT BE EXCHANGED/RETURNED</p>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>