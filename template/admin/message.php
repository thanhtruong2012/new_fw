<?php if($actMessage->hasMessages($actMessage::SUCCESS)||
        $actMessage->hasMessages($actMessage::ERROR)||
        $actMessage->hasMessages($actMessage::INFO)||
        $actMessage->hasMessages($actMessage::WARNING)){?>
<div class="fix-top fixed-top">
<?php $actMessage->display()?>
</div>
<?php } ?>
<script type="text/javascript">
    $(document).ready(function(){
        setTimeout(function(){
            $(".fix-top").fadeOut(500);
        },2000);
    });
</script>

