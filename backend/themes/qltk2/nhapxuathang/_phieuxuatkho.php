<?php
/**
 * Created by PhpStorm.
 * User: hungd
 * Date: 11/7/2016
 * Time: 10:32 AM
 * @var $noidungin string
 *
 */?>

<style>
    @page {
        /* dimensions for the whole page */
        size: A5 landscape;

        margin: 0.75cm;
    }
    @media print {
        .newpage {
            page-break-after: always;
            height: 270mm;
            position: relative;
        }

        .print-foot {
            position: absolute; bottom: 0px; right: 0px;
        }
        table{
            font-family: "Times New Roman";
        }

        table td{
            font-weight: normal;
        }

        table td,
        table th{
            padding: 5px 2px;
        }
        table th{
            text-align: center;
        }

        .text-center{
            text-align: center;
        }
        .text-right{
            text-align: right;
        }
    }

</style>

<div class="newpage">
    <?=$noidungin?>
</div>
