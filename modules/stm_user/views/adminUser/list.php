<?php
    $col_continue = array('created_at','created_by','updated_at','updated_by');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col col-lg-2">
            <a href="<?php echo $oUrl['create_url']?>"  class="btn btn-block btn-success m_bottom_10">Add</a>
            <form action="<?php echo $oUrl['form_url']?>" method="get">
                <div class="card">
                    <div class="card-header">
                        Search
                    </div>
                    <?php if(isset($oColumn) && !empty($oColumn)){?>
                        <?php foreach($oColumn as $keyColumn => $valColumn){?>
                            <div class="form-group">
                                <div class="col col-lg-12">
                                    <label for="<?php echo $valColumn['COLUMN_NAME']?>"><?php echo $valColumn['COLUMN_NAME']?></label>
                                    <input class="form-control" name="<?php echo $valColumn['COLUMN_NAME']?>" >
                                </div>
                            </div>
                        <?php }?>
                    <?php }?>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>

        </div>
        <div class="col col-lg-10">
            <div class="table-responsive-lg">

                <?php if (isset($oPagin) && !empty($oPagin)) { ?>
                    <div class="text-right">
                        <?php echo  $oPagin->html ?>
                    </div>
                <?php } ?>
                <table class="table table-bordered table-hover">
                    <?php if(isset($oColumn) && !empty($oColumn)){?>
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">
                                <input type="checkbox" class="sbchk_custom" id="check_all">
                                <label for="check_all"></label>
                            </th>
                            <?php foreach($oColumn as $keyColumn => $valColumn){
                                if(in_array($valColumn['COLUMN_NAME'],$col_continue)){continue;}                                
                                ?>
                                <th scope="col"><?php echo $valColumn['COLUMN_NAME']?></th>
                            <?php }?>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                    <?php }?>

                    <?php if(isset($oData) && !empty($oData)){?>
                        <tbody>
                        <?php foreach ($oData as $keyData => $valData){ ?>
                            <tr>
                                <td>
                                    <input type="checkbox" class="sbchk_custom" id="<?php echo $valData['user_id']?>">
                                    <label for="<?php echo $valData['user_id']?>"></label>
                                </td>
                                <?php if(isset($oColumn) && !empty($oColumn)){?>
                                    <?php foreach($oColumn as $keyColumn => $valColumn){
                                        if(in_array($valColumn['COLUMN_NAME'],$col_continue)){continue;}                                
                                        ?>
                                        <td ><?php echo $valData[$valColumn['COLUMN_NAME']]?></td>
                                    <?php }?>
                                <?php }?>
                                <td>
                                    <a href="<?php echo $valData['edit_url']?>" class="btn btn-warning">Edit</a>
                                    <a href="<?php echo $valData['delete_url']?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php }?>
                        </tbody>
                    <?php }?>
                </table>
                <?php if (isset($oPagin) && !empty($oPagin)) { ?>
                    <div class="text-right">
                        <?php echo  $oPagin->html ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

