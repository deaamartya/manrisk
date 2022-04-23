<page backtop="2mm" backbottom="5mm" backleft="5mm" backright="5mm"> 
    <table cellspacing="0" width="985">
    	<tr>
    		<td width="240" style="border-left: 1px; border-top: 1px; font-size:12px; " align="center" valign="middle">
    			<img src="../images/logo_bumn.png" style="width:120px;">
    		</td>
    		<td width="505" height="40" style="border-right: 1px;border-left: 1px; border-top: 1px; font-size:14px; padding-left: 10px; padding-right: 10px; line-height: 2px; padding-top: 5px; padding-bottom: 5px;" align="center" valign="middle">
    			<b>Hasil Kompilasi Risiko</b>
                <p>PI - PAL Indonesia Tahun 2022 </p>
    		</td>
    		<td width="240" style="border-right: 1px; border-top: 1px;" align="center" valign="middle">
    			<img src="../images/logo_pal.png" style="width:90px;">
    		</td>
    	</tr>
    </table>
    <table cellspacing="0" width="997">
    	<tr>
    		<td width="40" style="border-left: 1px; border-top: 1px; font-size:14px; font-weight: bold; text-align: center; border-bottom: 1px;" align="center" valign="middle">
    			No
    		</td>
            <td width="194" style="border-left: 1px; border-top: 1px; font-size:14px; font-weight: bold; text-align: center; border-bottom: 1px;" align="center" valign="middle">
                Konteks Organisasi
            </td>
    		<td width="524" style="border-left: 1px; border-top: 1px; font-size:14px; padding-left: 10px;font-weight: bold; text-align: center; border-bottom: 1px;" align="center" valign="middle">
    			Sumber Risiko
    		</td>
    		<td width="75" style="border-left: 1px; border-top: 1px; font-size:14px; font-weight: bold; text-align: center; border-bottom: 1px;" align="center" valign="middle">
    			L
    		</td>
    		<td width="76" style="border-left: 1px; border-top: 1px; border-right: 1px; font-size:14px; font-weight: bold; text-align: center; border-bottom: 1px;" align="center" valign="middle">
    			C
    		</td>
            <td width="76" style="border-top: 1px; border-right: 1px; font-size:14px; font-weight: bold; text-align: center; border-bottom: 1px solid;" align="center" valign="middle">
                R
            </td>
    	</tr>
    </table>
    <table cellspacing="0" width="997">
        <?php
        $no = 1;
        while ($data = mysqli_fetch_array($sql3)) { 
            ?>
            <tr>
                <td width="40" style="border-left: 1px; border-bottom: 1px;font-size:14px; text-align: center;" align="center" valign="middle">
                    <?php echo $no++; ?>
                </td>
                <td width="194" style="border-left: 1px; border-bottom: 1px; font-size:14px;" align="left" valign="middle">
                   <b> <?php echo $data['id_risk']; ?></b> - <?php echo $data['konteks']; ?>
                </td>
                <td width="524" style="border-left: 1px; border-bottom: 1px; font-size:14px; padding-left: 10px;" align="left" valign="middle">
                    <?php echo $data['s_risiko']; ?>
                </td>
                <td width="75" style="border-left: 1px; border-bottom: 1px; font-size:14px; " align="center" valign="middle">
                    <?php echo round($data['l'],2); ?>
                </td>
                <td width="76" style="border-left: 1px; border-bottom: 1px; border-right: 1px; font-size:14px;" align="center" valign="middle">
                    <?php echo round($data['c'],2); ?>
                </td>
                <td width="76" style="border-bottom: 1px; font-size:14px;border-right: 1px;" align="center" valign="middle">
                    <?php echo number_format($data['l']*$data['c'],2); ?>
                </td>
            </tr>
        <?php }
        ?>
            
    </table>
</page> 