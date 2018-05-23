    <table cellspacing="0" style="width: 100%;">
        <tr>
            <td rowspan="3" style="width: 40%; color: #444444;">
                <img style="width: 100%;" src="<?php echo URL_VIEW.'bootstrap-default/img/logo.png' ?>" alt="Logo">
            </td>
            <td  style="width: 45%; color: #000;font-size:11px;text-align: right;">
                <p style="margin:0"><?php echo $desde; ?> </p>
            </td>
            <td  style="width: 15%; color: #000;font-size:11px;text-align: left;">
                <p style="margin:0"><?php echo $date1;?></p>
            </td>           
        </tr>
        <tr>
            <td  style="width: 45%; color: #000;font-size:11px;text-align: right;">
                <p style="margin:0"><?php echo $hasta; ?></p>
            </td>
            <td  style="width: 15%; color: #000;font-size:11px;text-align: left;">
                <p style="margin:0"><?php echo $date2;?></p>
            </td>           
        </tr>
        <tr>
			<td  style="width: 45%; color: #000;font-size:11px;text-align: right;">
                <p style="margin:0"><?php echo $lbl_nivel.' : '; ?></p>
            </td>
            <td  style="width: 15%; color: #000;font-size:11px;text-align: left;">
                <p style="margin:0"><?php echo $return_nivel;?></p>
            </td>			
        </tr>
        <tr>
            <td colspan="3" style="color: #000;font-size:14px;text-align: center;font-weight: bold;padding-top: 10px">
                <?php echo $reporte_title;?>
            </td>
        </tr>

    </table>

