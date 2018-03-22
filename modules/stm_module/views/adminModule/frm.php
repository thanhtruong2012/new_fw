<div class="container">
    <form method="post">
        <div class="form-group">
            <div class="col col-12">
                <table class="table table-bordered">
                    <?php if(isset($oData) && !empty($oData)){?>
                        <tbody>
                        <?php if(isset($oColumn) && !empty($oColumn)){?>
                            <?php foreach($oColumn as $keyColumn => $valColumn){?>
                                <tr>
                                    <th class="text-right">
                                        <?php echo $valColumn['COLUMN_NAME']?>
                                    </th>
                                    <td>
                                        <input name="module[<?php echo $valColumn['COLUMN_NAME']?>]" class="form-control" value="<?php echo $oData[$valColumn['COLUMN_NAME']]?>"/>
                                    </td>
                                </tr>
                            <?php }?>
                        <?php }?>
                        </tbody>
                    <?php }?>
                </table>
            </div>
        </div>
        <div class="form-group">
            <div class="col col-12 text-center">
                <button name="btnSave" type="submit" class="btn btn-primary">Save</button>&nbsp;&nbsp;
                <a href="<?php echo $oUrl['back_url']?>" class="btn btn-primary">Back</a>
            </div>
        </div>
    </form>
</div>