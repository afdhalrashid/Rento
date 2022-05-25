<style>
    address {
        text-align: left;
    }

    address>span {
        text-align: left;
        display: inline-block;
    }

</style>

<span class="align-middle"> </span>
<div> </div>
<div></div>
<input name="house_id" type="hidden" value="<?php echo e($house->id); ?>">
<address class="my-3">
    <span>
        <?php echo e($house->address1); ?>, <?php echo e($house->address2); ?>,<br />
        <?php echo e($house->poskod); ?>, <?php echo e($house->daerah); ?>,<br />
        <?php echo e($house->parameter_state->type_name); ?><br />
    </span>
</address>
<?php /**PATH F:\Projects\LaravelProject\Rento\System\rento\resources\views/layouts/houseprofile2.blade.php ENDPATH**/ ?>