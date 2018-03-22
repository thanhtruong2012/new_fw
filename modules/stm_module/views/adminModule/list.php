<div class="container-fluid">
    <div class="row">
        <div class="col col-lg-2">
            <form action="<?php echo $oUrl['form_url']?>" method="post">
                <div class="card">
                    <div class="card-header">
                        Search
                    </div>
                    <?php if(isset($oColumn) && !empty($oColumn)){?>
                        <?php foreach($oColumn as $keyColumn => $valColumn){?>
                            <div class="form-group">
                                <div class="col col-lg-12">
                                    <label for="exampleInputEmail1"><?php echo $valColumn['COLUMN_NAME']?></label>
                                    <input class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                            </div>
                        <?php }?>
                    <?php }?>
                    <div class="card-footer">
                        <button class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col col-lg-10">
            <div class="table-responsive-lg">
                <table class="table table-bordered">
                    <?php if(isset($oColumn) && !empty($oColumn)){?>
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col"><input type="checkbox"/></th>
                            <?php foreach($oColumn as $keyColumn => $valColumn){?>
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
                                    <input type="checkbox" value="<?php echo $valData['module_id']?>"/>
                                </td>
                                <?php if(isset($oColumn) && !empty($oColumn)){?>
                                    <?php foreach($oColumn as $keyColumn => $valColumn){?>
                                        <td><?php echo $valData[$valColumn['COLUMN_NAME']]?></td>
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
            </div>
        </div>
    </div>
</div>

